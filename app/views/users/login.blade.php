@extends('admin.layouts.login')

@section('main')
	{{ Form::open(array('role' => 'form', 'route' => 'user..login.do_login')) }}
	<fieldset>
		<div class="form-group">
            <input class="form-control" tabindex="1" placeholder="admin" type="text" name="email" id="email" value="">
        </div>
        <div class="form-group">
             <input class="form-control" tabindex="2" placeholder="asdqwe123" type="password" name="password" id="password">
        </div>
        <div class="checkbox">
            <label>
                <input tabindex="4" type="checkbox" name="remember" id="remember" value="1">Remember Me
            </label>
        </div>

        <div class="form-group">
            <button tabindex="3" type="submit" class="btn btn-lg btn-success btn-block">Login</button>
        </div>
    </fieldset>
	{{ Form::close() }}
@stop