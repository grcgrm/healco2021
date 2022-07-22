<?php 
   session_start();
   
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {  
     ?>

<!DOCTYPE html>
<html>
<head>
	<title>HealCo</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="addpatient.css" >
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
         <span class="links_name">Health Records</span>
       </a>
       <span class="tooltip">Records</span>
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
     
     <li>
       <a href="users.php">
         <i class='bx bx-clinic' ></i>
         <span class="links_name">Clinics</span>
       </a>
       <span class="tooltip">Clinics</span>
     </li>

     <li class="profile">
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
           echo '<img src="uploads/default.png" width="20px" height="20px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="20px" height="20px" />

    <?php     }?>
    <?php     }?>
    <?php     }?>
    <?php     }?>
           <div class="name_job">
             <div class="name"><?=$_SESSION['cname']?></div>
             <div class="job"><?=$_SESSION['role']?></div>
           </div>
         </div>
         <div class="logout"><a href="logout.php" class='bx bx-log-out' type='solid' id="log_out" ></a></div>
         
     </li>
    </ul>
  </div>


  <?php include 'db_conn.php';
error_reporting(0);

if(isset($_POST['submit']))
{
   
  $id = $_GET['view'];

  $c_illness = $_POST['c_illness'];
  $m_problems = $_POST['m_problems'];
  $father = $_POST['father'];
  $f_age = $_POST['f_age'];
  $f_cause = $_POST['f_cause'];
  $mother = $_POST['mother'];
  $m_age = $_POST['m_age'];
  $m_cause = $_POST['m_cause'];
  $disease = $_POST['disease'];
  $reaction = $_POST['reaction'];
  $drug = $_POST['drug'];

  $medication = $_POST['medication'];
  $reason = $_POST['reason'];
  $diagnosis = $_POST['diagnosis'];
  $prescription = $_POST['prescription'];
  $doctor = $_POST['doctor'];
$datetime = $_POST['date_visit'];
$date_visit = date('Y-m-d H:i:s',$datetime);
  $clinic = $_SESSION['cname'];

  $sql = "UPDATE patient SET clinic = '$clinic' WHERE id = $id";
  $result = mysqli_query($conn, $sql);
   if($result){

    $sql1 ="INSERT INTO patient (patient, medication, reason, diagnosis, prescription, doctor, date_visit, clinic, c_illness, m_problems, father, f_age, f_cause, mother, m_age, m_cause, disease, reaction, drug) 
    VALUES ('$id', '$medication', '$reason', '$diagnosis', '$prescription', '$doctor', '$date_visit', '$clinic', '$c_illness', '$m_problems' , '$father', '$f_age', '$f_cause', '$mother', '$m_age', '$m_cause', '$disease', '$reaction',  '$drug')";
    $result1 = mysqli_query($conn, $sql1);

    if($result1)
    {
      echo "<script language = javascript>
      Swal.fire(
          'Good job!',
          'Patient updated Succesfully',
          'success'
        )
  </script>";
    } else {
      echo "<script language = javascript>
      Swal.fire(
          'Error!',
          'Patient Not Updated',
          'error'
        )
  </script>";
    }
  }
           
    }?>

    




  <section class="home-section1">

<?php  require_once 'delete.php'; ?>
<form form class="border shadow rounded-20" style="background-color: #fff; padding-top: -10px; padding-bottom: 20px; width: 90%; margin-right:auto; margin-left:auto;" action="" method="POST">




<?php include 'php/members2.php';
while ($rows = mysqli_fetch_assoc($res)):?>



<div class="text2">Patient Information</div>
      
<table>
            <tr>
                <th>
                <label for="" >Last Name</label>
                </th>

                <th>
                <label for="" >First Name</label>
                </th>

                <th>
                <label for="" >Middle Name</label>
                </th>
                

                <th>
                <label for="" >Username</label>
                </th>

                <th>
                <label for="" >Age</label>
                </th>
                
                <th>
                <label for="" >Phone Number</label>
                </th>
                <th>
                <label for="" >Email Address</label>
                </th>

               
            </tr>

            <tr>

            <td>
                <div class="mt-1 mb-0 input-group-sm">
                  <?php echo $rows['last'];?>   
	             </div>
                </td>

                <td>
                <div class="mt-1 mb-0 input-group-sm">
                    
                   <?php echo $rows['first'];?>   
	             </div>
                </td>

                <td>
                <div class="mt-1 mb-0 input-group-sm">
                    <?php echo $rows['middle'];?>
                     
	             </div>
                </td>

                

                <td>
                <div class="mt-1 mb-0 input-group-sm">
                   <?php echo $rows['username'];?>
		        </div>
                </td>

                

                <td width="100">
                <div class="mt-1 mb-0 input-group-sm">
                <?php $dateOfBirth = $rows['birth'];
                  $today = date("Y-m-d");
                  $diff = date_diff(date_create($dateOfBirth), date_create($today)); echo $diff->format('%y')?>
		        </div>
                </td>

                

                <td width="190">
                <div class="mt-1 mb-0 input-group-sm">
                <?php echo $rows['phone'];?>
		        </div>
                </td>

                <td>
                <div class="mt-1 mb-0 input-group-sm"> 
                <?php echo $rows['email'];?> 
		        </div>
                </td>



            </tr>


            

      </table>
          
     <table class="table1">

                    <tr>

                        <th>
                            <label for="" >Birthdate</label>
                            </th>

                            <th>
                            <label for="" >Sex</label>
                            </th>

                            <th>
                            <label for="" >Marital Status</label>
                            </th>

                        <th>
                            <label for="" >Complete Address</label>
                            </th>

                            

                    
                    </tr>




                <tr>

                    <td width="260">
                    <div class="mt-1 mb-0 input-group-sm">
                    <?php echo date("F d, Y",strtotime($rows['birth']))?>
                    </div>
                    </td>

                    <td width="160">

                    <?php echo $rows['sex'];?>

                    </td>

                    <td width="146">
                  
                    <?php echo $rows['status'];?>

                    </td>

                    <td>
                    <div class="mt-1 mb-0 input-group-sm">
                    <?php echo $rows['address'];?>
                        
                    </div>
                    </td>

                </tr>


     </table>
     <?php  endwhile;?>  

          
     <?php 
      $sql = "SELECT * FROM patient WHERE patient = $id";
      $result = mysqli_query($conn, $sql);

      $rows = mysqli_fetch_assoc($result);
     
?>

     <div class="text2">Personal Health Information</div>
     <table>
       <tr>
          <th>Childhood Illness</th>
          <th>List any medical problems that other doctors have diagnosed</th>
       </tr>
       
       <tr>
         <td width="430">
           <?php if (empty($rows['c_illness'])) { ?>

            <textarea class="form-control" id="c_illness" rows="1" name="c_illness"></textarea>

            <?php } else {?>

            <?php echo $rows['c_illness'];?> 
          
            <?php } ?>
                  </td>
                    
            <td>
            <?php if (empty($rows['m_problems'])) { ?>

              <textarea class="form-control" id="m_problems" rows="1" name="m_problems"></textarea>

            <?php } else {?>

              <?php echo $rows['m_problems'];?>
            <?php } ?>
                 
                   
        </td>
       </tr>
       
       

     </table>


     <div class="text2">Family History</div>
     <table>
       
     <tr>
        <th>Father</th>
        <th>Mother</th>
     </tr>

       <tr>
         <td class="fam" width="550">
         <?php if (empty($rows['father'])) { ?>

          <label class="d">Deceased:  </label> 
                <select class="form-select form-select-sm" style="width: 100px; margin-top: -15px; margin-left: 145px;"
                            name="father" id="father"  value="<?php echo $father?>">
                        <option value="YES">YES</option>
                        <option value="NO">NO</option>
                        
                        
                    </select>

                        <label for="f_age" class="fage">If YES, age of death: </label> 
                        <input type="text"
                        class="f_age" 
                        size="2"
                        name="f_age"
                        id="f_age"
                        value="<?php echo $f_age?>" > 

                        <label for="f_cause" class="fcause">Cause of death: </label> 
                        <input type="text"
                        class="f_cause" 
                        name="f_cause"
                        id="f_cause"
                        value="<?php echo $f_cause?>" >

<?php } else { ?>


       
         <label class="mt-2">Deceased:</label> <?php echo $rows['father'];?>
         
         <br>

         <?php if($rows['father'] == 'YES') { ?>
                  
                     <label>Age of death: </label> 
                     <?php echo $rows['f_age'];?> <br>

                     <label>Cause of death: </label> 
                     <?php echo $rows['f_cause'];?>
                      
               <?php } ?> 
               <?php } ?> 
                   
            </td>

            <td class="fam" width="550">

            <?php if (empty($rows['mother'])) { ?>

              Deceased: 
         
         <select class="form-select form-select-sm" style="width: 100px; margin-top: -25px; margin-left: 145px;"
                          name="mother" id="mother"  value="<?php echo $mother?>">
                      <option value="YES">YES</option>
                      <option value="NO">NO</option>
                      
                      
                  </select>

                      <label for="m_age" class="mage">If YES, age of death: </label> 
                      <input type="text" 
                      class="m_age" 
                      size="2"
                      name="m_age"
                      id="m_age"
                      value="<?php echo $m_age?>" > <br>

                      <label for="m_cause" class="mcause">Cause of death: </label> 
                      <input type="text"
                      class="m_cause" 
                      name="m_cause"
                      id="m_cause"
                      value="<?php echo $m_cause?>" >

              <?php } else { ?>

            <label class="mt-2">Deceased:</label> <?php echo $rows['mother'];?>
         
          <br> <?php if($rows['mother'] == 'YES') { ?>

                   
                      <label>Age of death: </label> 
                      <?php echo $rows['m_age'];?> <br>

                      <label>Cause of death: </label> 
                      <?php echo $rows['m_cause'];?>
                      
                      <?php } ?>  
                       <?php } ?>          
            </td>

       </tr>

       <tr>
          <th colspan="2">Diseases that runs in the family </th>
          
       </tr>
       <tr>
       <td colspan="2">

       <?php if (empty($rows['disease'])) { ?>

        <textarea class="form-control" id="disease" rows="1" name="disease"></textarea>

        <?php } else {?>

          <?php echo $rows['disease'];?>
        <?php } ?>
      
      </td>


       </tr>

 
     </table>
			  
     <div class="text2">Allergies to Medication</div>
     <table class="allergy">
     <tr>

        <th>Name of the drug</th>
        <th>Reactions you had</th>

      </tr>
      <tr>

      <td>

      <?php if (empty($rows['drug'])) { ?>

        <textarea class="form-control" id="drug" rows="1" name="drug"></textarea>

        <?php } else {?>

          <?php echo $rows['drug'] ?>
        <?php } ?>

      
      </td>

      <td>

      <?php if (empty($rows['reaction'])) { ?>

        <textarea class="form-control" id="reaction" rows="1" name="reaction"></textarea>

        <?php } else {?>

          <?php echo $rows['reaction'];?> 
        <?php } ?>
      
      
      </td>


      </tr>

      
     </table>  

     <div class="text2">Medical History</div>
     <table>

     <tr>
         
         <th>Current Medication</th>
         <th>Reason/s for visiting</th>
         <th>Diagnosis</th>
         <th>Prescription</th>
         <th>Doctor's Name</th>
         <th>Date</th>
       </tr>

       <tr>



</tr>
<?php 
 $sql = "SELECT * FROM patient WHERE patient = $id";
 $result1 = mysqli_query($conn, $sql);

 $currentDate = new DateTime();
while($rows = mysqli_fetch_assoc($result1)): ?>
     <tr>

<td>
<?php echo $rows['medication'];?>
</td>
  <td>
  
<?php echo $rows['reason'];?>
   
  </td>

  <td>
<?php echo $rows['diagnosis'];?>
</td>
  <td>
  
<?php echo $rows['prescription'];?>
   
  </td>

  <td>
<?php echo $rows['doctor'];?>
</td>
  <td>
  
<?php echo date("l M d, Y h:i A",strtotime($rows['date_visit']));?>
   
  </td>

</tr>

<?php endwhile; ?>

</table>


     <div class="text2">Doctor's Diagnosis</div>
     <table>

     <tr>
         <th>Current Medication</th>
         <th>Reason/s for visiting</th>
       </tr>

     <tr>

<td>
<textarea class="form-control" id="medication" rows="1" name="medication"></textarea>
</td>
  <td>
  
    <textarea class="form-control" id="reason" rows="1" name="reason"></textarea>
   
  </td>

</tr>

<tr>
         <th>Diagnosis</th>
         <th>Prescription</th>
       </tr>

       <tr>

<td>
<textarea class="form-control" id="diagnosis" rows="1" name="diagnosis"></textarea>
</td>
  <td>
  
    <textarea class="form-control" id="prescription" rows="1" name="prescription"></textarea>
   
  </td>

</tr>

<tr>
         <th>Doctor's Name</th>
         <th>Date</th>
       </tr>

       <tr>

<td>
<textarea class="form-control" id="doctor" rows="1" name="doctor"></textarea>
</td>
  <td>
  
    <textarea class="form-control text-center" id="date" rows="1" name="date_visit" disabled value="<?php date("l M d, Y h:i A")?>"><?php echo date("l M d, Y h:i A")?></textarea>
   
  </td>

</tr>
  
     </table>



    

     <div class="d-grid gap-2 col-3 mx-auto mb-3 mt-3" >
                <button type="submit" name="submit"  id="submit"
                        class="btn btn-primary">UPDATE</button>
                </div>
<?php 
if(isset($_GET['view']))
$id = $_GET['view'];


?>
                <div class="d-grid gap-2 col-3 mx-auto mb-3" >
                <a href="view.php?delete=<?=$id?>" class="btn btn-danger" name="delete" class="delete" id="delete">Delete</a>
								
                </div>

                <div class="d-grid gap-2 col-3 mx-auto mb-3" >
                <a href="print.php?print=<?=$id?>" class="btn btn-info">PRINT</a>
								
                </div>
           
     <script src="script.js"></script>
            


            
    </form>
  </section>

  <?php }else{
	header("Location: index.php");
} ?>