@extends('admin.layouts.admin')

@section('main')

<div class="row">
	<div class="col-lg-12">
		<h1>ประเภทสินค้าทั้งหมด</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
    <div class=" col-lg-4">
    <?php $parent_product_categories = ProductCategory::lists('name', 'id'); 
    	$parent_product_categories = [ '0' => 'ไม่มีประเภทหลัก'] + $parent_product_categories;
    	$product_category_id = Input::old('product_category_id') ? Input::old('product_category_id') : Input::get('product_category_id');
    	$submittext = isset($product_category) ? 'แก้ไข' : 'เพิ่มประเภทใหม่';
    ?>
    @if(!isset($product_category))
    	{{ Form::open(array('route' => 'admin..product_categories.store', 'class' => 'form-horizontal')) }}
	@else
		{{ Form::model($product_category, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('admin..product_categories.update', $product_category->id))) }}
	@endif
		    <div class="panel panel-default">
		    	<div class="panel-heading">
		            เพิ่มประเภทสินค้า
		        </div>
		    	<div class="panel-body">
		    		<div class="form-group">
			            
			            <div class="col-sm-12">{{ Form::label('name_th', 'ชื่อภาษาไทย:', array('class'=>'control-label')) }}
			              {{ Form::text('name_th', Input::old('name_th'), array('class'=>'form-control', 'placeholder'=>'ชื่อภาษาไทย')) }}
			            </div>
			        </div>

		    		<div class="form-group">
			            <div class="col-sm-12">
			            {{ Form::label('name_en', 'ชื่อภาษาอังกฤษ:', array('class'=>'control-label')) }}
			              {{ Form::text('name_en', Input::old('name_en'), array('class'=>'form-control', 'placeholder'=>'ชื่อภาษาอังกฤษ')) }}
			            </div>
			        </div>

		    		<div class="form-group">
			            <div class="col-sm-12">
			            {{ Form::label('product_category_id', 'ประเภทหลัก:', array('class'=>'control-label')) }}
			              {{ Form::select('product_category_id', $parent_product_categories, $product_category_id, array('class'=>'form-control', 'placeholder'=>'ประเภทหลัก')) }}
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
    	
		<div  class="tree well">
			<ul>
				<li><span><i class="fa fa-home fa-fw"></i>Root</span>
				<ul class="sortable">
		@if ($product_categories->count())
					@foreach ($product_categories as $product_category)
						
					<li>
						<span><i class="fa fa-tablet fa-fw"></i>{{{ $product_category->name }}}</span>
						<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..product_categories.destroy', $product_category->id))) }}
		                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
		                    {{ Form::close() }}
		                    {{ link_to_route('admin..product_categories.edit', 'Edit', array($product_category->id), array('class' => 'btn btn-info btn-xs')) }}
		          		</span>
		          		<span>{{ link_to_route('admin..product_categories.create', 'เพิ่ม sub product_category', array('product_category_id' => $product_category->id), array('class' => 'btn btn-primary btn-xs')) }}</span>
					
		          		<?php $subproduct_categories = ProductCategory::where('product_category_id', $product_category->id)->get(); ?>
		          		@if($subproduct_categories->count() > 0 )
		          			<ul class="sortable">
		          			@foreach ($subproduct_categories as $subproduct_category)
		          				<li>
		          				<span><i class="fa fa-tablet fa-fw"></i>{{{ $subproduct_category->name }}}</span>
												<span>{{ Form::open(array('style' => 'display: inline-block;', 'method' => 'DELETE', 'route' => array('admin..product_categories.destroy', $subproduct_category->id))) }}
				                        {{ Form::submit('Delete', array('class' => 'btn btn-danger btn-xs', 'data-confirm' => 'Are you sure?')) }}
				                    {{ Form::close() }}
				                    {{ link_to_route('admin..product_categories.edit', 'Edit', array($subproduct_category->id), array('class' => 'btn btn-info btn-xs')) }}
				          		</span>
		          				</li>
							@endforeach		
		          			</ul>
		          		@endif
					</li>
					@endforeach	
		@else
					<li>
						<span>ยังไม่มีประเภทสินค้า</span>
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
$( ".sortable" ).sortable({
	change: function(){

	}
});
@stop