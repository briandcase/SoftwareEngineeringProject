

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="utf-8">
        <title>Add</title>
    </head>
    <body>
    <h1>Add New Student Account</h1>
    <form method="POST">
        <a href="index.php">Back</a>
        <p>
            <label for="id">ID</label>
            <br>
            <input type="text" id="id" name="id">
        </p>
        <p>
            <label for="firstname">First Name</label>
            <br>
            <input type="text" id="firstname" name="firstname">
        </p>
        <p>
            <label for="lastname">Last Name</label>
            <br>
            <input type="text" id="lastname" name="lastname">
        </p>
        <p>
            <label for="password">Password</label>
            <br>
            <input type="text" id="password" name="password">
        </p>
        <hr>
        <p>
             <b>For each course, enter each exam score separated by a comma and no spaces in between. Each test score is accepted as an integer.</b>
        </p>
        <hr>
        <p>
            <label for="course1">Course 1 Name</label>
            <br>
            <input type="text" id="course1" name="course1">
            <br>
            <label for="course1exams">Course 1 Exam Scores</label>
            <br>
            <input type="text" id="course1exams" name="course1exams">
        </p>
        <p>
            <label for="course2">Course 2 Name</label>
            <br>
            <input type="text" id="course2" name="course2">
            <br>
            <label for="course2exams">Course 2 Exam Scores</label>
            <br>
            <input type="text" id="course2exams" name="course2exams">
        </p>
        <p>
            <label for="course3">Course 3 Name</label>
            <br>
            <input type="text" id="course3" name="course3">
            <br>
            <label for="course3exams">Course 3 Exam Scores</label>
            <br>
            <input type="text" id="course3exams" name="course3exams">
        </p>
        <p>
            <label for="course4">Course 4 Name</label>
            <br>
            <input type="text" id="course4" name="course4">
            <br>
            <label for="course4exams">Course 4 Exam Scores</label>
            <br>
            <input type="text" id="course4exams" name="course4exams">
        </p>
        <input type="submit" name="save" value="Save">
    </form>

    <?php
        if(isset($_POST['save'])){
            //open the json file
            $data = file_get_contents('members.json');
            $data = json_decode($data, true);

            //data in out POST
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

            //append the input to our array
            $data[] = $input;
            //encode back to json
            $data = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents('members.json', $data);

            header('location: index.php');
        }
    ?>
    </body>
    </html>
