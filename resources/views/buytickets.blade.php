@extends('Layout.master')
@section('title', 'Purchase Tickets')
@section('content')

    <div class="container-fluid">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger">
        <span onclick="this.parentElement.style.display='none'"
              class="button-red">&times;</span>
                <p>{!! $message !!}</p>
            </div>
            <?php Session::forget('error');?>
        @endif

        <div class="row">
            <div class="col-md-6 card" style="margin: 10px">
                <div>
                    <div class="card-image float-left">
                        <img src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: auto">
                        @if($event->number_of_tickets > 10) <span class="label label-success">Available </span>
                        @elseif($event->number_of_tickets < 10 && $event->number_of_tickets > 0) <span class="label label-warning">Running Out </span>
                        @else <span class="label label-danger"> SOLD OUT!</span>
                        @endif
                    </div>
                    <h2><b>{!! $event->name !!}</b></h2>
                    <p><b><i class="fas fa-map-marker-alt"></i> Event Venue:</b> {!! $event->location !!}</p>
                    <p><b><i class="fas fa-calendar-week"></i> Date:</b> {!! $event->start_date!!}</p>
                    <p><b><i class="far fa-clock"></i> Time:</b> {!! $event->start_time !!} to {!! $event->end_time !!}</p>
                    <p><b><i class="fas fa-money-bill-wave"></i> Charges:</b> $ {!! $event->charges !!} per Ticket</p>
                </div>
            </div>
            <div class="card col m5 s12">
                <div class="panel-heading">
                    <p><b>Confirm Ticket Details: </b></p>
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
                    <input type="hidden" name="event_name" value=" {!! $event->name !!}">
                    <input type="hidden" name="charges" value=" {!! $event->charges !!}">

                    <fieldset>
                        <div class="form-group">
                            {!! Form::label('name', 'Names:') !!}
                            <input type="text" name="name" value=" {!! $user->name !!}">
                            
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', 'Email:') !!}
                            <input type="text" name="email" value=" {!! $user->email !!}">
                            
                        </div>
                        <div class="form-group">
                            {!! Form::label('phone', 'Phone:') !!}
                            <input type="text" name="phone_number" value=" {!! $user->phone_number !!}">
                        </div>
                        <div class="form-group">
                            {!! Form::label('quantity', 'Number of Tickets:') !!}
                            {!! Form::number('quantity', null, ['class'=>'form-control', 'required', 'min=1', 'max=10']) !!}
                        </div>
                        <div class="form-group">
                            <button class="indigo darken-2 waves-effect waves-light btn" data-toggle="tooltip" title="purchase ticket" ><b>Proceed To Pay</b></button>
                            {{--{!! Form::submit('Proceed To Pay', ['class'=>'waves-effect waves-light btn form-control indigo darken-4']) !!}--}}

                        </div>
                    </fieldset>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection