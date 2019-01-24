@extends('Layout.master')
@section('title', 'View Event')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col m12">
                <div class="card col-md-12">
                    <div class="card-image">
                        <img src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: auto">
                    </div>
                    <h4 class="header">{!! $event->name !!}</h4>
                    <p>{!! $event->location !!}</p>
                    <p>{!! $event->start_date !!}</p>
                    <br>
                    <p>Kshs.{!! $event->charges !!} per Ticket</p>
                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="waves-effect waves-light btn">Buy Tickets</button></a>
                </div>
            </div>
            <div class="card col m12">
                <div class="card-body" align="center">
                    <h4>About Event</h4>
                    <p>{!! $event->description !!}</p>
                    <h4>Organizer</h4>
                    <h5>{!! $event->organizer !!}</h5>
                    <p>{!! $event->organizer_description !!}</p>
                </div>
            </div>
            <!--<div class="col-md-4 float-right">
                <p>Map Information will appear here</p>
                <div id="googleMap" style="width:100%;height:400px;"></div>

                <script>
                    function myMap() {
                        var mapProp= {
                            center:new google.maps.LatLng(51.508742,-0.120850),
                            zoom:5,
                        };
                        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                    }
                </script>

                <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
            </div>-->
        </div>
    </div>
@endsection