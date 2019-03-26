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
                <div class="text-center">
                <p><b><h2> THESE ARE THE EVENTS LISTED IN {{ $cat->name }}</h2></b></p>
                </div>
                @foreach($events as $event)
                    <div class="col s12 m6 l4 xl4">
                        <div class="card hoverable">
                            <div class="card-image">
                                <a href="/event/{!! $event->slug !!}"><img class="responsive-img" src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: 30%"></a>
                                @if($event->number_of_tickets > 10) <span class="label label-success">Available </span>
                                @elseif($event->number_of_tickets < 10 && $event->number_of_tickets > 0) <span class="label label-warning">Running Out </span>
                                @else <span class="label label-danger"> SOLD OUT!</span>
                                @endif

                                {{--bookmark event--}}
                                <a href="{{route('bookmark',['id'=>$event->id])}}">
                                    <button type="submit" class="halfway-fab btn-floating indigo darken-4 pulse" data-toggle="tooltip" title="add to bookmarks">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                </a>

                            </div>
                            <div align="centre">
                                <span class="card-title"><b>{!! $event->name !!}</b></span>
                            </div>
                            <div class="card-body">
                                <ul>
                                    <li><i class="fas fa-map-marker-alt"></i><b> Location:</b> {!! $event->location !!}</li>
                                    <li><i class="fas fa-calendar-week"></i><b> Date :</b> {!! $event->start_date !!}</li>
                                    <li><i class="fas fa-money-bill-wave"></i><b> Ticket Price:</b> $ {!! $event->charges !!}</li>
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