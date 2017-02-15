<?php require_once __DIR__ . '/../../../php/filters/user_only_auth.php'; ?>

<?php
if (!isset($_SESSION)) session_start();	//	start session if needed
if (isset($_SESSION['upload_image_errors'])) {	//	display errors if they exist
  echo '<div class="alert alert-danger text-center col-md-7 col-md-offset-2" role="alert">' . $_SESSION['upload_image_errors'] . '</div>';
  unset($_SESSION['upload_image_errors']);	//	delete errors
}
?>
<form action="../../php/commands/upload_profile_images.php" method="post" enctype="multipart/form-data" class='col-md-4 col-md-offset-4'>
	<div class='row'>
	    <div class='form-group col-md-3'>
	        <span class='btn btn-default btn-file'>
	            Browse for Image<input type="file" id="upload" name="profile_img">
	        </span>
	    </div>
	</div>
	<div id='image-container'>
	    <img id='img' name='image' src='' width='100%'>
	</div>
	<br>
	<div class='row'>
	    <input type="submit" value="Upload Image" class="btn btn-default col-md-offset-1" name='submit'>
	</div>
</form>