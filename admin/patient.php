<?php 
   session_start();
   
   include "../db_conn.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        
        var data = google.visualization.arrayToDataTable([
          ['Gender', 'Numbers'],
          
          
<?php 
          $sql = "SELECT * FROM patient WHERE sex ='Male'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Male', ".$rowcount."],";
          }

          $sql = "SELECT * FROM patient WHERE sex ='Female'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Female', ".$rowcount."],";
          }


        ?>
        ]);

        var options = {
          title: 'Patient Gender',
          pieHole: 0.4,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Healco | Admin</title>
</head>
<body>
    
<script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script>     
              <div class="sidebar">
    <div class="logo-details">
      <i class='bx bx-dna icon'></i>
        <div class="logo_name">HealCo</div>
        <i class='bx bx-menu' id="btn" ></i>
    </div>
    <ul class="nav-list">
     
      
      <li>
       <a href="dashboard.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Dashboard</span>
       </a>
       <span class="tooltip">Dashboard</span>
     </li>

     <li>
       <a href="clinic.php">
         <i class='bx bx-plus-medical' ></i>
         <span class="links_name">Clinics</span>
       </a>
       <span class="tooltip">Clinics</span>
     </li>

     
     <li>
       <a href="patient.php">
         <i class='bx bx-folder' ></i>
         <span class="links_name"> Patients</span>
       </a>
       <span class="tooltip">Patients</span>
     </li>

     


     
     
     <li class="profile">
         <div class="profile-details">
         <img src="../uploads/default.png" alt="" width="20px" height="20px">';
        
           <div class="name_job">
             <div class="name">HealCo</div>
             <div class="job">Admin</div>
           </div>
         </div>
         <div class="logout"><a href="logout.php" class='bx bx-log-out' type='solid' id="log_out" ></a></div>
         
     </li>
    </ul>
  </div>
  <section class="home-section1">

  <?php 
        
        if(isset($_POST['save'])){

          $patient = $_GET['patient'];
          $plan = $_POST['plan'];
          
          $sql = "UPDATE patient SET plan = $plan WHERE id = $patient";
          $result = mysqli_query($conn, $sql);
          
          if ($result) {
           echo "<script language = javascript>
                   Swal.fire(
                       'Success!',
                       'Patient is Updated',
                       'success'
                   ).then((result) => {
                     window.location.href = 'patient.php';
                   });
               </script>";
                   }
          }
        
        ?>

  <?php require_once 'edit.php'; ?>
  <?php 
              if($patient== false):?>

<?php 
        $patient_id = $_GET['patient'];
							$sql = "SELECT * FROM patient WHERE id= $patient_id";
                $result = mysqli_query($conn, $sql); 
                        
                if($result)
                {
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>

<form class="border shadow rounded-20 text-center" style="border-radius: 20px; height: 580px; background-color: white; width: 400px; margin-top:20px; margin-left: 85px;" method="POST" action="" enctype="multipart/form-data" id="manage-doctor">

<?php 
       if(empty($row['image']))
       {
         echo '<img src="uploads/default.png" alt="" width="200px" height="200px">';
       } else{
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="180px" height="180px" style="margin-top: 20px; border-radius:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"/>';

       }
      
       ?>

                

                      <h2 style="font-size: 22px;" class=" mt-4 mb-1"><?=$row['name']?></h2>
                      <p>@<?=$row['username']?></p>
<hr class="bg-info" style=" margin-left: auto;
      margin-right: auto;
      width: 80%;">
                     
                     
                      <p class="text-left ms-4 mb-0 mt-4" style="font-weight: 500;">Email Address:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['email']?></h6>

                       <p class="text-left ms-4 mb-0 mt-4 " style="font-weight: 500;">Contact Number:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['phone']?></h6>
                        
                        <p class="text-left ms-4 mb-0 mt-4 " style="font-weight: 500;">Complete Address:</p>
                            <h6 class="text-left ms-4 text-muted mb-2"><?php echo $row['address']?></h6>

                        <p class="text-left ms-4 mb-0 mt-4" style="font-weight: 500;">Age:</p>
                            <h6 class="text-left ms-4 text-muted"><?php echo $row['age']?></h6>


              
</form>
                        
<?php }?>
                        
                        <?php }?>
                        <?php  }?>  
    
<?php 
            $patient = $_GET['patient'];
							$sql = "SELECT * FROM patient WHERE id= $patient";
                $result = mysqli_query($conn, $sql); 
                        
              ?>                                   


<form class="bg-white border shadow p-4  mb-3 text-center" method="POST" style="border-radius: 20px; width: 600px; height: 430px; font-family: Poppins; margin-left: 700px; margin-top: -500px;">
<?php 
          while ($row = mysqli_fetch_assoc($result)) {

            ?>

<label class=" text-secondary form-label mt-2 mb-0" style="font-size: 22px; font-weight: 500">Active Plan of Patient #<?=$row['id']?></label> <br>


<?php if(empty($row['card_num']))
            { ?>
<div class="p-3 border shadow text-center bg-info mt-3" style="border-radius: 20px; margin: auto; border: none; width: 240px;height: 300px">
        
        <label class="text-white form-label mt-2 mb-0" style="font-size: 25px; font-weight: 500">BASIC PLAN</label> <br>

        <label class="text-white form-label" style="font-size: 17px;">Php 0</label>
       
        <div class="text-left text-white">
                    <i class='bx bx-check'></i> FREE</li> <br>
                   <i class='bx bx-check'></i> Register</li> <br>
                   <i class='bx bx-check'></i> Profile</li> <br>
                   <i class='bx bx-check'></i> Appointment</li> <br>
                   <i class='bx bx-check'></i> Search Clinic Location</li> <br>
                   <i class='bx bx-check'></i> Access Doctors' Information</li> <br>
                   
        </div>
       
        </div>

<?php } else {?>

<div class="p-3 border shadow text-center bg-warning mt-3" style="border-radius: 20px; margin-left: 20px; border: none; width: 240px;height: 300px">
        

        <label class="text-white form-label mt-2 mb-0" style="font-size: 25px; font-weight: 500">PREMIUM PLAN</label> <br>

        <label class="text-white form-label" style="font-size: 17px;">Php 50.00</label>
       
        <div class="text-left text-white">
                    
                   <i class='bx bx-check'></i> Register</li> <br>
                   <i class='bx bx-check'></i> Profile</li> <br>
                   <i class='bx bx-check'></i> Appointment</li> <br>
                   <i class='bx bx-check'></i> Search Clinic Location</li> <br>
                   <i class='bx bx-check'></i> Access Doctors' Information</li> <br>
                   <i class='bx bx-check'></i> Health Records</li> <br>
                   <i class='bx bx-check'></i> Laboratory</li> <br>
        </div>
       
        </div>

        <div class="form-label text-muted" style="margin-top: -210px; margin-left: 250px"> Waiting for confirmation</div>

        <select class="form-select" style="width: 200px; margin-top: 20px; margin-left: 300px"
		                  name="plan" id="plan"  value="<?php echo $row['plan']?>">

                      <option value="0" <?php echo isset($row['plan']) && $row['plan'] == 0 ? "selected" : '' ; ?>>Basic Plan</option>
                      <option value="1" <?php echo isset($row['plan']) && $row['plan'] == 1 ? "selected" : '' ; ?>>Premium Plan</option>
                     
                    </select>

        <button type="save" name="save" id="save" class="btn btn-info" style="margin-top: 20px; margin-left: 250px">Accept Payment</button>
        
        <?php } ?>
                 <?php } ?>

</form>


<?php else: ?>

  <?php require_once 'edit.php'; ?>

  <div class="text ms-5 mb-3">Patients</div>
<form class="bg-white border shadow p-4  mb-3" action="edit.php" method="POST" style="border-radius: 20px; width: 700px; font-family: Poppins; margin-left: 50px; height: 550px">

<?php
              $sql = "SELECT * FROM patient";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>

<table class="table" style="width:650px; margin: auto;">
<thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td width="7%">
                             ID
                         </td>
                         <td width="25%">
                            Patient
                         </td>
                         
                         <td width="10%">
                            Plan
                         </td>
                         <td width="10%">
                            Action
                         </td>
                     </tr>
                 </thead>
</table>
<div style="width:100%;overflow:auto; max-height:500px;">
             <table class="table table-hover" style="width:650px; margin: auto;">
                 

                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">
          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">
            <td width="6%"><?=$rows['id']?></td>
            <td width="25%">
            <?php if(empty($rows['image']))
       {
         echo '<img src="../uploads/default.png" alt="" width="20px" height="20px" style="margin-right: 10px">';
       } else{
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['image'] ).'" width="30px" height="30px" style="border-radius:40px; margin-right: 10px"/>';

       } ?> 
            <?=$rows['name']?>
        
            </td>


            <td width="10%">
                
                
                <?php if($rows['plan'] == 0): ?>
                    <span class="badge badge-warning">Basic</span>
                <?php endif ?>
                <?php if($rows['plan'] == 1): ?>
                    <span class="badge badge-success">Premium</span>
                <?php endif ?>
                
            
            </td>
            
            <td width="10%">
              
             <a href="patient.php?patient=<?=$rows['id']?>" class="btn btn-sm btn-info">Edit</a>
             <a href="patient.php?del=<?=$rows['id']?>" class="btn btn-sm btn-danger" name="id" class="id" id="btn-delete">Delete</a>
								
            </td>

          </tr>
          <?php  }?>
          </tbody>
          
             </table>
</div>
</form>


<form class="bg-white border shadow p-4  mb-3" style="border-radius: 20px; width: 600px; height: 430px; font-family: Poppins; margin-left: 800px; margin-top: -500px;">
<div id="piechart" style="width:550px; height: 400px;"></div>

</form>

 <?php endif; ?>
  </section>

<script src="../script.js"></script>

</body>


</html>