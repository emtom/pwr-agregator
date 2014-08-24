(function($){

	var main = $('main');

	main.append('<div class="loader-gif"></div>');

	var fbTplSource = $("#fb-tpl").html();
	var fbTplTemplate = Handlebars.compile(fbTplSource);
	var htmlElem;
	var html;


	$.ajax({
		url: ajaxLink
	}).done(function(data) {

		main.html('');
		stream = $('<div class="stream" id="home-stream"></div>');
		console.log(data);

		$.each(data.home.data, function(i, e){
			htmlElem = fbTplTemplate(e);
			stream.append(htmlElem);
		});

		main.append(stream);

		var msnry = new Masonry( '#home-stream', {
			itemSelector: '.post-container'
		});

	});



})($);