<html lang="en">
<head>

<!-- Bootstrap - Latest compiled and minified CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/admin.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Admin</title>
</head>

<body>
<div class="row justify-content-center">
<?php

/* Starts the session */
session_start();

if (!isset($_SESSION['UserData']['Username'])) {
    header("location:login.php");
    exit;
}

if (!$_SESSION['UserData']['admin']) {
    header('Location: student.php');
    exit;
}

?>
<div class="container">
  <div class="row">
  <div class="col-1"></div>
  <div class="col-10">
      <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Merchants_and_Manufacturers_Building_%28bayou_view%29_Houston.jpg/220px-Merchants_and_Manufacturers_Building_%28bayou_view%29_Houston.jpg" class="img-fluid" alt="Responsive image">
<h1>Database Manager</h1>
<a href="add.php">Add</a>
<a href="logout.php">Click here to Logout.</a>
<br/>
<table class="table" border="1">
    <thead>
        <tr>
            <th scope="col" colspan="4"> </th>
            <th scope="col" colspan="4">Courses</th>
            <th scope="col" colspan="3">Course 1 Exam Scores</th>
            <th scope="col" colspan="3">Course 2 Exam Scores</th>
            <th scope="col" colspan="3">Course 3 Exam Scores</th>
            <th scope="col" colspan="3">Course 4 Exam Scores</th>
        </tr>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">GPA</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">4</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
        <th scope="col">1</th>
        <th scope="col">2</th>
        <th scope="col">3</th>
      </tr>
    </thead>
    <tbody>
        <?php
            //fetch data from json
            $data = json_decode(file_get_contents('members.json'), true);

            if($data === null) echo 'Array is null.';

            $index = 0;
            foreach($data as $row){
                echo "
                    <tr>
                        <td>".$row['id']."</td>
                        <td>".$row['firstname']."</td>
                        <td>".$row['lastname']."</td>";
                        #"<td>".$row['gpa']."</td>";

                $gpa_calc = [];
                foreach($row['courses'] as $course){
                    if(count($course['exams']) > 0){
                        $avg = array_sum($course['exams']) / count($course['exams']);
                        $avg = $avg * 4.0 / 100;
                        array_push($gpa_calc, $avg);
                    }
                }

                if(count($gpa_calc) == 0){
                    echo "<td><b>N/A</b></td>";
                } else {
                    $avg = array_sum($gpa_calc) / count($gpa_calc);
                    echo "<td>".round($avg, 1)."</td>";
                }

                $course_num = 0;
                foreach($row['courses'] as $course){
                    echo "<td>".$course['name']."</td>";
                    $course_num++;
                }

                if($course_num < 4){
                    for($i = 0; $i < 4 - $course_num; $i++) echo "<td></td>";
                }

                foreach($row['courses'] as $course){
                    $exam_num = 0;
                    foreach($course['exams'] as $score){
                            echo "<td>".$score."</td>";
                            $exam_num++;
                    }

                    if($exam_num < 3){
                        for($i = 0; $i < 3 - $exam_num; $i++) echo "<td></td>";
                    }
                }

                if($course_num < 4){
                    for($i = 0; $i < 4 - $course_num; $i++) echo "<td></td><td></td><td></td>";
                }

                echo "
                        <td><a href='edit.php?index=".$index."'>Edit</a></td>
                        <td><a href='delete.php?index=".$index."'>Delete</a></td>
                    </tr>
                ";

                $index++;
            }
        ?>
    </tbody>
</table>
</div>
</div>
</div><div class="col-1"></div>

<br/>
</div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>
