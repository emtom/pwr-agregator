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

				});
			} else {

				$.ajax({
					url: ajaxLink
				}).done(function(data) {

					console.log(data);
					stream.removeClass('content-loading')

					$.each(data.home.data, function(i, e){
						htmlElem = fbTplTemplate(e);
						stream.append(htmlElem);
					});

					var msnry = new Masonry( '#home-stream', {
						itemSelector: '.post-container'
					});

					loading = false;

				});

			}


		}
	} // getStream




})($);