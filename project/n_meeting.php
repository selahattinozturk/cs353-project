

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
        <h5 class="navbar-text navbar-text-light">n_name <?php echo htmlspecialchars($_SESSION['sname']); ?></h5>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav mx-auto  ">
                
                <li class="nav-item px-5">
                    <a href="n_meeting.php" class="nav-link" >Meeting</a>
                
                <li class="nav-item px-5">
                    <a  href="n_profile.php" class="nav-link">Profile</a>
                </li>
            </ul>
        

    </nav>
    
    <div class="container-fluid">
    <div class="mt-5">
        <div class="row">
            <div class="col-md-6 "  style="border: 1px solid #003366">
               <h3>MEETING REQUESTS</h3>
            </div>
            <div class="col-md-6 "  style="border: 1px solid #003366">
            <h3>MEETING GRADING</h3>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-md-6" style="border: 1px solid #003366">
                <table id="staff" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Date</th>
                            <th>Link</th>
                            <th></th>
                            
                        </tr>
                    </thead>
                    
                    
                </table>
            </div>


            <div class="col-md-6" style="border: 1px solid #003366">
                <table id="patient" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>Student</th>
                            <th>Date</th>
                            <th>Grade</th>
                           
                            
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        
    </div>
</div>
    
    

    
    
</div>

