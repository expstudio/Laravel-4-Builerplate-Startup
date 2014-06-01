@extends('admin.layouts.admin')
@section('style')
<style type="text/css">
.editting {
	background-color: #EAEDF6;
}

.editting li {
	cursor: pointer;
}

</style>

@stop

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1> Menuทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
    <div class=" col-lg-4">
    <?php $parent_menus = Menu::lists('title', 'id'); 
    	$parent_menus = [ '0' => 'ไม่มี Menu หลัก'] + $parent_menus;
    	$menu_id = Input::old('menu_id') ? Input::old('menu_id') : Input::get('menu_id');
    	$submittext = isset($menu) ? 'แก้ไข' : 'เพิ่ม Menu ใหม่';
    ?>
    @if(!isset($menu))
    	{{ Form::open(array('route' => 'admin..menus.store', 'class' => 'form-horizontal')) }}
	@else
		{{ Form::model($menu, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('admin..menus.update', $menu->id))) }}
	@endif
		    <div class="panel panel-default">
		    	<div class="panel-heading">
		             {{ $submittext }}
		        </div>
		    	<div class="panel-body">
		    		<div class="form-group">
			            
			            <div class="col-sm-12">{{ Form::label('title', 'ชื่อเมนู:', array('class'=>'control-label')) }}
			              {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'ชื่อภาษาไทย')) }}
			            </div>
			        </div>

		    		<div class="form-group">
			            <div class="col-sm-12">
			            {{ Form::label('title_en', 'ชื่อเมนูภาษาอังกฤษ:', array('class'=>'control-label')) }}
			              {{ Form::text('title_en', Input::old('title_en'), array('class'=>'form-control', 'placeholder'=>'ชื่อภาษาอังกฤษ')) }}
			            </div>
			        </div>

		    		<div class="form-group">
			            <div class="col-sm-12">
			            {{ Form::label('path', 'ลิงค์:', array('class'=>'control-label')) }}
			              {{ Form::text('path', Input::old('path'), array('class'=>'form-control', 'placeholder'=>'ลิงค์')) }}
			            </div>
			        </div>

		    		<div class="form-group">
			            <div class="col-sm-12">
			            {{ Form::label('menu_id', 'เมนูหลัก:', array('class'=>'control-label')) }}
			              {{ Form::select('menu_id', $parent_menus, $menu_id, array('class'=>'form-control', 'placeholder'=>'ประเภทหลัก')) }}
			            </div>
			        </div>

		    		<div class="form-group">
			            <div class="col-sm-12">
			            {{ Form::label('script', 'Script:', array('class'=>'control-label')) }}
			              {{ Form::textarea('script', Input::old('script'), array('class'=>'form-control', 'placeholder'=>'Script', 'rows'=>'3')) }}
			            </div>
			        </div>

				</div>
				<div class="panel-footer">
       				 {{ Form::submit($submittext, array('class' => 'btn  btn-primary', 'data-disable-with'=>"กำลังบันทึก...")) }}
	            </div>
		    </div>
		{{ Form::close() }}
    </div>

    <div class="panel col-lg-8">	
    	
		<a id="btn-sort" class="btn btn-primary" href="#" alt="Sort Category" style="min-width:114px;">ปรับลำดับเมนู</a>
		<a id="btn-sort-cancel" class="btn btn-warning hide" href="#" alt="Sort Category">ยกเลิก</a>
		<div  class="tree well">
			<ul>
				<li><span><i class="fa fa-home fa-fw"></i>Root</span>
				<ul class="sortable lv1">
		@if ($menus->count())
					@foreach ($menus as $menu)
						
					<li data-id="{{ $menu->id}}">
						<span><i class="fa fa-tablet fa-fw"></i>{{{ $menu->title.'-'.$menu->title_en  }}}</span>
						<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..menus.destroy', $menu->id))) }}
		                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
		                    {{ Form::close() }}
		                    {{ link_to_route('admin..menus.edit', 'Edit', array($menu->id), array('class' => 'btn btn-info btn-xs')) }}
		          		</span>
		          		<span>{{ link_to_route('admin..menus.create', 'เพิ่ม sub menu', array('menu_id' => $menu->id), array('class' => 'btn btn-primary btn-xs')) }}</span>
					
		          		<?php $submenus = Menu::where('menu_id', $menu->id)->get(); ?>
		          		@if($submenus->count() > 0 )
		          			<ul class="sortable lv2">
		          			@foreach ($submenus as $submenu)
		          				<li data-id="{{ $submenu->id}}">
		          				<span><i class="fa fa-tablet fa-fw"></i>{{{ $submenu->title.'-'.$submenu->title_en }}}</span>
												<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..menus.destroy', $submenu->id))) }}
				                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
				                    {{ Form::close() }}
				                    {{ link_to_route('admin..menus.edit', 'Edit', array($submenu->id), array('class' => 'btn btn-info btn-xs')) }}
				          		</span>

				          		<span>{{ link_to_route('admin..menus.create', 'เพิ่ม sub menu', array('menu_id' => $submenu->id), array('class' => 'btn btn-primary btn-xs')) }}</span>
								<?php $lvsubmenus = Menu::where('menu_id', $submenu->id)->get(); ?>
				          		@if($lvsubmenus->count() > 0 )
				          			<ul class="sortable lv3">
				          			@foreach ($lvsubmenus as $lvsubmenu)
				          				<li data-id="{{ $lvsubmenu->id}}">
				          				<span><i class="fa fa-tablet fa-fw"></i>{{{ $lvsubmenu->title.'-'.$lvsubmenu->title_en }}}</span>
														<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..menus.destroy', $lvsubmenu->id))) }}
						                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
						                    {{ Form::close() }}
						                    {{ link_to_route('admin..menus.edit', 'Edit', array($lvsubmenu->id), array('class' => 'btn btn-info btn-xs')) }}
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
						<span>ยังไม่มี Menu</span>
					</li>
		@endif	
				</ul>
				</li>
			</ul>
		</div>
    </div>
</div>
@stop


@section('script')
$('#btn-sort').on('click', function(){
	if($(this).hasClass('btn-sort'))
	{
		var items = [];
		var sort_item = $('.sortable.lv1 li');
		var index = 0;
		$.each(sort_item, function(key, value){
			index++;
			var menu_item = {};
			menu_item['id'] = $(value).data('id');
			menu_item['index'] = index;
			items.push(menu_item);
		});

		sort_item = $('.sortable.lv2 li');
		$.each(sort_item, function(key, value){
			index++;
			var menu_item = {};
			menu_item['id'] = $(value).data('id');
			menu_item['index'] = index;
			items.push(menu_item);
		});

		sort_item = $('.sortable.lv3 li');
		$.each(sort_item, function(key, value){
			index++;
			var menu_item = {};
			menu_item['id'] = $(value).data('id');
			menu_item['index'] = index;
			items.push(menu_item);
		});

		if(sort_item.length > 0)
		{
			$.ajax({
		          url: '{{ action('admin\MenusController@updateList') }}',
		          type: 'POST',
		          data: { menus: items },
		          success: function (data) {
		                  window.location.href = data;
		          }
		      });


		}
	}

	$('#btn-sort').toggleClass('btn-sort');		
	$('#btn-sort-cancel').toggleClass('hide');

	if($(this).hasClass('btn-sort'))
	{
		$( ".sortable" ).sortable({
			change: function(){
			}
		});
		$('.tree.well').addClass('editting');			
		$('#btn-sort').html('บันทึก');
	}
	else
	{
		$( ".sortable" ).sortable('disable');
		$('.tree.well').removeClass('editting');		
		$('#btn-sort').html('ปรับลำดับเมนู');	
	}
});

$('#btn-sort-cancel').on('click', function(){	
	$('#btn-sort').toggleClass('btn-sort');		
	$('#btn-sort-cancel').toggleClass('hide');
	$( ".sortable" ).sortable('disable');
	$('.tree.well').removeClass('editting');			
	$('#btn-sort').html('ปรับลำดับเมนู');		
});
@stop