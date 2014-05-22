@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-md-10 col-md-offset-2">
        <h1>Edit Setting</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($setting, array('class' => 'form-horizontal', 'method' => 'PATCH', 'route' => array('admin..settings.update', $setting->id))) }}

        <div class="form-group">
            {{ Form::label('site_title', 'Site title:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('site_title', Input::old('site_title'), array('class'=>'form-control', 'placeholder'=>'Site_title')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('site_name', 'Site name:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('site_name', Input::old('site_name'), array('class'=>'form-control', 'placeholder'=>'Site_name')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('site_meta', 'Site meta:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('site_meta', Input::old('site_meta'), array('class'=>'form-control', 'placeholder'=>'Site_meta')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('site_keyword', 'Site keyword:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('site_keyword', Input::old('site_keyword'), array('class'=>'form-control', 'placeholder'=>'Site_keyword')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('app_key', 'Facebook app key:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('app_key', Input::old('app_key'), array('class'=>'form-control', 'placeholder'=>'')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('app_secret', 'Facebook app secret:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('app_secret', Input::old('app_secret'), array('class'=>'form-control', 'placeholder'=>'')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('page_id', 'Facebook Page ID:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('page_id', Input::old('page_id'), array('class'=>'form-control', 'placeholder'=>'')) }}
            </div>
        </div>


        <div class="form-group">
            {{ Form::label(' copy_right', 'Copy right:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
              {{ Form::text('copy_right', Input::old('copy_right'), array('class'=>'form-control', 'placeholder'=>'Copy_right')) }}
            </div>
        </div>


<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary')) }}
      {{ link_to_route('admin..settings.index', 'Cancel', '', array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop