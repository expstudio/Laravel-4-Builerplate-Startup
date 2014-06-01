@extends('admin.layouts.admin')

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1>ผู้ใช้ทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>

	<p>{{ link_to_route('admin..users.create', 'เพิ่มผู้ใช้ใหม่', null, array('class' => 'btn btn-lg btn-success pull-right')) }}</p>

</div>
@if ($users->count())
	<table class="table table-striped table-bordered table-hover dataTable ">
		<thead>
			<tr>
				<th>ID</th>
				<th>Username</th>
				<th>Email</th>
				<th>วันที่</th>
				<th>&nbsp;</th>
			</tr>
		</thead>

		<tbody>
			@foreach ($users as $user)
				<tr>
					<td>{{{ $user->id }}}</td>
					<td>{{{ $user->username }}}</td>
					<td>{{{ $user->email }}}</td>
					<td>{{{ $user->created_at }}}</td>
                    <td>
                        {{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..users.destroy', $user->id))) }}
                            {{ Form::submit('Delete', array('class' => 'btn btn-danger', 'data-confirm' => 'Are you sure?')) }}
                        {{ Form::close() }}
                        {{ link_to_route('admin..users.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}
                        
                    </td>
				</tr>
			@endforeach
		</tbody>
	</table>
	<?php echo $users->links(); ?>
@else
	ยังไม่มีผู้ใช้
@endif

@stop


@section('script')	

@stop