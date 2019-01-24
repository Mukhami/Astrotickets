@extends('Layout.master')
@section('title', 'Events')
@section('content')
    <div class="container-fluid">
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
        <span onclick="this.parentElement.style.display='none'"
              class="Button--success">&times;</span>
                <p>{!! $message !!}</p>
            </div>
            <?php Session::forget('success');?>
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
            <div class="status">
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
            @if ($events->isEmpty())
                <p> There is no Event.</p>
            @else
                @foreach($events as $event)

                    <div class="col s12 col m3 col-sm-6">
                        <div class="card">
                            <div class="card-image waves-light">
                                <a href="/event/{!! $event->slug !!}"><img class="responsive-img" src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: 30%"></a>
                            </div>
                            <div align="center">
                            <span class="card-title">{!! $event->name !!}</span>
                            </div>
                            <div class="card-body">
                                <p><b>At:</b> {!! $event->location !!}</p>
                                <p><b>On :</b> {!! $event->start_date !!}</p>
                                <p><b>Ticket Price:</b> Kshs.{!! $event->charges !!}</p>
                            </div>
                                <div class="card-action">
                                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="pink lighten-3 waves-effect waves-light btn">Buy Tickets</button></a><br>
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