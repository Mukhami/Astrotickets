
@extends('Layout.master')
@section('title', 'Bookmarked Events')
@section('content')

    <div class="container-fluid" style="margin-top: 5px">
        <div class="align-content-right border-0 grey lighten-3">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
            @endif

            <div class="container">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>EVENT NAME</th>
                        <th>DESCRIPTION</th>
                        <th>TICKET PRICE</th>
                        <th>DATE OF EVENT</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($bookmarks as $bookmark)
                    <tr>
                        <td><b><a href="/event/{{ $bookmark->event->slug }}">{!! $bookmark->event->name !!}</a></b></td>
                        <td><b>{!! str_limit($bookmark->event->description, 50)!!}</b></td>
                        <td><b>{!!  $bookmark->event->charges!!}</b></td>
                        <td><b>{!! \Carbon\Carbon::parse($bookmark->event->start_date)->format('d M Y')!!}</b></td>
                        <td> <a href="{{ route('delete_bookmark', ['id'=>$bookmark->id]) }}" class="btn-floating indigo z-depth-0"  data-toggle="tooltip" title="remove">
                                <i class="tiny material-icons">delete_forever</i></a> </td>

                    </tr>
                        @endforeach
                    </tbody>
                </table>
                <hr>
            </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                    <div class="" align="centre">
                        <a href="/" class="indigo darken- waves-effect waves-light btn"><b>Add more Tickets</b></a>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <br>
@endsection
