@extends('Layout.master')
@section('title', 'View Event Details')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col m12">
                <div class="card col-md-12">
                    <div class="card-image">
                        <img src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: auto">
                        <form action="cart" method="POST">
                                {!! csrf_field() !!}
                               <input type="hidden" name="id" value="{{ $event->id}}">
                               <input type="hidden" name="name" value="{{ $event->name}}">
                               <input type="hidden" name="charges" value="{{ $event->charges}}"> 
                                <button type="submit" class="halfway-fab btn-floating indigo pulse"><i class="material-icons">add_shopping_cart</i></button>
                        </form>
                    </div>
                    <h4 class="header">{!! $event->name !!}</h4>
                    <ul>
                      <li><i class="fas fa-map-marker-alt"></i><b> Location:</b> {!! $event->location !!}</li>
                      <li><i class="fas fa-calendar-week"></i><b> Date :</b> {!! $event->start_date !!}</li>
                      <li><i class="fas fa-money-bill-wave"></i><b> Ticket Price:</b> Kshs.{!! $event->charges !!}</li> 
                    </ul>
                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="waves-effect waves-light btn indigo">Purchase Tickets</button></a>
                </div>
            </div>
            <div class="card col m12">
                <div class="card-body" align="center">
                    <u><b><h2>About Event</h2></b></u>
                    <p>{!! $event->description !!}</p>
                    <u><b><h2>Organizer</h2></b></u>
                    <h6>{!! $event->organizer !!}</h6>
                    <p>{!! $event->organizer_description !!}</p>
                </div>
            </div>
            <div class="col-md-4 float-right">

                <p>Map Information</p>
                <div id="googleMap" style="width:100%;height:400px;"></div>

                <script>
                    function myMap() {
                        var mapProp= {
                            center:new google.maps.LatLng(51.508742,-0.120850),
                            zoom:5,
                        };
                        var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
                    }
                </script  
                <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY&callback=myMap"></script>
            </div>-->
        </div>
    </div>
@endsection