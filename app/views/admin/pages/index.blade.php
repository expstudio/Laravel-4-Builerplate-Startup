@extends('admin.layouts.admin')

@section('main')

<div class="row">
<h1>เพจทั้งหมด</h1>

</div>
@if ($pages->count())
<div  class="tree well">
	<ul>
		<li><span><i class="fa fa-home fa-fw"></i>Root</span>
		<ul id="sortable">
			@foreach ($pages as $page)
				
			<li>
				<span><i class="fa fa-tablet fa-fw"></i>{{{ $page->title }}}</span>
				<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..pages.destroy', $page->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
                    {{ Form::close() }}
                    {{ link_to_route('admin..pages.edit', 'Edit', array($page->id), array('class' => 'btn btn-info btn-xs')) }}
                    {{ link_to_route('pages.show', 'View', array($page->id), array('class' => 'btn btn-success btn-xs', 'target' => '_blank')) }}
          		</span>
          		<span>{{ link_to_route('admin..pages.create', 'เพิ่ม subpage', array('page_id' => $page->id), array('class' => 'btn btn-primary btn-xs')) }}</span>
			
          		<?php $subpages = Page::where('parent_id', $page->id)->get(); ?>
          		@if($subpages->count() > 0 )
          			<ul id="sortable">
          			@foreach ($subpages as $subpage)
          				<li>
          				<span><i class="fa fa-tablet fa-fw"></i>{{{ $subpage->title }}}</span>
										<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..pages.destroy', $subpage->id))) }}
		                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
		                    {{ Form::close() }}
		                    {{ link_to_route('admin..pages.edit', 'Edit', array($subpage->id), array('class' => 'btn btn-info btn-xs')) }}

                        {{ link_to_route('pages.show', 'View', array($subpage->id), array('class' => 'btn btn-success btn-xs', 'target' => '_blank')) }}
		          		</span>
          				</li>
					@endforeach		
          			</ul>
          		@endif
			</li>
			@endforeach		
			<li>
				<span>{{ link_to_route('admin..pages.create', 'สร้างเพจใหม่', null, array('class' => 'btn btn-xs btn-success pull-right')) }}	
         		</span>
			</li>
		</ul>
		</li>
	</ul>
</div>
@else
	ยังไม่มีเพจ
@endif
@stop

@section('script')
$( "#sortable" ).sortable();
@stop