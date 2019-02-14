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
                @foreach($events as $event)

                    <div class="col s12 col m3">
                        <div class="card">
                            <div class="card-image waves-light">
                                <a href="/event/{!! $event->slug !!}"><img class="responsive-img" src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: 30%"></a>
                            </div>
                            <div align="center">
                                <span class="card-title">{!! $event->name !!}</span>
                            </div>
                            <div class="card-content">
                                <p><b>Venue:</b> {!! $event->location !!}</p>
                                <p><b>Date:</b> {!! $event->start_date !!}<br> from {!! $event->start_time !!} to {!! $event->end_time !!}</p>
                                <p><b>Ticket Price:</b> KSHs.{!! $event->charges !!}</p>
                                <div class="card-action">
                                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="indigo waves-effect waves-light btn">Buy Tickets</button></a><br>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="row">
            @include('categories')
        </div>
    </div>
@endsection