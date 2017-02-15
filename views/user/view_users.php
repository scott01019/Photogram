<?php require_once __DIR__ . '/../../php/filters/user_only_auth.php'; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once __DIR__ . '/../partials/head.php'; ?>
    </head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_user.php'; ?>
        <div class="container">
            <div id='user-container' class='col-md-offset-2'>
            </div>
            <nav>
                <ul class="pager">
                    <li><a class='prev_page' href="#">Previous</a></li>
                    <li><a class='next_page' href="#">Next</a></li>
                </ul>
            </nav>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src='../../js/paginate.js'></script>
    </body>
</html>