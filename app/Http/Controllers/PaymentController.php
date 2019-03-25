<?php
namespace App\Http\Controllers;

use App\Ticket;
use App\UsersMetum;
use App\PaypalPayment;
use App\Mail\OrderPlaced;
use Illuminate\Support\Facades\DB;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;


/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }
    public function saveBillingData(Request $request)
    {
        $user_id=$request->user()->id;
    $charges=(int)$request->get('charges');
    $quantity=(int)$request->get('quantity');
    $total=$charges*$quantity;
    $event_id=$request->get('event_id');
    $event_name=$request->get('event_name');

        $users=new UsersMetum(array(
            'user_id'=>$user_id,
            'name' =>$request->get('name'),
            'email'=>$request->get('email'),
            'phone'=>$request->get('phone'),
        ));
        $users->save();
        return redirect('/ticketpurchase')->with(['charges'=>$total, 'Event'=>$event_name, 'Event_id'=>$event_id, 'quantity'=>$quantity]);

    }
    public function index()
    {
        return view('paywithpaypal');
    }
    public function payWithpaypal(Request $request)
    {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $event_id=$request->get('event_id');
        $quantity=$request->get('quantity');

        $item_1 = new Item();

        $item_1->setName($request->get('event')) /** event name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status/'.$event_id.'/'.$quantity)) /** Specify return URL **/
        ->setCancelUrl(URL::to('status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return Redirect::to('/');

            } else {

                \Session::put('error', 'Some error occurred, sorry for the inconvenience, please proceed to contact site Admin');
                return Redirect::to('/');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Unknown error occurred');
        return Redirect::to('/');

    }

    public function getPaymentStatus($event_id, $quantity)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            \Session::put('error', 'Payment failed');
            return Redirect::to('/');

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            //transaction data
            $txn_id = $result->id;
            $state = $result->state;
            $payerFirstName = $result->payer->payer_info->first_name;
            $payerLastName = $result->payer->payer_info->last_name;
            $payerName = $payerFirstName.' '.$payerLastName;
            $payerID = $result->payer->payer_info->payer_id;
            $payerEmail = $result->payer->payer_info->email;
            $payerCountryCode = $result->payer->payer_info->country_code;
            $paidAmount = $result->transactions[0]->amount->total;
            $currency = $result->transactions[0]->amount->currency;


            $ticket_id=uniqid();
            $user_id=Auth::user()->id;


            // save order data to Titec
                $order = new Ticket(array(
                    'ticket_id' =>$ticket_id,
                    'event_id' =>$event_id,
                    'quantity' =>$quantity,
                    'charges' =>$paidAmount,
                    'user_id' =>$user_id
                ));
                $order->save();


            //save PayPal payment data to DB
            $paymentdata=new PaypalPayment(array(
                'user_id'=>$user_id,
                'ticket_id'=>$ticket_id,
                'event_id' =>$event_id,
                'txn_id'=>$txn_id,
                'payment_gross'=>$paidAmount,
                'currency_code'=>$currency,
                'payer_id'=>$payerID,
                'payer_name'=>$payerName,
                'payer_email'=>$payerEmail,
                'payer_country'=>$payerCountryCode,
                'payment_status'=>$state
            ));
            $paymentdata->save();
            
            //sends order email after successful ticket purchase
            Mail::send(new OrderPlaced($order));

            //Decrements number of tickets with the number of tickets being purchased
            DB::table('events')
                ->where('id', '=', $event_id)
                ->decrement('number_of_tickets', $quantity);

            //Success Message
            Session::put('success', 'Payment made successfully, check registered email for purchased ticket(s)');

            //Returns to user page
            return Redirect::to('/user');

        }
        //Error Message
        Session::put('error', 'Payment failed, Contact Admin for help');
        return Redirect::to('/');

    }

}
