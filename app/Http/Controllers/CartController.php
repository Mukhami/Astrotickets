<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart'); /**cart view */
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //stores items to the cart
        $item=$request->name;
        $cartItem = Cart::add($request->id, $request->name, 1, $request->charges);
        Cart::associate($cartItem->rowId, 'App\Event');

        return redirect()->back()->with('status', $item.' '.'has successfully been added to cart');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        //remove item from the cart
        Cart::remove($request->rowId);
        
        return redirect()->back()->with('status', 'Item has successfully been removed from the cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cart::destroy();
    }
}
