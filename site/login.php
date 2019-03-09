<html>

<head>
    <title>Login</title>
</head>

<div align="center">
<?php

session_start();

if (isset($_POST['id']) && isset($_POST['password'])) {
    $login_json = json_decode(file_get_contents('data/login_info.txt'), true);
    if (isset($login_json[$_POST['id']])) {
        if ($login_json[$_POST['id']] == $_POST['password']) {

            $_SESSION['id'] = $_POST['id'];
            echo 'Login successful. <br><br>';

            $admin_json = json_decode(file_get_contents('data/admin_info.txt'), true);
            if (in_array($_POST['id'], $admin_json)) {
                $_SESSION['admin'] = true;
                echo '<a href="admin.php">Proceed to main page</a>';
            } else {
                $_SESSION['admin'] = false;
                echo '<a href="student.php">Proceed to main page</a>';
            }

        }
    } else {
        echo sprintf('Account for user with ID "%s" does not exist.', $_POST['id']);
        echo '<br><br><a href="index.html">Go back</a><a href="new_account.html">Create account</a>';
    }
} else {
    echo '';
}

?>
</div>

</html>
