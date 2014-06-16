@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-lg-12">
        <h1>แก้ไขเพจ <span><a href="{{ url(action('admin\PageTranslationsController@set_translation', $page->id)) }}">{{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:30px; width:auto;')) }}</a></span></h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($page, array('class' => 'form-horizontal', 'id'=> 'my-awesome-dropzone', 'method' => 'PATCH', 'route' => array('admin..pages.update', $page->id), 'files' => true)) }}

    <div class="form-group">
       
        <div class="col-sm-12">
              {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'Title')) }}
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
    </ul>
<!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="body">


        <div class="form-group">
            {{ Form::textarea('content', Input::old('content'), array('id'=>'editor', 'class'=>'form-control', 'placeholder'=>'Content')) }}
        </div>
      </div>

      <div class="tab-pane fade" id="images">

        <div class="form-group">
            {{ Form::label('cover', 'รูปปก:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ HTML::image($page->cover->url('thumb'), "Cover") }}
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

        @if(Input::get('page_id'))
        <div class="form-group">
            {{ Form::label('parent_id', 'หน้าหลัก:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::input('number', 'parent_id', Input::get('page_id'), array('class'=>'form-control')) }}
            </div>
        </div>
        @else
           <?php $parent_page = Page::lists('title', 'id'); 
              $parent_page = array('0' => 'ไม่มีหน้าหลัก') + $parent_page;
              $has_parent = Input::old('parent_id') ? Input::old('parent_id') : Input::get('parent_id');
            ?>
            <div class="form-group">
                  {{ Form::label('parent_id', 'หน้าหลัก:', array('class'=>'col-md-2 control-label')) }}
                <div class="col-sm-4">
                  {{ Form::select('parent_id', $parent_page, $has_parent, array('class'=>'form-control', 'placeholder'=>'หน้าหลัก')) }}
                </div>
            </div>
        @endif

        <div class="form-group">
            {{ Form::label('style', 'Stylesheet:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('style', Input::old('style'), array('id'=>'styleeditor', 'class'=>'form-control', 'placeholder'=>'style')) }}
            </div>
        </div>
      </div>
    </div>

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary', 'data-disable-with'=>"Updating...")) }}
      {{ link_to_route('admin..pages.index', 'Cancel', $page->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop

@section('script')
@if($page->slug != "home")
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
@endif
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
      $("input[type=submit]").remove();
    });
    this.on("successmultiple", function(files, response) {
      location = '{{{ action('admin\PagesController@index') }}}';
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

@foreach ($page->images as $image)
  uploadedFile = { name: "{{{ $image->id }}}", size: "{{{ $image->image_file_size }}}"};
  myDropzone.emit("addedfile", uploadedFile);
  myDropzone.emit("thumbnail", uploadedFile, "{{{ url($image->image->url('thumb')) }}}");
@endforeach

myDropzone.options.maxFiles = myDropzone.options.maxFiles - {{{ $page->images->count() }}};

$( "#sortable" ).sortable();

});

@stop