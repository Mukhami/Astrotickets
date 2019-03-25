@extends('Layout.master')
@section('title', 'Contact')
@section('content')
 <div class="">
    <div class="center" align="center">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
        @endif
        <h3><b>Our Contacts Details And Directions</b></h3>
        <p class="lead"></p>
    </div>
    <div class="container-fluid" align="center">
        <div class="col-md-6 col-sm-6 text-center">
            <div class="">
        <address>
                <p><b><i class="fas fa-map-marker-alt"></i> Physical Address</b></p>
            <p><b>KENYATTA UNIVERSITY</b></p>
        </address>
<br>
            <div class="gmap_canvas">
                <iframe width="400" height="250" src="https://maps.google.com/maps?q=kenyatta%20university%20computer%20centre&t=&z=15&ie=UTF8&iwloc=&output=embed" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
            <br>
            </div>
                <br>
            </div>
            <br>
        </div>

        <div class="col-sm-4" align="center">
            <div class="">
            <address>
                <h3><b><i class="fab fa-mailchimp"></i> Postal Address</b></h3>
                <p><b>P.O Box
                    1234-00100<br>
                        Nairobi, Kenya</b></p>
                <h3><b><i class="fas fa-phone"></i> Contacts</b></h3>
                <p><b>Phone/WhatsApp<br>0725-730 055<br>0776-350 488</b></p>
                <p><b>Email Address<br>astrotickets@gmail.com</b></p>
               <b> <p><a href="#"><i class="fab fa-twitter-square"></i> Twitter</i></a></p> </b>
                <b><p><a href="#"><i class="fab fa-facebook-square"></i> Facebook</i></a></p> </b>
               <b> <p><a href="#"><i class="fab fa-instagram"></i> Instagram</i></a></p> </b><br>
            </address>
            </div>
        </div>
    </div>
</div>
    <section id="contact-page">
        <div class="container">
           <div class="card hoverable grey lighten-4">
               <div class="card-header"><h3 align="center"><b><i class="far fa-envelope"></i> CONTACT US</b></h3></div>
            <div class="row contact-wrap">

                <form method="POST" action="{{ route('contactmail') }}">
                            @csrf()
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label><b>Name *</b></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label><b>Email *</b></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label><b>Subject *</b></label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required class="form-control" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-small waves-effect waves-light indigo darken-4" name="submit" type="submit"><b>SEND</b></button>
                        </div>
                    </div>
                </form>
            </div>
           </div>
        </div>
    </section>
@endsection