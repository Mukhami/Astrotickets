@extends('Layout.master')
@section('title', 'Browse Events by Category')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="status">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            @if ($events->isEmpty())
                <p><b> THERE ARE NO EVENTS LISTED.</b></p>
            @else
                <p><b> THESE ARE THE EVENTS LISTED IN.</b></p>

                @foreach($events as $event)
                    <div class="col s12 col m3">
                        <div class="card hoverable">
                            <div class="card-image">
                                <a href="/event/{!! $event->slug !!}"><img class="responsive-img" src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: 30%"></a>
                                @if($event->number_of_tickets > 10) <span class="label label-success">Available </span>
                                @elseif($event->number_of_tickets < 10 && $event->number_of_tickets > 0) <span class="label label-warning">Running Out </span>
                                @else <span class="label label-danger"> SOLD OUT!</span>
                                @endif

                                <form action="cart" method="POST">
                                    {!! csrf_field() !!}
                                    <input type="hidden" name="id" value="{{ $event->id}}">
                                    <input type="hidden" name="name" value="{{ $event->name}}">
                                    <input type="hidden" name="charges" value="{{ $event->charges}}">
                                    @if($event->number_of_tickets > 0)
                                        <button type="submit" class="halfway-fab btn-floating indigo pulse"><i class="far fa-bookmark"></i></button>
                                    @endif
                                </form>

                            </div>
                            <div align="centre">
                                <span class="card-title">{!! $event->name !!}</span>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i><b> Location:</b> {!! $event->location !!}</li>
                                    <li><i class="fas fa-calendar-week"></i><b> Date :</b> {!! $event->start_date !!}</li>
                                    <li><i class="fas fa-money-bill-wave"></i><b> Ticket Price:</b> Kshs.{!! $event->charges !!}</li>
                                </ul>
                                <div class="card-action">
                                    @if($event->number_of_tickets > 0)
                                        <a href="/event/buytickets/{!! $event->slug !!}"><button class="indigo darken- waves-effect waves-light btn">Purchase Ticket</button></a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection