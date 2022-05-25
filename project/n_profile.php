<!DOCTYPE html>
<html lang="en">
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
  margin-left:30px;
  margin-right:30px;
  
}

.navbar-nav .nav-item {
    margin-right: 250px;
    margin-left: 250px;
}
</style>
<body >

    <nav class=" navbar-expand-md navbar-dark bg-dark">
        <!--<h5 class="navbar-text navbar-text-light">n_name <?php echo htmlspecialchars($_SESSION['sname']); ?></h5>-->
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav mx-auto  ">
                
                <li class="nav-item px-5">
                    <a href="n_meeting.php" class="nav-link" >Meeting</a>
                
                <li class="nav-item px-5">
                    <a  href="n_profile.php" class="nav-link">Profile</a>
                </li>
            </ul>
        

    </nav>
<style> 
.container {
  display: flex;
  justify-content: center;
}
</style>
<div class="container mt-4">
  <div class="center">
    <div class="row">
    <img src="https://pbs.twimg.com/profile_images/1932171609/abdullah_atalar_400x400.jpg" alt="Girl in a jacket" width="40%" height="40%">
</div>
<div class="row">
    <?php
    echo "<ul align='center'><tr>
            <td>Abdullah Atalar</td>
        </tr><br>";
    echo "<tr>
            <td>Turkish,Turkey</td>
        </tr>";
    ?>
  </div>
    </div>
</div>

</body>
</html>