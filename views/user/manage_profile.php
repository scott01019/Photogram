<?php require_once __DIR__ . '/../../php/filters/user_only_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once __DIR__ . '/../partials/head.php'; ?>
    </head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_user.php'; ?>
        <div class="container">
            <h3 class='text-center'>Upload a Profile Image</h3>
            <br>
            <?php require_once __DIR__ . '/partials/manage_profile_form.php'; ?>
        </div> <!-- /container -->

        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src='../../js/upload_profile_img.js'></script>
    </body>
</html>
