<?php

if (!isset($_SESSION)) {session_start();}

if (!$_SESSION['admin'] or !isset($_SESSION['id'])) {
    header('Location: index.html');
}

?>

<html>

<head>
    <title>Admin Page</title>
</head>

<body>
    <form action="logout.php" method="post">
        <input type="submit" name="logout" value="Logout" />
    </form>
</body>

</html>
