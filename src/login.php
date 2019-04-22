<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Login</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/sign-in/">
    <!-- Bootstrap core CSS -->
    <link href="../public/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/css/signin.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<?php

/* Starts the session */
session_start();

/* Check Login form submitted */
if(isset($_POST['Submit'])){

    /* Define username and associated password array */
    $admins = array('Alex' => '123456');

    /* Check and assign submitted Username and Password to new variable */
    $Username = isset($_POST['Username']) ? $_POST['Username'] : '';
    $Password = isset($_POST['Password']) ? $_POST['Password'] : '';

    /* Check Username and Password existence in defined array */

    if($Username != '' && $Password != ''){

        $data = json_decode(file_get_contents('members.json'), true);

        /* Admin Login */
        if (isset($admins[$Username]) && $admins[$Username] == $Password){

            /* Success: Set session variables and redirect to Protected page  */
            $_SESSION['UserData']['Username']=$Username;
            $_SESSION['UserData']['admin'] = true;
            header("location:index.php");
            exit;
        }

        /* Checks if user is a student by checking the student database */
        foreach($data as $row){
            if($row['id'] == $Username && $row['password'] == $Password){
                $_SESSION['UserData']['Username']=$Username;
                $_SESSION['UserData']['admin'] = false;
                header("location:student.php");
                exit;
            }
        }
    }

    /*Unsuccessful attempt: Set error message */
    $msg="<span style='color:red'>Invalid Login Details</span>";

}
?>
<body class="text-center">
   
    <h1 class="site-title">Please sign in</h1>
    <form action="" method="post" name="Login_Form">
    <?php if(isset($msg)){?>
      <div><?php echo $msg;?></div>
    <?php } ?>
        <div class="form-group">
          <label for="Username">Username</label>
          <input type="text" class="form-control" name="Username" size="30" autofocus="autofocus" placeholder="Enter ID number here" required/>
        </div>

        <div>
          <label for="passwordInput">Password</label>
          <input type="password" class="form-control" name="password" size="30" placeholder="Enter password here" required/>
        </div>

        <button class="btn btn-primary btn-large">Sign in</button>
    </form>

<!-- Latest compiled and minified JavaScript -->
    <script src="../public/js/jquery-3.3.1.min.js"></script>
    <script src="../public/js/bootstrap.min.js"></script>
</body>


</html>
