@extends('layouts.application')

@section('style')
<style>
.compact-search{
    list-style-type:none;
    margin:0;
    padding:0;
    z-index: 1000;
    width: 100%;
    background-color: #eceff1;
}
.compact-search li{
    float:left;
    margin:0;
    padding:10px 27px;
}
.compact-search li a{
    float:left;
    text-indent:-99999px;
    height:122px;
    width:122px;
    background-size: contain;
}
.compact-search li a.compact-2-3-m{
    background:url(/assets/images/compact-house.png) no-repeat 0 0;
    background-size: contain;

}
.compact-search li a.compact-2-3-m:hover, .compact-search li a.compact-2-3-m-active{
    background:url(/assets/images/compact-house-hover.png) no-repeat 0 0;;
    background-size: contain;
}
.compact-search li a.compact-3-4-m{
    background:url(/assets/images/modern-house.png) no-repeat 0 0;
    background-size: contain;
}
.compact-search li a.compact-3-4-m:hover, .compact-search li a.compact-3-4-m-active{
    background:url(/assets/images/modern-house-hover.png) no-repeat 0 0;;
    background-size: contain;
}
.compact-search li a.compact-4-5-m{
    background:url(/assets/images/premium-house.png) no-repeat 0 0;
    background-size: contain;
}
.compact-search li a.compact-4-5-m:hover, .compact-search li a.compact-4-5-m-active{
    background:url(/assets/images/premium-house-hover.png) no-repeat 0 0;;
    background-size: contain;
}
.compact-search li a.compact-3-floor{
    background:url(/assets/images/luxury-house.png) no-repeat 0 0;
    background-size: contain;
}
.compact-search li a.compact-3-floor:hover, .compact-search li a.compact-3-floor-active{
    background:url(/assets/images/luxury-house-hover.png) no-repeat 0 0;
    background-size: contain;
}
.compact-search li:first-child{
    padding:29px 15px 0 24px;
}

.menu-padding {
    padding-top:40px;
}
.content p {
    margin-bottom:20px;
}
.sticky {
    position:fixed;
    top:0;
}
</style>
@stop

@section('title')
แบบบ้านของเรา
@stop

@section('main')
    <!-- BEGIN BLOG -->
    <section id="house-plan" class="blog-front odd">
        <div class="row">
            <div class="col-md-12 mg-bt-80">
                <div class="header-content">
                    <h2 class="thai-regular"><span><h2>House Plan</h2>  
                    <h3>“แบบบ้าน ....&nbsp;<a href="#" class="f-link">บริษัท แอ็ดวานซ์ เอนพาวเวอร์ จำกัด</a>"</h3> 
                    </span>
                    </h2>
                </div>
                <ul class="compact-search menu">
                    <li><span class="f-img-wrap"><img src="assets/images/img-search.png" alt="ค้นหา แบบบ้าน Compact"></span>    
                    </li>
                    <li><a href="?compact-2-3-m" class="compact-2-3-m-active f-link">2-3 ล้านบาท</a>    
                    </li>
                    <li><a href="?compact-3-4-m" class="compact-3-4-m f-link">3-4 ล้านบาท</a>   
                    </li>
                    <li><a href="?compact-4-5-m" class="compact-4-5-m f-link">4-5 ล้านบาท</a>   
                    </li>
                    <li><a href="?compact-3-floor" class="compact-3-floor f-link">บ้านสามชั้น</a>   
                    </li>
                </ul>
            </div>
        </div>
                            <br>
        <div class="row">
            @foreach ($products as $product)
            <article class="col-md-4 col-sm-6">
                <figure class="blog-thumb"> <span class="f-img-wrap"><img src="{{ url($product->cover->url('large')) }}" alt="{{ $product->title }}"></span> 
                </figure>
                <div class="post-area">
                    <a href="{{ url(action('PostsController@show', $product->slug)) }}" class="f-link"></a>
                    <h4><a href="{{ url(action('PostsController@show', $product->slug)) }}" class="f-link"></a><a class="btn btn-light small f-link" href="{{ url(action('ProductsController@show', $product->slug)) }}">{{ $product->code() }}</a></h4> 
                </div>
            </article>
            @endforeach
        </div>
    </section>
    <!-- END BLOG -->

@stop

@section('script')	
<script type="text/javascript">
    var $ = jQuery;
    $(document).ready(function () {

        var menu = $('.menu');
        var origOffsetY = menu.offset().top;

        function scroll() {
            if ($(window).scrollTop() >= origOffsetY) {
                $('.menu').addClass('sticky');
                $('.row').addClass('menu-padding');
            } else {
                $('.menu').removeClass('sticky');
                $('.row').removeClass('menu-padding');
            }


        }

        document.onscroll = scroll;

    });
</script>
@stop