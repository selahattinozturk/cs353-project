<?php
include("config.php");
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $given_cid = $_POST['given_cid'];
    $student_id = $_SESSION['sid'];

    
    $result = mysqli_query($db,"DELETE FROM apply WHERE sid ='$student_id' AND cid='$given_cid'");

    
    $result1 = mysqli_query($db,"UPDATE company SET quota = quota + 1 WHERE cid='$given_cid'");

    //checking errors
    if (!$result && !$result1) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }else{
        echo "<script LANGUAGE='JavaScript'>
            window.alert('Application is successfully deleted.');
            window.location.href = 't_lesson.php'; 
        </script>";
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style type="text/css">
        body{ font: 18px Cursive; text-align: bottom; }
        p { margin-bottom: 10px; }
        th, td { padding: 5px; text-align: left; }
    </style>
</head>
<body>
<div class="container">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <h5 class="navbar-text"><?php echo htmlspecialchars($_SESSION['sname']); ?>'s applied companies</h5>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="t_lesson.php">Lesson</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="t_hw.php">Homework</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="t_create_exam.php">Exam</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="t_grade.php">Grading</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="t_profile.php">Profile</a>
                </li>
                
            </ul>
        </div>

    </nav>
    <div>
    <div class="panel container-fluid">
<form action="" METHOD="POST">
<div class = "form-col">
    <table class="table table-lg table-striped">
        <legend>Select the language:</legend>
            <tr>
                <th>
                <div>
                <input type="radio" id="English" name="drone" value="English"
                        checked>
                <label for="English">English</label>
                </div>
                </th>
                <th>
                <div>
                <input type="radio" id="German" name="drone" value="German">
                <label for="German">German</label>
                </div>
                </th><th>
                <div>
                <input type="radio" id="Japanese" name="drone" value="Japanese">
                <label for="Japanese">Japanese</label>
                </div>
                </th><th>
                <div>
                <input type="radio" id="French" name="drone" value="French">
                <label for="French">French</label>
                </div>
                </th>
                <th>
                    <div>
                        <input type="radio" id="Russian" name="drone" value="Russian">
                        <label for="Russian">Russian</label>
                    </div>
                </th>
            </tr>
</div>

    
</table>
<div>
    <h4 class="page-header" style="font-weight: plain;">Enter Level from 1 to 10:</h4>

        
            <input class="form-control col-md-4" name="cid"  type="text"  placeholder="Enter Level">
            
        </div>
    </div>
    <p><a href="t_lesson.php" class="center btn btn-success">Create<a></p>
    </div>
    
</div>
</form>


</body>
</html>
