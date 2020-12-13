<?php
    //db config
    require_once('../config/config.php');
    include('../includes/classes/Post.php');
    include('../includes/classes/User.php');
    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        //query user details
        $user_details_query = mysqli_query($conn,"SELECT * FROM users WHERE username='$userLoggedIn' ");
        $user = mysqli_fetch_assoc($user_details_query);
        require_once('../includes/classes/User.php');
    }
    else{
        header('Location: register.php');
        exit();
    }
    //getting the id of specific post when we are clicking and opening a iframe
    if(isset($_GET['post_id']))
    {
        $post_id = $_GET['post_id'];
    }
    $query = "SELECT added_by, user_to FROM posts WHERE id='$post_id'";
    $user_query = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($user_query);
    $posted_to = $row['added_by'];


    if(isset($_POST['postComment'.$post_id]))
    {
        $post_body = mysqli_escape_string($conn,$_POST['post_body']);
        $date_time_now = date('Y-m-d H:i:s');
        $query2 = "INSERT INTO comments VALUES ('', '$post_body', '$userLoggedIn','$posted_to', '$date_time_now', 'no', '$post_id')";
         $post_comment_query = mysqli_query($conn,$query2);
         echo '<p>Comment Posted!</p>';
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/compiled.css">
</head>
<body>
    <form action="./_comment_frame.php?post_id=<?php echo $post_id?>" method="POST">
        <textarea name="post_body" id="" cols="30" rows="10"></textarea>
        <button type="submit" name="postComment<?php echo $post_id?>">Post</button>
    </form>
</body>
</html>