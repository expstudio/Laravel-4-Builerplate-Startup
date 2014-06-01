@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-lg-12">
        <h1>แก้ไขโพสท์ภาษาอังกฤษ {{ HTML::image(url('/assets/images/en-flag.png'), 'Set English translation', array('style' => 'height:30px; width:auto;')) }}</h1>

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
          </div>
        @endif
    </div>
</div>

{{ Form::model($product_translation, array('class' => 'form-horizontal', 'method' => 'POST', 'route' => array('admin..product_translations.store', $product->id))) }}

    <div class="form-group">
        {{ Form::label('title', 'หัวข้อเพจ:', array('class'=>'col-md-2 control-label')) }}
        <div class="col-sm-10">
              {{ Form::text('title', Input::old('title'), array('class'=>'form-control', 'placeholder'=>'Title')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('summary', 'สรุป:', array('class'=>'col-md-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::textarea('summary', Input::old('summary'), array('placeholder'=>'Summary', 'rows' => 3, 'cols'=> 'auto', 'class' => 'col-md-12 col-sm-12')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('content', 'เนื้อหา:', array('class'=>'col-md-2 control-label')) }}
        <div class="col-sm-10">
          {{ Form::textarea('content', Input::old('content'), array('id'=>'editor', 'class'=>'form-control', 'placeholder'=>'Content')) }}
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">&nbsp;</label>
        <div class="col-sm-10">
          {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary', 'data-disable-with'=>"Updating...")) }}
          {{ link_to_route('admin..products.edit', 'Cancel', $product->id, array('class' => 'btn btn-lg btn-default')) }}
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


@stop