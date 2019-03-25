@extends('Layout.master')
@section('title', 'Report Issue')
@section('content')
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

     <div class="card hoverable grey lighten-4">
        <div class="row">
            <div class="col m10 offset-m1 s12">
                <h2 class="center-align">REPORT AN ISSUE</h2>
                <div class="row">
                    <form action="{{ route('cancelticketmail') }}" method="POST" class="col s12">
                        @csrf()
                        <div class="row">
                            <div class="input-field col m6 s12">
                                <input id="name" type="text" name="name" value="{{ $user->name }}" class="validate" required>
                                <label for="name"><b>USERNAME</b></label>
                            </div>
                            <div class="input-field col m6 s12">
                                <input id="email" type="email" name="email" value="{{ $user->email }}" class="validate"  required>
                                <label for="email"><b>EMAIL</b></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12" aria-required="true">
                                <label for="subject"><b>SUBJECT</b></label>
                                <br/>
                            </div>
                            <div class="input-field col s12">
                                <select class="browser-default" name="subject" id="subject">
                                    <option value="" selected disabled>Choose your option</option>
                                    <option value="CANCEL A PURCHASED TICKET">CANCEL A PURCHASED TICKET</option>
                                    <option value="REPORT AN ISSUE">REPORT AN ISSUE</option>
                                    <option value="OTHER">OTHER</option>
                                </select>
                            </div>
                        </div>
                        <p><b>NOTE: Specify Ticket Number in the event of Cancellation</b></p>
                        <div class="input-field col m6 s12">
                            <input id="ticketnumber" type="text" name="ticketnumber"  class="validate" >
                            <label for="ticketnumber"><b>TICKET NUMBER</b></label>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <textarea id="message" name="message" class="materialize-textarea" required></textarea>
                                <label for="message"><b>MESSAGE*</b></label>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col m12">
                                <p class="right-align"><button class="btn btn-large waves-effect waves-light indigo darken-4" type="submit"><b>SUBMIT</b></button></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
@endsection