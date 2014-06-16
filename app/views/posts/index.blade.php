@extends('layouts.application')

@section('title')
ข่าวสารและสาระน่ารู้
@stop

@section('main')
    
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Blog
                    <small>Blog Homepage</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="active">Blog</li>
                </ol>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">
                @foreach($posts as $post)
                <h1><a href="{{ url(action('PostsController@show', $post->slug)) }}">{{ $post->title }}</a>
                </h1>
                <p class="lead">by <a href="#">{{ $post->user->username }}</a>
                </p>
                <hr>
                <p><i class="fa fa-clock-o"></i> Posted on {{ date("F d Y",strtotime($post->created_at)) }}</p>
                <hr>
                <a href="{{ url(action('PostsController@show', $post->slug)) }}">
                    <img src="{{ url($post->cover->url('large')) }}" class="img-responsive" width="100%">
                </a>
                <hr>
                <p>{{ $post->summary }}</p>
                <a class="btn btn-primary" href="{{ url(action('PostsController@show', $post->slug)) }}">Read More <i class="fa fa-angle-right"></i></a>

                <hr>
                @endforeach
                {{ $posts->links()}}

            </div>

            <div class="col-lg-4">
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                    <!-- /input-group -->
                </div>
                <!-- /well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php $categories = Category::where('category_id', '0')->orderBy('id', 'desc')->get(); ?>
                                <li><a href="{{ action('PostsController@index') }}">All</a></li>
                                @foreach($categories as $category)
                                <li><a href="{{ action('PostsController@index_category', array("category_id"=> $category->slug)) }}">{{ $category->name_th }} ({{$category->posts()->count()}})</a></li>
                                @endforeach 
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Bootstrap's default well's work great for side widgets! What is a widget anyways...?</p>
                </div>
                <!-- /well -->
            </div>
        </div>

    </div>
    <!-- /.container -->

@stop

@section('script')	

@stop