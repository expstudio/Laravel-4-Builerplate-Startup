@extends('admin.layouts.admin')

@section('main')

<div class="row">
    <div class="col-lg-12">
        <h1>แก้ไขข้อมูลผู้ใช้</h1>

        @if ($errors->any())
        	<div class="alert alert-danger">
        	    <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
        	</div>
        @endif
    </div>
</div>

{{ Form::model($user, array('class' => 'form-horizontal', 'id'=> 'my-awesome-dropzone', 'method' => 'PATCH', 'route' => array('admin..users.update', $user->id), 'files' => true)) }}

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#detail" data-toggle="tab">Detail</a>
        </li>
        <li><a href="#profile" data-toggle="tab">Profile</a>
        </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane fade in active" id="detail">

        <div class="form-group">
            {{ Form::label('username', 'Username:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('username', Input::old('username'), array('class'=>'form-control', 'placeholder'=>'Username', 'disabled')) }}
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

        <div class="form-group">
            {{ Form::label('confirmed', 'Confirmed :', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::checkbox('confirmed', Input::old('confirmed'), $user->confirmed) }}
            </div>
        </div>
      </div>
      <div class="tab-pane fade" id="profile">        

        <div class="form-group">
            {{ Form::label('profile[name]', 'ขื่อ:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('profile[name]', Input::old('profile[name]'), array('class'=>'form-control', 'placeholder'=>'Full Name')) }}
            </div>
        </div>  

        <div class="form-group">
            {{ Form::label('profile[title]', 'ตำแหน่ง:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('profile[title]', Input::old('profile[title]'), array('class'=>'form-control', 'placeholder'=>'Title')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('profile[about]', 'ข้อมูลส่วนตัว:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::textarea('profile[about]', Input::old('profile[about]'), array('class'=>'form-control', 'rows' => '5', 'placeholder'=>'About')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('profile[email]', 'Email:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('profile[email]', Input::old('profile[email]'), array('class'=>'form-control', 'placeholder'=>'Email')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('profile[facebook]', 'Facebook:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('profile[facebook]', Input::old('profile[facebook]'), array('class'=>'form-control', 'placeholder'=>'Facebook')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('profile[line]', 'Line:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('profile[line]', Input::old('profile[line]'), array('class'=>'form-control', 'placeholder'=>'Line')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('profile[twitter]', 'Twitter:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-4 col-md-4">
              {{ Form::text('profile[twitter]', Input::old('profile[twitter]'), array('class'=>'form-control', 'placeholder'=>'Twitter')) }}
            </div>
        </div>

        <div class="form-group">
            {{ Form::label('profile[cover]', 'รูปโปรไฟล์:', array('class'=>'col-md-2 control-label')) }}
            <div class="col-sm-10">
            @if($user->profile)
              {{ HTML::image($user->profile->cover->url('thumb'), "Cover") }}
            @endif
              {{ Form::file('profile[cover]', Input::old('profile[cover]'), array('class'=>'form-control')) }}
            </div>
        </div>
      </div>
    </div> <!-- Tab Panel -->

<div class="form-group">
    <label class="col-sm-2 control-label">&nbsp;</label>
    <div class="col-sm-10">
      {{ Form::submit('Update', array('class' => 'btn btn-lg btn-primary', 'data-disable-with'=>"Updating...")) }}
      {{ link_to_route('admin..users.index', 'Cancel', $user->id, array('class' => 'btn btn-lg btn-default')) }}
    </div>
</div>

{{ Form::close() }}

@stop

@section('script')
@stop