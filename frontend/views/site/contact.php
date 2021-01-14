<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
// use Yii;

$this->title = 'Contact-Us';
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="contact-bg">
    <div class="parallax-overlay">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 offset-lg-5 mt-5  p-4">
                    <div class="inpge-heading mb-3 animate__fadeInRight animate__animated">CONTACT US</div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="contact mt-mb">
    <div class="container">
        <div class="">
            <div class="row mt-5">
                <div class="col-lg-4 info-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class=""> <i class="fa fa-envelope"></i>
                                <h3>Email Us</h3>
                                <p> info@pilesfreeworld.com</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class=""> <i class=" fa fa-phone"></i>
                                <h3>Call Us</h3>
                                <p>+91 9112 675 901 <br>
                                    +91 7038 569 384</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 contact-frm bg-white">
                    <div class="">
                        <form action="" method="" role="form">
                            <div class="row">
                                <div class="col-lg-6 col-xs-12 col-sm-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" />
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-6 col-xs-12 col-sm-6 form-group">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" />
                                    <div class="validate"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" />
                                <div class="validate"></div>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="message" rows="15" placeholder="Message"></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn-sm btn btn-info text-uppercase">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 mt-5 text-center">
                    <div class="main-heading mb-3">OUR ADRESSES</div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box  box effect5 mt-4"> <i class="fa fa-map"></i>
                        <h3>PUNE</h3>
                        <p>Plot No. P.A.P. / G. /60, Thermax Chowk,<br />
                            Behind Kasturi Market, Majjid Road, <br />
                            Sambhaji Nagar, Chinchwad,<br />
                            Pune - 19.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box  box effect5 mt-4"> <i class="fa fa-map"></i>
                        <h3>MUMBAI</h3>
                        <p>Plot No. P.A.P. / G. /60, Thermax Chowk,<br />
                            Behind Kasturi Market, Majjid Road, <br />
                            Sambhaji Nagar, Chinchwad,<br />
                            Pune - 19.</p>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="info-box  box effect5 mt-4"> <i class="fa fa-map"></i>
                        <h3>NASHIK</h3>
                        <p>Plot No. P.A.P. / G. /60, Thermax Chowk,<br />
                            Behind Kasturi Market, Majjid Road, <br />
                            Sambhaji Nagar, Chinchwad,<br />
                            Pune - 19.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>