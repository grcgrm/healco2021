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
    <link rel="stylesheet" href="print.css" media="print">
</head>
<body>

<form style="background-color: #fff; width: 100%; margin-right:auto; margin-left:auto;" action="" method="POST">


<?php

$id = $_GET['print'];
        $sql = "SELECT * FROM patient WHERE id= $id";
        $result = mysqli_query($conn, $sql); 
        while ($rows = mysqli_fetch_assoc($result)):?>

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

                

                <td width="50">
                <div class="mt-1 mb-0 input-group-sm">
                <?php $dateOfBirth = $rows['birth'];
                  $today = date("Y-m-d");
                  $diff = date_diff(date_create($dateOfBirth), date_create($today)); echo $diff->format('%y')?>
		        </div>
                </td>

                

                <td width="100">
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

                    <td width="150">
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
         <td width="300">
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

          <label class="mt-0">Deceased:  </label> 
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


       
         <label class="mt-0">Deceased:</label> <?php echo $rows['father'];?>
         
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

            <label class="mt-0">Deceased:</label> <?php echo $rows['mother'];?>
         
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


<?php 
if(isset($_GET['view']))
$id = $_GET['view'];


?>
 

                <div class="d-grid gap-2 col-2 mx-auto mb-3 mt-4" >
                <button class="btn btn-info text-white" onclick="window.print()" name="print" id="print"><b>PRINT</b> </button>
				<a href="records.php" class="btn btn-secondary" name="print" id="print">BACK</a>			
                </div>
           
            


            
    </form>
  </section>

  <?php }else{
	header("Location: index.php");
} ?>