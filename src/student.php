<?php

if (!isset($_SESSION)) {session_start();}

if (!isset($_SESSION['UserData']['Username'])) {
    header('Location: login.php');
    exit;
}

if ($_SESSION['UserData']['admin']) {
    header('Location: index.php');
    exit;
}

//fetch data from json
$data = file_get_contents('members.json');
//decode into php array
$data = json_decode($data);

$student_info = [];
$is_found = false;
foreach($data as $row){
    if ($row->id == $_SESSION['UserData']['Username']) {
        $is_found = true;
        $student_info = $row;
    }
}

?>

<html>

<head>
    <title>Student</title>
</head>

<body>

<?php if($is_found) { ?>
<h1>Student Info</h1>
<br>
<div class="col-8">
<table class="table" border="1">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">examScore</th>
        <th scope="col">courses</th>
        <th scope="col">gpa</th>
      </tr>
    </thead>
    <tbody>
        <?php
            echo "
                <tr>
                    <td>".$student_info->id."</td>
                    <td>".$student_info->firstname."</td>
                    <td>".$student_info->lastname."</td>
                    <td>".$student_info->examScore."</td>
                    <td>".$student_info->courses."</td>
                    <td>".$student_info->gpa."</td>
                </tr>
            ";
        ?>
    </tbody>
</table>
</div>

<?php } else { ?>

<h1 align="center">Account does not exist.</h1>

<?php } ?>
<br>
<a href="logout.php">Click here</a> to Logout.
</body>

</html>
