<?php

include("config.php");
session_start();

$username = "";
$password = "";


if($_SERVER["REQUEST_METHOD"] == "POST") {
    // getting the entered values
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    //checking the entered vals from table
    
    if($stmt = mysqli<?php

    include("config.php");
    session_start();
    
    $username = "";
    $password = "";
    
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // getting the entered values
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $password = mysqli_real_escape_string($db,$_POST['password']);
    
        //checking the entered vals from table
        
        if($stmt = mysqli_prepare($db, "SELECT sname, sid FROM student WHERE sname = ? and sid = ?")){
           
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
                            $_SESSION['sname'] = $username;
                            $_SESSION['sid'] = $password;
                            header("location: index.php");
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
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" id="username">
    
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input  class="form-control" id="password" type="password" name="password">
    
                    </div>
                    <div class="form-group">
                        <input onclick="check()" value="Sign Up"  class="btn btn-primary" >
                    </div>
                    
                </form>
            </div>
        </div>
        <body>
    </div>
    
    
    <script type="text/javascript">
        function check() {
            
            var passwordVal = document.getElementById("password").value;
            var usernameVal = document.getElementById("username").value;
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
    _prepare($db, "SELECT sname, sid FROM student WHERE sname = ? and sid = ?")){
       
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
                        $_SESSION['sname'] = $username;
                        $_SESSION['sid'] = $password;
                        header("location: index.php");
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
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" id="username">

                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input  class="form-control" id="password" type="password" name="password">

                </div>
                <div class="form-group">
                    <input onclick="check()" value="Login"  class="btn btn-primary" >
                </div>
                
            </form>
        </div>
    </div>
    <body>
</div>


<script type="text/javascript">
    function check() {
        
        var passwordVal = document.getElementById("password").value;
        var usernameVal = document.getElementById("username").value;
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
