@extends('layouts.application')

@section('title')
{{$post->title}}
@stop

@section('style')
{{$post->style}}
@stop

@section('main')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/th_TH/sdk.js#xfbml=1&appId=1428532447420222&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{{ $post->title }}
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/">Home</a>
                    </li>
                    <li class="active">{{ $post->title }}</li>
                </ol>
            </div>

        </div>

        <div class="row">

            <div class="col-lg-8">

                <!-- the actual blog post: title/author/date/content -->
                <hr>
                <p><i class="fa fa-clock-o"></i> Posted on {{ date("F d Y",strtotime($post->created_at)) }} by <a href="#">{{ $post->user->username }}</a>
                </p>
                <hr>
                <img src="{{ url($post->cover->url('large')) }}" class="img-responsive" width="100%">
                <hr>
                
                {{ $post->content }}

                <hr>

                <!-- the comment box -->
                <div class="well">
                    <div class="fb-comments" data-href="{{ Request::url() }}" data-width="710" data-numposts="10" data-colorscheme="light"></div>
                </div>

                <hr>

               
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
                    <h4>Popular Blog Categories</h4>
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
