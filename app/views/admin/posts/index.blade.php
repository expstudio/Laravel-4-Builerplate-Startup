@extends('admin.layouts.admin')

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1>โพสท์ทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>

	<p>{{ link_to_route('admin..posts.create', 'เพิ่มโพสท์ใหม่', null, array('class' => 'btn btn-lg btn-success pull-right')) }}</p>

</div>
@if ($posts->count())
	<table class="table table-striped table-bordered table-hover dataTable ">
		<thead>
			<tr>
				<th>ID</th>
				<th>หัวข้อโพสท์</th>
				<th>สถานะ</th>
				<th>วันที่</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($posts as $post)
				<tr>
					<td>{{{ $post->id }}}</td>
					<td>{{{ $post->title }}}</td>
					<td>{{{ $post->post_status }}}</td>
					<td>{{{ $post->created_at }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..posts.destroy', $post->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'data-confirm' => 'Are you sure?')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin..posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-info')) }}
                        <span><a href="{{ url(action('admin\PostTranslationsController@set_translation', $post->id)) }}">
                        {{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:34px; width:auto;')) }}</a>
                        </span>
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<?php echo $posts->links(); ?>
@else
	ยังไม่มีโพสท์
@endif

@stop


@section('script')	

@stop