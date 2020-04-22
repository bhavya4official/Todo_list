<?php
// Start the session
session_start();
?>
<?php

// Grab User submitted information
$uname = $_POST["uname"];
$psw = $_POST["psw"];

// Connect to the database
require_once 'connect.php';

$result = mysqli_query($conn,"SELECT * FROM user_table WHERE password = md5('$psw');");
$row = mysqli_fetch_array($result);

if($row["name"]==$uname && $row["password"]==MD5($psw)){
    //echo"You are a validated user.";
    // Set session variables
    $_SESSION["user_name"] = $row["name"];

    header('location: index.php');
}
else{

    $_SESSION['loginerror'] = 1;
    echo"Sorry, your credentials are not valid, Please try again.";
    header('location: login.php');
}
?>