<html lang="en"> 
<head>
  
    <!-- Bootstrap - Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin</title>
</head>

<body>
    <p>&nbsp;</p>
    <div class="row justify-content-center">
   		<?php session_start(); /* Starts the session */
if(!isset($_SESSION['UserData']['Username'])){
header("location:login.php");
exit;
}
?>

Congratulation! You have logged into password protected page. 
<a href="logout.php">Click here</a> to Logout.
    </div>
<!-- Latest compiled and minified JavaScript -->
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>

</html>