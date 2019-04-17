

    <?php
    // get the index from URL
    $index = $_GET['index'];

    // get json data
    $data = file_get_contents('members.json');
    $data_array = json_decode($data);

    // assign the data to selected index
    $row = $data_array[$index];

    ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>CRUD Operation on JSON File using PHP</title>
</head>
<body>
	<form method="POST">
		<a href="index.php">Back</a>
		<p>
			<label for="id">ID</label> <input type="text" id="id" name="id"
				value="<?php echo $row->id; ?>">
		</p>
		<p>
			<label for="firstname">Firstname</label> <input type="text"
				id="firstname" name="firstname"
				value="<?php echo $row->firstname; ?>">
		</p>
		<p>
			<label for="lastname">Lastname</label> <input type="text"
				id="lastname" name="lastname" value="<?php echo $row->lastname; ?>">
		</p>
		<p>
			<label for="examScore">examScore</label> <input type="text" id="examScore"
				name="examScore" value="<?php echo $row->examScore; ?>">
		</p>
		<p>
			<label for="courses">courses</label> <input type="text" id="courses"
				name="courses" value="<?php echo $row->courses; ?>">
		</p>
		<p>
			<label for="gpa">gpa</label> <input type="text" id="gpa"
				name="gpa" value="<?php echo $row->gpa; ?>">
		</p>
		<input type="submit" name="save" value="Save">
	</form>
     
    <?php
    if (isset($_POST['save'])) {
        // set the updated values
        $input = array(
            'id' => $_POST['id'],
            'firstname' => $_POST['firstname'],
            'lastname' => $_POST['lastname'],
            'examScore' => $_POST['examScore'],
            'courses' => $_POST['courses'],
            'gpa' => $_POST['gpa'],
        );

        // update the selected index
        $data_array[$index] = $input;

        // encode back to json
        $data = json_encode($data_array, JSON_PRETTY_PRINT);
        file_put_contents('members.json', $data);

        header('location: index.php');
    }
    ?>
    </body>
</html>