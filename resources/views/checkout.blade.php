@extends('Layout.master')
@section('title', 'Checkout Credentials')
@section('content')
<?php
$items = Cart::content();
$subtotal = Cart::subtotal();
?>
<div class="container white">
    <h2><b>CHECKOUT</b><h2>
    <div class="row justify-content-center">
        <div class="col s4 m8 l9 col m4 l3">
            <div class="card">
                <br>
                <div class="card-header" align="center"><h6>1. Confirm User Credentials <i class="fas fa-user-edit"></i></h6></div>
                <div class="card-body">
                <form method="POST" action="checkout">
                                     @csrf()
                           <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Name </label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" placeholder=" Enter Name" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number" class="col-md-4 col-form-label text-md-right">Phone Number</label>
                            <div class="col-md-6">
                                <input id="number" type="number" class="form-control{{ $errors->has('number') ? ' is-invalid' : '' }}" name="number" value="{{ old('number') }}" placeholder="07** *** ***"required>          
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Enter Email Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" placeholder="abc@example.com" required><br>
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                      </div>
                     </div>
                 </div>


     <div class="card col m4 l3">
        <div class="card-header" align="center"><h6>Cart Items<i class="fas fa-shopping-cart"></h6></i></div>
        <hr>
            <div class="card-body">
                <ul>
                @foreach($items as $item)
                <li class="list-group-item">
                   <h6><strong>{{$item->name}}</strong>
                    <span class="label label-primary">Ksh. {{$item->price}}</span>
                    <span class="label label-primary">{{ $item->qty}} ticket(s)</span></h6>
                </li>
                @endforeach
                </ul>
               <h6><strong>TOTAL: Ksh. <?php echo $subtotal ?></strong></h6>
                   </div>
               </div>
            </div>

        <div class="div s4 m8 l9 col m4 l3">
            <div class="card-header" align="left"><h6>2. Payment Method<i class="fas fa-hand-holding-usd"></i></h6></i></div>
                   <hr>
                <div class="card-body">
                   <form action="#">
                       <p> <label><input name="group1" type="radio" class="with-gap" /> <span>Mobile Money</span></label></p>
                       <p> <label><input name="group1" type="radio" class="with-gap" /> <span>Paypal</span></label></p>
              </div>
           </div>
        <button  type="submit" class="btn waves-effect waves-light form-control indigo"><b>Proceed to Checkout</b></button>
        </div>
    </div>
 </form>
</div>
@endsection