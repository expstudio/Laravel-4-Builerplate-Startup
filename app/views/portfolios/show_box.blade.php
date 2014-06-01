@extends('layouts.application_box')

@section('style')
<style type="text/css">
body {
    background-color: rgba(255, 255, 255, 0.86);
    padding: 10px;
}

.post .post-title {
    right: auto;
}
.row {
    margin-right: auto;
}

.post .post-thumb {
    position: relative;
    text-align: center;
}

.post .post-thumb img {
    width: 95%;
}

.post .post-meta {
    margin-bottom: 10px;
}

#primary {
    margin-bottom: 0px;
}
.post .post-meta span {
    font-size: 17px;
}
</style>
@stop

@section('main')

<!-- BEGIN BLOG -->
            <section id="blog" class="blog">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12">
                            <!-- BEGIN ARTICLE -->
                            <article class="post">
                                <div id="primary" class="row col-sm-8">
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
                                            <span class="dates">{{ date("d F Y",strtotime($portfolio->created_at)) }}</span>
                                        </div>
                            
                                </div>
                                <div class="post-content col-sm-3">
                                    {{ $portfolio->content }}                                    
                                </div>
                            </article>
                                
                            <!-- END ARTICLE -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BLOG -->


@stop
