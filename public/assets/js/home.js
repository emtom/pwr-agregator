var xhr;

(function($){

	var main = $('main');
	var stream = $('<div class="stream" id="home-stream"></div>');
	var loading = false;
	var paging = {};
	var msnry;

	main.append('<div class="loader-gif"></div>');

	var fbTplSource = $("#fb-tpl").html();
	var twTplSource = $('#tw-tpl').html();
	var instaTplSource = $('#insta-tpl').html();

	var fbTplTemplate = Handlebars.compile(fbTplSource);
	var twTplTemplate = Handlebars.compile(twTplSource);
	var instaTplTemplate = Handlebars.compile(instaTplSource);

	var htmlElem;
	var html;

	getStream('initial');



	$(window).scroll(function() {
		if($(window).scrollTop() + $(window).height() > $(document).height() - 100) {
			if(!loading) {
				stream.addClass('content-loading');
				getStream('scrolled');
			}

		}
	});


	function getStream(type) {

		if(!loading) {

			loading = true;
			console.log('fetching...');

			if(type == 'initial') {

				xhr = $.ajax({
					url: ajaxLink,
					data: {
						'getType': 'initial'
					}
				}).done(function(response) {

					main.html('');
					console.log(response);

					$.each(response.data, function(i, e){
						console.log(e);

						if(e.item_type == 'fb')
							htmlElem = fbTplTemplate(e);
						if(e.item_type == 'tw')
							htmlElem = twTplTemplate(e);
						if(e.item_type == 'insta')
							htmlElem = instaTplTemplate(e);

						stream.append(htmlElem);
					});

					main.append(stream);

					$('#home-stream').imagesLoaded(function(){
						msnry = new Masonry( '#home-stream', {
							itemSelector: '.post-container'
						});
					});


					loading = false;
					paging.prev = response.paging.fb.previous;
					paging.next = response.paging.fb.next;

					console.log( paging.prev );
					console.log( paging.next );

				});
			} else {

				main.append('<div class="loader-gif"></div>');

				xhr = $.ajax({
					url: ajaxLink,
					data: {
						'getType': 'scrolled',
						'paging': paging.next.substring(31)
					}
				}).done(function(response) {

					if(response.data.length) {
						main.find('.loader-gif').remove();

						$.each(response.data, function(i, e){
							console.log(e);
							if(e.item_type == 'fb')
								htmlElem = fbTplTemplate(e);
							if(e.item_type == 'tw')
								htmlElem = twTplTemplate(e);
							if(e.item_type == 'insta')
								htmlElem = instaTplTemplate(e);
							stream.append(htmlElem);
						});

						$('#home-stream').imagesLoaded(function(){
							msnry = new Masonry( '#home-stream', {
								itemSelector: '.post-container'
							});
						});

						loading = false;
						if(response.paging.fb) {
							paging.prev = response.paging.fb.previous;
							paging.next = response.paging.fb.next;
						}

					} else {
						loading = false;
						main.find('.loader-gif').remove();
					}

				});

			}


		}
	} // getStream




	Handlebars.registerHelper('compare', function(lvalue, rvalue, options) {

		if (arguments.length < 3)
			throw new Error("Handlerbars Helper 'compare' needs 2 parameters");

		operator = options.hash.operator || "==";

		var operators = {
			'==':		function(l,r) { return l == r; },
			'!=':		function(l,r) { return l != r; },
			'===':	function(l,r) { return l === r; },
			'!=':		function(l,r) { return l != r; },
			'<':		function(l,r) { return l < r; },
			'>':		function(l,r) { return l > r; },
			'<=':		function(l,r) { return l <= r; },
			'>=':		function(l,r) { return l >= r; },
			'typeof':	function(l,r) { return typeof l == r; }
		}

		if (!operators[operator])
			throw new Error("Handlerbars Helper 'compare' doesn't know the operator "+operator);

		var result = operators[operator](lvalue,rvalue);

		if( result ) {
			return options.fn(this);
		} else {
			return options.inverse(this);
		}

	});


})($);

$(document).ready(function(){
	$('.main-nav a').on('click', function(){
		if(typeof xhr.abort == 'function') {
			xhr.abort();
		}
	});
});