@extends('layouts.application')

@section('title')
{{$portfolio->title}}
@stop

@section('style')
{{$portfolio->style}}
@stop

@section('main')

<!-- BEGIN BLOG -->
            <section id="blog" class="blog">
                <div class="row">
                    <div class="col-md-9">
                        <div id="primary" class="row">
                            <div class="col-md-12">
                                <!-- BEGIN ARTICLE -->
                                <article class="post">
                                    <div class="post-thumb">
                                        <a href="blog-post.html">
                                            <img src="{{ url($portfolio->cover->url('large')) }}" alt="{{ $portfolio->title }}" />
                                        </a>
                                    </div>
                                    <div class="post-title">
                                        <h1><a href="{{ url(action('PortfoliosController@show', $portfolio->id)) }}">{{ $portfolio->title }}</a>
                                        </h1>
                                    </div>
                                    <div class="post-meta">
                                        <span class="dates">{{ $portfolio->created_at }}</span>
                                    </div>
                                    <div class="post-content">
                                        <p>{{ $portfolio->content }}
                                        </p>

                                    </div>
                                </article>
                                <!-- END ARTICLE -->
                            </div>
                            <!-- BLOG AUTHOR -->
                            <div class="col-md-12">
                                <div class="blog-author">
                                    <h3>Blog Author</h3>
                                    <div class="media">
                                        <figure class="pull-left">
                                            <img class="media-object" src="/images/author.png" alt="Author">
                                        </figure>
                                        <div class="media-body">
                                            <h4 class="media-heading"><a href="javascript:;">John Doe</a>
                                            </h4>
                                            <p>
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                                                <br/>
                                                <a href="#" class="zocial icon facebook">Sign in with Facebook</a>
                                                <a href="#" class="zocial icon googleplus">Sign in with Facebook</a>
                                                <a href="#" class="zocial icon twitter">Sign in with Facebook</a>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- BLOG COMMENTS -->
                            <div class="col-md-12">
                                <div class="blog-comments">
                                    
                                </div>
                            </div>
                            <!-- END BLOG COMMENTS -->
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
                                        Latest Post
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

                        

                    </div>
                </div>
            </section>
            <!-- END BLOG -->


@stop
