$(document).ready(function() {
	$('#received-tab').on('click', function() {	//	when received-tab is clicked
		$('#received-messages').show();		//	show received messages
		$('#sent-messages').hide();			//	hide sent messages
	});

	$('#sent-tab').on('click', function() {	//	when sent-tab is clicked
		$('#received-messages').hide();		//	hide received messages
		$('#sent-messages').show();			//	show sent messages
	});

	$('#sent-messages').hide();				//	hide sent messages on load
});