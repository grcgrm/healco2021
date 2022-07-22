<?php 
   session_start();
   
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
<title>HealCo | Appointment</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.css"/>
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style1.css">

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
                ?>

     <li class="profile">
         <div class="profile-details">

       <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" width="20px" height="20px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="20px" height="20px" />

    <?php     }?>
    <?php     }?>
    <?php     }?>
    <?php     }?>

           
           <div class="name_job">
             <div class="name"><?=$_SESSION['name']?></div>
             <div class="job"><?=$_SESSION['role']?></div>
           </div>
         </div>
         <div class="logout"><a href="logout.php" class='bx bx-log-out' type='solid' id="log_out" ></a></div>
         
     </li>
    </ul>
  </div>
  <section class="home-section1">
      

  <?php 
include 'db_conn.php';
error_reporting(0);

if(isset($_POST['set']))
{
  $id = $_GET['viewsched'];
  $cname = $_POST['cname'];
  $doctor = $_POST['doctor'];
  $name_pref = $_POST['name_pref'];
  $schedule = $_POST['date'] . '.' . $_POST['time'];
  $patient_id = $_POST['patient_id'];
  $patient_name = $_POST['patient_name'];

  mysqli_query($conn,"INSERT INTO appointment_list(clinic, doctor_id, doctor_name, name_pref, patient_name, patient_id, schedule) 
  VALUES('$cname', '$id','$doctor','$name_pref', '$patient_name', '$patient_id', '$schedule')");
  

        echo "<script language = javascript>
        Swal.fire(
            'Success!',
            'Appointment is Set. Please wait for confirmation via SMS.',
            'success'
        ).then((result) => {
          window.location.href = 'set_appointment.php';
        });
    </script>"; 
     
}

?>


  <?php require 'delete.php'; ?>
      <?php 
            if($viewsched == false):
      ?>  

<form class="border shadow rounded-20 p-3" style="background-color: #fff; margin-top: -5px; padding-top: 30px; width: 30%; margin-left: 100px; height:650px" action="" method="POST" >

<label for="" class="doctor mb-3 ms-3" style="font-size: 22px; margin-top: 5px">Doctor's Schedule</label> <br>
        
<?php 

$viewsched = $_GET['viewsched'];
              $list = $conn->query("SELECT * FROM doctors_schedule WHERE doctor_id = $viewsched order by id asc");

                ?>  
                
                <table class="table">

                  <tr>
                    <tr style="background-color: #b0e0e6;">
                      <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;"> Day </td>
                      <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;"> Start </td>
                      <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;"> End </td>
                    </tr>
                   <?php while($row=mysqli_fetch_assoc($list)): ?>
<tr>
                  <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;">
                    <?php echo $row['day'];?>
                    </td>
                    <td style="width: 150px; border: none; font-size: 17px;">
                    <?php echo date("h:i A",strtotime($row['time_from']));?>
                    </td>

                    <td style=" width: 150px; border: none; font-size: 17px;">
                    <?php echo date("h:i A",strtotime($row['time_to']));?>
                    </td>

                  </tr>
                  <?php endwhile; ?>
                </table>
                
                <div class="col-md-12 text-center">
                
        </div>
                

</form>


<?php require_once 'delete.php'; ?>

<form class="border shadow rounded-20 p-3" style="background-color: #fff; margin-top: -650px; padding-top: 30px; width: 45%; margin-left: 630px; height:650px" action="" method="POST" >

<label for="" class="doctor mb-3 ms-3" style="font-size: 22px; margin-top: 5px">Set Appointment</label> <br>


    <label class="ms-5" style="margin-bottom: -20px;">Clinic Name</label>

    <input class="form-control ms-5 mb-3" style="width: 500px;" type="text" name="cname" value="<?php echo $cname?>">


    <label class="ms-5" style="margin-bottom: -20px;">Doctor Name</label>
    <input type="hidden" name="name_pref" value="<?php echo $name_pref?>">

    <input  required  class="form-control ms-5 mb-3" type="text" name="doctor" style="width: 500px;" value="<?php echo $name?>">

      

    <label class="ms-5" style="margin-bottom: -20px;">Schedule Date</label>

    <input  required class="form-control ms-5 mb-3 datepicker" type="date" name="date" style="width: 500px;" min="CURRENT_DATE()" max="2030-12-31">

    <label class="ms-5" style="margin-bottom: -20px;">Schedule Time</label>

    <input  required class="form-control ms-5 mb-3" type="time" name="time" style="width: 500px;">

    <label class="ms-5" style="margin-bottom: -20px;">Patient ID</label>

    <input  required class="form-control ms-5 mb-3" type="text" name="patient_id" style="width: 500px;" value="<?=$_SESSION['id']?>">

    <label class="ms-5" style="margin-bottom: -20px;">Patient Name</label>

    <input  required  class="form-control ms-5 mb-3" type="text" name="patient_name" style="width: 500px;" value="<?=$_SESSION['name']?>">

        <p class="text-center"><small> Setting appointment on the current date is not allowed. </small></p>

        <div class="col-md-12 text-center">
        <button type="submit" name="set" class="btn btn-info mb-0 mt-1">Set Appointment</button>

        </div>
</form>




      <?php else: ?>  

      <form class="border shadow rounded-20 p-3" style="background-color: #fff; margin-top: -5px; padding-top: 30px; width: 90%; margin-right:auto; margin-left:auto; height:650px" action="" method="GET" >
      <label style="color: #11101d; font-size: 18px; font-weight: 400; margin-left: 170px; margin-top: 26px;">Filter:  </label>

      <select name="specialty" id="" class="form-select " style="width: 200px; margin-left: 250px; margin-top: -48px;" value="<?php if(isset($_GET['specialty'])){echo $_GET['specialty'];} ?>">
                  <option value="" disabled selected>Specialty</option>
                  <option value="General Physician" >General Physician</option>
                  <option value="Pediatrician">Pediatrician</option>
                  <option value="Dentist">Dentist</option>
                  <option value="Obstetrician/Gynecologist">Obstetrician/Gynecologist</option>
                  <option value="Optometrist">Optometrist</option>
                  <option value="Dermatologist">Dermatologist</option>
                  <option value="Psychiatrist">Psychiatrist</option>
                  <option value="Dialysis">Dialysis</option>
                  <option value="Internal Medicine">Internal Medicine</option>
                  <option value="Diagnostic Radiology">Diagnostic Radiology</option>
      </select>

      <select class="form-select" style="width: 200px; margin-left: 470px; margin-top: -38px;"
		          name="city" id="city"  value="<?php if(isset($_GET['city'])){echo $_GET['city'];} ?>"
		          >
              <option value="" disabled selected>Location</option>
              <option value="Agoncillo">Agoncillo</option>
              <option value="Alitagtag">Alitagtag</option>
              <option value="Balayan ">Balayan </option>
              <option value="Balete">Balete</option>
              <option value="Batangas City">Batangas City</option>
              <option value="Bauan ">Bauan </option>
              <option value="Calaca">Calaca </option>
              <option value="Calatagan">Calatagan</option>
              <option value="Cuenca ">Cuenca </option>
              <option value="Fernando Airbase ">Fernando Airbase </option>
              <option value="Ibaan">Ibaan</option>
              <option value="Laurel">Laurel</option>
              <option value="Lemery">Lemery</option>
              <option value="Lian">Lian</option>
              <option value="Lipa City">Lipa City</option>
              <option value="Lobo">Lobo</option>
              <option value="Mabini">Mabini </option>
              <option value="Malvar">Malvar </option>
              <option value="Mataas na Kahoy">Mataas na Kahoy</option>
              <option value="Nasugbu">Nasugbu </option>
              <option value="Padre Garcia">Padre Garcia</option>
              <option value="Rosario">Rosario</option>
              <option value="San Jose ">San Jose </option>
              <option value="San Juan">San Juan</option>
              <option value="San Luis">San Luis</option>
              <option value="San Nicolas ">San Nicolas </option>
              <option value="San Pascual">San Pascual</option>
              <option value="Sta. Teresita">Sta. Teresita</option>
              <option value="Sto. Tomas">Sto. Tomas</option>
              <option value="Taal">Taal</option>
              <option value="Talisay">Talisay</option>
              <option value="Tanauan">Tanauan</option>
              <option value="Taysan">Taysan</option>
              <option value="Tingloy">Tingloy</option>
              <option value="Uy">Uy</option>
		  </select>


      <input type="text" class="form-control text-sm ps-2" style="position: absolute; margin-left: 700px; margin-top: -38px; border: 2px solid #bfc5c9; height: 38px; width: 270px;"
                name="users" 
                placeholder="Search Clinic"
                value="<?php if(isset($_GET['users'])){echo $_GET['users'];} ?>">
  <button type="submit" class="btn btn-primary pt-1 pb-1" style="margin-left: 980px; margin-top: -62px;">Search</button>
     

<?php 
            if($users == false):
            
              $keywords = $_GET['users'];

                  
                  $query="SELECT * FROM users WHERE  cname = '$keywords'" ;
                  $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0) 
                    {
                        
                      ?>
<div style="width:1300px;overflow:auto; max-height:600px; margin: auto; z-index: 1;">
        <table class="table table-hover table-sm" style="width:1100px; border:none; margin-top:5px" cellspacing="0">
        <thead >
        <tr>

          <th width="70" >ID</th>

          <th width="160">Image</th>

          <th width="520">Doctor</th>

          <th>Action</th>

          </tr>
        </thead>
       <?php while($row=$query_run->fetch_assoc()):
                           ?>
                           
            <tbody >
          <tr >

          <td width="70">

          <?php echo $row['id'];?>
          </td>


              <td class="pt-2 pb-1" width="160" >

              <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="120px" height="130px" >';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="120px" height="130px"/>

    <?php     }
        
         ?>

              </td>

              <td class="text-left" width="520">
                    
                    <p class="mb-0 mt-2">Clinic Name: <?php echo $row['cname']?></p>
										 <p class="mb-0"><small>Email: <?php echo $row['email'] ?></small></p>
                     <p class="mb-0"><small>Clinic Location: <?php echo $row['address'] ?> <?php echo $row['city'] ?></small></p>
                     <p class="mb-0"><small>Contact Number: <?php echo $row['phone'] ?></small></p>


                     

                <?php $sql="SELECT * FROM doctors_list WHERE cname = '".$row['cname']."' ORDER BY id ASC" ;
                      $res = mysqli_query($conn, $sql);
                      while($row=$res->fetch_assoc()){
                ?>
                     <p class="mb-0"><small>Specialty: <?php echo $row['specialty_ids'] ?></small></p>
                     
                     
                     <p class="mb-0 mt-2"><small>Doctor/s: <?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></small></p>          
                     
                     <?php } ?>
                     
              </td>
              
             
              
              <td class="text-center pt-2">
              <?php 

$keywords = $_GET['users'];

                  
$query="SELECT * FROM users WHERE  CONCAT(cname,username) LIKE '%{$keywords}%'" ;
$query_run = mysqli_query($conn, $query);

$row=mysqli_fetch_assoc($query_run);

$cname = $row['cname'];


$list1 = "SELECT * FROM doctors_list WHERE cname = '".$cname."'";
$res1 = mysqli_query($conn, $list1);
$row1=mysqli_fetch_assoc($res1);
$id = $row1['id'];

?>
 
              <a href="set_appointment.php?viewsched=<?=$row1['id']?>" class="btn btn-info mt-5" >Appointment</a>
             
										
          </td>
          


          </tr>
          </tbody>
          <?php endwhile; ?>
          
          
        </table>

        
            <?php } else {?>

              <table>
                <tr>
                  <td colspan="2" style="color: brown; font-size: 18px; font-weight: 600; border: none;">
                  
                  No Clinic found
                
                </td>
                </tr>
              </table>

                <?php  }?>



                <?php else: ?>           
                
                <?php 
            if($city == false):
            
              $city = $_GET['city'];

            
                  $query="SELECT * FROM users WHERE city='$city'" ;
                  $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0) 
                    {
                        
                      ?>

<div style="width:1300px;overflow:auto; max-height:600px; margin: auto; z-index: 1;">
        <table class="table table-hover table-sm" style="width:1100px; border:none; margin-top:5px" cellspacing="0">
        <thead>
        <tr>

          <th width="70" >ID</th>

          <th width="160">Image</th>

          <th width="520">Doctor</th>

          <th>Action</th>

          </tr>
        </thead>
       <?php while($row=$query_run->fetch_assoc())
                          { ?>
                           
            <tbody >
          <tr >

          <td width="70">

          <?php echo $row['id'];?>
          </td>


              <td class="pt-2 pb-1" width="160" >

              <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="120px" height="130px" >';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="120px" height="130px"/>

    <?php     }
        
         ?>

              </td>

              <td class="text-left" width="520">
                    
                    <p class="mb-0 mt-2">Clinic Name: <?php echo $row['cname']?></p>
										 <p class="mb-0"><small>Email: <?php echo $row['email'] ?></small></p>
                     <p class="mb-0"><small>Clinic Location: <?php echo $row['address'] ?> <?php echo $row['city'] ?></small></p>
                     <p class="mb-0"><small>Contact Number: <?php echo $row['phone'] ?></small></p>


                     

                <?php $sql="SELECT * FROM doctors_list WHERE cname = '".$row['cname']."' ORDER BY id ASC" ;
                      $res = mysqli_query($conn, $sql);
                      while($row=$res->fetch_assoc()){
                ?>
                     <p class="mb-0"><small>Specialty: <?php echo $row['specialty_ids'] ?></small></p>
                     
                     
                     <p class="mb-0 mt-2"><small>Doctor/s: <?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></small></p>          
                     
                     <?php } ?>
                     
              </td>
              
             
              
              <td class="text-center pt-2">
              
              <?php 

              

                    $city = $_GET['city'];
                    $list = "SELECT * FROM users WHERE city='".$city."'";
                    $res = mysqli_query($conn, $list);
                    $row=mysqli_fetch_assoc($res);
                    
                    $cname = $row['cname'];
                    

                    $list1 = "SELECT * FROM doctors_list WHERE cname = '".$cname."'";
                    $res1 = mysqli_query($conn, $list1);
                    $row1=mysqli_fetch_assoc($res1);
                    $id = $row1['id'];

              ?>
              <a href="set_appointment.php?viewsched=<?=$row1['id']?>" class="btn btn-info mt-5" >Appointment</a>
             
            
          </td>
          


          </tr>
          </tbody>
          <?php } ?>
          
          
        </table>

            <?php } else {?>

              <table>
                <tr>
                  <td colspan="2" style="color: brown; font-size: 18px; font-weight: 600; border: none;">
                  
                  No Clinic found
                
                </td>
                </tr>
              </table>

                <?php  }?>


                <?php else: ?>           
                
                <?php 
            if($specialty == false):
            
              $specialty = $_GET['specialty'];

            
                  $query="SELECT * FROM doctors_list WHERE specialty_ids='$specialty'" ;
                  $query_run = mysqli_query($conn, $query);

                if(mysqli_num_rows($query_run) > 0) 
                    {
                         while($row=$query_run->fetch_assoc())
                          {
                           
                      ?>

<div style="width:1150px;overflow:auto; max-height:450px; margin: auto; z-index: 1;">
        <table class="table table-hover table-sm" style="width:1100px; border:none; margin-top:5px" cellspacing="0">
        <thead  >
        <tr>

          <th width="70" >ID</th>

          <th width="160">Image</th>

          <th width="520">Doctor</th>

          <th>Action</th>

          </tr>
        </thead>
         
            <tbody >
          <tr >

          <td width="70">

          <?php echo $row['id'];?>
          </td>


              <td class="pt-2 pb-1" width="160" >

             
         <?php     if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="120px" height="130px" >';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="120px" height="130px"/>

    <?php     }
        
         ?>
         </td>

              <td class="text-left" width="520">
              
                     
                     
                     <p class="mb-0 mt-2">Doctor: <?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></p>           
                    <p class="mb-0"><small>Clinic Name: <?php echo $row['cname']?></small></p>
										 <p class="mb-0"><small>Email: <?php echo $row['email'] ?></small></p>  
                     <p class="mb-0"><small>Contact Number: <?php echo $row['contact'] ?></small></p>

              <?php $sql="SELECT * FROM users WHERE cname = '".$row['cname']."' ORDER BY id ASC" ;
                      $res = mysqli_query($conn, $sql);
                      while($rows=$res->fetch_assoc()){
              ?>
                     
                     <p class="mb-0"><small>Clinic Location: <?php echo $rows['address'] ?> <?php echo $row['city'] ?></small></p>
                     
              <?php } ?>
                     
                     <p class="mb-0"><small>Specialty: <?php echo $row['specialty_ids'] ?></small></p>
              </td>
              
              
              
              <td class="text-center pt-2">

              <a href="set_appointment.php?viewsched=<?=$row['id']?>" class="btn btn-info mt-5" >Appointment</a>
              
										
          </td>
          <?php } ?>


          </tr>
          </tbody>
          
          
          
        </table>

        
            <?php } else {?>

              <table>
                <tr>
                  <td colspan="2" style="color: brown; font-size: 18px; font-weight: 600; border: none;">
                  
                  No Clinic found
                
                </td>
                </tr>
              </table>

                <?php  }?>


<?php else: ?>

                <?php 
								$list = $conn->query("SELECT * FROM doctors_list order by id asc");
                
                ?>

<div style="width:1150px;overflow:auto; max-height:500px; margin: auto; z-index: 1;">
        <table class="table table-hover table-sm" style="width:1100px; border:none; margin-top:10px" cellspacing="0">
        <thead>
        <tr>

          <th width="70" >ID</th>

          <th width="160">Image</th>

          <th width="520">Doctor</th>

          <th>Action</th>

          </tr>
        </thead>
          <?php  while($row=$list->fetch_assoc()){
               
            ?>
            <tbody >
          <tr >

          <td width="70">

          <?php echo $row['id'];?>
          </td>


              <td class="pt-2 pb-1" width="160" >
        
              <?php     if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="120px" height="130px" >';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="120px" height="130px"/>

    <?php     }
        
         ?>
              </td>

              <td class="text-left" width="520">
                    
                     
                     <p class="mb-0 mt-2">Doctor: <?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></p>           
                    <p class="mb-0"><small>Clinic Name: <?php echo $row['cname']?></small></p>
										 <p class="mb-0"><small>Email: <?php echo $row['email'] ?></small></p>  
                     <p class="mb-0"><small>Contact Number: <?php echo $row['contact'] ?></small></p>

              <?php $sql="SELECT * FROM users WHERE cname = '".$row['cname']."' ORDER BY id ASC" ;
                      $res = mysqli_query($conn, $sql);
                      while($rows=$res->fetch_assoc()){
              ?>
                     
                     <p class="mb-0"><small>Clinic Location: <?php echo $rows['address'] ?> <?php echo $row['city'] ?></small></p>
                     
              <?php } ?>
                     
                     <p class="mb-0"><small>Specialty: <?php echo $row['specialty_ids'] ?></small></p>
              </td>
              
              
              
              <td class="text-center pt-2">

               
            

              <a href="set_appointment.php?viewsched=<?=$row['id']?>" class="btn btn-info mt-5" >Appointment</a>
              					
          </td>
      


          </tr>
          </tbody>
          
          <?php }?>
          
        </table>

  </div>
   
</form>



<?php endif; ?>
<?php endif; ?>
<?php endif; ?>
<?php endif; ?>

         
                
               
</section>
 


  <script src="script.js"></script>
		    
			  
			
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>