var current_page = 0;	//	current_page of view_users

$(document).ready(function() {
	$(document.body).on('click', '.next_page, .prev_page', function() { // when next page or previous page is clicked
		$('#user-container').children().remove();	//	remove former results

		if ($(this).hasClass('next_page')) current_page++;	//	if next page is clicked increment current_page
		else current_page--;								//	else prev page is clicked decrement current_page

		$.ajax({	//	ajax call to paginate_users.php to receive next page of users
			url: '../../php/commands/paginate_users.php',
			type: 'post',
			dataType: 'json',
			data: { next_page: current_page },
			success: function(data) {
				if (data.length < 25) $('.next_page').hide();	//	if there are less than 25 results there is no next page
				else $('.next_page').show();					//	else there is a next page show the nextpage button

				if (current_page == 0) $('.prev_page').hide();	//	if we are on the first page there is no previous page, so hide the button
				else $('.prev_page').show();					//	else there is a previous page show the button

				displayUsers(data);								//	display the users on the page
			},
			error: function() {
				console.log('error error error');
			}
		});
	});

	//	this ajax call is the same as the one above it is used onload of the page
	$.ajax({
		url: '../../php/commands/paginate_users.php',
		type: 'post',
		dataType: 'json',
		data: { next_page: current_page },
		success: function(data) {
			if (data.length < 5) $('.next_page').hide();
			else $('.next_page').show();

			if (current_page == 0) $('.prev_page').hide();
			else $('.prev_page').show();

			displayUsers(data);
		},
		error: function() {
			console.log('error error error');
		}
	});
});

//	a function to return the users in the proper format
function displayUsers(users) {
	$.ajax({	//	ajax request to get_profile_img.php (sends array of users)
		url: '../../php/commands/get_profile_img.php',
		type: 'post',
		dataType: 'json',
		data: { users: users },
		success: function(data) {	//	receives the profile images of each user
			for (var i = 0; i < data.length; ++i) {	//	for each user format data to panel correctly and output it to the page
				if (i % 5 == 0) $('#user-container').append("<div id='row" + Math.floor(i/5) + "' class='row'></div>");
				var entry = '<div class="col-md-2"><div class="thumbnail">'
							+ '<a href="index.php?user=' + users[i] + '" style="text-decoration: none">'
							+ '<img class="profile-img" src="../../resources/images/profiles/' + data[i] + '" alt="...">'
							+ '<div class="caption"><h3 class="text-center">' + users[i] + '</h3></div></a></div>';
				$('#row' + Math.floor(i/5)).append(entry);
			}
		}, error: function() {
			console.log('fail');
		}
	});
}