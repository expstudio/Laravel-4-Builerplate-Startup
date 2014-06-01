@extends('admin.layouts.admin')

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1>พอร์ตโฟลิโอทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>

<p>{{ link_to_route('admin..portfolios.create', 'เพิ่มพอร์ตโฟลิโอใหม่', null, array('class' => 'btn btn-lg btn-success pull-right')) }}</p>

</div>
@if ($portfolios->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>หัวข้อพอร์ตโฟลิโอ</th>
				<th>สถานะ</th>
				<th>วันที่</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($portfolios as $portfolio)
				<tr>
					<td>{{{ $portfolio->id }}}</td>
					<td>{{{ $portfolio->title }}}</td>
					<td>{{{ $portfolio->tags }}}</td>
					<td>{{{ $portfolio->created_at }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..portfolios.destroy', $portfolio->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'data-confirm' => 'Are you sure?')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin..portfolios.edit', 'Edit', array($portfolio->id), array('class' => 'btn btn-info')) }}
                        <span><a href="{{ url(action('admin\PortfolioTranslationsController@set_translation', $portfolio->id)) }}">
                        {{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:34px; width:auto;')) }}</a>
                        </span>
                        
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<?php echo $portfolios->links(); ?>
@else
	ยังไม่มีพอร์ตโฟลิโอ
@endif

@stop


@section('script')	

@stop