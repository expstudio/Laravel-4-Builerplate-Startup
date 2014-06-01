@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-lg-12">
      <h1>เพิ่มผู้ใช้ใหม่</h1>
        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::open(array('class' => 'form-horizontal', 'id'=> 'my-awesome-dropzone', 'route' => 'admin..users.store', 'files' => true)) }}

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#detail" data-toggle="tab">Detail</a>
        </li>
    </ul>
<!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="detail">

        <div class="form-group">
            {{ Form::label('username', 'Username:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Username')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('email', 'Email:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('email', Input::old('email'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password', 'Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value='{{ Input::old('password') }}' name='password'>
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('password_confirmation', 'Confirm Password:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm Password" value='' name='password_confirmation'>
            </div>
        </div>
      </div>
    </div> <!-- Tab Panel -->
    
  <div class="form-group">
      <label class="col-sm-2 control-label">&nbsp;</label>
      <div class="col-sm-10">
        {{ Form::submit('Create', array('class' => 'btn btn-lg btn-primary', 'data-disable-with'=>"Saving...")) }}
        {{ link_to_route('admin..users.index', 'Cancel', null, array('class' => 'btn btn-lg btn-default ')) }}
      </div>
  </div>
{{ Form::close() }}
@stop

@section('script')

@stop


