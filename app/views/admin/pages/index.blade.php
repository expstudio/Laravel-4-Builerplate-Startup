@extends('admin.layouts.admin')

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1>เพจทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>

</div>
<div  class="tree well">
	<ul>
		<li><span><i class="fa fa-home fa-fw"></i>Root</span>
		<ul id="sortable">
@if ($pages->count())
			@foreach ($pages as $page)
				
			<li>
				<span><i class="fa fa-tablet fa-fw"></i>{{{ $page->title }}}</span>
				<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..pages.destroy', $page->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
                    {{ Form::close() }}
                    {{ link_to_route('admin..pages.edit', 'Edit', array($page->id), array('class' => 'btn btn-info btn-xs')) }}
                    {{ link_to_route('pages.show', 'View', array($page->slug), array('class' => 'btn btn-success btn-xs', 'target' => '_blank')) }}
          		</span>
          		<span>{{ link_to_route('admin..pages.create', 'เพิ่ม subpage', array('page_id' => $page->id), array('class' => 'btn btn-primary btn-xs')) }}</span>
				<span><a href="{{ url(action('admin\PageTranslationsController@set_translation', $page->id)) }}">{{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:22px; width:auto;')) }}</a></span>
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

                        {{ link_to_route('pages.show', 'View', array($subpage->slug), array('class' => 'btn btn-success btn-xs', 'target' => '_blank')) }}
		          		</span>
		          		<span>{{ link_to_route('admin..pages.create', 'เพิ่ม subpage', array('page_id' => $subpage->id), array('class' => 'btn btn-primary btn-xs')) }}</span>
						<span><a href="{{ url(action('admin\PageTranslationsController@set_translation', $subpage->id)) }}">{{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:22px; width:auto;')) }}</a></span>
		          		<?php $lv3_subpages = Page::where('parent_id', $subpage->id)->get(); ?>
		          		@if($lv3_subpages->count() > 0 )
		          			<ul id="sortable">
		          			@foreach ($lv3_subpages as $lv_subpage)
		          				<li>
		          				<span><i class="fa fa-tablet fa-fw"></i>{{{ $lv_subpage->title }}}</span>
												<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..pages.destroy', $lv_subpage->id))) }}
				                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
				                    {{ Form::close() }}
				                    {{ link_to_route('admin..pages.edit', 'Edit', array($lv_subpage->id), array('class' => 'btn btn-info btn-xs')) }}

		                        {{ link_to_route('pages.show', 'View', array($lv_subpage->slug), array('class' => 'btn btn-success btn-xs', 'target' => '_blank')) }}
				          		</span>
		          				</li>
							@endforeach		
		          			</ul>
		          		@endif
          				</li>
					@endforeach		
          			</ul>
          		@endif
			</li>
			@endforeach	
@else
			<li>
				<span>ยังไม่มีเพจ</span>
			</li>
@endif	
			<li>
				<span>{{ link_to_route('admin..pages.create', 'สร้างเพจใหม่', null, array('class' => 'btn btn-xs btn-success pull-right')) }}	
         		</span>
			</li>
		</ul>
		</li>
	</ul>
</div>
@stop
