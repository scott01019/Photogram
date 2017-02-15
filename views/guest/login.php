<?php require_once __DIR__ . '/../../php/filters/guest_only_auth.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
    		<?php require_once __DIR__ . '/../partials/head.php'; ?>
		</head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_guest.php'; ?>

        <div class="container">
            <h1 class='text-center'>Login</h1>
            <?php require_once __DIR__ . '/partials/login_form.php'; ?>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>
