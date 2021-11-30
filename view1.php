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
         if(empty($_SESSION['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="20px" height="20px">';
         } else{
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $_SESSION['image'] ).'" width="30px" height="40px" />';

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
<form form class="border shadow rounded-20" style="background-color: #fff; padding-top: -10px; width: 90%; margin-right:auto; margin-left:auto;" action="">

<?php 

$sql = "SELECT * FROM patient WHERE username= '".$_SESSION['username']."' AND plan = 1 ORDER BY id ASC ";
$res = mysqli_query($conn, $sql);
     
if (mysqli_num_rows($res) === 1) {
  
                  while ($rows = mysqli_fetch_assoc($res)) {
                    
                    ?>
                 


         


<div class="text1">Added by: <?=$rows['clinic']?> (<?=$rows['date_created']?>) </div> <br>
<div class="text2">Patient Information</div>
      
      <table>
            <tr>
                <th>
                <label for="" >Full Name</label>
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

            <td width="286">
            <?=$rows['name']?>
                </td>

                

                <td width="180">
                <?=$rows['username']?>
                </td>

                

                <td width="140">
                <?=$rows['age']?>
                </td>

                

                <td width="190">
                <?=$rows['phone']?>
                </td>

                <td>
                <?=$rows['email']?>
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

                    <td width="286">
                    <?=$rows['birth']?>
                    </td>

                    <td width="180">
                    <?=$rows['sex']?>
                    
                    

                    </td>

                    <td width="140">

                    <?=$rows['status']?>


                    </td>

                    <td>
                    <?=$rows['address']?>
                    </td>

                </tr>


     </table>

     <div class="text2">Personal Health Information</div>
     <table>
       <tr>
          <th>Childhood Illness</th>
          <th>List any medical problems that other doctors have diagnosed</th>
       </tr>
       
       <tr>
         <td width="430">
         <?=$rows['c_illness']?>
                  </td>
                    
            <td>
            <?=$rows['m_problems']?>
        </td>
       </tr>

       <tr>
         <th>Current Medication</th>
         <th>Reason/s for visiting</th>
       </tr>
       <tr>

        <td>
        <?=$rows['medication']?>
        </td>
          <td>
          <?=$rows['reason']?>
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
         <td width="550">
                Deceased: 

                <?=$rows['father']?>
           <?php 
           if($rows['father'] == 'YES'){
            ?> 
            <br> <label for="f_age">If YES, age of death: </label> 
            <?=$rows['f_age']?>

                       <br> <label for="f_cause">Cause of death: </label> 
                       <?=$rows['f_cause']?> 
                        

                        
                        <?php    }?>   
            </td>

            <td>
           Deceased: 
           <?=$rows['mother']?>
           <?php 
           if($rows['mother'] == 'YES'){
            ?> 
           <br> <label for="m_age">If YES, age of death: </label> 
           <?=$rows['m_age']?>

                     <br>   <label for="m_cause">Cause of death: </label> 
                     <?=$rows['m_cause']?> 
                        

                        
                        <?php    }?>   
      
            </td>
         
       </tr>

       <tr>
          <th>Diseases that runs in the family </th>
          <th>Other diseases</th>
       </tr>
       <tr>
       
          <td >
          
								
          <?=$rows['disease']?>

          </td>

          <td>
          <?=$rows['other']?>
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
      <?=$rows['drug']?>
      </td>

      <td>
      <?=$rows['reaction']?>
      </td>


      </tr>
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