@extends('Layout.master')
@section('title', 'Edit Info')
@section('content')
    <div class="container">
        <div class="panel">
            <div class="panel-heading" align="center">
                <h5>Edit Info</h5>
            </div>
            <div class="panel-body">
                {!! Form::open(['url'=>'update-info']) !!}
                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif
                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="event_id" value=" {!! $user->id !!}">
                <fieldset>
                    <div class="form-group">
                        {!! Form::Label('fname', 'First Name:') !!}
                        {!! Form::text('fname', null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('lname', 'Last Name:') !!}
                        {!! Form::text('lname', null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::Label('email', 'Email:') !!}
                        {!! Form::text('email', null, ['class'=>'form-control', 'required']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Update', ['class'=>'waves-effect waves-light btn form-control']) !!}
                    </div>
                </fieldset>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    @endsection