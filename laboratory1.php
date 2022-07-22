<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HealCo | Laboratory</title>
	
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="addpatient.css">
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
       <a href="profile.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Profile</span>
       </a>
       <span class="tooltip">Profile</span>
     </li>
     <li>
       <a href="set_appointment.php">
         <i class='bx bx-calendar-plus' ></i>
         <span class="links_name">Appointment</span>
       </a>
       <span class="tooltip">Appointment</span>
     </li>
     
     <li>
       <a href="view1.php">
         <i class='bx bx-folder' ></i>
         <span class="links_name">Health Records</span>
       </a>
       <span class="tooltip">Records</span>
     </li>

     <li>
       <a href="laboratory1.php">
         <i class='bx bx-plus-medical' ></i>
         <span class="links_name">Laboratory</span>
       </a>
       <span class="tooltip">Laboratory</span>
     </li>
     
     <?php 
							$sql = "SELECT * FROM patient WHERE username= '".$_SESSION['username']."'";
                $result = mysqli_query($conn, $sql); 
                        
                if($result)
                {
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>
               

     <li class="profile">
         <div class="profile-details">
         <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" width="20px" height="20px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="20px" height="20px" />

    <?php     }
        
         ?>
           
           <div class="name_job">
             <div class="name"><?=$_SESSION['name']?></div>
             <div class="job"><?=$_SESSION['role']?></div>
           </div>
         </div>
         <div class="logout"><a href="logout.php" class='bx bx-log-out' type='solid' id="log_out" ></a></div>
         
     </li>
    </ul>
  </div>
  <?php }?>
                        
                        <?php }?>
                        <?php  }?>
  <section class="home-section1">

  <?php 
$sql = "SELECT * FROM patient WHERE username= '".$_SESSION['username']."' AND plan = 1 ORDER BY id ASC ";
$res = mysqli_query($conn, $sql);
     
if (mysqli_num_rows($res) === 1) {
  
                  while ($rows = mysqli_fetch_assoc($res)) {
                    
                    ?>

<?php 
$sql = "SELECT * FROM cbc WHERE patient_id= '".$_SESSION['id']."'";
$res = mysqli_query($conn, $sql);
     
if (mysqli_num_rows($res) === 1) {
  
                  while ($rows = mysqli_fetch_assoc($res)) {
                    
                    ?>

<form class="bg-white border shadow p-4 text-left" id="form" action="" method="POST" style="position: absolute; border-radius: 20px; width: 410px; height: 650px; font-family: Poppins; margin-left: 40px; margin-top: -15px">


  <img src="img/red-blood-cells.png" class="ms-5 mt-1" style="width: 60px; height: 60px; margin-bottom: -40px; margin-top: -10px">
  <h5 class="card-title" style="margin-left: 120px; margin-top: -10px; font-size: 24px; color: #4a5454">CBC Blood Test</h5>

  
      <label class="mt-5" style="font-size: 15px; font-weight: 500"> Clinic Name</label> <br>
      <label class="mt-0 ms-5" style="font-size: 18px;"><?php echo $rows['clinic']?></label> <br>

      <label class="mt-5" style="font-size: 15px; font-weight: 500">CBC Lab Result</label> <br>
     
      <embed class="ms-3" type="application/pdf" src="uploads/<?php echo $rows['lab']?>" width="300px" height="300px" />

            

      
      
</form>
<?php  } ?>
      <?php  } ?>

      <?php 
$sql1 = "SELECT * FROM cholesterol WHERE patient_id= '".$_SESSION['id']."'";
$res1 = mysqli_query($conn, $sql1);
     
if (mysqli_num_rows($res1) > 0) {
  
                  while ($rows = mysqli_fetch_assoc($res1)) {
                    
                    ?>

<form class="bg-white border shadow p-4 text-left" id="form" action="" method="POST" style="border-radius: 20px; width: 410px; height: 650px; font-family: Poppins; margin-left: 520px; margin-top: -10px; position: absolute;">


  <img src="img/cholesterol.png" class="ms-5 mt-1" style="width: 60px; height: 60px; margin-bottom: -40px; margin-top: -10px">
  <h5 class="card-title" style="margin-left: 120px; margin-top: -5px; font-size: 24px; color: #4a5454">Cholesterol Test</h5>

  
      <label class="mt-5" style="font-size: 15px; font-weight: 500"> Clinic Name</label> <br>
      <label class="mt-0 ms-5" style="font-size: 18px;"><?php echo $rows['clinic']?></label> <br>


      <label class="mt-5" style="font-size: 15px; font-weight: 500">Cholesterol Lab Result</label> <br>

      <embed class="ms-3" type="application/pdf" src="uploads/<?php echo $rows['result_cho']?>" width="300px" height="300px" />

            
</form>
<?php  } ?>
      <?php  } ?>


<?php  } ?>


 
     <?php  } else {
       $id = $_SESSION['id'];

        echo "<p class='echo1'>Your plan does not include viewing of your Health Records. 
            <br>  If you want to view your records, add your payment information and pay only P50 for a premium plan.</p>";
            
            
        echo "<a href='editpayment.php?id=$id' class='btn btn-info text-white ms-5 mt-2 mb-5' type='submit' name='submit' value='Submit'> Click here to Apply </a>";
        
        }?>
        
   </form>
  </section>



<script src="script.js"></script>
			
</body>
</html>

<?php }else{
	header("Location: index.php");
} ?>