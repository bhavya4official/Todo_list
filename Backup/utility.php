<?php  

// Start the session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

require_once 'connect.php';
//$taskErr = $commentErr = $imageErr = "";
//$task = $comment = $image = "";

/*Query for Register a user*/
if(isset($_POST['register'])){
  // Grab User submitted information
  $uname = $_POST["uname"];
  $email = $_POST["email"];
  $psw = $_POST["psw"];
  $image = $_FILES['fileToUpload']['name'];
  $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];

  // image file directory
  $target = "upload/".basename($image);  //destination path
  move_uploaded_file($file_tmp_name,$target); //moving to upload folder
    
  $sql = "INSERT INTO user_table (name,email,uimage,password) VALUES ('$uname','$email','$image',md5('$psw'))";
  $result =mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  if($row){                          //Check if already exist
    if($row["name"]==$uname){
      $name_exist = "User name already exist.";
      header('location: register.php');
    }
    else if($row["email"]==$email){
      $email_exist = "Sorry! email already exist.";
      header('location: register.php');
    }    
  }
  // Set session variables
  $_SESSION["user_id"] = $row["id"];
  $_SESSION["user_name"] = $row["name"];
  $_SESSION["user_email"] = $row["email"];
  $_SESSION["user_image"] = $image;
  header('location: index.php');
}

/*Query for login cradential*/
if(isset($_POST['login'])){
  // Grab User submitted information
  $uname = $_POST["uname"];
  $psw = $_POST["psw"];

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
    header('location: login.php');
  }
}

/*Log out session*/
if(isset($_GET['logout'])){
  session_unset();
	session_destroy();
	header("location:login.php");
	exit;
}

/*Select query for Home*/
if(isset($_POST['search'])){    //If search button is clicked

  $current_id = $_SESSION["user_id"];
  $task=$_POST['search_string'];
  $tasks = mysqli_query($conn,"SELECT * FROM task_table WHERE task LIKE '%$task%' WHERE name='$current_id'");
}
else{                           // select all tasks if page is visited or refreshed

  $current_id = $_SESSION["user_id"];
  $tasks = mysqli_query($conn, "SELECT * FROM task_table WHERE name='$current_id'");
}

/*Fetch current values*/
if (isset($_GET['task_id'])) {

  require_once 'connect.php';
  $id = $_GET['task_id'];
  $tasks = mysqli_query($conn,"SELECT * FROM task_table WHERE id=$id;");
  $row = mysqli_fetch_array($tasks);
}

/*ADD TASK Query*/
if (isset($_POST['submit']) && empty($_POST['hidden_id'])) {


  /*if (empty($_POST['task']) || empty($_POST['comment'])) {
    
    $errors = "You must enter some task & description!";

  }*/

    $task = $_POST['task'];
    $comment=$_POST['comment'];

    // Get image name
    $image = $_FILES['fileToUpload']['name'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $current_user = $_SESSION["user_name"];
    
    // image file directory
    $target = "upload/".basename($image);  //Destination path    
    move_uploaded_file($file_tmp_name,$target); //moving to upload folder
    
    //$sql = "INSERT INTO task_table (task,comment,image) VALUES ('$task','$comment','$image')";

    $sql = "INSERT INTO task_table (task,comment,image,uid) Select '$task','$comment','$image',uid FROM user_table 
    WHERE name='$current_user'";

    mysqli_query($conn, $sql);
    header('location: index.php');
}

/*UPDATE Query*/
if(isset($_POST['submit']) && isset($_POST['hidden_id'])){

    $id = $_POST['hidden_id'];
    $task = $_POST['task'];
    $comment=$_POST['comment'];
    
    // Get image name
    $image = $_FILES['fileToUpload']['name'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];

    // image file directory
    $target = "upload/".basename($image);  //check path
    move_uploaded_file($file_tmp_name,$target); //moving to upload folder

    $query = "UPDATE task_table SET task='$task',comment='$comment',image='$image' WHERE id= $id";
   
    mysqli_query($conn, $query);
    header("Location: index.php");
}   

/*DELETE Query*/
if (isset($_GET['del_task'])) {

  $id = $_GET['del_task'];
  $sql="DELETE FROM task_table WHERE id=$id;";
  mysqli_query($conn, $sql);
  header("Location: index.php");               //'Location: '.$_SERVER['PHP_SELF']  die;
}
?>