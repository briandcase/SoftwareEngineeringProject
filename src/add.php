

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
            <label for="id">ID</label>
            <input type="text" id="id" name="id">
        </p>
        <p>
            <label for="firstname">Firstname</label>
            <input type="text" id="firstname" name="firstname">
        </p>
        <p>
            <label for="lastname">Lastname</label>
            <input type="text" id="lastname" name="lastname">
        </p>
        <p>
            <label for="examScore">examScore</label>
            <input type="text" id="examScore" name="examScore">
        </p>
        <p>
            <label for="courses">courses</label>
            <input type="text" id="courses" name="courses">
        </p>
        <p>
            <label for="gpa">gpa</label>
            <input type="text" id="gpa" name="gpa">
        </p>
        <p>
            <label for="password">password</label>
            <input type="text" id="password" name="password">
        </p>

        <input type="submit" name="save" value="Save">
    </form>

    <?php
        if(isset($_POST['save'])){
            //open the json file
            $data = file_get_contents('members.json');
            $data = json_decode($data);

            //data in out POST
            $input = array(
                'id' => $_POST['id'],
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'examScore' => $_POST['examScore'],
                'courses' => $_POST['courses'],
                'gpa' => $_POST['gpa'],
                'password' => $_POST['password']
            );

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
