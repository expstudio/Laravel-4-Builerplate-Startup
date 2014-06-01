@extends('layouts.application')

@section('title')
{{$page->title}}
@stop

@section('style')
<style>
{{$page->style}}
</style>
@stop

@section('main')

{{$page->content}}

@stop


@section('script')
<script type="text/javascript">
(function() {
 	var $ = jQuery;
	$.noConflict();
	
	$(document).ready(function(){
		$('.step-flexslider').flexslider({
	        animation: "slide",
	        slideshow: false,
	    });
	});

	$('#btn-step').on('click', function(){
		$('.step-flexslider').data('flexslider').flexAnimate(0);
		$('.nav-tabs li').removeClass('active');
		$(this).parent().addClass('active');
	});
	$('#btn-payment').on('click', function(){
		$('.step-flexslider').data('flexslider').flexAnimate(6);
		$('.nav-tabs li').removeClass('active');
		$(this).parent().addClass('active');
	});
	$('#btn-warranty').on('click', function(){
		$('.step-flexslider').data('flexslider').flexAnimate(8);
		$('.nav-tabs li').removeClass('active');
		$(this).parent().addClass('active');
	});
 
}());
</script>
@stop