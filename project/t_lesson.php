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
            window.location.href = 'welcome.php'; 
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
    <div class="panel container-fluid">
        
        <?php
        
        $query = "SELECT u.name l.l_name FROM Student s, User u, lesson l, enrolls e,  give g Where e.status = waiting AND s.u_id=u.u_id AND e.u_id = s.u_id AND l.l_id = e.l_id AND g.l_id = l.l_id";


        $result = mysqli_query($db, $query);

        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        echo "<table class=\"table table-lg table-striped\">
            <tr>
            <th>Student ID</th>
            <th>Requested Lesson</th>
            <th>Accept</th>
            <th> </th>
            </tr>";

        while($resultss = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $resultss['s.u_id'] . "</td>";
            echo "<td>" . $resultss['l.l_name'] . "</td>";
            echo "<td> <form action=\"\" METHOD=\"POST\">
            
                    <button type=\"submit\" name = \"given_cid\"class=\"btn btn-primary btn-sm\" value =".$resultss['l_id'] .">Accept</button>
                    </form>
                     
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
        ?>
    </div>
    <p><a href="t_create_lesson.php" class="center btn btn-primary">Create Lesson<a></p>
</div>



</body>
</html>
