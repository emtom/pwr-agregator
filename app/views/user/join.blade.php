@extends ('master')

@section ('title')
	@parent logowanie
@stop

@section ('content')

	<main class="no-aside">
		<div class="content-box credentials-panel">

			<div class="content">
				<h1>Logowanie</h1>

				<p>
					Połącz się fejsem
				</p>
			</div>


			<a href="{{ url('fblogin') }}" class="btn btn-facebook">Połącz przez fejsa!</a>


		</div><!-- / register panel -->

		<div class="text-box credential-text-panel">

			<p>Jeśli jesteś tu po raz pierwszy, zarejestruj się:</p>
			<a href="{{ url('fbregister') }}" class="link">Zarejestruj się przez Facebook</a>

		</div><!-- / cretential text panel -->

	</main>

@stop