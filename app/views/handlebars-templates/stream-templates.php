<script id="fb-tpl" type="text/x-handlebars-template">

	<div class="post-container">
		<article class="post fb-post">

			{{#if message}}
			<div class="content">

				<p>{{ message }}</p>

			</div>
			{{/if}}

			{{#if picture}}
				<div class="img-container">
					<a href="{{ link }}" target="_blank"><img src='{{picture}}' alt=""></a>
				</div>
			{{/if}}
			{{#if description}}
				<div class="content small">
					{{#if name }} <h3>{{ name }}</h3> {{/if}}
					{{#if description }} <p>{{ description }}</p> {{/if}}
				</div>
			{{/if}}
			<div class="footer">

				<div class="footer__left"></div>
				<div class="footer__right">- {{ from.name }}</div>

			</div>

		</article>
	</div>

</script>

<script id="instagram-tpl" type="text/x-handlebars-template">

	<article class="post insta-post">

		<div class="content">

		</div>
		<div class="footer">
			<small>-author</small>
		</div>

	</article>

</script>

<script id="twitter-tpl" type="text/x-handlebars-template">

	<article class="post tw-post">

		<div class="content">

		</div>
		<div class="footer">
			<small>-author</small>
		</footer>

	</article>

</script>