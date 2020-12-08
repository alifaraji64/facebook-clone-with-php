<?php
if (!isset($_SESSION)) {
    session_start();
}
$conn = mysqli_connect('localhost', 'root', '', 'social');
if (mysqli_connect_error()) {
    echo 'failed to connect:' . mysqli_connect_error();
}
//declaring vars
$fname = '';
$lname = '';
$em = '';
$em2 = '';
$password = '';
$password2 = '';
$date = '';
$error_array = array();
$success_msg = '';

if (isset($_POST['register_btn'])) {
    $fname = strip_tags($_POST['reg_fname']); //remove possible html tags
    $fname = str_replace(' ', '', $fname); //remove the space
    $fname = ucfirst(strtolower($fname)); //uppercase the first letter
    $_SESSION['reg_fname'] = $fname; //saving the typed name in session

    $lname = strip_tags($_POST['reg_lname']); //remove possible html tags
    $lname = str_replace(' ', '', $lname); //remove the space
    $lname = ucfirst(strtolower($lname)); //uppercase the first letter
    $_SESSION['reg_lname'] = $lname;

    $em = strip_tags($_POST['reg_email']); //remove possible html tags
    $em = str_replace(' ', '', $em); //remove the space
    $em = ucfirst(strtolower($em)); //uppercase the first letter
    $_SESSION['reg_email'] = $em;

    $em2 = strip_tags($_POST['reg_email2']); //remove possible html tags
    $em2 = str_replace(' ', '', $em2); //remove the space
    $em2 = ucfirst(strtolower($em2)); //uppercase the first letter
    $_SESSION['reg_email2'] = $em2;

    $password = strip_tags($_POST['reg_password']); //remove possible html tags
    $password2 = strip_tags($_POST['reg_password2']); //remove possible html tags
    $_SESSION['reg_password'] = $password;
    $_SESSION['reg_password2'] = $password2;

    $date = date('Y-m-d');

    //email validation
    if ($em == $em2) {
        //email is in valid format
        if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
            //check if email exists already
            $e_check = mysqli_query($conn, "SELECT email FROM users where email='$em'");
            //count the number of rows returned
            $num_rows = mysqli_num_rows($e_check);
            if ($num_rows > 0) {
                array_push($error_array,'email is already in use <br/>');
            }
        } else {
            array_push($error_array,'email is invalid <br/>');
        }
    } else {
        array_push($error_array,'email dont match <br/>');
    }

    //fname validation
    if (strlen($fname) > 25 || strlen($fname) < 2) {
        array_push($error_array,'your first name must be between 2 and 25 charcters <br/>');
    }
    //flname validation
    if (strlen($lname) > 25 || strlen($lname) < 2) {
        array_push($error_array,'your last name must be between 2 and 25 charcters <br/>');
    }
    //password validation
    if ($password != $password2) {
        echo 'your passwords do not match <br/>';
    } else {
        if (preg_match('/[^A-Za-z0-9]/', $password)) {
            array_push($error_array,'your password can only contain english characters or numbers <br/>');
        }
    }
    if (strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array,'your password must be between 5 and 30 characters <br/>');
    }
    //we don't have any error
    if(empty($error_array)){
        $password = md5($password);//encrypt password before sending to db
        //generate a unique username
        $username = strtolower($fname . '_' . $lname);
        $check_username_query = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
        $i = 0;
        //if username exists add number to it
        //this while will run as long as the condition is true(rows are not 0)
        while(mysqli_num_rows($check_username_query) != 0){
            $i++;
            $username = $username . '_' . $i;
            $check_username_query = mysqli_query($conn,"SELECT username FROM users WHERE username='$username'");
        }
        //setting a default profile picture for each user
        $rand = rand(1,2);
        $profile_pic = "assets/images/profile-pictures/defaults/image-$rand.png";
        $insert_query = "INSERT INTO users VALUES ('','$fname','$lname','$username','$em','$password','$date','$profile_pic','0','0','no',',')";
        $res = mysqli_query($conn,$insert_query) or trigger_error("Query Failed! SQL: $insert_query - Error: ".mysqli_error($conn), E_USER_ERROR);
        //showing the success message
        $success_msg = "<span style='color:#00db3a'>You are all set! go ahead and login</span><br />";
        //clearing the session
        $_SESSION['reg_fname'] = '';
        $_SESSION['reg_lname'] = '';
        $_SESSION['reg_email'] = '';
        $_SESSION['reg_email2'] = '';
        $_SESSION['reg_password'] = '';
        $_SESSION['reg_password2'] = '';
    }
}
