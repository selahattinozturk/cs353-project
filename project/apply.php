<?php
/**
 * CS353 hw4
 * Author: selahattin cem ozturk
 * applying for an internship page
 */
include("config.php");
session_start();

//total application count

$result = mysqli_query($db, "SELECT COUNT(*) AS cnt FROM apply WHERE sid =" . $_SESSION['sid']);

if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
$row = mysqli_fetch_array($result);
$input_success = true;
$num_of_application = $row['cnt'];

if($num_of_application == 3){

    $input_success = false;
    echo "<script LANGUAGE='JavaScript'>
          window.alert('Max application count is 3, you can not apply no more');
          window.location.href='welcome.php';
       </script>";

}

if($_SERVER["REQUEST_METHOD"] == "POST") {
 $student_id = $_SESSION['sid'];
    $input_success = true;
    $given_cid = $_POST['cid'];
   
   
    


    $result = mysqli_query($db, "SELECT COUNT(*) AS cnt  FROM company WHERE cid='$given_cid'");
    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
  
    $cnt = mysqli_fetch_array($result)['cnt'];
    if($cnt == 0){
        $input_success = false;
        echo "<script LANGUAGE='JavaScript'>
            window.alert('Wrong input there is no such company exists.');
            window.location.href='apply.php';
        </script>";
    }


 


    $result = mysqli_query($db,"SELECT COUNT(*) as cnt FROM apply WHERE sid IN (SELECT sid FROM apply WHERE cid ='$given_cid' AND sid ='$student_id')");
    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $row = mysqli_fetch_array($result);
    $application_count = $row['cnt'];
    if($application_count >= 1){
        $input_success = false;
        echo "<script LANGUAGE='JavaScript'>
            window.alert('You have already applied to this company.');
            
        </script>";
    }



    $result = mysqli_query($db,"SELECT quota FROM company WHERE cid='$given_cid'");
    if (!$result) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
    $row = mysqli_fetch_array($result);
    $quota_count = $row['quota'];

    if($quota_count == 0){
        $input_success = false;
        echo "<script LANGUAGE='JavaScript'>
            window.alert('There is no available quota for this company.');
            
        </script>";
    }
    if($input_success == true){
       
        
        $result = mysqli_query($db,"UPDATE company SET quota = quota -1 WHERE cid = '$given_cid'");
        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

     
        $result = mysqli_query($db,"INSERT INTO apply VALUES ('$student_id','$given_cid')");
        if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }else{
            echo "<script LANGUAGE='JavaScript'>
            window.alert('Application is successfully added redirecting to welcome page');
            window.location.href = 'welcome.php'; 
        </script>";
        }
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Accounts</title>
    <link  href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
          rel="stylesheet" crossorigin="anonymous">
    <style type="text/css">
    	th, td { padding: 7px; text-align: bottom; }
        body{ font: 18px Cursive; text-align: bottom; }
        #centerdiv { display: inline; }
        p { margin-bottom: 20px; }
        
        #centerwrapper { text-align: right; margin-bottom: 20px; }
        
    </style>
</head>
<body bdcolor="blue">
<div class="container">
    <nav class=" navbar-expand-md navbar-dark bg-dark">
        <h5 class="navbar-text navbar-text-light">You can apply these companies, <?php echo htmlspecialchars($_SESSION['sname']); ?></h5>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a  href="welcome.php" class="nav-link">Go back</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link" >Exit</a>
                </li>
            </ul>
        </div>

    </nav>
    <div class="panel container-fluid">
        <h3  style="font-weight: bold;" class="page-header">Apply For a Company</h3>
        <?php
        echo "<table class=\"table table-lg table-striped\">
        <tr>
            <th>Company id</th>
            <th>Company name</th>
            <th>Quota</th>
        </tr>";

        $query ="SELECT c.cid as cid, c.cname as cname,c.quota as quota FROM company as c WHERE quota >= 1 AND gpathreshold <= (select s.gpa from student s where s.sid = " . $_SESSION['sid'] . ")  AND  NOT EXISTS (SELECT * FROM apply WHERE c.cid = cid AND sid =" . $_SESSION['sid'] . ")";

       

        if (!$query) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
        }

        $result = mysqli_query($db, $query);

        while($current = mysqli_fetch_array($result)){
            echo "<tr>";
            echo "<td>" . $current['cid'] . "</td>";
            echo "<td>" . $current['cname'] . "</td>";
            echo "<td>" . $current['quota'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>

    <form action="" METHOD="POST">
        <div class = "form-col">
            <input class="form-control col-md-4" name="cid"  type="text"  placeholder="Company ID">
            <button class="btn btn-primary" type="submit" >Submit the application</button>
        </div>
    </form>
</div>
