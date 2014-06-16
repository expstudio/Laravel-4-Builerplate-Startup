@extends('layouts.application')

@section('title')
ผลงานที่ผ่านมา
@stop

@section('main')
    <div class="container">

        <div class="row">

            <div class="col-lg-12">
                <h1 class="page-header">Portfolios
                    <small>Showcase Your Work</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="active">Portfolios</li>
                </ol>
            </div>

        </div>

        <div class="row">
            @foreach($portfolios as $portfolio)
            <div class="col-md-6 portfolio-item">
                <a href="{{url(action('PortfoliosController@show', $portfolio->slug ))}}">
                    <img class="img-responsive" src="{{url($portfolio->cover->url('large'))}}">
                </a>
                <h3><a href="{{url(action('PortfoliosController@show', $portfolio->slug ))}}">{{$portfolio->title}}</a>
                </h3>
                <p>{{$portfolio->customer}}</p>
            </div>
            @endforeach
        </div>
        

        <hr>

        <div class="row text-center">

            <div class="col-lg-12">
                {{ $portfolios->links() }}
            </div>

        </div>

    </div>
    <!-- /.container -->@stop

@section('script')	

@stop