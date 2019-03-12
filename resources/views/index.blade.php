@extends('Layout.master')
@section('title', 'AstroTickets')
@section('content')


    <div class="container">       <!-- Category section top of page -->
       <div class="col s12 m6 l4">
           @include('categories')
            </div>
     </div>


    <!-- Search field -->
    <div class="container align-content-center">
        <hr>
             <form action="{{ route('search') }}" method="GET" class="search-form" >
                 <i class="fa fa-search search-icon fa-lg"></i>
                   <input  type="'text" id="query" name="query" type="query" value="{{ request()->input('query') }}" style="height:40px; text-align: left; width:550px;" placeholder=" Search for an Event" required>
             </form>
        <hr>
    </div>

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
                <p><b> There is no Event listed.</b></p>
            @else
                @foreach($events as $event)
                    <div class="col s12 m12 l3 xl3">
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
                                <button type="submit" class="halfway-fab btn-floating indigo pulse"><i class="material-icons">add_shopping_cart</i></button>
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
                             </div>
                                <div class="card-action">
                                @if($event->number_of_tickets > 0)
                                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="indigo darken- waves-effect waves-light btn">Purchase Ticket</button></a>
                                @endif
                                </div>
                            </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
