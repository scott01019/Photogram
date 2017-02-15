<?php require_once __DIR__ . '/../../../php/filters/user_only_auth.php'; ?>

<?php
    require_once __DIR__ . '/../../../php/utilities/functions.php';
    if (!isset($_SESSION)) session_start();	//	start session if needed
    if (isset($_GET['user'])) $username = $_GET['user'];	//	assign username to GET['user'] if other users profile
    else $username = $_SESSION['username'];	//	else it is this users profile assign SESSION['username']
    $profile_img = '../../resources/images/profiles/' . getProfileImg($db, $username);	//	get profile image directory
?>

<div class="col-md-2">
    <div class="thumbnail">
        <img class="profile-img" src=<?= $profile_img ?> alt="...">
        <h3 class="text-center"><?= $username ?></h3>
    </div>
</div>