<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ Setting::SITE_META() }}">
    <meta name="author" content="EXP Studio">
    <link rel="shortcut icon" href="/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/assets/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="canonical" href="http://expstudio.net/" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ Setting::SITE_TITLE() }}" />
    <meta property="og:description" content="{{ Setting::SITE_META() }}" />
    <meta property="og:url" content="http://expstudio.net/" />
    <meta property="og:site_name" content="EXP Studio" />
    <meta property="article:publisher" content="https://www.facebook.com/expstudio" />
    <meta property="og:image" content="http://expstudio.net/assets/images/logo.png" />
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="@watee"/>
    <meta name="twitter:domain" content="EXP Studio"/>
    <meta name="twitter:creator" content="@watee"/>

    <title>@yield('title') 
        | 
        {{ Setting::SITE_TITLE() }}
    </title>

    <!-- Bootstrap core CSS -->
    {{ HTML::style('assets/css/libs/bootstrap.min.css') }}
    <!-- Font Awesome CSS -->
    {{ HTML::style('assets/css/libs/font-awesome.css') }}
    <!-- STYLE CSS -->
    {{ HTML::style('assets/css/modern-business.css') }}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      {{ HTML::script('assets/js/html5shiv.js') }}
      {{ HTML::script('assets/js/respond.min.js') }}
    <![endif]-->
    @yield('style')
</head>