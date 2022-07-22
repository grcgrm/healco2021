<?php 
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
		$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
}
//##########################################################################


?>


<?php 
   session_start();
   
   include "../db_conn.php"; 
?>


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
          ['Specialization', 'Numbers'],
          
          
<?php 
          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='General Physician'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['General Physician', ".$rowcount."],";
          }

          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Obstetrician/Gynecologist'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Obstetrician/Gynecologist', ".$rowcount."],";
          }

          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Optometrist'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Optometrist', ".$rowcount."],";
          }

          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Dermatologist'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Dermatologist', ".$rowcount."],";
          }

          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Psychiatrist'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Psychiatrist', ".$rowcount."],";
          }

          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Dialysis'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Dialysis', ".$rowcount."],";
          }

          $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Diagnostic Radiology'";
          $result = mysqli_query($conn, $sql); 
          $rowcount = mysqli_num_rows($result);

          if ($result) {

            echo "['Diagnostic Radiology', ".$rowcount."],";
          }

         $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Pediatrician'";
         $result = mysqli_query($conn, $sql); 
         $rowcount = mysqli_num_rows($result);

        if ($result) {

          echo "['Pediatrician', ".$rowcount."],";
         }

         $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Internal Medicine'";
         $result = mysqli_query($conn, $sql); 
         $rowcount = mysqli_num_rows($result);
         
         if ($result){

          echo "['Internal Medicine', ".$rowcount."],";
         }

         $sql = "SELECT * FROM doctors_list WHERE specialty_ids ='Dentist'";
         $result = mysqli_query($conn, $sql); 
         $rowcount = mysqli_num_rows($result);
         
         if ($result){

          echo "['Dentist', ".$rowcount."],";
         }
        ?>
        ]);

        var options = {
          title: 'Doctors Specialization',
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
 
 <?php if(isset($_POST['submit'])){

$clinic = $_GET['clinic'];
$payment = $_POST['payment'];
$status = $_POST['status'];

$sql = "UPDATE users SET payment = '$payment', status = '$status' WHERE id = $clinic";
$result = mysqli_query($conn, $sql);

if ($result) {

      $list = "SELECT * FROM users WHERE id='".$clinic."'";
       $res = mysqli_query($conn, $list);
       $row=mysqli_fetch_assoc($res);
       
       if($row['status'] == 1)

       {

        $apicode = "ST-HEALC117601_YNVGC";
        $apipw = "vjs4]3mu81";
        $phone = $row['phone'];
      
        $text = "Your application is accepted by HealCo. You can now log in to your account. Thank you.";
      
        $result = itexmo($phone,$text,$apicode, $apipw);
            if ($result == ""){
                echo "<script language = javascript>
                    Swal.fire(
                        'Sorry!',
                        'No response from server. Please try again.',
                        'error'
                    )
                </script>";
                }else if ($result == 0){
      
                    echo "<script language = javascript>
                    Swal.fire(
                        'Success!',
                        'Clinic is Confirmed',
                        'success'
                    ).then((result) => {
                      window.location.href = 'clinic.php';
                    });
                    </script>";
                              
                
                }
                else{	
                    echo "<script language = javascript>
                    Swal.fire(
                        'Sorry!',
                        'Error Number #'. $result . 'was encountered! Contact our customer support.',
                        'error'
                    ).then((result) => {
            
                        window.location.href = 'clinic.php';
                      });
                </script>";
                
                }
      
               }

               echo "<script language = javascript>
               Swal.fire(
                   'Success!',
                   'Clinic is Updated',
                   'success'
               ).then((result) => {
                 window.location.href = 'clinic.php';
               });
               </script>";

       }

 
}
?>


  <?php require_once 'edit.php'; ?>
  <?php 
              if($clinic == false):?>

<form class="bg-white border shadow p-4 text-center" action="" method="POST" style="border-radius: 20px; width: 410px; height: 658px; font-family: Poppins; margin-left: 80px; margin-top: -20px">

<?php 
        $clinic = $_GET['clinic'];
							$sql = "SELECT * FROM users WHERE id= $clinic";
                $result = mysqli_query($conn, $sql); 
                        
                if($result)
                {
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) { ?>
    
         <?php 
         if(empty($row['image']))
         {
           echo '<img src="../uploads/default.png" width="100px" height="100px" style="border-radius: 80px">';
         } else{ ?>
          
          <img src="../uploads/<?php echo $row['image']?>" width="100px" height="100px" style="margin-top: 20px; margin: auto; border-radius:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"/>

    <?php     }
        
         ?> 


<h2 style="font-size: 20px;" class="mt-3"><?=$row['cname']?></h2>
                      <p>@<?=$row['username']?></p>
<hr class="bg-info" style=" margin-left: auto;
      margin-right: auto;
      width: 80%;">
                     
                     
                      <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Email Address:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['email']?></h6>

                       <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Contact Number:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['phone']?></h6>
                        
                        <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Complete Address:</p>
                            <h6 class="text-left ms-4 text-muted mb-2"><?php echo $row['address']?></h6>

                        <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">City:</p>
                            <h6 class="text-left ms-4 text-muted"><?php echo $row['city']?></h6>

                        <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Accepted Payment:</p>
                        <select class="form-select mt-0 mb-0 ms-4 mb-3" style="width: 250px"
		                  name="payment" id="payment"  value="<?php echo $row['payment']?>">

                      <option value="gcash" <?php echo isset($row['payment']) && $row['payment'] == 'gcash' ? "selected" : '' ; ?>>GCASH</option>
                      <option value="paymaya" <?php echo isset($row['payment']) && $row['payment'] == 'paymaya' ? "selected" : '' ; ?>>PAYMAYA</option>
                      <option value="card" <?php echo isset($row['payment']) && $row['payment'] == 'card' ? "selected" : '' ; ?>>CARD</option>
                     
                    </select>

                  <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Status:</p>
                  <select class="form-select mt-0 mb-0 ms-4 mb-3" style="width: 250px"
		                  name="status" id="status"  value="<?php echo $row['status']?>">

                      <option value="0" <?php echo isset($row['status']) && $row['status'] == 0 ? "selected" : '' ; ?>>For Verification</option>
                      <option value="1" <?php echo isset($row['status']) && $row['status'] == 1 ? "selected" : '' ; ?>>Confirmed</option>
                     
                    </select>

                    <button type="submit" name="submit" id="submit" class="btn btn-info">Save Changes</button>
                    
</form>
                  

<form class="bg-white border shadow p-4" action="" style="border-radius: 20px; width: 700px; font-family: Poppins; margin-left: 580px; margin-top: -640px" enctype="multipart/form-data" >
<!-- 
<?php 
        $clinic = $_GET['clinic'];
							$sql = "SELECT * FROM users WHERE id= $clinic";
                $result = mysqli_query($conn, $sql); 
                        
              ?>             -->
<div class="table-responsive">
<table class="table table-hover" style="width: 550px; margin: auto;" cellspacing="0" id="docu">
                 <thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         
                         <td>
                            Documents
                         </td>
                         <td>

                         </td>
                     </tr>
                 </thead>

                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">

          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">

            <td> BIR </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['bir']?>" width="150px" height="200px" >
 
             </td>

          </tr>

           <tr style="border: none">

          <td> Mayor's Permit </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['mayor']?>" width="150px" height="200px" >
          </td>

          </tr>

          <tr style="border: none">

          <td> Doctor's License </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['license']?>" width="150px" height="200px" >
          </td>
            
          </tr>

          <tr style="border: none">

          <td> License to Operate </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['operate']?>" width="150px" height="200px" >
          </td>
            
          </tr>

          <tr style="border: none">

          <td> DOH Form </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['doh']?>" width="150px" height="200px" >
           </td>
            
          </tr>

          <tr style="border: none">

          <td> Certification of BFP Safety </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['bfp']?>" width="150px" height="200px" >
          </td>
            
          </tr>

          <tr style="border: none">

          <td> Building Permit </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['build']?>" width="150px" height="200px" >
          </td>
            
          </tr>

          <tr style="border: none">

          <td> Valid ID </td>
            
            <td class="text-center">
            <img src="../uploads/<?php echo $row['valid']?>" width="150px" height="200px" >
          </td>
            
          </tr>

          
          <?php  }?>
          </tbody>
          
             </table>
</div>
</form>
<?php }?>
 <?php }?>
<?php  }?>     



                        <?php else: ?>

  <?php require_once 'edit.php'; ?>
  <div class="text ms-5 mb-1">Clinics</div>
  <form class="bg-white border shadow p-4 ms-5" action="edit.php" style="border-radius: 20px; width: 710px; font-family: Poppins; height: 600px">

<?php
              $sql = "SELECT * FROM users order by id asc";
              $result = mysqli_query($conn, $sql); 
              
             ?>
<div style="width:100%;overflow:auto; max-height:600px;">
             <table class="table table-hover" style="width: 600px; margin: auto;" cellspacing="0" id="list">
                 <thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td>
                             ID
                         </td>
                         <td>
                            Clinic
                         </td>
                        
                         <td>
                            Status 
                         </td>
                         <td>
                            Action
                         </td>
                     </tr>
                 </thead>

                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">
          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">
            <td><?=$rows['id']?></td>
            <td class="text-left">

           <?php 
         if(empty($rows['image']))
         {
           echo '<img src="../uploads/default.png" width="20px" height="20px" style="margin-right: 10px">';
         } else{ ?>
          
          <img src="../uploads/<?php echo $rows['image']?>" width="30px" height="30px" style="border-radius:40px; margin-right: 10px"/>

    <?php     }
        
         ?>

            <?=$rows['cname']?></td>
            
           
            <td>
                
                <?php if($rows['status'] == 0): ?>
                    <span class="badge badge-danger">Pending</span>
                <?php endif ?>
                <?php if($rows['status'] == 1): ?>
                    <span class="badge badge-success">Active</span>
                <?php endif ?>
                
            
            </td>
            
            <td>
              
             <a href="clinic.php?clinic=<?=$rows['id']?>" class="btn btn-sm btn-info">Edit</a>
             <a href="clinic.php?id=<?=$rows['id']?>" class="btn btn-sm btn-danger" name="id" class="id" id="btn-delete">Delete</a>
									
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