@extends('Layout.master')
@section('title', 'AstroTickets')
@section('content')
<div class="carousel carousel-slider center">
    <div class="carousel-fixed-item center">
      <a class="btn waves-effect white indigo-text darken-text-2"><b>Browse Category</b></a>
    </div>
    <div class="carousel-item red white-text" href="#one!">
      <h2>First Panel</h2>
      <p class="white-text">This is your first panel</p>
    </div>
    <div class="carousel-item amber white-text" href="#two!">
      <h2>Second Panel</h2>
      <p class="white-text">This is your second panel</p>
    </div>
    <div class="carousel-item green white-text" href="#three!">
      <h2>Third Panel</h2>
      <p class="white-text">This is your third panel</p>
    </div>
    <div class="carousel-item blue white-text" href="#four!">
      <h2>Fourth Panel</h2>            
      <p class="white-text">This is your fourth panel</p>
    </div>
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
                <p> There is no Event listed.</p>
            @else
                @foreach($events as $event)
                    <div class="col s12 m12 l3 xl3">
                        <div class="card">
                            <div class="card-image">
                                <a href="/event/{!! $event->slug !!}"><img class="responsive-img" src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: 30%"></a>
                                <form action="cart" method="POST">
                                {!! csrf_field() !!}
                               <input type="hidden" name="id" value="{{ $event->id}}">
                               <input type="hidden" name="name" value="{{ $event->name}}">
                               <input type="hidden" name="charges" value="{{ $event->charges}}"> 
                                <button type="submit" class="halfway-fab btn-floating indigo pulse"><i class="material-icons">add_shopping_cart</i></button>
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
                                    <a href="/event/buytickets/{!! $event->slug !!}"><button class="indigo darken- waves-effect waves-light btn">Purchase Ticket</button></a>
                                </div>
                            </div>
                     
                </div>
                @endforeach
            @endif
        </div>
                <div class="container">
                <div class="col s12 m6 l4">
                @include('categories') 
            </div>
        </div>
    </div>
@endsection
