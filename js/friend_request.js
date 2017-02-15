$(document).ready(function() {
	$('#friend-request').on('click', function() {
		var username = getParameterByName('user');	//	read the current $_GET['user'] variable
		$.ajax({	//	ajax request to trigger friend_request.php and pass the user to be requested
			url: '../../php/commands/friend_request.php',
			type: 'post',
			dataType: 'json',
			data: { recip: username},
			success: function(data) {
				$('#friend-request').remove();	//	remove ability to friend request again
			},
			error: function() {
				console.log('error during friend request');
			}
		});
	});
});

//	A function that reads finds the $_GET['name'] variable
//	Stolen from stack overflow, not really sure how it works
function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}