<?php
    require_once('../config/config.php');
    require_once('../includes/classes/User.php');
    require_once('../includes/classes/Post.php');
    $limit = 10;
    $posts = new Post($conn,$_REQUEST['userLoggedIn']);
    $posts->loadPostsFriends();

?>