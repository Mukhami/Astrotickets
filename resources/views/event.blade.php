@extends('Layout.master')
@section('title', 'View Event Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col m12">
                <div class="card col-md-12 hoverable">
                    <div class="card-image">
                        <img src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: auto">
                        @if($event->number_of_tickets > 10) <span class="label label-success">Available </span>
                                @elseif($event->number_of_tickets < 10 && $event->number_of_tickets > 0) <span class="label label-warning">Running Out </span>
                                @else <span class="label label-danger"> SOLD OUT!</span>
                                @endif
                        <form action="cart" method="POST">
                                {!! csrf_field() !!}
                               <input type="hidden" name="id" value="{{ $event->id}}">
                               <input type="hidden" name="name" value="{{ $event->name}}">
                               <input type="hidden" name="charges" value="{{ $event->charges}}"> 
                        </form>
                    </div>
                    <h4 class="header">{!! $event->name !!}</h4>
                    <ul>
                      <li><i class="fas fa-map-marker-alt"></i><b> Location:</b> {!! $event->location !!}</li>
                      <li><i class="fas fa-calendar-week"></i><b> Date :</b> {!! $event->start_date !!}</li>
                      <li><i class="fas fa-money-bill-wave"></i><b> Ticket Price:</b> $ {!! $event->charges !!}</li>
                    </ul>
                    @if($event->number_of_tickets > 0) 
                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="waves-effect waves-light btn indigo">Purchase Ticket</button></a>
                    @endif
                </div>
            </div>
            <div class="card col m12 hoverable">
                <div class="card-body" align="center">
                    <u><b><h2>About Event</h2></b></u>
                    <p>{!! $event->description !!}</p>
                    {{--<u><b><h2>Organizer</h2></b></u>--}}
                    {{--<h6>{!! $event->organizer !!}</h6>--}}
                    {{--<p>{!! $event->organizer_description !!}</p>--}}
                </div>
            </div>
        </div>
    </div>
@endsection