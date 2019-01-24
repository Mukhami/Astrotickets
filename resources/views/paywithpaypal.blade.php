@extends('Layout.master')
@section('title', 'Paypal')
@section('content')
    <div class="container">
        <div class="row">
                <div class="card" align="center">
                                <p><b>Pay with PayPal</b></p>
                            <div class="panel-body">
                                {!! Form::open(['url'=>'paypal']) !!}
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <fieldset>
                                    @if (session('charges'))
                                    <div class="form-group">
                                        <label for="amount">
                                            Total Charges
                                        </label>
                                        <input type="number" name="amount" value="{!! session('charges') !!}" required readonly>
                                    </div>
                                    @endif
                                    <div class="form-group">
                                        {!! Form::submit('submit', ['class'=>'waves-effect waves-light btn form-control']) !!}
                                    </div>
                                </fieldset>
                                {!! Form::close() !!}
                            </div>
                </div>
                    </fieldset>
            </div>
        </div>
    @endsection