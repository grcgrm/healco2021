<?php 
   session_start();
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
	<title>HealCo | Doctors</title>
	
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
           <div class="name_job">
             <div class="name"><?=$_SESSION['cname']?></div>
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
include "db_conn.php";
error_reporting(0);
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
    $name_pref = $_POST['name_pref'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $specialty_ids = $_POST['specialty_ids'];
    $clinic = $_SESSION['cname'];
    $address = $_SESSION['address'];
    $city = $_SESSION['city'];

    $file = addslashes(file_get_contents($_FILES['image']['tmp_name'])) ;

    
    $sql = "SELECT * FROM doctors_list WHERE email='$email'";
		$result = mysqli_query($conn, $sql);

        
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO doctors_list (name, name_pref, email, specialty_ids, contact, cname, image, address, city)
					VALUES ('$name', '$name_pref', '$email', '$specialty_ids', '$contact', '$clinic', '$file', '$address', '$city')";
                  
      $result = mysqli_query($conn, $sql);
      if ($result) {

        move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" . $_FILES["image"]["name"]);
        
        echo "<script language = javascript>
        Swal.fire(
            'Success!',
            'Doctor Added',
            'success'
          )
    </script>";

    $name = "";
    $name_pref = "";
    $email = "";
    $contact = "";
    $specialty_ids = "";
		       
  }
} else {
  echo "<script language = javascript>
            Swal.fire(
                'Oops!',
                'Email Already Exist. Please try again.',
                'error'
              )
        </script>";
}
    
}?>
<?php
include 'db_conn.php';
error_reporting(0);

if(isset($_POST['update']))
{
    
    $id = $_GET['edit'];
    $name = $_POST['name'];
    $name_pref = $_POST['name_pref'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $specialty_ids = $_POST['specialty_ids'];
    $address = $_SESSION['address'];
    $city = $_SESSION['city'];
    $file = addslashes(file_get_contents($_FILES['image']['tmp_name'])) ;

    
		
			mysqli_query($conn,"UPDATE doctors_list SET name = '$name', name_pref = '$name_pref', email = '$email', contact = '$contact', specialty_ids = '$specialty_ids', image = '$file', address = '$address', city = '$city' WHERE id = '$id' ");
                  
			
move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" . $_FILES["image"]["name"]);
        
				
				        
                echo "<script language = javascript>
          Swal.fire(
              'Good job!',
              'Profile Updated Succesfully',
              'success'
            ).then((result) => {
                    
              window.location.href = 'doctors.php';
            });
          </script>";

          $name = "";
          $name_pref = "";
          $email = "";
          $contact = "";
          $specialty_ids = "";
          $file = "";
          
        }

?>


<!-- START OF SCHEDULE SETTING -->


<?php require_once 'delete.php'; ?>
<?php 
              if($sched == false):?>
 
<form class="doctor border shadow p-2 rounded-20 ms-2" style="background-color: white;position:absolute; width: 400px; margin-top:-15px; margin-bottom:-15px;" method="POST" action="" enctype="multipart/form-data" id="manage-doctor">
<input type="hidden" name="doctor_id" value="<?php echo $_GET['sched'] ?>">

		
<label for="" class="doctor mb-3 ms-3" style="font-size: 22px; margin-top: 5px">Set Schedule</label> <br>
<?php 
include 'db_connect.php';

$sched = $_GET['sched'];
$sql = "SELECT * FROM doctors_schedule where doctor_id ='".$sched."'";
$result = mysqli_query($conn, $sql); 

?>       
        
			

          <table style="margin-bottom: -1px; margin-top: -1px; ">
            <tbody>
            <?php 
					$days = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
					for($i = 0 ; $i < 7;$i++):
					?>

              <tr>
                <td class="ps-4 pb-0 pt-0 text-start" style="border: none; margin-bottom: -1px">
                  <input class="form-check-input" style="margin-bottom: 10px; margin-left: 0px" type="checkbox" name="check[<?php echo $i ?>]" value="<?php echo isset($id[$days[$i]]) ? $id[$days[$i]] : '' ?>" <?php echo isset($id[$days[$i]]) ? "checked" :( $c > 0 ? '' : 'checked') ?>>
                  <label style="margin-left: 30px; margin-bottom: 2px"><?php echo $days[$i] ?></label>
                  <input type="hidden" name="days[<?php echo $i ?>]" value="<?php echo $days[$i] ?>">
                </td>
                
						    </tr>
           
              <tr>
                <td  style="border: none;">
                <input style="width: 150px; margin-left: 10px; margin-top: -7px; margin-bottom: 5px;" name="time_from[<?php echo $i ?>]" type="time" value="<?php echo isset($from[$days[$i]]) ? $from[$days[$i]] : '' ?>" class="form-control">
					
                </td>
                <td style="border: none;">
                <input style="width: 150px; margin-left: 10px; margin-top: -7px; margin-bottom: 5px;" name="time_to[<?php echo $i ?>]" type="time" value="<?php echo isset($to[$days[$i]]) ? $to[$days[$i]] : '' ?>" class="form-control" id="">
					
                </td>
              </tr>
              <?php endfor; ?>
            
            </tbody>
          </table>
            	
					
				
								
          <button type="submit" name="save" id="save" class="btn btn-sm btn-primary col-sm-3 offset-md-3 mt-3">Save</button>
					<button class="btn btn-sm btn-default col-sm-3 mt-3" type="button" onclick="_reset()">Cancel</button>
					
				
</form>

<!-- END OF SCHEDULE SETTING -->


<!--Start of VIEW SCHEDULE -->
<?php else: ?>
                  
<?php require 'delete.php'; ?>
<?php 
              if($view == false):?>

<form class="doctor border shadow p-2 rounded-20 ms-2" style="background-color: white;position:absolute; width: 400px; margin-top:30px; margin-bottom:-15px;" method="POST" action="delete.php" enctype="multipart/form-data" id="manage-doctor">
<input type="hidden" name="id" value="<?php echo $id;?>">

		
<label for="" class="doctor mb-3 ms-3" style="font-size: 22px; margin-top: 5px">View Schedule</label> <br>
        
<?php 

$view = $_GET['view'];
								$list = $conn->query("SELECT * FROM doctors_schedule WHERE doctor_id='".$view."' order by id asc");
                $res = mysqli_query($conn, $list);
               
                ?>  
                
                <table class="table">

                  <tr>
                    <tr style="background-color: #b0e0e6;">
                      <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;"> Day </td>
                      <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;"> Start </td>
                      <td style="width: 35%; border: none; font-size: 17px; font-weight: 500;"> End </td>
                    </tr>
                   <?php while($row=$list->fetch_assoc()): ?>
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
                <a href="doctors.php?sched=<?=$_GET['view']?>" class="btn btn-info mt-2 mb-3" >Set Schedule</a>
                    
        </div>
                
                
 
 		

				
</form>



<!-- END OF VIEW SCHEDULE -->

<!-- START OF FORM -->


								 <?php else: ?>
                  

<?php require_once 'delete.php'; ?>

<form class="doctor border shadow p-4 rounded-20 ms-2" style="height: 730px; background-color: white;position:absolute; width: 400px; margin-top:-45px; margin-bottom:-15px;" method="POST" action="" enctype="multipart/form-data" id="manage-doctor">
<input type="hidden" name="id" value="<?php echo $id;?>">
<input type="hidden" name="address" value="<?=$_SESSION['address']?>">
<input type="hidden" name="city" value="<?=$_SESSION['city']?>">

		
				<label for="" class="doctor mb-1" style="font-size: 22px; margin-top: -5px">Doctor's Form</label>
					
							
							<div class="doctor">
								<label for="" class="control-label mb-0">Prefix</label>
								<input type="text" class="form-control" name="name_pref" placeholder="(M.D.)" value="<?php echo $name_pref?>" required style="width: 100%; margin-bottom: 6px;">
							</div>
							<div class="doctor">
								<label class="control-label mb-0">Name</label>
								<input type="text" class="form-control" name="name" id="name" value="<?php echo $name?>" required style="width: 100%; margin-bottom: 6px;">
							</div>
							<div class="doctor" >
								<label class="control-label mb-0">Medical Specialties</label> <br>
								<select class="text-muted" name="specialty_ids" id="specialty_ids" style="width: 100%; height:35px; margin-bottom: 10px; border: 1px solid #d5d5d5" value="<?php echo $specialty_ids?>" required>
                
                  <option value="General Physician" <?php echo $specialty_ids == 'General Physician' ? 'selected' : ''?>>General Physician</option>
                  <option value="Pediatrician" <?php echo $specialty_ids == 'Pediatrician' ? 'selected' : ''?>>Pediatrician</option>
                  <option value="Dentist" <?php echo $specialty_ids == 'Dentist' ? 'selected' : ''?>>Dentist</option>
                  <option value="Obstetrician/Gynecologist" <?php echo $specialty_ids == 'Obstetrician/Gynecologist' ? 'selected' : ''?>>Obstetrician/Gynecologist</option>
                  <option value="Optometrist" <?php echo $specialty_ids == 'Optometrist' ? 'selected' : ''?>>Optometrist</option>
                  <option value="Dermatologist" <?php echo $specialty_ids == 'Dermatologist' ? 'selected' : ''?>>Dermatologist</option>
                  <option value="Psychiatrist" <?php echo $specialty_ids == 'Psychiatrist' ? 'selected' : ''?>>Psychiatrist</option>
                  <option value="Dialysis" <?php echo $specialty_ids == 'Dialysis' ? 'selected' : ''?>>Dialysis</option>
                  <option value="Diagnostic Radiology" <?php echo $specialty_ids == 'Diagnostic Radiology' ? 'Diagnostic Radiology' : ''?>>Diagnostic Radiology</option>
									<option value="Internal Medicine" <?php echo $specialty_ids == 'Internal Medicine' ? 'selected' : ''?>>Internal Medicine</option>
								</select>
							</div>
							
							<div class="doctor">
								<label for="" class="control-label mb-0">Contact Number</label>
								<input type="phone" class="form-control" name="contact" id="contact" required value="<?php echo $contact?>" style="width: 100%; margin-bottom: 6px;">
							</div>
							<div class="doctor">
								<label for="" class="control-label mb-0">Email</label>
								<input type="email" 
                    class="form-control" 
                    name="email" required
                    id="email"
                    value="<?php echo $email?>"
                    style="width: 100%; margin-bottom: 8px;"
                    >
							</div>
              <div class="doctor">
                <label for="" class="control-label mb-0">Clinic Name</label>
                <input type="email" class="form-control" name="email" disabled value="<?=$_SESSION['cname']?>" style="width: 100%; margin-bottom: 6px;"> 
              </div>
							<div class="doctor">
								<label for="" class="control-label">Image</label>
								<input required type="file" class="form-control" name="image" id="image" onchange="displayImg(this,$(this))">
							</div>
							<div class="doctor text-center">
								<img src="" alt="" id="cimg">
							</div>	
								

              <?php 
              if($update == false):?>
              
                <button type="submit" name="update" class="btn btn-sm btn-info col-sm-3 offset-md-3 mb-0">Update</button>
              
                <?php else: ?>
                  
                  <button type="submit" name="submit" class="btn btn-sm btn-primary col-sm-3 offset-md-3 mb-0">Save</button>
                  
                <?php endif; ?>
                
								<button class="btn btn-sm btn-default col-sm-3 mb-0" type="button" onclick="_reset()">Cancel</button>
                <?php endif; ?>
                <?php endif; ?>
                
					
        
</form>

<!-- END OF FORM -->

<style>
img{
  margin-top: 10px;
  margin-bottom: 10px;
		max-width:100px;
		max-height:120px;
	}
</style>
<script>
function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function _reset(){
		$('[name="id"]').val('');
		$('#manage-doctor').get(0).reset();
	}
  </script>


<!-- START OF LIST -->

<form class="border shadow p-4" action="" method="POST" style="background-color: white;  margin-left: 420px; margin-top: -15px; width: 980px; max-height: 100%; " enctype="multipart/form-data">
    
        <label for="" class="mb-1" style="font-size: 22px; margin-top: -5px">List of Doctors</label>

        <?php 
								$list = $conn->query("SELECT * FROM doctors_list WHERE cname='".$_SESSION['cname']."' order by id asc");
                $res = mysqli_query($conn, $list);
                ?>


        <table class="table table-hover table-bordered table-sm" cellspacing="0" id="list">
        <thead>
        <tr>

          <th width="100" >ID</th>

          <th width="150" >Image</th>

          <th >Details</th>

          <th width="190" >Action</th>

          </tr>
        </thead>
          <?php  while($row=$list->fetch_assoc()):
 
            ?>
            <tbody >
          <tr >

          <td>

          <?php echo $row['id'];?>
          </td>


              <td>
              <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'"/>';?>

              </td>

              <td class="text-left">
              <p class="mb-0">Name: <?php echo "Dr. ".$row['name'].', '.$row['name_pref'] ?></p>
										 <p class="mb-0"><small>Email: <?php echo $row['email'] ?></small></p>
										 <p class="mb-0"><small>Clinic Name: <?php echo $row['cname'] ?></small></p>
										 <p class="mb-0"><small>Contact Number: <?php echo $row['contact'] ?></small></p>
                     <p class="mb-0"><small>Specialty: <?php echo $row['specialty_ids'] ?></small></p>
                     
                      <a href="doctors.php?view=<?=$row['id']?>" class="btn btn-info btn-sm mt-2" >Schedule</a>

            
            </td>

            

              <td class="text-center pt-2">
              
              <a href="doctors.php?edit=<?=$row['id']?>" class="btn btn-primary" >EDIT</a>
              <a href="doctors.php?id=<?=$row['id']?>" class="btn btn-danger" name="id" class="id" id="btn-delete">Delete</a>
										
          </td>



          </tr>
          </tbody>
          <?php endwhile; ?>
          
        </table>
        
</form>

<!-- END of list -->

<script src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#list').DataTable( {
        scrollY:        '74vh',
        searching: false,
        paging:         false,
    } );
} );
</script>



</section>



<script src="script.js"></script>
			
</body>
</html>

<?php }else{
	header("Location: index.php");
} ?>