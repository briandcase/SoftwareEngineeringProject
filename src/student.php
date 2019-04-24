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
$data = json_decode($data, true);

$student_info = [];
$is_found = false;
foreach($data as $row){
    if ($row['id'] == $_SESSION['UserData']['Username']) {
        $is_found = true;
        $student_info = $row;
    }
}

?>

<html>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link href="css/admin.css" rel="stylesheet">
<head>
    <title>Student</title>
</head>

<body>

<?php if($is_found) { ?>
<h1>Courses and Grades</h1>
<br>
<div class="col-8">

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

    $index = 0;
    echo "
        <tr>
            <td>".$student_info['id']."</td>
            <td>".$student_info['firstname']."</td>
            <td>".$student_info['lastname']."</td>";

    $gpa_calc = [];
    foreach($student_info['courses'] as $course){
        if(count($course['exams']) > 0){
            $avg = array_sum($course['exams']) / count($course['exams']);
            $avg = $avg * 4.0 / 100;
            array_push($gpa_calc, $avg);
        }
    }

    if(count($gpa_calc) == 0){
        echo "<td><b>4.0</b></td>";
    } else {
        $avg = array_sum($gpa_calc) / count($gpa_calc);
        echo "<td>".round($avg, 1)."</td>";
    }

    $course_num = 0;
    foreach($student_info['courses'] as $course){
        echo "<td>".$course['name']."</td>";
        $course_num++;
    }

    if($course_num < 4){
        for($i = 0; $i < 4 - $course_num; $i++) echo "<td></td>";
    }

    foreach($student_info['courses'] as $course){
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
