<?php
    $error_array = array();
    if(isset($_POST['login_btn'])){
        $email = filter_var($_POST['log_email'],FILTER_SANITIZE_EMAIL);
        $password = md5($_POST['log_password']);
        $_SESSION['log_email'] = $email;//saving email in session for showing it after any possible error
        $check_db_query = mysqli_query($conn,"SELECT username,email FROM users WHERE email='$email' AND password='$password'");
        $rows = mysqli_num_rows($check_db_query);
        if($rows == 1){
            //every thing is ok and user can login
            $row = mysqli_fetch_assoc($check_db_query);
            //change the user_closed column to no in db
            $user_closed_query = mysqli_query($conn,"SELECT * FROM users WHERE email='$email' AND user_closed='yes'");
            if(mysqli_num_rows($user_closed_query) == 1){
                //user is closed and we have to open it
                $reopen_account_query = mysqli_query($conn,"UPDATE users SET user_closed='no' WHERE email='$email'");
            }

            //store username and email in session
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            header('Location: index.php');
            exit();
        }
        //email or password is incorrect
        else{
            array_push($error_array,'email or password is incorrect <br/>');
        }
    }