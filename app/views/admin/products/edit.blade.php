@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-lg-12">
        <h1>แก้ไขสินค้า 
                        <span><a href="{{ url(action('admin\ProductTranslationsController@set_translation', $product->id)) }}">
                        {{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:30px; width:auto;')) }}</a>
                        </span></h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($product, array('class' => 'form-horizontal', 'id'=> 'my-awesome-dropzone', 'method' => 'PATCH', 'route' => array('admin..products.update', $product->id), 'files' => true)) }}
        
    <div class="form-group">
       
        <div class="col-sm-12">
          {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'Enter Title Here')) }}
        </div>
    </div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#body" data-toggle="tab">Body</a>
        </li>
        <li><a href="#images" data-toggle="tab">Images</a>
        </li>
        <li><a href="#setting" data-toggle="tab">Setting</a>
        </li>
        <li><a href="#attribute" data-toggle="tab">Attribute</a>
        </li>
    </ul>
<!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="body">

        <div class="form-group">
            {{ Form::label('summary', 'สรุป:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('summary', Input::old('summary'), array('placeholder'=>'Summary', 'rows' => 3, 'cols'=> 'auto', 'class' => 'col-md-12 col-sm-12')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('content', 'เนื้อหา:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('content', Input::old('content'), array('id'=>'editor', 'placeholder'=>'Content')) }}
            </div>
        </div>
      </div>

      <div class="tab-pane fade" id="images">
        <div class="form-group">
            {{ Form::label('cover', 'รูปปก:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ HTML::image($product->cover->url('thumb'), "Cover") }}
              {{ Form::file('cover', Input::old('cover'), array('class'=>'form-control')) }}
            </div>
        </div>
        
        <div class="form-group">
          <label  class="col-md-2 control-label">รูปสไลด์:</label>
          <div id="sortable" class="dropzone dz-clickable dropzone-previews col-md-10">
            
            <div class="dz-default dz-message col-md-9"><span>Drop files here to upload</span></div>
          </div>
          <div class="fallback">
            <input name="images" type="file" multiple />
          </div>
        </div>
      </div>

      <div class="tab-pane fade" id="setting">

        <div class="form-group">
            {{ Form::label('slug', 'Friendly Url:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('slug', Input::old('slug'), array('class'=>'form-control', 'placeholder'=>'Friendly Url')) }}
            </div>
        </div>
        
        <div class="form-group">
            {{ Form::label('tags', 'Tags:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('tags', Input::old('tags'), array('class'=>'form-control', 'placeholder'=>'Tags', 'data-role'=>"tagsinput")) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('comment_status', 'อนุญาติให้แสดงความเห็น:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('comment_status', 'open') }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('post_status', 'เผยแพร่:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('post_status', 'publish') }}
            </div>
        </div>

        <?php $categories = Category::with('subCategories')->where('category_id', '0')->get(); ?>
        <div class="form-group well">
            {{ Form::label('category_id[]', 'ประเภท:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              <ul class="form-group">
                  @foreach($categories as $category)
                  <li class="checkbox">
                      <label> 
                        {{ Form::checkbox('product_category_id[]', $category->id, in_array($category->id, $product_categories)) }} {{ $category->name }}
                      </label>
                      <?php $subcategories = Category::where('category_id', $category->id)->get(); ?>
                      @if($subcategories->count() > 0 )
                        <ul id="sortable">
                        @foreach ($subcategories as $subcategory)
                          <li class="checkbox">
                          <label> 
                            {{ Form::checkbox('product_category_id[]', $subcategory->id, in_array($subcategory->id, $product_categories)) }} {{ $subcategory->name }}
                          </label>
                            
                          </li>
                        @endforeach   
                        </ul>
                      @endif
                  </li>
                  @endforeach
              </ul>
            </div>
        </div>
      </div><!--  Tab Pane -->

      <div class="tab-pane fade" id="attribute">
      @foreach ($meta_list as $key => $value)

        <div class="form-group">
              {{ Form::label("metas[$key]", Product::$metas[$key].':', array('class'=>'col-md-3 control-label')) }}
            <div class="col-sm-6">
              {{ Form::text("metas[$key]", $value, array('class'=>'form-control', 'placeholder'=>Product::$metas[$key])) }}
            </div>
        </div>
        
      @endforeach
      </div>
    </div> <!-- Tab Panel -->

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('แก้ไข', array('class' => 'btn btn-lg btn-primary', 'data-disable-with'=>"Updating...")) }}
      {{ link_to_route('admin..products.index', 'ยกเลิก', $product->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop

@section('script')
$(function(){
$('#editor').editable({
            inlineMode: false, 
            imageUploadURL: '{{ url('/upload') }}',
            imageParams: {id: "my_editor"},    
            buttons: ["bold", "italic", "underline", "strikeThrough", "fontSize", "color", "formatBlock", "align", "insertOrderedList", "insertUnorderedList", "outdent", "indent", "selectAll", "createLink", "anchor", "insertImage", "insertVideo", "undo", "redo", "html"], 
            blockTags: ['p'], 
            customButtons: {
            anchor: {
              title: 'Anchor',
              icon: {
                type: 'font',
                value: 'fa fa-anchor'
              },
              callback: function (editor){
                var anchor_id = prompt("Set anchor id");
                editor.insertHTML("<a id='" + anchor_id + "' class='fa-anchor f-link f-anchor'></a>");
              }
            }
          }
          })
});

Dropzone.autoDiscover = false;
$(document).ready(function(){
Dropzone.options.myAwesomeDropzone = { // The camelized version of the ID of the form element

  // The configuration we've talked about above
  autoProcessQueue: false,
  uploadMultiple: true,
  parallelUploads: 10,
  maxFiles: 10,
  paramName: "images",
  previewsContainer: ".dropzone-previews",
  addRemoveLinks: true,
  clickable: '.dropzone-previews',
  removedfile: function(file) {
    var _ref;
    var file_id = file.name;
    $('<input>').attr({
      type: 'hidden',
      id: 'file_to_delete_' + file_id,
      name: 'deleted_files[]',
      value: file_id
  }).appendTo('form');
    return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
  },
  // The setting up of the dropzone
  init: function() {
    var myDropzone = this;

    // First change the button to actually tell Dropzone to process the queue.
    this.element.querySelector("input[type=submit]").addEventListener("click", function(e) {
      // Make sure that the form isn't actually being sent.
      e.preventDefault();
      e.stopPropagation();
      if(myDropzone.files.length > 0)
      {
        myDropzone.processQueue();
      }
      else
      {
        $( "#my-awesome-dropzone" ).submit();  
      } 
    });

    // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
    // of the sending event because uploadMultiple is set to true.
    this.on("sendingmultiple", function(file, xhr, formData) {
      if($('#cover')[0].files[0])
      {
        formData.append('cover', $('#cover')[0].files[0]);
        $('#cover').remove();
      }
      $("input[type=submit]").prop('disabled', true);
    });
    this.on("successmultiple", function(files, response) {
      location = '{{{ action('admin\ProductsController@index') }}}';
    });
    this.on("errormultiple", function(files, response) {
      $("input[type=submit]").prop('disabled', false);
    });
  }

}

var myDropzone = new Dropzone("form#my-awesome-dropzone", Dropzone.options.myAwesomeDropzone);
myDropzone.on("addedfile", function(file) {
  file.previewElement.addEventListener("click", function() { myDropzone.removeFile(file); });
});

var uploadedFile = {};

@foreach ($product->images as $image)
  uploadedFile = { name: "{{{ $image->id }}}", size: "{{{ $image->image_file_size }}}"};
  myDropzone.emit("addedfile", uploadedFile);
  myDropzone.emit("thumbnail", uploadedFile, "{{{ $image->image->url('thumb') }}}");
@endforeach

myDropzone.options.maxFiles = myDropzone.options.maxFiles - {{{ $product->images->count() }}};

$( "#sortable" ).sortable();

});

@stop