<html>

<body>

<div align="center">
<?php

$filename = 'data/login_info.txt';

$login_json = json_decode(file_get_contents($filename), true);
$stud_json = json_decode(file_get_contents('data/student_info.txt'), true);


if (isset($stud_json[$_POST['id']])) {
    $login_json[$_POST['id']] = $_POST['password'];

    file_put_contents($filename, json_encode($login_json));

    echo 'Your account has been successfully created.';
    echo '<br><br><a href="index.html">Back to login</a>';
} else {
    echo 'Invalid school ID.';
    echo '<br><br><a href="new_account.html">Create account</a>&nbsp;&nbsp;&nbsp;<a href="index.html">Login</a>';
}

?>
</div>

</html>
