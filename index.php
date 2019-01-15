<?php
$errors = ""; //initialize errors variable

$db = mysqli_connect("localhost","root","","todotasks"); //connect to database

if (isset($_POST['submit'])) {
	if (empty($_POST['task'])) {
		$errors = "you must fill in the task!";	//code to submit button
	}
	else{
		$task = $_POST['task'];
		$sql= "insert into task (task)Values('$task')";
		mysqli_query($db, $sql);
		header('location:index.php');

	}
	
	}

// delete task
if (isset($_GET['del_task'])) {
	$id = $_GET['del_task'];

	mysqli_query($db, "DELETE FROM task WHERE id=".$id);
	header('location: index.php');
}



	?>

<!DOCTYPE html>
<html>
<head>
	<title>To Do List</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>

<style>
	body{background-color:#F5EEF8;}
</style>

<body>
<div class="heading"> 
	<h2 style= "font-style:'Verdana';"> To Do List</h2>
</div>


<form method="post" action="index.php" class="input_form">
	<input type="text" name="task" class="task_input">
	<button type="submit" name="submit" id="add_btn" class="add_btn">Add Task</button>

<?php if (isset($errors)) { ?>
	<p><?php echo $errors; ?></p>
<?php } ?>

</form>

<table>
	<thead>
		<tr>
			<th>Task No.</th>
			<th>Task</th>
			<th style="width: 60px; text-align: center;">Action</th>
		</tr>
	</thead>

	<tbody>
		<?php 
		// select all tasks if page is visited or refreshed
		$tasks = mysqli_query($db, "SELECT * FROM task");

		$i = 1; while ($row = mysqli_fetch_array($tasks)) { ?>
			<tr>
				<td> <?php echo $i; ?> </td>
				<td class="task"> <?php echo $row['task']; ?> </td>
				<td class="delete"> 
					<a href="index.php?del_task=<?php echo $row['id'] ?>">x</a> 
				</td>
			</tr>
		<?php $i++; } ?>	
	</tbody>
</table>
</body
</html>