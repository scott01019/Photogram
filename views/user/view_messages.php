<?php require_once __DIR__ . '/../../php/filters/user_only_auth.php'; 
require_once __DIR__ . '/../../php/utilities/functions.php';
require_once __DIR__ . '/../../php/utilities/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once __DIR__ . '/../partials/head.php'; ?>
    </head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_user.php'; ?>
        <div class="container">
            <?php require_once __DIR__ . '/partials/messages_nav.php'; ?>
            <div id='received-messages'>
                <?php echo getReceivedMessages($db, $_SESSION['username']); ?>
            </div>
            <div id='sent-messages'>
                <?php echo getSentMessages($db, $_SESSION['username']); ?>
            </div>
        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src='../../js/messages_nav_tabs.js'></script>
    </body>
</html>