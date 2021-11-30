<?php 
   session_start();
   
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
<title>HealCo</title>
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
								$list = $conn->query("SELECT * FROM patient WHERE username= '".$_SESSION['username']."'");
                
                ?>

     <li class="profile">
         <div class="profile-details">
         <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="20px" height="20px">';
         } else{
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="30px" height="40px" />';

         }
        
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
  <section class="home-section1">
      
  <?php require 'delete.php'; ?>


      <form class="border shadow rounded-20 p-3" style="background-color: #fff; margin-top: -5px; padding-top: 30px; width: 90%; margin-right:auto; margin-left:auto; max-height:700px" action="" method="GET" >
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


      <input type="text" class="form-control text-sm ps-2" style="position: absolute; margin-left: 700px; margin-top: -38px; border: 2px solid #bfc5c9; height: 38px; width: 250px;"
                name="users" 
                placeholder="Search Clinic Name"
                value="<?php if(isset($_GET['doctor'])){echo $_GET['doctor'];} ?>">
  <button type="submit" class="btn btn-primary pt-1 pb-1" style="margin-left: 960px; margin-top: -62px;">Search</button>
     
  
<?php 

if(isset($_GET['users']) && isset($_GET['city']) && isset($_GET['specialty'])) {
  $keywords = $_GET['users'];
  $sql="SELECT * FROM doctors_list WHERE  CONCAT(specialty_ids) LIKE '%{$keywords}%'" ;
  $sql="SELECT * FROM clinic WHERE  CONCAT(cname,city) LIKE '%{$keywords}%'" ;
  $result = mysqli_query($conn, $sql);
 
}
?>

<?php 
            if($users == false):
            
                  $users = $_GET['users'];


                  $query = "SELECT * FROM clinic WHERE cname='$users'";
                  $query_run = mysqli_query($conn, $query);


                          while ($rows=pg_fetch_array($query_run))
                          {
                      ?>

<th><?=$rows['id']?></th>
                <td><?=$rows['cname']?></td>
                <td><?=$rows['username']?></td>
                <td><?=$rows['phone']?></td>
                <td><?=$rows['email']?></td>
                <td><?=$rows['address']?></td>

            
            <?php } ?>
              
              

<?php else: ?>

                <?php 
								$list = $conn->query("SELECT * FROM users order by id asc");
                
                ?>

<table class="table table-hover table-sm" style="width:1100px; border:none; margin-left: 63px; z-index: -10;" cellspacing="0">
<thead>
        <tr>

          <th width="70" >ID</th>

          <th width="160">Image</th>

          <th width="520">Details</th>

          <th>Action</th>

          </tr>
        </thead>
</table>

<div style="width:1150px;overflow:auto; max-height:450px; margin: auto; z-index: 1;">
        <table class="table table-hover table-sm" style="width:1100px; border:none; margin-top:-5px" cellspacing="0">
        
          <?php  while($row=$list->fetch_assoc()):
               
            ?>
            <tbody >
          <tr >

          <td width="70">

          <?php echo $row['id'];?>
          </td>


              <td class="pt-2 pb-1" width="160" >


             <?php   if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="100px" height="120px">';
         } else{
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="100px" height="120px" />';

         } ?>
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
                     
                     
              
              </td>
              
             
              
              <td class="text-center pt-2">

              <a href="set_appointment.php?view=<?=$row['id']?>" class="btn btn-secondary btn-sm mt-5" >View Schedule</a>
              <a href="set_appointment.php?set=<?=$row['id']?>" class="btn btn-info btn-sm mt-5" >Set Appointment</a>
              
										
          </td>
          <?php } ?>


          </tr>
          </tbody>
          
          <?php endwhile; ?>
          
        </table>

  </div>
   
</form>

<?php endif; ?>





</section>
 


  <script src="script.js"></script>
		    
			  
			
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>