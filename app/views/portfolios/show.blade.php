@extends('layouts.application')

@section('title')
{{$portfolio->title}}
@stop

@section('style')
{{$portfolio->style}}
@stop

@section('main')

    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">{{$portfolio->title}}
                    <small>{{$portfolio->customer}}</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{url('/')}}">Home</a>
                    <li><a href="{{url('/portfolios')}}">Portfolio</a>
                    </li>
                    <li class="active">{{$portfolio->title}}</li>
                </ol>
            </div>

        </div>

        <div class="row">

            <div class="col-md-8">
                <img class="img-responsive" src="{{url($portfolio->cover->url('large'))}}">
            </div>

            <div class="col-md-4">
                <h3>Project Description</h3>
                <p>{{$portfolio->content}}</p>
                <h3>Project Details</h3>
                <ul>
                    <li><i class="fa fa-user"></i> {{$portfolio->customer}}</li>
                    <li><i class="fa fa-globe"></i> <a href="{{ url($portfolio->site_url) }}">{{$portfolio->site_url}}</a></li>
                    <li><i class="fa fa-edit"></i> {{ date("F d Y",strtotime($portfolio->created_at)) }}</li>
                </ul>
            </div>

        </div>

        <?php $portfolios = Portfolio::where('id', '<>', $portfolio->id)->paginate(4); ?>
        @if($portfolios->count() > 0)
        <div class="row">

            <div class="col-lg-12">
                <h3 class="page-header">Related Projects</h3>
            </div>
            @foreach($portfolios as $rel_portfolio)
            <div class="col-sm-3 col-xs-6">
                <a href="{{url(action('PortfoliosController@show', $rel_portfolio->slug ))}}">
                    <img class="img-responsive img-customer" src="{{ url($rel_portfolio->cover->url('medium'))}}">
                </a>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    <!-- /.container -->


@stop
