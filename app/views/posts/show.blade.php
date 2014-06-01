@extends('layouts.application')

@section('title')
{{$post->title}}
@stop

@section('style')
{{$post->style}}
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
                                    </div>
                                    <div class="post-content">
                                        <p>{{ $post->content }}
                                        </p>

                                    </div>
                                </article>
                                <!-- END ARTICLE -->
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-md-3 widgetbar">

                        <div class="row widget">
                            <div class="col-md-12">
                                <div class="post-meta">
                                        <div class="avatar"><img alt="{{ $post->user->username }}" src="{{ $post->user->profile->cover->url('large') }}" class="avatar avatar-80 photo" height="80" width="80"></div>
                                        <table>
                                        <tbody><tr><td>By:</td><td>{{ $post->user->username }}</td></tr>
                                        <tr><td>At:</td><td>{{ date("d F Y",strtotime($post->created_at)) }}</td></tr>
                                        
                                        </tbody></table>
                                </div>
                            </div>
                        </div>
                        <!-- /widget -->

                        <?php echo View::make('shared.widget_category', compact('categories')) ?> 
                        <?php echo View::make('shared.widget_tag')->with('tags', $post->tags) ?> 
                    </div>
                </div>
            </section>
            <!-- END BLOG -->


@stop
