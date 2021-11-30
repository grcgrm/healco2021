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

if(isset($_POST['savec']))
{

  $clinic_id = $_GET['cbc'];
  $patient_id = $_POST['patient_id'];
  $patient = $_POST['patient'];
  $parameter = $_POST['parameter'];
  $value = $_POST['value'];
  $range = $_POST['range'];
  $clinic = $_SESSION['cname'];
    
      $sql1 = "INSERT INTO `cbc` (`clinic_id`, `clinic`, `patient_id`, `patient`, `parameter`, `value`, `range`)
            VALUES ('$clinic_id', '$clinic', '$patient_id', '$patient', '$parameter', '$value', '$range')";
                  
      $result1 = mysqli_query($conn, $sql1);
      if ($result1) {
       
        echo "<script language = javascript>
        Swal.fire(
            'Success!',
            'Patient CBC is Added',
            'success'
          )
        </script>";     
  }

    
}


?>


  <?php require_once 'delete.php'; ?>

 <?php if($cbc == false):
  
  ?>    
  <form class="bg-white border shadow p-4 text-left" id="form" action="" method="POST" style="border-radius: 20px; width: 410px; height: 658px; font-family: Poppins; margin-left: 40px; margin-top: -20px">


  <img src="img/red-blood-cells.png" class="ms-5 mt-1" style="width: 60px; height: 60px; margin-bottom: -40px; margin-top: -10px">
  <h5 class="card-title" style="margin-left: 120px; margin-top: -10px; font-size: 24px; color: #4a5454">CBC Blood Test</h5>


      <label class="mt-4" style="font-size: 15px;"> Clinic Name</label>
      <input class="form-control" name="clinic" type="text" value="<?=$_SESSION['cname']?>">

      <label class="mt-2" style="font-size: 15px;"> Patient ID</label>
      <input class="form-control" name="patient_id" type="text" value="<?php echo $patient_id?>">

      <label class="mt-2" style="font-size: 15px;"> Patient Name</label>
      <input class="form-control" name="patient" type="text" value="<?php echo $patient?>">

      <label class="mt-2" style="font-size: 15px;"> Parameter</label>
      <input class="form-control" name="parameter" type="text" value="<?php echo $parameter?>">

      <label class="mt-2" style="font-size: 15px;"> Value</label>
      <input class="form-control" name="value" type="text" value="<?php echo $value?>">

      <label class="mt-2" style="font-size: 15px;"> Reference Range</label>
      <input class="form-control" name="range" type="text" value="<?php echo $range?>">

     
      <button type="submit" name="savec" class="btn btn-sm btn-primary col-sm-3 offset-md-3 mb-0 mt-4">Save</button>

      <button class="btn btn-sm btn-default col-sm-3 mb-0 mt-4" type="button" onclick="_reset()">Cancel</button>

</form>

<form class="bg-white border shadow p-4  mb-3" action="" method="POST" style="border-radius: 20px; width: 900px; font-family: Poppins; margin-left: 500px; height: 650px; margin-top: -650px">


<?php
              $id = $_SESSION['id'];
              $sql = "SELECT * FROM cbc WHERE clinic_id = $id";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>

<div style="width:100%;overflow:auto; max-height:550px;">
             <table class="table table-hover" style="width:850px; margin: auto; font-size:14px">
             <thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td>
                             ID
                         </td>
                         <td>
                            Patient
                         </td>
                         
                         <td>
                            Parameter
                         </td>
                         <td>
                            Value
                         </td>
                         <td>
                            Reference
                         </td>
                         <td>
                            Date Created
                         </td>
                         <td>
                           Action
                         </td>
                     </tr>
                 </thead>              
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">

          <?php while ($rows = mysqli_fetch_assoc($result)) {?>

          <tr style="border: none">

            <td>
              <?=$rows['patient_id']?>
            </td>

            <td>
            
            <?=$rows['patient']?>
        
            </td>


            <td>
                
            <?=$rows['parameter']?>
            
            </td>
            
            <td>
            <?=$rows['value']?>

            </td>

            <td>
            <?=$rows['range']?>

            </td>

            <td>
            <?php echo date("l M d, Y h:i A",strtotime($rows['date_created'])) ?>
            </td>
            
            <td>
              
             <a href="laboratory.php?cbc=<?=$rows['id']?>" class="btn btn-sm btn-info">Edit</a>
             <a href="laboratory.php?delc=<?=$rows['id']?>" class="btn btn-sm btn-danger" name="delc" class="delc" id="btn-delete">Delete</a>
								
            </td>

          </tr>
          <?php  }?>
          </tbody>
          
             </table>
</div>
</form>

<script>
function _reset(){
		$('[name="id"]').val('');
		$('#form').get(0).reset();
	}
</script>


<?php else: ?>
  
  <?php
  include "db_conn.php";
  error_reporting(0);

  if(isset($_POST['savechol']))
  {
  
    $clinic_id = $_GET['chol'];
    $patient_id = $_POST['patient_id'];
    $patient = $_POST['patient'];
    $test_name = $_POST['test_name'];
    $result_cho = $_POST['result_cho'];
    $units_cho = $_POST['units_cho'];
    $normal = $_POST['normal'];
    $clinic = $_SESSION['cname'];
      
        $query = "INSERT INTO cholesterol (`clinic_id`, `clinic`, `patient_id`, `patient`, `test_name`, `result_cho`, `units_cho`, `normal_values`)
              VALUES ('$clinic_id', '$clinic', '$patient_id', '$patient', '$test_name', '$result_cho', '$units_cho', '$normal')";
                    
        $res = mysqli_query($conn, $query);
        if ($res) {
         
          echo "<script language = javascript>
          Swal.fire(
              'Success!',
              'Patient Cholesterol Test is Added',
              'success'
            )
          </script>";     
    } else{
      echo "<script language = javascript>
      Swal.fire(
          'Error',
          'Error encounter',
          'error'
        )
      </script>";    
    }
  
      
  }
  ?>


<?php require 'delete.php'; ?>
    <?php 
            if($chol == false):?>

<form class="bg-white border shadow p-4 text-left" id="cholesterol" action="" method="POST" style="border-radius: 20px; width: 410px; height: 680px; font-family: Poppins; margin-left: 40px; margin-top: -20px">


  <img src="img/cholesterol.png" class="ms-5 mt-1" style="width: 60px; height: 60px; margin-bottom: -40px; margin-top: -10px">
  <h5 class="card-title" style="margin-left: 120px; margin-top: -5px; font-size: 24px; color: #4a5454">Cholesterol Test</h5>


      <label class="mt-4" style="font-size: 15px;"> Clinic Name</label>
      <input class="form-control" name="clinic" type="text" value="<?=$_SESSION['cname']?>">

      <label class="mt-1" style="font-size: 15px;"> Patient ID</label>
      <input class="form-control" name="patient_id" type="text" value="<?php echo $patient_id?>">

      <label class="mt-1" style="font-size: 15px;"> Patient Name</label>
      <input class="form-control" name="patient" type="text" value="<?php echo $patient?>">

      <label class="mt-1" style="font-size: 15px;"> Test Name</label>
      <input class="form-control"  type="text" name="test_name" value="<?php echo $test_name?>">

      <label class="mt-1" style="font-size: 15px;"> Results</label>
      <input type="text" class="form-control" name="result_cho" value="<?php echo $result_cho?>">

      <label class="mt-1" style="font-size: 15px;"> Units</label>
      <input type="text" class="form-control" name="units_cho" value="<?php echo $units_cho?>">

      <label class="mt-1" style="font-size: 15px;"> Normal Values</label>
      <input type="text" class="form-control" name="normal" value="<?php echo $normal?>">

     
      <button type="submit" name="savechol" class="btn btn-sm btn-primary col-sm-3 offset-md-3 mb-0 mt-4">Save</button>

      <button class="btn btn-sm btn-default col-sm-3 mb-0 mt-4" type="button" onclick="_reset()">Cancel</button>

</form>

<form class="bg-white border shadow p-4  mb-3" action="" method="POST" style="border-radius: 20px; width: 950px; font-family: Poppins; margin-left: 460px; height: 650px; margin-top: -670px">


<?php
              $id = $_SESSION['id'];
              $sql = "SELECT * FROM cholesterol WHERE clinic_id = $id";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>

<div style="width:100%;overflow:auto; max-height:550px;">
             <table class="table table-hover" style="width:880px; margin: auto; font-size:14px">
             <thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td>
                             ID
                         </td>
                         <td>
                            Patient
                         </td>
                         
                         <td>
                            Test
                         </td>
                         <td>
                            Result
                         </td>
                         <td>
                            Units
                         </td>
                         <td>
                            Normal Values
                         </td>
                         <td>
                            Date Created
                         </td>
                         <td>
                           Action
                         </td>
                     </tr>
                 </thead>              
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">

          <?php while ($rows = mysqli_fetch_assoc($result)) {?>

          <tr style="border: none">

            <td>
              <?=$rows['patient_id']?>
            </td>

            <td>
            
            <?=$rows['patient']?>
        
            </td>


            <td>
                
            <?=$rows['test_name']?>
            
            </td>
            
            <td>
            <?=$rows['result_cho']?>

            </td>

            <td>
            <?=$rows['units_cho']?>

            </td>

            <td>
            <?=$rows['normal_values']?>

            </td>


            <td>
            <?php echo date("l M d, Y h:i A",strtotime($rows['date_created'])) ?>
            </td>
            
            <td>
              
             <a href="laboratory.php?chol=<?=$rows['id']?>" class="btn btn-sm btn-info">Edit</a>
             <a href="laboratory.php?delcho=<?=$rows['id']?>" class="btn btn-sm btn-danger" name="delcho" class="delc" id="btn-delete">Delete</a>
								
            </td>

          </tr>
          <?php  }?>
          </tbody>
          
             </table>
</div>
</form>

<script>
function _reset(){
		$('[name="id"]').val('');
		$('#cholesterol').get(0).reset();
	}
</script>


<?php else: ?>

  <div class="text">Laboratory</div>


<?php require_once 'delete.php'; ?>
  <div class="card border shadow ms-5 mt-5" style="width: 430px; height: 225px">
  <div class="card-body">
    <img src="img/red-blood-cells.png" style="width: 50px; height: 50px; margin-bottom: -40px; margin-top: -10px">
  <h5 class="card-title" style="margin-left: 60px; margin-top: -10px">CBC Blood Test</h5>
    <p class="card-text text-justify mt-4">A blood test used to evaluate overall health and detect a wide range of disorders, including anemia, infection and leukemia.</p>
    <a href="laboratory.php?cbc=<?=$_SESSION['id']?>" class="btn btn-info">Add</a>
  </div>
</div>

<div class="card border shadow ms-5 mt-5" style="width: 430px; height: 225px">
  <div class="card-body">
  <img src="img/cholesterol.png" style="width: 50px; height: 50px; margin-bottom: -40px; margin-top: -10px">
    <h5 class="card-title" style="margin-left: 60px; margin-top: -10px">Cholesterol Test</h5>
    <p class="card-text text-justify mt-4">A blood test done to determine whether the cholesterol is high and to estimate the risk of heart attacks and other forms of heart disease. </p>
    <a href="laboratory.php?chol=<?=$_SESSION['id']?>" class="btn btn-info">Add</a>
  </div>
</div>

<div class="card border shadow" style="width: 430px; height: 225px; margin-left: 500px; margin-top: -498px">
  <div class="card-body">
  <img src="img/stool-test.png" style="width: 50px; height: 50px; margin-bottom: -40px; margin-top: -10px">
    <h5 class="card-title" style="margin-left: 60px; margin-top: -10px">Fecalysis</h5>
    <p class="card-text text-justify mt-4">A noninvasive laboratory test useful in identifying disorders of the digestive tract.</p>
    <a href="#" class="btn btn-info">Add</a>
  </div>
</div>

<div class="card border shadow" style="width: 430px; height: 225px; margin-left: 500px; margin-top: 48px">
  <div class="card-body">
  <img src="img/dark-urine.png" style="width: 50px; height: 50px; margin-bottom: -40px; margin-top: -10px">
    <h5 class="card-title" style="margin-left: 60px; margin-top: -10px">Urinalysis</h5>
    <p class="card-text text-justify mt-4">Various tests to examine the urine contents for any abnormalities that indicate a disease condition or infection.</p>
    <a href="#" class="btn btn-info">Add</a>
  </div>
</div>

<div class="card border shadow" style="width: 430px; height: 225px; margin-left: 955px; margin-top: -498px">
  <div class="card-body">
  <img src="img/blood.png" style="width: 50px; height: 50px; margin-bottom: -40px; margin-top: -10px">
    <h5 class="card-title" style="margin-left: 60px; margin-top: -10px">BMP (Basic Metabolic Panel)</h5>
    <p class="card-text text-justify mt-4">A blood chemistry test that measures your sugar level, electrolyte balance, and kidney function.</p>
    <a href="#" class="btn btn-info">Add</a>
  </div>
</div>

<div class="card border shadow" style="width: 430px; height: 225px; margin-left: 955px; margin-top: 48px">
  <div class="card-body">
  <img src="img/ultrasound.png" style="width: 50px; height: 50px; margin-bottom: -40px; margin-top: -10px">
    <h5 class="card-title" style="margin-left: 60px; margin-top: -10px">Ultrasound</h5>
    <p class="card-text text-justify mt-4">A type of imaging test to examine the internal organs using very high frequency sound waves.</p>
    <a href="#" class="btn btn-info">Add</a>
  </div>
</div>


<?php endif; ?>
<?php endif; ?>

  </section>



<script src="script.js"></script>
			
</body>
</html>

<?php }else{
	header("Location: index.php");
} ?>