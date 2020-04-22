<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?> 
<!DOCTYPE HTML>
<html>
<head>
<title>ToDo List</title>
  <link rel="icon" href="upload/title_icon.jpg" type="image/gif" sizes="16x16"/>
  <link rel="stylesheet" type="text/css" href="login_style.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="heading">
    <h1 style="font-style: 'Times New Roman',Times,Monospace;">
        <i class="fa fa-sign-in" aria-hidden="true"></i>
        Login
    </h1>
</div>

<form action="utility.php" method="post">

  <div class="container">
    <label for="uname"><b>Username:</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

    <?php
    if (isset($_POST['login'])) {
    echo "<p class='error'>Invalid User Name or Password, please try again.</p>";
    }
    ?>

    <button type="submit" name="login">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
</form> 

<div class="container" style="background-color:#f1f1f1">
  <a href="register.php">
    <button type="button" class="cancelbtn" name="new_user">New User</button>
  </a>
  <span class="psw"><a href="#">Forgot password?</a></span>
</div>

</body>
</html>