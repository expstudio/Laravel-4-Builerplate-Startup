@extends('admin.layouts.admin')

@section('main')

<div class="row">
<h1>ข่าวทั้งหมด</h1>

<p>{{ link_to_route('admin..news.create', 'เพิ่มข่าวใหม่', null, array('class' => 'btn btn-lg btn-success pull-right')) }}</p>

</div>
@if ($news->count())
	<table class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>หัวข้อข่าว</th>
				<th>สถานะ</th>
				<th>วันที่</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($news as $new)
				<tr>
					<td>{{{ $new->id }}}</td>
					<td>{{{ $new->title }}}</td>
					<td>{{{ $new->is_published ? 'เผยแพร่' : 'ปิด' }}}</td>
					<td>{{{ $new->created_at }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..news.destroy', $new->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'data-confirm' => 'Are you sure?')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin..news.edit', 'Edit', array($new->id), array('class' => 'btn btn-info')) }}
                        {{ link_to_route('news.show', 'View', array($new->id), array('class' => 'btn btn-success', 'target' => '_blank')) }}
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<?php echo $news->links(); ?>
@else
	ยังไม่มีข่าว
@endif

@stop


@section('script')	

@stop