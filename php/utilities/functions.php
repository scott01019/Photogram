<?php

//  salt used for passwords
function getSalt() { return 'Zk1*<@]]$4bU;5=i9#(pqCL/&$paoKj.Q7g-(D==Z)C[?Ih(Y]%}0xF/u Dc`SlU'; }

//  returns users from database with similar names to search
function searchUser($db, $search) {
    $search = sanitizeString($db, $search); //  sanitize the serach
    $data = array();    //  initialize array for results
    while (count($data) < 10 && isset($search) && strlen($search) > 1) {    //  while less than 10 results and $search has a length > 1
        $sql_search_users = "SELECT USERNAME FROM USERS_P2 WHERE USERNAME LIKE '%" . $search . "%'";    //  prepare statement for users with usernames like search
        $check_search_users = $db->query($sql_search_users);    //  query database

        while ($row = $check_search_users->fetch_row()) {   //  while results exists
            array_push($data, $row[0]); //  push result onto array
        }
        $data = array_unique($data);    //  delete all reoccuring entries in results
        $search = substr($search, 0, -1);   //  drop last char of search string
    }
    return array_values($data); //  return resulting array
}

//  gets the profile image name from database for specific user
function getProfileImg($db, $username) {
    $username = sanitizeString($db, $username); //  sanitize username string
    $sql_profile_img = "SELECT PROFILE_IMG FROM USERS_P2 WHERE USERNAME = '" . $username . "'"; //  prepare statement for querying
    $check_profile_img = $db->query($sql_profile_img);  //  query the database
    if ($check_profile_img) {   //  if result exists
        $result = $check_profile_img->fetch_row();  //  get result
        return $result[0];  //  return result
    }
    else return 'default.jpg';  //  else return default image
}

//  sanitizes a string for database query
function sanitizeString($_db, $str)
{
    $str = strip_tags($str);
    $str = htmlentities($str);
    $str = stripslashes($str);
    return mysqli_real_escape_string($_db, $str);
}

//  get html formated postcard for given recipient
function getPostCards($db, $recip) {
    $sql_get_postcards = "SELECT AUTHOR, IMAGE_NAME, FILTER, IMAGE_TEXT, IMAGE_TITLE FROM POSTCARDS_P2 WHERE RECIP ='" 
                        . $recip . "' ORDER BY TIME_STAMP DESC";    //  prepare sql statement
    $query_get_postcards = $db->query($sql_get_postcards);  //  query the statement
    $output = '';   //  initialize output
    while ($row = $query_get_postcards->fetch_assoc()) {    //  while results exist format them and append them to output
        $output .= '<div class="panel panel-default postcard-panel"><div class="panel-heading">"' . $row['IMAGE_TITLE']
        . '" posted by ' . $row['AUTHOR'] 
        . '</div><div class="body"><img src="../../resources/images/postcards/' . $row['IMAGE_NAME'] . '" class="postcard-img ' . $row['FILTER'] . '" width="300px">' . $row['IMAGE_TEXT'] . '</div></div>';
    }
    return $output; //  return output
}

//  get received messages for a given recipient
function getReceivedMessages($db, $recip) {
    $sql_get_messages = 'SELECT AUTHOR, MESSAGE_TITLE, MESSAGE_TEXT FROM MESSAGES_P2 WHERE RECIP = "' 
                        . sanitizeString($db, $recip) . '" ORDER BY ID DESC';   //  prepare sql statement for querying
    $query_get_messages = $db->query($sql_get_messages);    //  query the statement
    $output = '';   //  initialize output
    while ($row = $query_get_messages->fetch_assoc()) { //  while results exists format and append to ouput
        $output .= '<div class="panel panel-default postcard-panel"><div class="panel-heading">"' . $row['MESSAGE_TITLE']
        . '" sent by ' . $row['AUTHOR'] 
        . '</div><div class="body">' . $row['MESSAGE_TEXT'] . '</div><div class="text-right"><a href="send_message.php?user=' 
        . $row['AUTHOR'] . '">Reply</a></div></div>';
    }
    return $output; //  return output
}

//  gets the messages sent by the given author
function getSentMessages($db, $author) {
    $sql_get_messages = 'SELECT RECIP, MESSAGE_TITLE, MESSAGE_TEXT FROM MESSAGES_P2 WHERE AUTHOR = "' 
                        . sanitizeString($db, $author) . '" ORDER BY ID DESC';  //  prepare the sql statement to find sent messages
    $query_get_messages = $db->query($sql_get_messages);    //  query the database
    $output = '';   //  intitialize output
    while ($row = $query_get_messages->fetch_assoc()) { //  while results exists format and append them to output
        $output .= '<div class="panel panel-default postcard-panel"><div class="panel-heading">"' . $row['MESSAGE_TITLE']
        . '" sent to ' . $row['RECIP'] 
        . '</div><div class="body">' . $row['MESSAGE_TEXT'] . '</div></div>';
    }
    return $output; //  return output
}

//  determine if a friend request exists between two users
function friendRequestExists($db, $friend_one, $friend_two) {
    $sql_check_valid_friend_request = 'SELECT * FROM FRIENDS_P2 WHERE FRIEND_ONE = "' 
                                . $friend_one . '" AND FRIEND_TWO = "' . $friend_two . '"'; //  prepare sql statement for first query
    $query_check_valid_friend_request = $db->query($sql_check_valid_friend_request);    //  query the database
    if ($query_check_valid_friend_request->num_rows != 0) { //  if result is found return true
        return true;
    }

    $sql_check_valid_friend_request = 'SELECT * FROM FRIENDS_P2 WHERE FRIEND_ONE = "' 
                                    . $friend_two . '" AND FRIEND_TWO = "' . $friend_one . '"'; //  prepare sql statement for second query
    $query_check_valid_friend_request = $db->query($sql_check_valid_friend_request);    //  query the database
    if ($query_check_valid_friend_request->num_rows != 0) { //  if result is found return true
        return true;
    } else {    //  else return false
        return false;
    }
}

//  get friend requests sent to the given recipient
function getFriendRequests($db, $recip) {
    $sql_get_friend_requests = "SELECT FRIEND_ONE FROM FRIENDS_P2 WHERE FRIEND_TWO = '" 
                            . $recip . "' AND STATUS = '2' ORDER BY TIME_STAMP DESC";   //  prepare sql statement for query
    $query_get_friend_requests = $db->query($sql_get_friend_requests);  //  query the database
    $output = '';   //  initialize output
    $i = 0; //  set index to 0
    while ($row = $query_get_friend_requests->fetch_assoc()) {  //  while results exist format and append to output
        $i++;   //  increment index
        if ($i % 5 == 1) {  //  every five entries begin a new row
            $output .= '<div class="row">';
        }
        $output .= '<div class="col-md-2"><div class="thumbnail">'
                . '<img class="profile-img" src="../../resources/images/profiles/' . getProfileImg($db, $row['FRIEND_ONE']) . '" alt="...">'
                . '<div class="caption"><h3 class="text-center">' . $row['FRIEND_ONE'] . '</h3></div>' 
                . '<div class="panel-footer"><a href="../../php/commands/accept_friend.php?user=' . $row['FRIEND_ONE']
                . '" style="text-decoration: none"><button type="button" class="btn btn-default btn-block">' 
                . 'Accept Friend</button></a>'
                . '<a href="../../php/commands/decline_friend.php?user=' . $row['FRIEND_ONE'] 
                . '" style="text-decoration: none"><button type="button" class="btn btn-default btn-block">' 
                . 'Decline Friend</button></div></div></div>';
        if ($i % 5 == 0) {  //  end row every five entries
           $output .= '</div>';
       }
    }
    return $output; /// return result
}

//  returns all accepted friends of the given user
function getFriends($db, $username) {
    $sql_get_friends = "SELECT FRIEND_TWO, FRIEND_ONE FROM FRIENDS_P2 WHERE (FRIEND_ONE = '" . sanitizeString($db, $username) 
                    . "' OR FRIEND_TWO = '" . sanitizeString($db, $username) . "') AND STATUS = '1'";   //  prepare sql statement to find accepted friends
    $query_get_friends = $db->query($sql_get_friends);  //  query database for accepted friends
    $output = '';   //  initialize output
    $i = 0; //  set to zero
    while ($row = $query_get_friends->fetch_assoc()) {  //  while results exist format and append to output
         $i++; 
         if ($i % 5 == 1) { //  every five entries we start a new row
             $output .= '<div class="row">';
         }
         $current = (strcmp($row['FRIEND_ONE'], $username) == 0) ? $row['FRIEND_TWO'] : $row['FRIEND_ONE'];  //  determine which username is the friend's
         $output .= '<div class="col-md-2"><div class="thumbnail">'
                 . '<img class="profile-img" src="../../resources/images/profiles/' . getProfileImg($db, $current) . '" alt="...">'
                 . '<div class="caption"><h3 class="text-center">' . $current . '</h3></div></div></div>';
         if ($i % 5 == 0) { //  finish row after every five entries
            $output .= '</div>';
        }
    }
    return $output; //  return output
}
?>
