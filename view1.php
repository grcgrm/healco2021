<?php 
   session_start();
   
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {  
     ?>

<!DOCTYPE html>
<html>
<head>
	<title>HealCo</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="addpatient.css">
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
     

     <li class="profile">
         <div class="profile-details">
   
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
<form form class="border shadow rounded-20" style="background-color: #fff; padding-top: -10px; width: 90%; margin-right:auto; margin-left:auto;" action="">

<?php 

$sql = "SELECT * FROM patient WHERE username= '".$_SESSION['username']."' AND plan = 1 ORDER BY id ASC ";
$res = mysqli_query($conn, $sql);
     
if (mysqli_num_rows($res) === 1) {
  
                  while ($rows = mysqli_fetch_assoc($res)) {
                    
                    ?>
                 


         



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
     <?php 
      $sql = "SELECT * FROM patient WHERE patient = '".$rows['id']."'";
      $result = mysqli_query($conn, $sql);

      while($rows = mysqli_fetch_assoc($result)):
     
?>

     <div class="text2">Personal Health Information</div>
     <table>
       <tr>
          <th>Childhood Illness</th>
          <th>List any medical problems that other doctors have diagnosed</th>
       </tr>
       
       <tr>
         <td width="430">
           
            <?php echo $rows['c_illness'];?> 
   
                  </td>
                    
            <td>
                  
                  <?php echo $rows['m_problems'];?>
                   
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
                
       
         <label class="mt-2">Deceased:</label> <?php echo $rows['father'];?>
         
         <br>

         <?php if($rows['father'] == 'YES') { ?>
                  
                     <label>Age of death: </label> 
                     <?php echo $rows['f_age'];?> <br>

                     <label>Cause of death: </label> 
                     <?php echo $rows['f_cause'];?>
                      
               <?php } ?>       
            </td>

            <td class="fam" width="550">
            <label class="mt-2">Deceased:</label> <?php echo $rows['mother'];?>
         
          <br> <?php if($rows['mother'] == 'YES') { ?>

                   
                      <label>Age of death: </label> 
                      <?php echo $rows['m_age'];?> <br>

                      <label>Cause of death: </label> 
                      <?php echo $rows['m_cause'];?>
                      
                      <?php } ?>  
                        
            </td>
         
       </tr>

       <tr>
          <th colspan="2">Diseases that runs in the family </th>
          
       </tr>
       <tr>
       <td colspan="2">
      <?php echo $rows['disease'];?>
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
      <?php echo $rows['drug'] ?>
      </td>

      <td>
      <?php echo $rows['reaction'];?> 
      
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
<?php endwhile; ?>

</table>
     

     <?php  } ?>
     <?php  } else {
       $id = $_SESSION['id'];

        echo "<p class='echo1'>Your plan does not include viewing of your Health Records. 
              <br>  If you want to view your records, add your payment information and pay only P50 for a premium plan.</p>";
      
      echo "<a href='editpayment.php?id=$id' class='btn btn-info text-white ms-5 mt-2 mb-5' type='submit' name='submit' value='Submit'> Click here to Apply </a>";}?>
   

           
     <script src="script.js"></script>
            
            

            
    </form>
  </section>
  <?php }else{
	header("Location: index1.php");
} ?>