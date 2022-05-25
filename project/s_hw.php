<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta http-equiv = "X-UA-Compatible" contens = "IE=edge">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

</head>
<style>
.navbar-nav
{
  font-family: 'Lato', sans-serif;
  color:0x000;
  font-size: 30px;
  margin: 0px;
  
}



</style>
<body bdcolor="blue">
<style> 
.container {
  display: flex;
  justify-content: center;
}
.navbar-nav .nav-item {
    margin-right: 100px;
    margin-left: 100px;
}
</style>

    
    <nav class=" navbar-expand-md navbar-dark bg-dark">
        <!--<h5 class="navbar-text navbar-text-light">t_name <?php echo htmlspecialchars($_SESSION['sname']); ?></h5>-->
        <div class="container-fluid">
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav mx-auto ">
                <li class="nav-item ">
                    <a  href="s_lesson.php" class="nav-link">Lesson</a>
                </li>
                <li class="nav-item">
                    <a href="s_hw.php" class="nav-link" >Homework</a>
                </li>
                <li class="nav-item">
                    <a  href="s_exam.php" class="nav-link">Exam</a>
                </li>
            </ul>
        </div>
        </div>
    </nav>
    <div class="container mt-5 text-left" >
    <div class="center">
    <div class="panel container-fluid">
    <h3  style="font-weight: bold;" class="page-header">Your Homework List</h3>
    </div>
    </div>
    </div>
    <div class="panel container-fluid">
    <table class = "table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Due Date</th>
                <th>Total Contribution</th>
                <th>Grade</th>
            </tr>
        </thead>
    
        <tbody>
            <?php
            $servername = "dijkstra.ug.bcc.bilkent.edu.tr";
            $username = "selahattin.oztur";
            $password = "sFXKHkZQ";
            $database = "selahattin_ozturk";

            $connection = new mysqli($servername, $username, $password, $database);

            if($connection->connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            require_once('config.php');  
            $sql="SELECT h.h_id, h.due_date, h.total_contribution, g.grade FROM Homeworks h, Grades g WHERE g.h_id = h.h_id";            
            $result = mysqli_query($db,$sql);

            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td>" . $row['h_id'] . "</td>";
                
                echo "<td>" . $row['due_date'] . "</td>";
                echo "<td>" . $row['total_contribution'] . "</td>";
                echo "<td>" . $row['grade'] . "</td>";
                echo "</tr>";
            }

            $sql2="SELECT h.h_id FROM Homeworks h WHERE h.total_contribution in (SELECT max(h.total_contribution) FROM Homeworks h, Grades g WHERE g.h_id = h.h_id)";            
            $result2 = mysqli_query($db,$sql2);
            while($row2 = mysqli_fetch_array($result2)){
            echo "<tr>";
            echo "<td>" . "MAX TOTAL CONTRIBUTION HOMEWORK : " . "</td>";
            echo "<td>" . $row2['h_id'] . "</td>";
            echo "</tr>";
            }
            echo "</table>";
            
            ?>
        <tbody>
    </table>
        </div>
</body>
</html>