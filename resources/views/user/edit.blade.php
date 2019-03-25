@extends('Layout.master')
@section('title', 'Edit Info')
@section('content')
    <div class="container">
        <div class="panel grey lighten-4 hoverable">
            <div class="panel-heading " align="center">
                <h4>Edit Account Information</h4>
            </div>
            <div class="panel-body">
                {!! Form::open(['url'=>'update-info', 'method'=>'post']) !!}
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="id" value=" {!! $user->id !!}">
                <fieldset>
                    <div class="form-group">
                        {!! Form::Label('name', 'NAME:') !!}
                        {!! Form::text('name', null, ['class'=>'form-control', 'required', 'placeholder'=>'Enter Your preferred Name']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('email', 'E-MAIL:') !!}
                        {!! Form::text('email', null, ['class'=>'form-control', 'required', 'placeholder'=>'Enter Your preferred Email']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('phonenumber', 'PHONE NUMBER:') !!}
                        {!! Form::text('phonenumber', null, ['class'=>'form-control', 'required', 'placeholder'=>'Enter Your preferred Phone Number']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update', ['class'=>'waves-effect waves-light btn form-control indigo darken-2']) !!}
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endsection