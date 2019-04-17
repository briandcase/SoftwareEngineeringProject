<html lang="en">
<head>

<!-- Bootstrap - Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin</title>
</head>

<body>
	<p>&nbsp;</p>
	<div class="row justify-content-center">
   		<?php

session_start(); /* Starts the session */
    if (! isset($_SESSION['UserData']['Username'])) {
        header("location:login.php");
        exit();
    }
    ?>


<a href="add.php">Add</a>
<table border="1">
	<thead>
		<th>ID</th>
		<th>Firstname</th>
		<th>Lastname</th>
		<th>Address</th>
		<th>Gender</th>
		<th>Action</th>
	</thead>
	<tbody>
		<?php
			//fetch data from json
			$data = file_get_contents('members.json');
			//decode into php array
			$data = json_decode($data);
 
			$index = 0;
			foreach($data as $row){
				echo "
					<tr>
						<td>".$row->id."</td>
						<td>".$row->firstname."</td>
						<td>".$row->lastname."</td>
						<td>".$row->address."</td>
						<td>".$row->gender."</td>
						<td>
							<a href='edit.php?index=".$index."'>Edit</a>
							<a href='delete.php?index=".$index."'>Delete</a>
						</td>
					</tr>
				";
 
				$index++;
			}
		?>
	</tbody>
</table>


<a href="logout.php">Click here</a> to Logout.
	</div>
	<!-- Latest compiled and minified JavaScript -->
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>

</html>