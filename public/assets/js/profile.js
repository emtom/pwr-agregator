$(document).ready(function(){

	var list = $('#user-friends');
	var friends = list.find('tr');

	$('#friend-filter-options a').on('click', function(e){

		e.preventDefault();
		var a = $(this);

		if(a.attr('data-target') == 'all') {
			friendsFiltered = friends;
		} else {
			friendsFiltered = friends.filter(function() {
				return $(this).attr('data-type') == a.attr('data-target');
			});
		}

		if( friendsFiltered.length ) {
			list.empty().hide().append(friendsFiltered).fadeIn('fast');
		} else {
			list.empty().append('<p class="info">brak wyników</p>');
		}

	});

});