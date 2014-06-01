@extends('admin.layouts.admin')

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1>สินค้าทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>

	<p>{{ link_to_route('admin..products.create', 'เพิ่มสินค้าใหม่', null, array('class' => 'btn btn-lg btn-success pull-right')) }}</p>

</div>
@if ($products->count())
	<table class="table table-striped table-bordered table-hover dataTable ">
		<thead>
			<tr>
				<th>ID</th>
				<th>code</th>
				<th>รายการสินค้า</th>
				<th>สถานะ</th>
				<th>วันที่</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($products as $product)
				<tr>
					<td>{{{ $product->id }}}</td>
					<td>{{{ $product->metas()->where('meta_key', '=', 'code')->first()->meta_value }}}</td>
					<td>{{{ $product->title }}}</td>
					<td>{{{ $product->post_status }}}</td>
					<td>{{{ $product->created_at }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..products.destroy', $product->id))) }}
                            {{ Form::submit('ลบ', array('class' => 'btn btn-danger', 'data-confirm' => 'Are you sure?')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin..products.edit', 'แก้ไข', array($product->id), array('class' => 'btn btn-info')) }}
                        <span><a href="{{ url(action('admin\ProductTranslationsController@set_translation', $product->id)) }}">
                        {{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:34px; width:auto;')) }}</a>
                        </span>
                        
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<?php echo $products->links(); ?>
@else
	ยังไม่มีสินค้า
@endif

@stop


@section('script')	

@stop