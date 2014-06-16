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
@stop