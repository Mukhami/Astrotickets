@extends('Layout.master')
@section('title', 'Proceed to Paypal')
@section('content')
    <div class="container">
        <div class="row">
                <div class="card" align="center">
                    <h3>CONFIRM YOUR PURCHASE DETAILS</h3>
                            <div class="panel-body">
                                {!! Form::open(['url'=>'paypal']) !!}
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <fieldset>
                                    @if (session('charges'))
                                    <div class="form-group">
                                        <input type="text" name="event_id" value="{!! session('Event_id') !!}" hidden required readonly>
                                        <input type="text" name="quantity" value="{!! session('quantity') !!}" hidden required readonly>
                                    </div>
                                        <div class="form-group">
                                            <label for="name">
                                                <b>Event Name:</b><input type="text" name="event" value="{!! session('Event') !!}" required readonly>
                                            </label>
                                        </div>

                                        <div class="form-group">
                                            <label for="amount">
                                                <b>Total Charges:</b><input type="number" name="amount" value="{!! session('charges') !!}" required readonly>
                                            </label>
                                        </div>

                                    @endif
                                    <div class="form-group">
                                        {!! Form::submit('submit', ['class'=>'waves-effect waves-light btn form-control indigo']) !!}
                                    </div>
                                </fieldset>
                                {!! Form::close() !!}
                            </div>
                </div>
                    </fieldset>
            </div>
        </div>
    @endsection