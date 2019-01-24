@extends('Layout.master')
@section('title', 'Contact')
@section('content')
    <div class="center" align="center">
        <h3><b>Our Contacts And Directions</b></h3>
        <p class="lead"></p>
    </div>
    <div class="container-fluid" align="center">
        <div class="col-md-6 col-sm-6 text-center">
            <div class="gmap">
                <iframe src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d15955.882780806445!2d36.91847921977539!3d-1.1810564999999946!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2ske!4v1531223244377" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>

        <div class="col-sm-4" align="center">
            <address>
                <p><b>Physical Address</b></p>
                <p>Kenyatta University</p>
            </address>

            <address>
                <p><b>Postal Address</b></p>
                <p>P.O Box
                    43844-00100<br>
                    Nairobi, Kenya</p>
                <p><b>Contacts</b></p>
                <p>Phone/Whatsapp<br>0725-822 625<br>0713- 878 633</p>
                <p>Email Address<br>info@kimtickets.com</p>
                <p>Skype<br>#</p>
                <p><a href="#"><i class="fa fa-facebook" style="color: dodgerblue">facebook</i></a></p>
            </address>
        </div>
    </div>


    </section>  <!--/gmap_area -->

    <section id="contact-page">
        <div class="container">
            <h3 align="center"><b>Send Message</b></h3>
            <div class="row contact-wrap">

                <form method="post" action="sendemail.php">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="form-group">
                            <label>Name *</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email *</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone *</label>
                            <input type="number" class="form-control" name="phone" required>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="form-group">
                            <label>Subject *</label>
                            <input type="text" name="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Message *</label>
                            <textarea name="message" id="message" required class="form-control" rows="8"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="waves-effect waves-light btn btn-lg" required value="Send Message">
                        </div>
                    </div>
                </form>
            </div><!--/.row-->
        </div><!--/.container-->
    </section>
@endsection