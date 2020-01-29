<!DOCTYPE HTML>
<html>
<head>
<title>ToDo List</title>
  <link rel="icon" href="upload/title_icon.jpg" type="image/gif" sizes="16x16"/>
  <link rel="stylesheet" type="text/css" href="task_style.css"/>
  <link rel="stylesheet" type="text/css" href="style.css"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<!-- <i class="fa fa-home fa-4x" style="background-color: #aaa;border-radius: 2.5px;float: left; top: 10%;"></i> -->
<div class="heading">
  
    <?php   //Display fa fa icon in Update form
      if(isset($_GET['task_id'])){

        ?>
        <h1 style="font-style: 'Times New Roman',Times,Monospace;">
        <i class="fa fa-cog fa-spin fa-.5x fa-fw"></i> <b>Update Task</b>
        </h1>
        <?php
        require_once 'utility.php';
      }
      else{  //Display fa fa icon in Add form
      
        ?>
        <h1 style="font-style: 'Times New Roman',Times,Monospace;">
        <i class="fa fa-thumb-tack" aria-hidden="true"></i> <b>Add Task</b>
        </h1>
        <?php
      }
    ?>  
</div>

<form method="post" action="utility.php" enctype="multipart/form-data">

  <?php   //Display current Image on update form
    if(isset($_GET['task_id'])){
      echo "<img src='upload/".$row['image']."' style='float:right;width:30%;height:30%;border-style: outset;'>";
    }
  ?>

  <p>*required field</p>
    *Task title:
    <input type="text" name="task" value="<?php echo $row['task'];?>" required/>
    <br/><br/>

    *Description: <br>
    <textarea rows="4" cols="50" name="comment" required><?php echo $row['comment'];?>
    </textarea>
    <br/><br/>
    
    Select Image: <br/>
    <input type="file" name="fileToUpload" id="image" />
    <p>(File type: JPG,JPEG,PNG)</p>
    <br><br>

    <input type="hidden" name="hidden_id" value="<?php echo $_GET['task_id']; ?>"><br/>   <!--Hidden current title-->
    
    <?php

      if(empty($_GET['task_id'])){    //Display cancel button for ADD form
        ?>
        <a href="index.php" class="button" >Cancel</a>
        <?php
      }
      else{                           //Display Delete button for Update form

        $id= $row['id'];
        echo '<a class="btn btn-danger" href="utility.php?del_task=$id"> 
        <i class="fa fa-trash-o fa-lg"></i> Delete</a>';
      }
    ?>

    <input type="submit" value="Save" name="submit"/>
    <?php    
    if(isset($_GET['task_id'])){

      ?>
      <br/><br/><a href="index.php"> <ins>Go back to home<ins></a>
    <?php
    }?>
</form>

</body>
</html>