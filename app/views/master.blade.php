<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js ie lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js ie lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js ie lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js ie  "> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>
	        @section('title')
	        	Agregator -
	        @show
        </title>

        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!--[if lt IE 9]>
            <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
            <script>window.html5 || document.write('<script src="js/vendor/html5shiv.js"><\/script>')</script>
        <![endif]-->

    	{{ HTML::style('assets/css/reset.css') }}
        {{ HTML::style('assets/css/font-awesome.min.css') }}
        {{ HTML::style('assets/css/style.css') }}



    </head>
    <body class="@yield('body-class')">

        <aside>

            <section class="aside__bar--right">
                <a href="{{ url('home') }}" class="btn-home"><i class="fa fa-home"></i></a>
                @yield('aside-nav')
            </section>
            <section class="aside__bar--left">
                @yield('aside-contents')
            </section>

        </aside>



		@yield('content')

        <div class="mask"></div>

		{{ HTML::script('./assets/js/jquery-1.9.1.js') }}
		{{ HTML::script('./assets/js/handlebars-v1.3.0.js')}}
		{{ HTML::script('./assets/js/masonry.pkgd.min.js')}}
		{{ HTML::script('./assets/js/scripts.js') }}

		@yield ('scripts')

    </body>
</html>