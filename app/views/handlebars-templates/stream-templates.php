<script id="fb-tpl" type="text/x-handlebars-template">

	<div class="post-container">
		<article class="post fb-post">

			{{#if message}}
			<div class="content">

				<p>{{#if to}} <a href="{{ to.data.0.link_to }}" target="_blank">@{{ to.data.0.name }}</a> {{/if}} {{ message }}</p>

			</div>
			{{/if}}

			{{#compare type 'photo' operator="==" }}
				{{#if picture}}
					<div class="img-container">
						<a href="{{ link }}" target="_blank">

							<img src='{{ picture }}' alt="">
						</a>
					</div>
				{{/if}}
				{{#if description}}
					<div class="content small">
						{{#if name }} <h3>{{ name }}</h3> {{/if}}
						{{#if description }} <p>{{ description }}</p> {{/if}}
					</div>
				{{/if}}
			{{/compare}}

			{{#compare type 'link' operator='=='}}

				<a href="{{ link }}" target="_blank" class="link-container">
					{{#if picture}}
						<img src='{{ picture }}' alt="{{ name }}">
					{{/if}}
					{{#if description}}

						{{#if name }} <h3>{{ name }}</h3> {{/if}}
						{{#if description }} <p>{{ description }}</p> {{/if}}

					{{/if}}
					{{#if story}}
						<p>{{ story }}</p>
					{{/if}}
				</a>

			{{/compare}}
			{{#compare type 'video' operator='=='}}

				<a href="{{ link }}" target="_blank" class="link-container">
					{{#if picture}}
						<img src='{{ picture }}' alt="{{ name }}">
					{{/if}}
					{{#if description}}

						{{#if name }} <h3>{{ name }}</h3> {{/if}}
						{{#if description }} <p>{{ description }}</p> {{/if}}

					{{/if}}
				</a>

			{{/compare}}


			<div class="footer">

				<div class="footer__left">
					{{#if likes}}
						<i class="fa fa-heart"></i> {{ likes.data.length }}{{#if likes.paging.next }}+{{/if}}
					{{/if}}
				</div>
				<div class="footer__right">- <a href="{{ from.link_to }}" target="_blank">{{ from.name }}</a> <span class="fb-icon"><i class="fa fa-facebook-square"></i></span></div>

			</div>

		</article>
	</div>

</script>

<script id="insta-tpl" type="text/x-handlebars-template">

	<div class="post-container">
		<article class="post insta-post">

			{{#if caption}}
			<div class="content">
				<p> {{ caption }}</p>
			</div>
			{{/if}}
			<div class="img-container">
				<img src='{{ img_url.url }}' alt="{{ username }} picture">
			</div>
			<div class="footer">
				<div class="footer__left">
					<i class="fa fa-heart"></i> {{ like_count }}
				</div>
				<div class="footer__right">
					<small>- <a href="http://instagram.com/{{ username }}" target="_blank">{{ username }}</a> <span class="insta-icon"><i class="fa fa-instagram"></i></span></small>
				</div>
			</div>

		</article>
	</div>

</script>

<script id="tw-tpl" type="text/x-handlebars-template">


	<div class="post-container">
		<article class="post tw-post">

			<div class="content">
				<p>{{ text }}</p>
			</div>
			<div class="footer">
				<div class="footer__left">
					<i class="fa fa-heart"></i> {{ favorite_count }}
				</div>
				<div class="footer__right">
					<small>- <a href="https://twitter.com/{{ user.screen_name }}" target="_blank">{{ user.screen_name }}</a> <span class="tw-icon"><i class="fa fa-twitter-square"></i></span></small>
				</div>
			</div>

		</article>
	</div>

</script>


<script>

</script>