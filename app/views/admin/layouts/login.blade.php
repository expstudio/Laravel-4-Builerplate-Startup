
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') Admin</title>

    {{ HTML::style('assets/css/libs/bootstrap.min.css') }}
    {{ HTML::style('assets/css/libs/font-awesome.css') }}
    {{ HTML::style('assets/css/sb-admin.css') }}

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                       @yield('main')
                    </div>
                    <div class="panel-footer">
                       <div class="text-center">
                        Powered by <a href="http://www.expstudio.net" title="EXP Studio" target="_blank">EXP Studio</a>
                        <br>
                        Need Support <a href="mailto:waycs16@gmail.com" title="waycs16@gmail.com">waycs16@gmail.com</a>
                       </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{ HTML::script('assets/js/libs/jquery-1.11.0.min.js') }}
    {{ HTML::script('assets/js/libs/bootstrap.min.js') }}
    {{ HTML::script('assets/js/plugins/metisMenu/jquery.metisMenu.js') }}
    {{ HTML::script('assets/js/sb-admin.js') }}

</body>

</html>
