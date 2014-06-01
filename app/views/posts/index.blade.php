@extends('layouts.application')

@section('title')
ข่าวสารและสาระน่ารู้
@stop

@section('main')
<!-- BEGIN BLOG -->
            <section id="blog" class="blog">
                <div class="row">
                    <div class="col-md-9">
                        <div id="primary" class="row">
                            <div class="col-md-12">
                             @foreach ($posts as $post)
                                <!-- BEGIN ARTICLE -->
                                <article class="post">
                                    <div class="post-thumb">
                                        <a href="{{ url(action('PostsController@show', $post->slug)) }}">
                                            <img src="{{ url($post->cover->url('large')) }}" alt="{{ $post->title }}" />
                                        </a>
                                    </div>
                                    <div class="post-title">
                                        <h1><a href="{{ url(action('PostsController@show', $post->slug)) }}">{{ $post->title }}</a>
                                        </h1>
                                    </div>
                                    <div class="post-meta">
                                        <span class="dates">{{ date("d F Y",strtotime($post->created_at)) }}</span>
                                        </span>
                                    </div>
                                    <div class="post-content">
                                        <p>{{ $post->summary }} <a href="{{ url(action('PostsController@show', $post->slug)) }}">
                                            [...]
                                        </a></p>
                                        <br/>
                                        <a class="btn btn-light medium" href="{{ url(action('PostsController@show', $post->slug)) }}">Read More</a>
                                    </div>
                                </article>
                                <!-- END ARTICLE -->
           					 @endforeach
                            </div>
                            <div class="col-md-12">
                                <?php echo $posts->links(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 widgetbar">
                        <?php echo View::make('shared.widget_category', compact('categories')) ?> 
                        <?php echo View::make('shared.widget_tag')->with('tag') ?> 
                    </div>
                </div>
            </section>
            <!-- END BLOG -->

@stop

@section('script')	

@stop