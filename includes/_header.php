<?php
    require_once('../config/config.php');

    if(isset($_SESSION['username'])){
        $userLoggedIn = $_SESSION['username'];
        //query user details
        $user_details_query = mysqli_query($conn,"SELECT * FROM users WHERE username='$userLoggedIn' ");
        $user = mysqli_fetch_assoc($user_details_query);
        require_once('../includes/classes/User.php');
         $user_obj = new User($conn,$userLoggedIn);
         $user_obj->getNumPosts();
    }
    else{
        header('Location: register.php');
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/compiled.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>index index</title>
</head>
<body class="min-h-screen bg-gray-200">
    <nav class="bg-blue-500 flex justify-between h-9 items-center" id="nav">
        <div>
            <h1 class="text-xl font-bold text-white ml-1">Facebook clone <i class="fab fa-facebook"></i></h1>
        </div>
        <div class="flex justify-around items-center text-white">
           <a href="" class="nav_link_hover">
                <div class='break-normal'>
                    <?php echo $user_obj->getFirstAndLastName();?>
                </div>
            </a>
            <a href="index.php" class="nav_link_hover">
                <i class="fa fa-home fa-lg"></i>
            </a>
            <a href="" class="nav_link_hover">
                <i class="fa fa-envelope fa-lg"></i>
            </a>
            <a href="" class="nav_link_hover">
                <i class="fa fa-bell fa-lg"></i>
            </a>
            <a href="" class="nav_link_hover">
                <i class="fa fa-users fa-lg"></i>
            </a>
            <a href="includes/_logout.php" class="nav_link_hover">
                <i class="fa fa-sign-out-alt fa-lg"></i>
            </a>
        </div>
    </nav>