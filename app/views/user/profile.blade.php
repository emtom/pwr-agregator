@extends ('master')

@section ('title')
	@parent profil
@stop

@section ('body-class')profile-page @stop

@section ('aside-nav')

	<a href="#" class="btn-aside btn-show-aside">menu</a>

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

	<div class="main-container sub-page">
		<div id="profile-page">

			<h1 class="page-heading"><span class="pull-left">{{ $user['name'] }}</span> <span class="pull-right">Profil użytkownika</span></h1>

		</div>
	</div>

@stop