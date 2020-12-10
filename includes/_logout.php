<?php
    if (!isset($_SESSION))
    {
        session_start();
    }
    //clear out the session
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    //redirect to register page
    header('Location: ../register.php');
    exit();
?>