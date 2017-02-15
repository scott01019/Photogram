<?php 
require_once __DIR__ . '/../../php/filters/user_only_auth.php'; 
require_once __DIR__ . '/../../php/utilities/db_connect.php';
require_once __DIR__ . '/../../php/utilities/functions.php';
?>

<?php
    $username = isset($_GET['user']) ? $_GET['user'] : $_SESSION['username'];   //  determine username for profile (other user or currentuser)
    $url_upload = 'upload_postcard.php?user=' . $username;  //  create link for upload postcard
    if ((isset($_GET['user']) && strcmp(mb_strtolower($_GET['user']), mb_strtolower($_SESSION['username'])) == 0) || !isset($_GET['user'])) {    //  check if current user profile
        $message = '';  //  assign null if it is
        $friend = '';   //  assign null if it is
    } else {    //  else user is looking at other users profile
        $url_message = 'send_message.php?user=' . $username;    //  set send message url
        $message = '<a href=' . $url_message . ' style="text-decoration: none"><button type="button" class="btn';   //  format message button
        $message .= ' btn-default btn-block profile-btn" aria-label="Left Align">Message</button></a>';

        if (! friendRequestExists($db, $_SESSION['username'], $_GET['user'])) { //  check if friendship exists between users
            $url_friend = 'request_friend.php?user=' . $username;   //  if not create url for friend request button
            $friend = '<button type="button" class="btn';   //  format and assign friend request button
            $friend .= ' btn-default btn-block profile-btn" id="friend-request" aria-label="Left Align">Request Friendship</button>';
        } else {    //  if friendship exists friend button is assigned null
            $friend = '';
        }
    }
    $friends = getFriends($db, $username);  //  get list of friends for friends tab 
    $get_friends = empty($friends) ? "No current friends." : $friends;  //  if the result of get friends is empty then assign no current friends.
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once __DIR__ . '/../partials/head.php'; ?>
        <link href='../../css/styles.css' rel='stylesheet'>
    </head>

    <body>
        <?php require_once __DIR__ . '/partials/nav_user.php'; ?>
        <div class="container">
                        <header class='user-header col-md-12'>
                            <div class='row'>
                                <?php require_once __DIR__ . '/partials/profile_img.php'; ?>
                                <?php require_once __DIR__ . '/partials/profile_nav.php'; ?>
                            </div>
                        </header>
                        <div class="btn-group-vertical col-md-2" role="group">
                            <a href=<?=$url_upload ?> style='text-decoration: none'>
                                <button type="button" class="btn btn-default btn-block profile-btn" aria-label="Left Align">
                                    Upload a Postcard
                                </button>
                            </a>
                            <?php echo $message; ?>
                            <?php echo $friend; ?>
                        </div>
                        <div id='postcards' class='col-md-10'>
                            <?php echo getPostCards($db, $username); ?>
                        </div>
                        <div id='friends' class='col-md-10'>
                            <?php echo $get_friends; ?>
                        </div>
        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="../../js/bootstrap.min.js"></script>
        <script src='../../js/profile_nav_tabs.js'></script>
        <script src='../../js/friend_request.js'></script>
    </body>
</html>
