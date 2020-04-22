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
<head><title>Todo List</title>
	<link rel="icon" href="upload/title_icon.jpg" type="image/gif" sizes="16x16"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<!--Bootstrap for fa fa -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="heading">
	<h1 style="font-style: 'Times New Roman',Times,Monospace;">
	✅ ToDo List
	<a href='index.php?logout=1' >                            <!--logout-->
		<!-- <img src="<php echo $_SESSION['user_image']; ?>"   /> -->
		<i class="fa fa-sign-out" aria-hidden="true" style="margin-right:3%;float:right;"></i>
	</a>
	</h1>
</div>

<div class="topnav">
  <a class="active" href="task_form.php">
  	<i class="fa fa-plus" aria-hidden="true"></i> Add Task
  </a>
  	<span class="center">
	  Welcome <?php echo $_SESSION["user_name"];
  	  ?>
  	</span>

	<div class="search-container">

    <form action="index.php" method="POST">
      <input type="text" placeholder="Search.." name="search_string" value="<?php if(isset($_POST['search'])){ echo $_POST['search_string'];}?>">
	  <button type="submit" name="search"><i class="fa fa-search"></i></button>
		<a href="index.php">
			<i class="fa fa-refresh"></i>
    	</a>
    </form>

  	</div>

</div>
<table>
	<thead>
		<tr>
			<th>No.</th>
			<th>Tasks</th>
			<!-- <th style="text-align: justify;">View</th> -->
			<th style="text-align: justify;">Update</th>
			<th style="width: 60px;">Action</th>
		</tr>
	</thead>
	<tbody>
		<?php
		include_once "utility.php";

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>									<!--Echo id-->

				<td class="task">
					<a href="view.php?task_id=<?php echo $row['id']?>">
					<?php echo $row['task']; ?>									<!--Echo task title-->
					</a>
				</td>

				<!-- <td class="delete" style="text-align: justify;">
					<a href="task_form.php?task_id=<php echo $row['id'] ?>">
						<i class="fa fa-eye" aria-hidden="true"></i>			<--Echo view icon--
					</a>
				</td> -->

				<td class="delete" style="text-align: justify;">
					<a href="task_form.php?task_id=<?php echo $row['id'] ?>">	<!--Echo update icon-->
						<i class="fa fa-edit" aria-hidden="true"></i>
					</a>
				</td>

				<td class="delete">
					<a href="utility.php?del_task=<?php echo $row['id'] ?>"><!--Echo delete icon-->
						<i class="fa fa-trash" aria-hidden="true"></i>
					</a>
				</td>
			</tr>

		<?php $i++; } ?>
	</tbody>
</table>

</body>
</html>
