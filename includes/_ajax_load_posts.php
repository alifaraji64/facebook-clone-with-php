<?php
    require_once('../config/config.php');
    require_once('../includes/classes/User.php');
    require_once('../includes/classes/Post.php');
    $posts = new Post($conn,$_REQUEST['userLoggedIn']);
    $posts->loadPostsFriends($_REQUEST);


?>