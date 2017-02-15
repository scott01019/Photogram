<?php require_once __DIR__ . '/../../php/filters/guest_only_auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
	<?php require_once __DIR__ . '/../partials/head.php'; ?>
    </head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_guest.php'; ?>
        <div class="container">

            <!-- Main component for a primary marketing message or call to action -->
            <div class="jumbotron">
                <h1>Welcome to Photogram!</h1>
                <p>The coolest place on the web to share images with your friends.</p>
                <p>Click "Sign Up!" below to see what all the fuss is about!</p>
                <p>
                    <a class="btn btn-lg btn-default" href="registration.php" role="button">Sign Up!</a>
                </p>
            </div>

        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>
