$(document).ready(function () {
	$('#friends-tab').on('click', function() {	//	when friends-tab is clicked
		$('#postcards').hide();					//	hide postcards
		$('#friends').show();					//	show friends
	});

	$('#postcards-tab').on('click', function() {	//	when postcards-tab is clicked
		$('#postcards').show();						//	show postcards
		$('#friends').hide();						//	hide friends
	});

	$('#friends').hide();	//	hide friends onload (postcards are active tab)
});