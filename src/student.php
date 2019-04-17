<?php

if (!isset($_SESSION)) {session_start();}

if (!isset($_SESSION['id'])) {
    header('Location: index.html');
}

if ($_SESSION['admin']) {
    header('Location: admin.php');
}

?>

<html>

<head>
    <title>Student Page</title>
</head>

<body>
    <form action="logout.php" method="post">
        <input type="submit" name="logout" value="Logout" />
    </form>
</body>

</html>
