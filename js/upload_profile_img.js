$(document).ready(function() {

	//	Purpose: Loads uploaded image file to canvas. 
	//	PreCondition: User has uploaded a new image file.
	//	PostCondiiton: Image file will be drawn to canvas.
	$('#upload').change(function(e) {
		var reader = new FileReader();
		reader.onload = function(event)
		{
			$('#img').attr('src', event.target.result);
		}
		reader.readAsDataURL(e.target.files[0]);   
	});
});