<?php 
   session_start();
   
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HealCo | Appointment</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
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
       <a href="profile1.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Profile</span>
       </a>
       <span class="tooltip">Profile</span>
     </li>
     <li>
       <a href="appointment.php">
         <i class='bx bx-calendar-plus' ></i>
         <span class="links_name">Appointment</span>
       </a>
       <span class="tooltip">Appointment</span>
     </li>
     
     <li>
       <a href="records.php">
         <i class='bx bx-folder' ></i>
         <span class="links_name"> Patients Records</span>
       </a>
       <span class="tooltip">Patients</span>
     </li>

     <li>
       <a href="doctors.php">
         <i class='bx bx-plus-medical' ></i>
         <span class="links_name">Doctors</span>
       </a>
       <span class="tooltip">Doctors</span>
     </li>

     <li>
       <a href="laboratory.php">
         <i class='bx bx-vial' ></i>
         <span class="links_name">Laboratory</span>
       </a>
       <span class="tooltip">Laboratory</span>
     </li>
     
     <?php
                        $sql = "SELECT * FROM users WHERE username= '".$_SESSION['username']."'";
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
           echo '<img src="uploads/default.png" alt="" width="20px" height="20px">';
         } else{
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="30px" height="40px" />';

         }
        
         ?>
         <?php  }?>
         <?php  }?>
         <?php  }?>
           <div class="name_job">
             <div class="name"><?=$_SESSION['cname']?></div>
             <div class="job"><?=$_SESSION['role']?></div>
           </div>
         </div>
         <div class="logout"><a href="logout.php" class='bx bx-log-out' type='solid' id="log_out" ></a></div>
         
     </li>
    </ul>
  </div>


  

  <section class="home-section1">
  <div class="text">Appointment</div>


      
<?php require_once 'del.php'; ?>
<?php 
                    
if($appoint == false):?>        
<form class="border shadow rounded-20 p-4" style="background-color: #fff; margin-top: 5px; width: 45%; margin-left:100px;" action="" method="POST">
<label for="" class="mb-1" style="font-size: 22px; margin-top: -5px">Schedule Details</label>
            <table class="table">
            
    <?php 
        $appoint = $_GET['appoint'];
				$list = "SELECT * FROM appointment_list WHERE id='".$appoint."'";
        $res = mysqli_query($conn, $list);
        $row=mysqli_fetch_assoc($res); ?>

                  <tr>
                      <td width="200" class="bg-info text-white" style="border-color: white; font-weight: 500">
                      <label class="form-label">Doctor</label>
                    </td>
                    <td style="border-color: white; background-color: #f0f8ff;"><?php echo "Dr. ".$row['doctor_name'].', '.$row['name_pref'] ?> </td>
                  
                  </tr>

                  <tr>
                    <td class="bg-info text-white" style="border-color: white; font-weight: 500">
                    
                    <label class="form-label" >Patient Name</label>
                    </td>
                    <td style="border-color: white; background-color: #f0f8ff;"><?php echo $row['patient_name'] ?></td>
                  </tr>

                  <tr>
                    
                    <td class="bg-info text-white" style="border-color: white; font-weight: 500">
                    <label class="form-label">Patient ID</label>
                    </td>
                    <td style="border-color: white; background-color: #f0f8ff;">#<?php echo $row['patient_id'] ?></td>
                    </tr>

                  <tr>
                    <td class="bg-info text-white" style="border-color: white; font-weight: 500">
                    <label class="form-label">Date Created</label>
                    </td>
                    <td style="border-color: white; background-color: #f0f8ff;"><?php echo date("l M d, Y h:i A",strtotime($row['date_created'])) ?></td>
                 
                    
                  </tr>

                  <tr>
                  <td width="200" class="bg-info text-white" style="border-color: white; font-weight: 500">
                        <label class="form-label">Schedule Date</label>
                      </td>
                      <td style="border-color: white; background-color: #f0f8ff;"><input type="date"  name="date" class="form-control" value="<?php echo $row['schedule'] ? date("Y-m-d",strtotime($row['schedule'])) : '' ?>" required></td>

                  </td>
                  </tr>

                  <tr>
                  <td width="200" class="bg-info text-white" style="border-color: white; font-weight: 500">
                        <label class="form-label">Schedule Time</label>
                      </td>
                      <td style="border-color: white; background-color: #f0f8ff;"><input type="time"  name="time" class="form-control" value="<?php echo $row['schedule'] ? date("H:i",strtotime ($row['schedule'])) : '' ?>" required></td>

                  </td>
                  </tr>

                  <tr>
                    <td class="bg-info text-white" style="border-color: white; font-weight: 500">
                    <label class="form-label">Status</label>
                    </td>

                    <td style="border-color: white; background-color: #f0f8ff;">
                      <select class="form-select mt-0 mb-0"
		                  name="status" id="status"  value="<?php echo $row['status']?>">

                      <option value="0" <?php echo isset($row['status']) && $row['status'] == 0 ? "selected" : '' ; ?>>Request</option>
                      <option value="1" <?php echo isset($row['status']) && $row['status'] == 1 ? "selected" : '' ; ?>>Confirmed</option>
                      <option value="2" <?php echo isset($row['status']) && $row['status'] == 2 ? "selected" : '' ; ?>>Rescheduled</option>
                      <option value="3" <?php echo isset($row['status']) && $row['status'] == 3 ? "selected" : '' ; ?>>Completed</option>
                   
                    </select>
                    </td>
                     </tr>
            </table>
            <div class="text-center">
            <button type="submit" name="appoints" id="appoints" class="btn btn-primary mt-1">Save Schedule</button>
            </div>
          
</form>

<?php 
        $patient_id = $row['patient_id'];
							$sql = "SELECT * FROM patient WHERE id= $patient_id";
                $result = mysqli_query($conn, $sql); 
                        
                if($result)
                {
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) { ?>

<form class="border shadow rounded-20 text-center" style="height: 580px; background-color: white; width: 400px; margin-top:-580px; margin-bottom: -15px; margin-left: 895px;" method="POST" action="" enctype="multipart/form-data" id="manage-doctor">

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
      
<?php else: ?>
  <form class="border shadow rounded-20 p-3" style="background-color: #fff; margin-top: 10px; padding-top: 30px; width: 90%; margin-right:auto; margin-left:auto;" action="delete.php" method="POST">
          
          <table class="table table-bordered">
              <thead>
                <tr>
                <th>Schedule</th>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
                        <?php 
              
              $qry = $conn->query("SELECT * FROM appointment_list WHERE clinic = '".$_SESSION['cname']."' order by id desc ");
              while($row = $qry->fetch_assoc()):
              ?>
                        <tr>
                <td><?php echo date("l M d, Y h:i A",strtotime($row['schedule'])) ?></td>
                <td><?php echo "Dr. ".$row['doctor_name'].', '.$row['name_pref'] ?></td>
                <td><?php echo $row['patient_name'] ?></td>
                <td>
                <?php if($row['status'] == 0): ?>
								<span class="badge badge-warning">Pending Request</span>
							<?php endif ?>
							<?php if($row['status'] == 1): ?>
								<span class="badge badge-primary">Confirmed</span>
							<?php endif ?>
							<?php if($row['status'] == 2): ?>
								<span class="badge badge-info">Rescheduled</span>
							<?php endif ?>
							<?php if($row['status'] == 3): ?>
								<span class="badge badge-info">Done</span>
							<?php endif ?>
                </td>
                <td class="text-center">
                  <a href="appointment.php?appoint=<?=$row['id']?>" class=" btn btn-sm text-white btn-info" >Update</a>
                  <a href="appointment.php?del=<?=$row['id']?>" class="btn btn-sm text-white btn-danger" >Delete</a>
                </td>
              </tr>
                        <?php endwhile; ?>
        </table>
        </form>
    <?php endif; ?>


  </section>

  


  <script src="script.js"></script>
        
  		    
			  
			
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>