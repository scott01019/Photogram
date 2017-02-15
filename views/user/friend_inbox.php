<?php require_once __DIR__ . '/../../php/filters/user_only_auth.php'; 
require_once __DIR__ . '/../../php/utilities/functions.php';
require_once __DIR__ . '/../../php/utilities/db_connect.php';

$friend_requests = getFriendRequests($db, $_SESSION['username']);   //  get the friend requests
$output = empty($friend_requests) ? '<h3 class="text-center">No current friend requests.</h3>' : $friend_requests;  //  determine if friend requests exist and assign them if they do
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once __DIR__ . '/../partials/head.php'; ?>
    </head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_user.php'; ?>
        <div class="container">
            <?php echo $output; ?>
        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>