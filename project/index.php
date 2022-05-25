<?php

include("config.php");
session_start();

$username = "";
$password = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // getting the entered values
    $username = mysqli_real_escape_string($db,$_POST['name']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    //checking the entered vals from table
    
    if($stmt = mysqli_prepare($db, "SELECT name, password FROM User WHERE name = ? and password = ?")){
        
        mysqli_stmt_bind_param($stmt, "ss", $entered_username, $entered_password);

        //parameters are binded
        $entered_username = $username;
        $entered_password = $password;
        
        //running the statements that is specified
        if(mysqli_stmt_execute($stmt)){
            
            mysqli_stmt_store_result($stmt);
            //controlling 
            if(mysqli_stmt_num_rows($stmt) != 1){
                //inputs are wrong pop an alert
                echo "<script type='text/javascript'>alert('You enter wrong username or password.');</script>";
            }else{
                
            mysqli_stmt_bind_result($stmt, $username, $turned_pw);

                if(mysqli_stmt_fetch($stmt)){
                    
                    if($turned_pw == $password){
                        
                        //going to the welcome page 
                        session_start();
                        $_SESSION['name'] = $username;
                        $_SESSION['password'] = $password;

                        if($stmt2 = mysqli_prepare($db, "SELECT name FROM User WHERE name = ? and role_id = '1' ")){
                            mysqli_stmt_bind_param($stmt2, "s", $entered_username2);
                            $entered_username2 = $username;
                            if(mysqli_stmt_execute($stmt2)){
                                mysqli_stmt_store_result($stmt2);
                                if(mysqli_stmt_num_rows($stmt2) == 1){
                                    
                                    header("location: s_lesson.php");
                                }
                            }
                        }
                        mysqli_stmt_close($stmt2);
                        if($stmt3 = mysqli_prepare($db, "SELECT name FROM Teacher WHERE name = ? ")){
                            mysqli_stmt_bind_param($stmt3, "s", $entered_username3);
                            $entered_username3 = $username;
                            if(mysqli_stmt_execute($stmt3)){
                                mysqli_stmt_store_result($stmt3);
                                if(mysqli_stmt_num_rows($stmt3) == 1){
                                    mysqli_stmt_close($stmt3);
                                    header("location: t_lesson.php");
                                }
                            }
                        }
                        if($stmt5 = mysqli_prepare($db, "SELECT name FROM Native WHERE name = ? ")){
                            mysqli_stmt_bind_param($stmt5, "s", $entered_username5);
                            $entered_username5 = $username;
                            if(mysqli_stmt_execute($stmt5)){
                                mysqli_stmt_store_result($stmt5);
                                if(mysqli_stmt_num_rows($stmt5) == 1){
                                    mysqli_stmt_close($stmt5);
                                    header("location: n_profile.php");
                                }
                            }
                        }
                        if($stmt4 = mysqli_prepare($db, "SELECT name FROM Admin WHERE name = ? ")){
                            
                            mysqli_stmt_bind_param($stmt4, "s", $entered_username4);
                            $entered_username4 = $username;
                            if(mysqli_stmt_execute($stmt4)){
                                mysqli_stmt_store_result($stmt4);
                                
                                if(mysqli_stmt_num_rows($stmt4) == 1){
                                    mysqli_stmt_close($stmt4);
                                    
                                    header("location: a_statistics.php");
                                }
                            }
                        }else{

                        }
                    }
                }
                
            }

        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log-in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 18px Cursive; }
        #centerwrapper { text-align: bottom; margin-bottom: 20px; }
        #centerdiv { display: inline; }
    </style>
</head bgcolor="#801200">
<body bgcolor="#801200">
<div class="container">
    
      
   <body bgcolor="#800000">
    <div id="centerwrapper">
        <div id="centerdiv" >
            <br><br>
            <h2>Welcome</h2>
            <form  method="post" id="loginForm" action="">  
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" name="name" class="form-control" id="name">

                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input  class="form-control" id="password" type="password" name="password">

                </div>
                <div class="form-group">
                    <input onclick="check()" value="Login"  class="btn btn-primary" >
                </div>
                
            </form>
            <p><a href="register_s.php" class="center btn btn-primary">Sign up for student</a></p>
            <p><a href="register_t.php" class="center btn btn-primary">Sign up for Teacher</a></p>
            <p><a href="register_n.php" class="center btn btn-primary">Sign up for Native Speaker</a></p>
        </div>
    </div>
    <body>
</div>


<script type="text/javascript">
    function check() {
        
        var passwordVal = document.getElementById("password").value;
        var usernameVal = document.getElementById("name").value;
        if (usernameVal !== "" && passwordVal !== "") {
           var form = document.getElementById("loginForm").submit();
        }
        else {
        alert("either password or username or both are empty!");
            
        }
    }
</script>
<script type="text/javascript">
    function register() {
        
        window.location = 'http://localhost/register.php?q=' + checkB + '&p=' + tableName;
    }
</script>
</body>
</html>
