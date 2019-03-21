@extends('Layout.master')
@section('title', 'Home')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="panel">
                <div class="panel-heading text-center">HOME</div>

                <div class="panel-body text-center">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <b> YOU ARE LOGGED-IN. YOUR ACCOUNT IS: {{auth()->user()->verified() ? 'Verified' : 'Not Verified'}} </b>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
