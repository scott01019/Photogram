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

	//	Purpose: Changes filter when user selects new filter.
	//	PreCondition: User selects new filter.
	//	PostCondition: Applies new filter to Image canvas.
	$('#filterSelect').change(function() {
		$('#img').removeClass();
		switch($('#filterSelect option:selected').val()) {
			case 'original': $('#img').removeClass();;
			break;
			case '1977': $('#img').addClass('Seventies');
			break;
			case 'Amaro': $('#img').addClass('Amaro');
			break;
			case 'Brannan': $('#img').addClass('Brannan');
			break;
			case 'Earlybird': $('#img').addClass('Earlybird');
			break;
			case 'Grayscale': $('#img').addClass('Grayscale');
			break;
			case 'Hefe': $('#img').addClass('Hefe');
			break;
			case 'Hudson': $('#img').addClass('Hudson');
			break;
			case 'Inkwell': $('#img').addClass('Inkwell');
			break;
			case 'Kelvin': $('#img').addClass('Kelvin');
			break;
			case 'LoFi': $('#img').addClass('LoFi');
			break;
			case 'Mayfair': $('#img').addClass('Mayfair');
			break;
			case 'NashVille': $('#img').addClass('NashVille');
			break;
			case 'Nostalgia': $('#img').addClass('Nostalgia');
			break;
			case 'Rise': $('#img').addClass('Rise');
			break;
			case 'Sierra': $('#img').addClass('Sierra');
			break;
			case 'Sutro': $('#img').addClass('Sutro');
			break;
			case 'Toaster': $('#img').addClass('Toaster');
			break;
			case 'Valencia': $('#img').addClass('Valencia');
			break;
			case 'Walden': $('#img').addClass('Walden');
			break;
			case 'Willow': $('#img').addClass('Willow');
			break;
			case 'XPro2': $('#img').addClass('XPro2');
			break;
		}
	});
});