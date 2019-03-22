@extends('Layout.master')
@section('title', 'AstroTickets')
@section('content')


    <div class="container"> <!-- Category section top of page -->
       <div class="col-xs-12 col-m6 col-l4">
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


<!-- Section for error/success messages-->
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


            <!-- Lists Events-->
            @if ($events->isEmpty())
                <div class="container text-center">
                    <div class="col-xs-12 col-m6 col-l4">
                        <p><b><h3> There is no Event listed.</h3></b></p>
                    </div>
                </div>
            @else
                @foreach($events as $event)
                    <div class="col s12 m6 l4 xl4">
                        <div class="card hoverable">
                            <div class="card-image">
                                <a href="/event/{!! $event->slug !!}"><img class="responsive-img" src='{!! Voyager::image( $event->event_poster ) !!}' style="width: 100%; height: 30%"></a>
                                @if($event->number_of_tickets > 10) <span class="label label-success">Available </span>
                                @elseif($event->number_of_tickets < 10 && $event->number_of_tickets > 0) <span class="label label-warning">Running Out </span>
                                @else <span class="label label-danger"> SOLD OUT!</span>
                                @endif 

                               @if($event->number_of_tickets > 0)

                                   {{--bookmark event--}}
                                <a href="{{route('bookmark',['id'=>$event->id])}}">
                                    <button type="submit" class="halfway-fab btn-floating indigo darken-4 pulse" data-toggle="tooltip" title="add to bookmarks">
                                        <i class="far fa-bookmark"></i>
                                    </button>
                                </a>
                                @endif

                            </div>
                            <div align="centre">
                                <br>
                                <span class="card-title"><b>{!! $event->name !!}</b></span>
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
                                        <a href="/event/buytickets/{!! $event->slug !!}"><button class="indigo darken-2 waves-effect waves-light btn" data-toggle="tooltip" title="purchase ticket" ><b>Purchase Ticket</b></button></a>
                                @endif
                                </div>
                            </div>
                         </div>
                @endforeach
            @endif
        </div>

            <!-- Pagination Links -->

            <div class="container text-center">
            <hr>
                {!! $events->appends(request()->input())->links() !!}
            <hr>
            </div>
    </div>
@endsection
