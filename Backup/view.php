<?php
// Start the session
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(empty($_SESSION["user_name"])){?>

	<div Style="text-align:center;
	  padding: 20px 50px 20px 100px;
  	  border: 3px solid green;">
	  <a href="login.php">Please login</a>
  	</div>

<?php
	die;
}
?>
<!DOCTYPE html>
<html>
<head>
<title>ToDo List</title>
  <link rel="icon" href="upload/title_icon.jpg" type="image/gif" sizes="16x16"/>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <!--<link rel="stylesheet" type="text/css" href="task_style.css"/> -->
    <link rel="stylesheet" type="text/css" href="view.css"/>
</head>
<body>

<div class="heading">
    <h1 style="font-style: 'Times New Roman',Times,Monospace;">
        <i class="fa fa-eye" aria-hidden="true"></i>
        View Task
        <a href='index.php?logout=1' >                            <!--logout-->
		    <!-- <img src="upload/$row['uimage']"  style="margin-right:3%;float:right;" /> -->
            <i class="fa fa-sign-out" aria-hidden="true" style="margin-right:3%;float:right;"></i>
	    </a>
    </h1>
</div>

<?php
    require_once "utility.php";


    echo
    '<div class="card">
        <img src="upload/'.$row["image"].'" alt="No Image" style="width:100%;" />
        <h1>'.$row["task"].'</h1>
    <p class="title">
        '.$row["comment"].'
    </p>
    
    <p>
    <br/><br/>
        <a href="utility.php?del_task='.$row['id'].'">
            <button type="cancel">Delete</button>
        </a>
    </p>
    </div>';
?>
<button type="cancel" onclick="window.location='index.php';">Home</button>

</body>
</html>