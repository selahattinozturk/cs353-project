<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Registration</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>
<?php
    include("config.php");
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['name'])) {
        // removes backslashes
        $name = stripslashes($_REQUEST['name']);
        //escapes special characters in a string
        $name = mysqli_real_escape_string($db, $name);
        $email    = stripslashes($_REQUEST['email']);
        $email    = mysqli_real_escape_string($db, $email);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($db, $password);
        $query    = "INSERT into `User` (email, name, password, role_id)
                     VALUES ('$email', '$name', '" . md5($password) . "', '1')";
        $result   = mysqli_query($db, $query);



        if ($result) {
            echo "<div class='form'>
                  <h3>You are registered successfully.</h3><br/>
                  <p class='link'>Click here to <a href='index.php'>Login</a></p>
                  </div>";
        } else {
            echo "<div class='form'>
                  <h3>Required fields are missing.</h3><br/>
                  <p class='link'>Click here to <a href='registration.php'>registration</a> again.</p>
                  </div>";
        }
    } else {
?>
    <form class="form" action="" method="post">
        <h1 class="login-title">Registration</h1>
        <input type="text" class="login-input" name="name" placeholder="Name" required />
        <input type="text" class="login-input" name="email" placeholder="Email Adress">
        <input type="password" class="login-input" name="password" placeholder="Password">
        <input type="submit" name="submit" value="Register" class="login-button">
        <p class="link"><a href="index.php">Click to Login</a></p>
    </form>
<?php
    }
?>
</body>
</html>