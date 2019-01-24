@extends('Layout.master')
@section('title', 'User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="img img-circle img-responsive">
                <img class="img-circle" src="{!! Voyager::image($user->avatar) !!}" height="100" width="100">
            </div>
            <p>{!! $user->name !!}</p>
            <p>{!! $user->email !!}</p>
        </div>
    </div>
@endsection