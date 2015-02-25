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
					Połącz się używając:
				</p>
			</div>


			<a href="{{ url('fblogin') }}" class="btn btn-facebook">Facebook</a>


		</div><!-- / register panel -->

	</main>

@stop