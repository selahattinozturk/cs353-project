<?php
/**
 * CS353 hw4
 * Author: selahattin cem ozturk
 *welcome page of the application
 */
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
    <!-- <h5 class="navbar-text"><?php echo htmlspecialchars($_SESSION['sname']); ?>'s applied companies</h5> -->
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Go Back</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Exit the system</a>
                </li>
            </ul>
        </div>

    </nav>
    <div class="panel container-fluid">
        <h3 class="page-header" style="font-weight: bold;">Applied Internships</h3>
        <?php
        
       // $query = "SELECT C.cid, C.cname, C.quota, C.gpathreshold FROM student as S, apply as A, company as C WHERE   A.sid = S.sid and A.cid = C.cid and S.sid = " .$_SESSION['sid'];

       // echo "<p><b>Student ID:</b> " . $_SESSION['sid'] . "</p>";

        //$result = mysqli_query($db, $query);

        //if (!$result) {
        //    printf("Error: %s\n", mysqli_error($db));
        //    exit();
        //}

        echo "<table class=\"table table-lg table-striped\">
            <tr>
            <th>Cid</th>
            <th>Cname</th>
            <th>Quota</th>
            <th>Min GPA</th>
            <th> </th>
            </tr>";

        //while($resultss = mysqli_fetch_array($result)) {
        //   echo "<tr>";
        //    echo "<td>" . $resultss['cid'] . "</td>";
        //    echo "<td>" . $resultss['cname'] . "</td>";
        //    echo "<td>" . $resultss['quota'] . "</td>";
        //    echo "<td>" . $resultss['gpathreshold'] . "</td>";
        //    echo "<td> <form action=\"\" METHOD=\"POST\">
        //            <button type=\"submit\" name = \"given_cid\"class=\"btn btn-danger btn-sm\" value =".$resultss['cid'] .">Remove</button>
        //            </form>
                     
        //          </td>";
        //    echo "</tr>";
        //}

        echo "</table>";
        ?>
    </div>
    <p><a href="apply.php" class="center btn btn-primary">Apply to another company for internship</a></p>
</div>



</body>
</html>
