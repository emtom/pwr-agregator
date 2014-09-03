@extends ('master')

@section ('title')
	@parent strona glówna
@stop

@section ('body-class') home-page @stop

@section ('aside-nav')

	<a href="#" class="btn-aside btn-show-aside"><i class="fa fa-bars"></i></a>

@stop

@section ('aside-contents')

	<section class="aside-profile">
		<div class="img-container">
			<img src="{{$user['photo'] }}" alt="user">
		</div>
	</section>
	<nav class="main-nav">

		<ul>
			<li><a href="{{ url('profile') }}">Profil</a></li>
			<li><a href="{{ url('logout') }}">wyloguj</a></li>
		</ul>

	</nav>

@stop

@section ('content')

	<div class="main-container">
		<main>

			<div class="stream"></div>

		</main>
	</div>
	<script>
		//var ajaxLink = "{{ url('fbstream') }}";
		var ajaxLink = "{{ url('stream') }}";
	</script>


	@include ('handlebars-templates/stream-templates');


@stop

@section ('scripts') {{ HTML::script('./assets/js/home.js') }} @stop


