<!DOCTYPE html>
<html>
<head>
<title>ToDo List</title>
    <link rel="icon" href="upload/title_icon.jpg" type="image/gif" sizes="16x16"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="register_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="heading">
    <h1 style="font-style: 'Times New Roman',Times,Monospace;">
        <i class="fa fa-user" aria-hidden="true"></i>
        Register
    </h1>
</div>

<div class="imgcontainer">        <!--Upload profile photo-->
      <label for="fileElem">
          <img src="upload/smiley1.jpg" alt="Avatar" class="avatar"><br/>
          <u class="u">Select profile picture.</u>
      </label>        
      <input type="file" name="fileToUpload" accept="image/*" class="visually-hidden" /> <!--hidden upload file field-->
</div>

<form action="utility.php" method="post">
    <hr>
    <div class="input_box">
    <b id="message">(Please fill in this form to create an account)</b><br/><br/>

    <label for="uname"><b>User Name:</b></label>
    <input type="Text" placeholder="Enter User Name" name="uname" id="box" required><br/>

    <label for="email"><b>Email:</b></label>
    <input type="email" placeholder="Enter Email" name="email" id="box" required><br/>

    <label for="psw" data-error="Please enter a name of length minum 8 characters"><b>Password:</b></label>
    <input type="password" placeholder="Enter Password" name="psw" id="password" minlength="5" required><br/>

    <label for="psw-repeat"><b>Repeat Password:</b></label>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" id="confirm_password" required><br/>

    <?php
          if(isset($_POST['register'])){
          echo $user_exist;
          echo $email_exist;
          }
    ?>
    </div>
    <hr>
    <p style="text-align:right;">By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <button type="submit" class="registerbtn" name="register">Register</button>
  
  <div class="signin">
    <p>Already have an account? <a href="login.php">Sign in</a>.</p>
  </div>
</form>

</body>
<script type="text/javascript">
var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>
</html>
