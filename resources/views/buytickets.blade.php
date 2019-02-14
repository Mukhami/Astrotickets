@extends('Layout.master')
@section('title', 'Purchase Tickets')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 card" style="margin: 10px">
                <div>
                    <div class="card-image float-left">
                        <img src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: auto">
                    </div>
                    <h3> {!! $event->name !!}</h3>
                    <p>{!! $event->location !!}</p>
                    <p>{!! $event->start_date!!}<br> from {!! $event->start_time !!} to {!! $event->end_time !!}</p>
                    <br>
                    <p>Kshs.{!! $event->charges !!} per Ticket</p>
                </div>
            </div>
            <div class="card col m5 s12">
                <div class="panel-heading">
                    <p><b>Enter Details: </b></p>
                </div>
                <div class="panel-body">
                    {!! Form::open(['url'=>'saveBillingData']) !!}
                    @foreach ($errors->all() as $error)
                        <p class="alert alert-danger">{{ $error }}</p>
                    @endforeach
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                    <input type="hidden" name="event_id" value=" {!! $event->id !!}">
                    <input type="hidden" name="charges" value=" {!! $event->charges !!}">
                    <fieldset>
                        <div class="form-group">
                            {!! Form::label('name', 'Name:') !!}
                            {!! Form::text('name', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            {!! Form::email('email', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone:') !!}
                            {!! Form::number('phone', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('quantity', 'Number of Tickets:') !!}
                            {!! Form::number('quantity', null, ['class'=>'form-control', 'required']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Proceed To Checkout', ['class'=>'waves-effect waves-light btn form-control']) !!}
                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection