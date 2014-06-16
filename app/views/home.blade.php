@extends('layouts.application')
@section('title')
ยินดีต้อนรับสู่
@stop

@section('style')
@stop
@section('main')
            
            <!-- BEGIN HOME CAROUSEL -->
            <?php $home_page = Page::where('slug', '=', 'home')->first(); ?>
            @if($home_page)
                {{ $home_page->content }}
            @endif
            <!-- END HOME CAROUSEL -->

            <!-- BEGIN ABOUT US -->
            <?php $about_page = Page::where('slug', '=', 'about-us-home')->first(); ?>
            @if($about_page)
                {{ $about_page->content }}
            @endif
            <!-- END ABOUT US -->
             <?php $portfolios = Portfolio::orderBy('id', 'desc')->paginate(4); ?>
            @if($portfolios->count() > 0)
            <div class="section">

                <div class="container">

                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <h2>Some Portfolio</h2>
                            <hr>
                        </div>

                        @foreach($portfolios as $rel_portfolio)
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="{{url(action('PortfoliosController@show', $rel_portfolio->slug ))}}">
                                <img class="img-responsive img-home-portfolio" src="{{ url($rel_portfolio->cover->url('medium'))}}">
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.row -->

                </div>
                <!-- /.container -->

            </div>
            <!-- /.section -->
            @endif

            
            <?php $home_page = Page::where('slug', '=', 'home-bottom')->first(); ?>
            @if($about_page)
                {{ $home_page->content }}
            @endif
@stop            

@section('script')
@stop