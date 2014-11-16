@extends ('master')

@section ('title')
	@parent profil
@stop

@section ('body-class')profile-page @stop

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

	<div class="main-container sub-page">
		<div id="profile-page">

			<h1 class="page-heading"><span class="pull-left">{{ $user['name'] }}</span> <span class="pull-right">Profil użytkownika</span></h1>

			<div class="box">
				<h3>Połączenia</h3>

				<form action="#" class="connections">
					<fieldset>

						<ul>
							<li class="connection">

								<div class="connection__logo">
									<div class="container tw">
										<i class="fa fa-twitter"></i>
									</div>
								</div>
								<div class="connection__text">
									<h4>Twitter</h4>
									<p class="status">nie połączono</p>
								</div>
								<div class="connection__action">
									<a href="{{ url('twitter/connect') }}">połącz</a>
								</div>

							</li>

							<li class="connection">

								<div class="connection__logo">
									<div class="container instagram">
										<i class="fa fa-instagram"></i>
									</div>
								</div>
								<div class="connection__text">
									<h4>Instagram</h4>
									<p class="status">nie połączono</p>
								</div>
								<div class="connection__action">
									<a href="{{ url('instagram/connect') }}">połącz</a>
								</div>

							</li>
						</ul>

					</fieldset>
				</form>

			</div>

			<div class="box">

				<h3>
					<span class="pull-left">Lista znajomych</span>
					<span class="pull-right">filtruj:
						<ul id="friend-filter-options">
							<li><a href="#friends-all" data-target='all' title="wszyscy"><i class="fa fa-users"></i></a></li>
							<li><a href="#friends-facebook" data-target='fb' title="facebook"><i class="fa fa-facebook-square"></i></a></li>
							<li><a href="#friends-twitter" data-target='tw' title="twitter"><i class="fa fa-twitter-square"></i></a></li>
							<li><a href="#friends-instagram" data-target='insta' title="instagram"><i class="fa fa-instagram"></i></a></li>
						</ul>
					</span>
				</h3>

				<table class="user-friends" id="user-friends">

					@foreach ($fbFriends as $fbFriend)
						<tr data-type="{{$fbFriend['type']}}">
							<td class="type">
								<i class="fa fa-facebook-square"></i>
							</td>
							<td class="img-container">
								<img src="https://graph.facebook.com/{{$fbFriend["id"]}}/picture"/>
							</td>
							<td class="name">
								<h4><a href="https://www.facebook.com/{{$fbFriend['id']}}" target="_blank">{{ $fbFriend['name']}}</a></h4>
							</td>
							<td class="options">

							</td>
						</tr>
					@endforeach

					@foreacH ($twitterFriends as $twFriend)
						<tr data-type="{{$twFriend['type']}}">
							<td class="type">
								<i class="fa fa-twitter-square"></i>
							</td>
							<td class="img-container">
								<img src="{{$twFriend['profile_image_url']}}"/>
							</td>
							<td class="name">
								<h4><a href="https://twitter.com/{{$twFriend['screen_name']}}" target="_blank">{{$twFriend['name']}}</a></h4>
							</td>
							<td class="options">

							</td>
						</tr>
					@endforeach

				</table>

			</div>

		</div>
	</div>

@stop

@section ('scripts')
	{{ HTML::script('./assets/js/profile.js') }}
@stop