@extends('layouts.application')

@section('title')
ผลงานที่ผ่านมา
@stop

@section('main')
<!-- BEGIN BLOG -->
            <section id="blog" class="blog">
                <div class="row">
                    <div class="col-md-9">
                        <div id="primary" class="row">
                            <div class="col-md-12">
                             @foreach ($portfolios as $portfolio)
                                <!-- BEGIN ARTICLE -->
                                <article class="post">
                                    <div class="post-thumb">
                                        <a href="{{ url(action('PortfoliosController@show', $portfolio->slug)) }}">
                                            <img src="{{ url($portfolio->cover->url('large')) }}" alt="{{ $portfolio->title }}" />
                                        </a>
                                    </div>
                                    <div class="post-title">
                                        <h1><a href="{{ url(action('PortfoliosController@show', $portfolio->slug)) }}">{{ $portfolio->title }}</a>
                                        </h1>
                                    </div>
                                    <div class="post-meta">
                                        <span class="dates">{{ $portfolio->created_at }}</span>
                                        </span>
                                    </div>
                                    <div class="post-content">
                                        <p>{{ $portfolio->summary }}</p>
                                        <br/>
                                        <a class="btn btn-light medium" href="{{ url(action('PortfoliosController@show', $portfolio->slug)) }}">Read More</a>
                                    </div>
                                </article>
                                <!-- END ARTICLE -->
           					 @endforeach
                            </div>
                            <div class="col-md-12">
                                <?php echo $portfolios->links(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widgetbar">

                        <div class="row widget">
                            <div class="col-md-12">
                                <form class="search-widget">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="search..">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                    <!-- /input-group -->
                                </form>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="categories-widget">
                                    <h3 class="widget-title">
                                        Categories
                                    </h3>
                                    <ul>
                                        <li>
                                            <a href="javascript:;">CSS3 Tutorials</a> (5)
                                        </li>
                                        <li>
                                            <a href="javascript:;">Web Design</a> (2)
                                        </li>
                                        <li>
                                            <a href="javascript:;">Magazine</a> (5)
                                        </li>
                                        <li>
                                            <a href="javascript:;">Icon Inspiration</a> (12)
                                        </li>
                                        <li>
                                            <a href="javascript:;">Fonts</a> (8)
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="popular-post-widget">
                                    <h3 class="widget-title">
                                        Popular Post
                                    </h3>
                                    <ul>
                                        <li>
                                            <a href="javascript:;">Plunker hypanthial unagricultura</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Unstaffed intertransformability</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Tamatave squaller superwrought outsold equanimous</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Submissiveness nasalized flagella</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;">Ungrizzled lassitude</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="rss-widget">
                                    <h3 class="widget-title">
                                        <a href="javascritp:;">Connect with RSS <i class="fa fa-rss"></i></a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="ads-widget">
                                    <h3 class="widget-title">
                                        Ads Banner
                                    </h3>
                                    <a href="javascript:;">
                                        <img src="images/ads336x280.png" alt="ads">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="zocial-widget">
                                    <h3 class="widget-title">
                                        Zocial Icons
                                    </h3>
                                    <a href="#" class="zocial icon facebook">Sign in with Facebook</a>
                                    <a href="#" class="zocial icon googleplus">Sign in with Google+</a>
                                    <a href="#" class="zocial icon twitter">Sign in with Twitter</a>
                                    <a href="#" class="zocial icon google">Sign in with Google</a>
                                    <a href="#" class="zocial icon linkedin">Sign in with LinkedIn</a>
                                    <a href="#" class="zocial icon paypal">Pay with Paypal</a>
                                    <a href="#" class="zocial icon amazon">Sign in with Amazon</a>
                                    <a href="#" class="zocial icon dropbox">Sync with Dropbox</a>
                                    <a href="#" class="zocial icon evernote">Clip to Evernote</a>
                                    <a href="#" class="zocial icon skype">Call me on Skype</a>
                                    <a href="#" class="zocial icon guest">Sign in as guest</a>
                                    <a href="#" class="zocial icon spotify">Play on Spotify</a>
                                    <a href="#" class="zocial icon lastfm">Sign in with Last.fm</a>
                                    <a href="#" class="zocial icon songkick">Sign in with Songkick</a>
                                    <a href="#" class="zocial icon forrst">Follow me on Forrst</a>
                                    <a href="#" class="zocial icon dribbble">Sign in with Dribbble</a>
                                    <a href="#" class="zocial icon cloudapp">Sign in to CloudApp</a>
                                    <a href="#" class="zocial icon github">Fork me on Github</a>
                                    <a href="#" class="zocial pinterest icon">Follow me on Pinterest</a>
                                    <a href="#" class="zocial quora icon">Follow me on Quora</a>
                                    <a href="#" class="zocial pinboard icon">Bookmark with Pinboard</a>
                                    <a href="#" class="zocial lanyrd icon">Attend on Lanyrd</a>
                                    <a href="#" class="zocial icon itunes">Download on iTunes</a>
                                    <a href="#" class="zocial icon android">Download on Android</a>
                                    <a href="#" class="zocial icon disqus">Sign in with Disqus</a>
                                    <a href="#" class="zocial icon yahoo">Sign in with Yahoo</a>
                                    <a href="#" class="zocial icon vimeo">Upload to Vimeo</a>
                                    <a href="#" class="zocial icon chrome">Add to Chrome</a>
                                    <a href="#" class="zocial icon ie">Get a new browser</a>
                                    <a href="#" class="zocial icon html5">Made from HTML5</a>
                                    <a href="#" class="zocial icon instapaper">Read It Later</a>
                                    <a href="#" class="zocial icon scribd">Read more on Scribd</a>
                                    <a href="#" class="zocial icon wordpress">Sign in with WordPress</a>
                                    <a href="#" class="zocial icon wikipedia">View on Wikipedia</a>
                                    <a href="#" class="zocial icon tumblr">Follow me on Tumblr</a>
                                    <a href="#" class="zocial icon foursquare">Check in with foursquare</a>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                    </div>
                </div>
            </section>
            <!-- END BLOG -->

@stop

@section('script')	

@stop