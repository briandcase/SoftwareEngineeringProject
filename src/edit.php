<?php

// get the index from URL
$index = 0;
if(isset($_GET['index'])) $index = $_GET['index'];

// get json data
$data = file_get_contents('members.json');
$data_array = json_decode($data, true);


// assign the data to selected index
$row = $data_array[$index];
$courses = [];
for($i = 1; $i <= 4; $i++) $courses["course{$i}"] = ['name' => '', 'exams' => ''];
$course_num = 1;
if (count($row['courses']) > 0){
    foreach($row['courses'] as $course){
        $temp_course = ["name" => $course["name"]];
        if(count($course['exams']) > 0){
            $temp_course['exams'] = implode(',', array_map('strval', $course['exams']));
        }
        $courses["course{$course_num}"] = $temp_course;
        $course_num++;
    }
}

?>

<!DOCTYPE html>
<html>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/admin.css">

<head>
<meta charset="utf-8">
<title>Edit</title>
</head>
<body>
    <h1>Edit Student Info</h1>
    <form method="POST">
        <a href="index.php">Back</a>
        <p>
            <label for="id">ID</label>
            <br>
            <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>">
        </p>
        <p>
            <label for="firstname">First Name</label>
            <br>
            <input type="text" id="firstname" name="firstname" value="<?php echo $row['firstname']; ?>">
        </p>
        <p>
            <label for="lastname">Last Name</label>
            <br>
            <input type="text" id="lastname" name="lastname" value="<?php echo $row['lastname']; ?>">
        </p>
        <p>
            <label for="password">Password</label>
            <br>
            <input type="text" id="password" name="password" value="<?php echo $row['password']; ?>">
        </p>
        <hr>
        <p>
             <b>For each course, enter each exam score separated by a comma and no spaces in between. Each test score is accepted as an integer.</b>
        </p>
        <hr>
        <p>
            <label for="course1">Course 1 Name</label>
            <br>
            <input type="text" id="course1" name="course1" value="<?php echo $courses['course1']['name']; ?>">
            <br>
            <label for="course1exams">Course 1 Exam Scores</label>
            <br>
            <input type="text" id="course1exams" name="course1exams" value="<?php echo $courses['course1']['exams']; ?>">
        </p>
        <p>
            <label for="course2">Course 2 Name</label>
            <br>
            <input type="text" id="course2" name="course2" value="<?php echo $courses['course2']['name']; ?>">
            <br>
            <label for="course2exams">Course 2 Exam Scores</label>
            <br>
            <input type="text" id="course2exams" name="course2exams" value="<?php echo $courses['course2']['exams']; ?>">
        </p>
        <p>
            <label for="course3">Course 3 Name</label>
            <br>
            <input type="text" id="course3" name="course3" value="<?php echo $courses['course3']['name']; ?>">
            <br>
            <label for="course3exams">Course 3 Exam Scores</label>
            <br>
            <input type="text" id="course3exams" name="course3exams" value="<?php echo $courses['course3']['exams']; ?>">
        </p>
        <p>
            <label for="course4">Course 4 Name</label>
            <br>
            <input type="text" id="course4" name="course4" value="<?php echo $courses['course4']['name']; ?>">
            <br>
            <label for="course4exams">Course 4 Exam Scores</label>
            <br>
            <input type="text" id="course4exams" name="course4exams" value="<?php echo $courses['course4']['exams']; ?>">
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
            'password' => $_POST['password'],
            'courses' => []
        );

        $nums = ["1", "2", "3", "4"];
        foreach($nums as $suffix){
            if($_POST["course{$suffix}"] != ""){
                $temp_course = ['name' => $_POST["course{$suffix}"], 'exams' => []];
                if($_POST["course{$suffix}exams"] != ""){
                    $scores = explode(",", $_POST["course{$suffix}exams"]);
                    foreach($scores as $score){
                        $temp_course['exams'][] = (int) $score;
                    }
                }
                $input['courses'][] = $temp_course;
            }
        }

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
