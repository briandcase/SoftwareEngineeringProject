<html>

<head>
    <title>Logout</title>
</head>

<div align="center">
<?php

if (! empty($_POST)) {
    if (! isset($_SESSION)) {session_start();}

    if (isset($_POST['logout'])) {
        session_destroy();
        echo 'Logout successful.<br><br><a href="index.html">Return to login page</a>';
    }
} else {
    header('Location: index.html');
}

?>
</div>

</html>
