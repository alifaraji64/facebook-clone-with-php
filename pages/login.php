<?php
    //db config
    require_once('../config/config.php');
    //login handler
    require_once('../includes/_login.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/compiled.css">
    <title>login</title>
</head>
<body class="min-h-screen">
    <div class="bg-blue-400 h-screen text-center">
        <div class="w-2/5 mx-auto border-4 border-blue-500 bg-white rounded-lg">
            <h1 class="text-2xl font-bold">Login Form</h1>
            <form action="login.php" method="POST">
                <input type="text" name="log_email" class="log_reg_input"placeholder="email" value="<?php
                    if(isset($_SESSION['log_email'])){
                        echo $_SESSION['log_email'];
                    }
                ?>">
                <br>
                <input type="password" name="log_password" class="log_reg_input" placeholder="password">
                <br>
                <?php
                    if(in_array('email or password is incorrect <br/>',$error_array)){
                        echo '<span class="text-red-500 bg-yellow-100">email or password is incorrect</span> <br/>';
                    }
                ?>
                <button class="bg-blue-500 rounded-md px-2 py-1 text-white mb-2 hover:bg-blue-600"  type="submit" name="login_btn">Login</button>
            </form>
        </div>
    </div>
</body>
</html>