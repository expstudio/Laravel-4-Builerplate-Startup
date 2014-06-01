@extends('layouts.application')
@section('title')
ยินดีต้อนรับสู่
@stop

@section('style')
@stop
@section('main')
            
            <div id="myCarousel" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                    <li data-target="#myCarousel" data-slide-to="2"></li>
                    <li data-target="#myCarousel" data-slide-to="3"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <div class="fill" style="background-image:url('{{url('/assets/images/slide1.jpg')}}');"></div>
                        <div class="carousel-caption">
                            <h1>Laravel 4 + Bootstrap Boilerplate</h1>
                        </div>
                    </div>
                    <div class="item">
                        <div class="fill" style="background-image:url('{{url('/assets/images/slide2.jpg')}}');"></div>
                        <div class="carousel-caption">
                            <h1>Ready to Style &amp; Add Content</h1>
                        </div>
                    </div>
                    <div class="item">
                        <div class="fill" style="background-image:url('{{url('/assets/images/slide3.jpg')}}');"></div>
                        <div class="carousel-caption">
                            <h1>Additional Layout Options at <a href="http://expstudio.net">http://expstudio.net</a>
                            </h1>
                        </div>
                    </div>
                    <div class="item">
                        <div class="fill" style="background-image:url('{{url('/assets/images/slide6.jpg')}}');"></div>
                        <div class="carousel-caption">
                            <h1>Expert Experience Express
                            </h1>
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="icon-prev"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="icon-next"></span>
                </a>
            </div>

            <!-- BEGIN ABOUT US -->
            <?php $about_page = Page::where('slug', '=', 'about-us')->first(); ?>
            @if($about_page)
                {{ $about_page->content }}
            @endif
            <!-- END ABOUT US -->

            
            <div class="section-colored text-center">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-12">
                            <h2>Laravel 4 Startup: A Clean &amp; Simple Full Website Template by Start Bootstrap</h2>
                            <p>A complete website design featuring various single page templates from Start Bootstraps library of free HTML starter templates.</p>
                            <hr>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /.section-colored -->

            <div class="section">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>Display Some Work on the Home Page Portfolio</h2>
                            <hr>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-home-portfolio" src="http://placehold.it/700x450">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-home-portfolio" src="http://placehold.it/700x450">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-home-portfolio" src="http://placehold.it/700x450">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-home-portfolio" src="http://placehold.it/700x450">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-home-portfolio" src="http://placehold.it/700x450">
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="portfolio-item.html">
                                <img class="img-responsive img-home-portfolio" src="http://placehold.it/700x450">
                            </a>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /.section -->

            <div class="section-colored">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h2>Laravel 4 Startup Features Include:</h2>
                            <ul>
                                <li>Bootstrap 3 Framework</li>
                                <li>Mobile Responsive Design</li>
                                <li>Predefined File Paths</li>
                                <li>Working PHP Contact Page</li>
                                <li>Minimal Custom CSS Styles</li>
                                <li>Unstyled: Add Your Own Style and Content!</li>
                                <li>Font-Awesome fonts come pre-installed!</li>
                                <li>100% <strong>Free</strong> to Use</li>
                                <li>Open Source: Use for any project, private or commercial!</li>
                            </ul>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <img class="img-responsive" src="http://placehold.it/700x450/ffffff/cccccc">
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /.section-colored -->

            <div class="section">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <img class="img-responsive" src="http://placehold.it/700x450">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <h2>Laravel 4 Startup Features Include:</h2>
                            <ul>
                                <li>Bootstrap 3 Framework</li>
                                <li>Mobile Responsive Design</li>
                                <li>Predefined File Paths</li>
                                <li>Working PHP Contact Page</li>
                                <li>Minimal Custom CSS Styles</li>
                                <li>Unstyled: Add Your Own Style and Content!</li>
                                <li>Font-Awesome fonts come pre-installed!</li>
                                <li>100% <strong>Free</strong> to Use</li>
                                <li>Open Source: Use for any project, private or commercial!</li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /.section -->

            <div class="container">

                <div class="row well">
                    <div class="col-lg-8 col-md-8">
                        <h4>'Laravel 4 Startup' is a ready-to-use, Bootstrap 3 updated, multi-purpose HTML theme!</h4>
                        <p>For more templates and more page options that you can integrate into this website template, visit Exp Studio!</p>
                    </div>
                    <div class="col-lg-4 col-md-4">
                        <a class="btn btn-lg btn-primary pull-right" href="http://expstudio.net">See More Templates!</a>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->
            
@stop            

@section('script')
@stop