<?php require_once __DIR__ . '/../../../php/filters/user_only_auth.php'; ?>

<?php
    require_once __DIR__ . '/../../../php/utilities/functions.php';
    require_once __DIR__ . '/../../../php/utilities/db_connect.php';
    $result = '../../resources/images/profiles/' . getProfileImg($db, $_SESSION['username']);  //  user's profile image directory for nav
?>
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">Photogram</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form navbar-left" role="search" method='post' action='search_user_results.php'>
                <div class="form-group">
                    <input type="text" class="form-control" name='search' placeholder="Find a Friend">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li class='hidden-xs'>
                    <a href="index.php" id='nav-profile-img-container' class="thumbnail img-responsive">
                        <img id='nav-profile-img' src=<?= $result ?> >
                    </a>
                </li>
                <li>
                    <li style='margin-left: 5px'><a href='friend_inbox.php'><span class='glyphicon glyphicon-user' aria-hidden='true'></span></a></li>
                    <li><a href="view_messages.php"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        <?php echo $_SESSION['username']; ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href='view_users.php'>View Users</a>
                        </li>
                        <li>
                            <a href='manage_profile.php'>Manage Profile</a>
                        </li>
                        <li>
                            <a href="../../php/commands/logout.php">Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div>
</nav>
