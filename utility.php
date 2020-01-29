<?php  
require 'connect.php';
//$taskErr = $commentErr = $imageErr = "";
//$task = $comment = $image = "";

/*Select query for home*/
if(isset($_POST['search'])){    //If search button is clicked

  $task=$_POST['search_string'];
  $tasks = mysqli_query($conn,"SELECT * FROM task_table WHERE task LIKE '%$task%'");
}
else{                           // select all tasks if page is visited or refreshed

  $tasks = mysqli_query($conn, "SELECT * FROM task_table");
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

  if (empty($_POST['task']) || empty($_POST['comment'])) {
    
    $errors = "You must enter some task & description!";
  }
  else{

    $task = $_POST['task'];
    $comment=$_POST['comment'];

    // Get image name
    $image = $_FILES['fileToUpload']['name'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];

    // image file directory
    $target = "upload/".basename($image);  //check path    
    move_uploaded_file($file_tmp_name,$target); //moving to upload folder
    
    $sql = "INSERT INTO task_table (task,comment,image) VALUES ('$task','$comment','$image')";

    mysqli_query($conn, $sql);
    header('location: index.php');
  }
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