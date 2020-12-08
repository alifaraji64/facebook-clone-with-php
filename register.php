<?php
require('./includes/_register.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="POST" action="register.php">
        <?php
            if(strlen($success_msg) > 0){
                echo $success_msg;
            }
        ?>

        <input type="text" name="reg_fname" placeholder="first name" value="<?php
        if (isset($_SESSION['reg_fname'])) {
            echo $_SESSION['reg_fname'];
        }
        ?>" required>
        <br>
        <?php
            if(in_array('your first name must be between 2 and 25 charcters <br>',$error_array)) echo 'your first name must be between 2 and 25 charcters <br/>';
        ?>



        <input type="text" name="reg_lname" placeholder="last name" value="<?php
        if (isset($_SESSION['reg_lname'])) {
            echo $_SESSION['reg_lname'];
        }
        ?>" required>
        <br>
        <?php
            if(in_array('your last name must be between 2 and 25 charcters <br/>',$error_array)) echo 'your last name must be between 2 and 25 charcters <br/>';
        ?>



        <input type="email" name="reg_email" placeholder="email" value="<?php
        if (isset($_SESSION['reg_email'])) {
            echo $_SESSION['reg_email'];
        }
        ?>" required>
        <br>



        <input type="email" name="reg_email2" placeholder="confirm email" value="<?php
        if (isset($_SESSION['reg_email2'])) {
            echo $_SESSION['reg_email2'];
        }
        ?>" required>
        <br>
        <?php
            if(in_array('email is already in use <br/>',$error_array)) echo 'email is already in use <br/>';
            else if(in_array('email is invalid <br/>',$error_array)) echo 'email is invalid <br/>';
            else if(in_array('email dont match <br/>',$error_array)) echo 'email don\'t match <br/>';
        ?>


        <input type="password" name="reg_password" placeholder="password" value="<?php
        if (isset($_SESSION['reg_password'])) {
            echo $_SESSION['reg_password'];
        }
        ?>" required>


        <br>
        <input type="password" name="reg_password2" placeholder="confirm password" value="<?php
        if (isset($_SESSION['reg_password2'])) {
            echo $_SESSION['reg_password2'];
        }
        ?>" required>
        <br>
        <?php
            if(in_array('your passwords do not match <br/>',$error_array)) echo 'your passwords do not match <br/>';
            else if(in_array('your password must be between 5 and 30 characters <br/>',$error_array)) echo 'your password must be between 5 and 30 characters <br/>';
            else if(in_array('your password can only contain english characters or numbers <br/>',$error_array)) echo 'your password can only contain english characters or numbers <br/>';
        ?>

        <button type="submit" name="register_btn">Register</button>
    </form>
</body>

</html>