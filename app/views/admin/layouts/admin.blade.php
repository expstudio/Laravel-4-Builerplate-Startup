<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>
          @section('title')
          Admin
          @show
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSS are placed here -->

    {{ HTML::style('assets/css/libs/bootstrap.min.css') }}
    {{ HTML::style('assets/css/libs/bootstrap-responsive.min.css') }}
    {{ HTML::style('assets/css/libs/bootstrap-tagsinput.css') }}
		{{ HTML::style('assets/css/libs/font-awesome.css') }}
    {{ HTML::style('assets/css/libs/bootstrap-tagsinput.css') }}
    {{ HTML::style('assets/css/libs/froala_editor.min.css') }}
    {{ HTML::style('assets/css/libs/dropzone.css') }}
    {{ HTML::style('assets/css/libs/jquery-ui-1.10.4.custom.min.css') }}
    {{ HTML::style('assets/css/libs/slider.css') }}
    {{ HTML::style('assets/css/libs/datepicker.css') }}
    {{ HTML::style('assets/css/tree.css') }}
    {{ HTML::style('assets/css/sb-admin.css') }}
	</head>

	<body>
		<div id="wrapper">
		  <?php echo View::make('admin.layouts.navigation') ?>
		  <?php echo View::make('admin.layouts.left_side_bar') ?>
	      <div id="page-wrapper">
	         
	        @if (Session::has('message'))
						<div class="flash alert">
							<p>{{ Session::get('message') }}</p>
						</div>
					@endif

			@yield('main')
	      
	      </div>
	      <!-- /#page-wrapper -->

	    </div>

			{{ HTML::script('assets/js/libs/jquery-1.11.0.min.js') }}
			{{ HTML::script('assets/js/libs/bootstrap.min.js') }}
			{{ HTML::script('assets/js/libs/bootstrap3-typeahead.min.js') }}
	    {{ HTML::script('assets/js/libs/bootstrap-tagsinput.js') }}
	    {{ HTML::script('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}
	    {{ HTML::script('assets/js/libs/jquery.hotkeys.js') }}
	    {{ HTML::script('assets/js/libs/froala_editor.min.js') }}
			{{ HTML::script('assets/js/libs/dropzone.js') }}
			{{ HTML::script('assets/js/libs/laravel-ujs.js') }}
			{{ HTML::script('assets/js/libs/jquery-ui-1.10.4.custom.min.js') }}
			{{ HTML::script('assets/js/libs/bootstrap-slider.js') }}
			{{ HTML::script('assets/js/libs/underscore-min.js') }}
			{{ HTML::script('assets/js/libs/bootstrap-datepicker.js') }}
			{{ HTML::script('assets/js/tree.js') }}
    	{{ HTML::script('assets/js/sb-admin.js') }}
	    <script>
      	@yield('script')
    	</script>
	</body>

</html>