<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Purchased Ticket</title>
</head>
<body>
<p class="container-fluid">
Dear {!! $order->user->name !!},
<p><b>EVENT INFORMATION</b></p>
<p>NAME: {!! $order->event->name !!}</p>
<p>VENUE: {!! $order->event->location !!}</p>
<p>FROM:{!! $order->event->start_date !!}, {!! $order->event->start_time !!}</p>
<p>TILL: {!! $order->event->end_date !!}, {!! $order->event->end_time !!}</p>

<p>Options on what to do with the ticket(s) attached below:</p>

<p>1. Present this ticket on your phone for validation of the QR Code (Tip: take a screenshot)</p>
<p>2. Print this ticket and bring it with you (tip: not so good for the environment)</p>
<p>3. DO NOT SHARE THE QR CODE</p>

Here are your tickets,<br>

<p><b>TICKET INFORMATION</b></p>
<p>NUMBER OF TICKETS PURCHASED: {!! $order->quantity !!}</p>
<p>AMOUNT PAID: {!! $order->charges !!}</p>

<hr>
<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->color(255,0,127)->size(200)->generate($order->ticket_id)) !!} ">
<hr>
    <p>Thank you and have a lovely day.</p>
</div>
</body>
</html>



