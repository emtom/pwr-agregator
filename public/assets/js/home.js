(function($){

	var main = $('main');
	var stream = $('<div class="stream" id="home-stream"></div>');
	var loading = false;
	var paging = {};

	main.append('<div class="loader-gif"></div>');

	var fbTplSource = $("#fb-tpl").html();
	var fbTplTemplate = Handlebars.compile(fbTplSource);
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

			if(type == 'initial') {

				$.ajax({
					url: ajaxLink
				}).done(function(data) {

					main.html('');
					console.log(data);

					$.each(data.home.data, function(i, e){
						htmlElem = fbTplTemplate(e);
						stream.append(htmlElem);
					});

					main.append(stream);

					var msnry = new Masonry( '#home-stream', {
						itemSelector: '.post-container'
					});

					loading = false;
					paging.next = data.home.paging.next;
					paging.prev = data.home.paging.previous;

					console.log( paging.prev );

				});
			} else {

				main.append('<div class="loader-gif"></div>');
				$("html, body").animate({ scrollTop: $(document).height() }, 1500);

				$.ajax({
					url: ajaxLink
				}).done(function(data) {

					console.log(data);
					main.find('.loader-gif').remove();

					$.each(data.home.data, function(i, e){
						htmlElem = fbTplTemplate(e);
						stream.append(htmlElem);
					});

					var msnry = new Masonry( '#home-stream', {
						itemSelector: '.post-container'
					});

					loading = false;
					paging.next = data.home.paging.next;
					paging.prev = data.home.paging.previous;

					console.log( paging.prev );

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