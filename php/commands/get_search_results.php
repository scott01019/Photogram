<?php
require_once __DIR__ . '/../utilities/db_connect.php';
require_once __DIR__ . '/../utilities/functions.php';

//  this file is triggered on submission of a search user request

if (!isset($_POST['search'])) $_POST['search'] = 'not set'; //  assign value if notset
$results = searchUser($db, $_POST['search']); //  call this function to find users related to search
$user_search_results = array(); //  an array to hold the results
if (count($results)) {  //  if results are found
    for ($i = 0; $i < 10; ++$i) {   //  for the top 10 results
        if (isset($results[$i])) {  //  format data and push to results array
            $user_result = '<a href="index.php?user=' . $results[$i]; 
            $user_result .= '"><div class="col-md-2" style="margin-left: 0;"><div class="thumbnail">';
            $user_result .= '<img class="profile-img" src="../../resources/images/profiles/';
            $user_result .= getProfileImg($db, $results[$i]) . '" alt="...">';
            $user_result .= '<div class="caption"><h3 class="text-center">';
            $user_result .= $results[$i] . '</h3></div></div></div>';
            array_push($user_search_results, $user_result);
        }
    }
} else {    //  else no results found
    array_push($user_search_results, '<h3 class="text-center">No results found</h3>');
}
?>