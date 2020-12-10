<?php
if (!isset($_SESSION)) {
    session_start();
}
$conn = mysqli_connect('localhost', 'root', '', 'social');
if (mysqli_connect_error()) {
    echo 'failed to connect:' . mysqli_connect_error();
}
?>