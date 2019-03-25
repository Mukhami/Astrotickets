@extends('Layout.master')
@section('title', 'Search Results')
@section('content')

    <div class="container-fluid">
        <div class="container">
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
        </div>

        <div class="container">
        <h2><b> Search Results</b></h2>

            <!-- Search field -->
            <div class="container align-content-center">
                <hr>
                <form action="{{ route('search') }}" method="GET" class="search-form" >
                    <i class="fa fa-search search-icon fa-lg"></i>
                    <input  type="'text" id="query" name="query" type="query" value="{{ request()->input('query') }}" style="height:40px; text-align: left; width:550px;" placeholder=" Search for an Event" required>
                </form>
                <hr>
                <h2>{{ $events->count() }} Result(s) for '{{ request()->input('query') }}'</h2>
            </div>

               <table class="table table-striped table-hover">
                   <thead>
                   <tr>
                       <th>Event Name</th>
                       <th>Description</th>
                       <th>Guests</th>
                       <th>Date</th>
                       <th>Location</th>
                       <th>Charges</th>
                   </tr>
                   </thead>
                   <tbody>
                   @foreach($events as $event)
                   <tr>
                       <td><b><a href="/event/{{ $event->slug }}"> {{ $event->name }}</a></b></td>
                       <td><b>{!! str_limit($event->description, 50) !!}</b></td>
                       <td><b>{{ $event->guests }}</b></td>
                       <td><b>{{ \Carbon\Carbon::parse($event->start_date)->format('d M Y') }}</b></td>
                       <td><b>{{ $event->location }}</b></td>
                       <td><b>{{ $event->charges }}</b></td>
                   </tr>
                   @endforeach
                   </tbody>
               </table>


            <br>
        </div>
    </div>
@endsection
