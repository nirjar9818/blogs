@extends('layouts.frontend.app')

@section('content')
    <!--================ Hero sm banner start =================-->
    <section class="mb-30px">
        <div class="container">
            <div class="hero-banner hero-banner--sm">
                <div class="hero-banner__content">
                    <h1>Contact Us</h1>
                    <nav aria-label="breadcrumb" class="banner-breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!--================ Hero sm banner end =================-->


    <!-- ================ contact section start ================= -->
    <section class="section-margin--small section-margin">
        <div class="container">
            <div class="row">
               
                <div class="col-md-4">
                    <div class="contact-info">
                        <img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>
                        <h1>Get in touch</h1>
                       <div class="location">
                          <i class="ti-location-pin"></i> Panga,Kitripur
                       </div>
                        <div class="email">
                            <i class="ti-email"></i> maharjan@company.com
                        </div>
                        <div class="contact">
                            <i class="ti-mobile"></i> +977-9860457821
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="contact-form">
                        <div class="form-group">
                            <label for="first_name">First Name:</label>

                            <input type="text" class="form-control" id="first_name" placeholder="Enter First Name"
                                   name="fname">

                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name:</label>

                            <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name"
                                   name="lname">

                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>

                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">

                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>

                            <textarea class="form-control" rows="5" id="messge"></textarea>

                        </div>
                        <div class="form-group">

                            <button type="submit" class="btn btn-default">Submit</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ================ contact section end ================= -->


@endsection
