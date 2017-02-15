<?php require_once __DIR__ . '/../../php/filters/user_only_auth.php'; ?>
<?php require_once __DIR__ . '/../../php/commands/get_search_results.php'; ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once __DIR__ . '/../partials/head.php'; ?>
    </head>
    <body>
        <?php require __DIR__ . '/partials/nav_user.php'; ?>
        <div class="container">
            <div id='user-container'>
                <?php foreach($user_search_results as $user) echo $user; ?>
            </div>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
    </body>
</html>
