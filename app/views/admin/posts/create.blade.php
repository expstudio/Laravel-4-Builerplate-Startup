@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>เพิ่มข่าวใหม่</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('class' => 'form-horizontal', 'id'=> 'my-awesome-dropzone', 'route' => 'admin..news.store', 'files' => true)) }}

        <div class="form-group">
            {{ Form::label('title', 'หัวข้อ:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'Title')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('content', 'เนื้อหา:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::textarea('content', Input::old('content'), array('id'=>'editor', 'placeholder'=>'Content')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('cover', 'รูปปก:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::file('cover', Input::old('cover'), array('class'=>'form-control')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('tags', 'Tags:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('tags', Input::old('tags'), array('class'=>'form-control', 'placeholder'=>'Tags', 'data-role'=>"tagsinput")) }}
            </div>
        </div>

        <div class="form-group products">
            {{ Form::label('products', 'สินค้าเกี่ยวข้อง:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('products', Input::old('products'), array('id'=>'products', 'class'=>'form-control', 'placeholder'=>'Product Code')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('is_published', 'เผยแพร่:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::checkbox('is_published') }}
            </div>
        </div>
        
        <div class="form-group">
        <label  class="col-md-2 control-label">รูปสไลด์:</label>
        <div id="sortable" class="dropzone dz-clickable dropzone-previews">
          
          <div class="dz-default dz-message"><span>Drop files here to upload</span></div>
        </div>
        <div class="fallback">
          <input name="images" type="file" multiple />
        </div>
        </div>
        
<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary', 'data-disable-with'=>"Saving...")) }}
      {{ link_to_route('admin..news.index', 'Cancel', null, array('class' => 'btn btn-lg btn-default ')) }}
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
      formData.append('cover', $('#cover')[0].files[0]);
      $('#cover').remove();
      $("input[type=submit]").prop('disabled', true);
    });
    this.on("successmultiple", function(files, response) {
      location = '{{{ action('admin\NewsController@index') }}}';
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
$( "#sortable" ).sortable();

});
$('.products > > input').tagsinput({
    itemValue: 'id',
    itemText: 'code',
    typeahead: {
      source: function(query) {
        return $.getJSON('{{{ url('/admin/products.json')}}}');
      }
    }
  });
@stop


