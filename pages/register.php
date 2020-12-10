<?php
//db config
require_once('../config/config.php');
//register handler
require('../includes/_register.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/compiled.css">
    <title>Register</title>
</head>

<body class="min-h-screen">
    <div class="bg-blue-400 h-screen text-center">
        <div class="w-2/5 mx-auto border-4 border-blue-500 bg-white rounded-lg">
          <h1 class="text-2xl font-bold">Register Form</h1>
          <form method="POST" action="register.php">
            <?php
                if(strlen($success_msg) > 0){
                    echo $success_msg;
                }
            ?>

            <input type="text" name="reg_fname" class="log_reg_input" placeholder="first name" value="<?php
            if (isset($_SESSION['reg_fname'])) {
                echo $_SESSION['reg_fname'];
            }
            ?>" required>
            <br>
            <?php
                if(in_array('your first name must be between 2 and 25 charcters <br>',$error_array)) echo 'your first name must be between 2 and 25 charcters <br/>';
            ?>



            <input type="text" name="reg_lname" class="log_reg_input" placeholder="last name" value="<?php
            if (isset($_SESSION['reg_lname'])) {
                echo $_SESSION['reg_lname'];
            }
            ?>" required>
            <br>
            <?php
                if(in_array('your last name must be between 2 and 25 charcters <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">your last name must be between 2 and 25 charcters </span><br/>';
            ?>



            <input type="email" name="reg_email" class="log_reg_input" placeholder="email" value="<?php
            if (isset($_SESSION['reg_email'])) {
                echo $_SESSION['reg_email'];
            }
            ?>" required>
            <br>



            <input type="email" name="reg_email2" class="log_reg_input" placeholder="confirm email" value="<?php
            if (isset($_SESSION['reg_email2'])) {
                echo $_SESSION['reg_email2'];
            }
            ?>" required>
            <br>
            <?php
                if(in_array('email is already in use <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">email is already in use </span><br/>';
                else if(in_array('email is invalid <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">email is invalid </span><br/>';
                else if(in_array('email dont match <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">email don\'t match </span><br/>';
            ?>


            <input type="password" name="reg_password" class="log_reg_input" placeholder="password" value="<?php
            if (isset($_SESSION['reg_password'])) {
                echo $_SESSION['reg_password'];
            }
            ?>" required>


            <br>
            <input type="password" name="reg_password2" class="log_reg_input" placeholder="confirm password" value="<?php
            if (isset($_SESSION['reg_password2'])) {
                echo $_SESSION['reg_password2'];
            }
            ?>" required>
            <br>
            <?php
                if(in_array('your passwords do not match <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">your passwords do not match</span> <br/>';
                else if(in_array('your password must be between 5 and 30 characters <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">your password must be between 5 and 30 characters </span><br/>';
                else if(in_array('your password can only contain english characters or numbers <br/>',$error_array)) echo '<span class="text-red-500 bg-yellow-100">your password can only contain english characters or numbers </span><br/>';
            ?>

            <button type="submit" class="bg-blue-500 rounded-md px-2 py-1 text-white mb-2 hover:bg-blue-600" name="register_btn">Register</button>
          </form>
        </div>

    </div>
</body>

</html>