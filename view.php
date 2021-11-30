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
     
     <li class="profile">
         <div class="profile-details">
           <img src="img/default.jpg" alt="profileImg">
           
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
    mysqli_query($conn, "UPDATE patient SET name = '".$_POST['name']."',  username = '".$_POST['username']."',  age = '".$_POST['age']."',  phone = '".$_POST['phone']."',  email = '".$_POST['email']."', 
      birth = '".$_POST['birth']."',  sex = '".$_POST['sex']."',  status = '".$_POST['status']."',  address = '".$_POST['address']."',  c_illness = '".$_POST['c_illness']."',  m_problems = '".$_POST['m_problems']."',
      medication = '".$_POST['medication']."',  reason = '".$_POST['reason']."',  father = '".$_POST['father']."',  f_age = '".$_POST['f_age']."',  f_cause = '".$_POST['f_cause']."',  mother = '".$_POST['mother']."',  m_age = '".$_POST['m_age']."',  m_cause = '".$_POST['m_cause']."',
      disease = '".$_POST['disease']."',  other = '".$_POST['other']."',  drug = '".$_POST['drug']."',  reaction = '".$_POST['reaction']."',  clinic = '".$_SESSION['cname']."' WHERE id=$id");

    echo "<script language = javascript>
                Swal.fire(
                    'Good job!',
                    'Patient updated Succesfully',
                    'success'
                  )
            </script>";
           
    }?>

    




  <section class="home-section1">
<form form class="border shadow rounded-20" style="background-color: #fff; padding-top: -10px; padding-bottom: 20px; width: 90%; margin-right:auto; margin-left:auto;" action="" method="POST">




<?php include 'php/members2.php';
while ($rows = mysqli_fetch_assoc($res)) {?>



<div class="text1">Added by: <?=$_SESSION['cname']?> (<?=$rows['date_created']?>) </div> <br>
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

            <td>
                <div class="mt-1 mb-0 input-group-sm">
                    <input type="text"
                    class="form-control" 
                    name="name" required
                    id="name"
                    placeholder="First Name M.I. Last Name"
                    value="<?php echo $rows['name'];?>"
                    >   
	             </div>
                </td>

                

                <td>
                <div class="mt-1 mb-0 input-group-sm">
                    <input type="text" 
                    class="form-control" 
                    name="username" required
                    id="username"
                    placeholder="Minimum 0f 6 characters"
                    value="<?php echo $rows['username'];?>"
                    >
		        </div>
                </td>

                

                <td width="100">
                <div class="mt-1 mb-0 input-group-sm">
                    <input type="text" 
                    class="form-control" 
                    name="age" required
                    id="age"
                    value="<?php echo $rows['age'];?>"
                    >
		        </div>
                </td>

                

                <td width="190">
                <div class="mt-1 mb-0 input-group-sm">
                <input type="phone" 
                    class="form-control" 
                    name="phone" required
                    id="phone"
                    placeholder="+63 --"
                    value="<?php echo $rows['phone'];?>"
                >
		        </div>
                </td>

                <td>
                <div class="mt-1 mb-0 input-group-sm"> 
                <input type="email" 
                    class="form-control" 
                    name="email" required
                    id="email"
                    value="<?php echo $rows['email'];?>"
                    >
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

                    <td width="286">
                    <div class="mt-1 mb-0 input-group-sm">
                    <input type="date" 
                        class="form-control" 
                        name="birth" required
                        id="birth"
                        placeholder="Day-Month-Year"
                        value="<?php echo $rows['birth'];?>"
                    >
                    </div>
                    </td>

                    <td width="140">
                    
                    <select class="form-select form-select-sm "
                            name="sex" id="sex"  value="<?php echo $rows['sex'];?>">
                        <option value="Male" <?php echo $rows['sex'] == 'Male' ? 'selected' : ''?>>Male</option>
                        <option value="Female" <?php echo $rows['sex'] == 'Female' ? 'selected' : ''?>>Female</option>
                        <option value="Others" <?php echo $rows['sex'] == 'Others' ? 'selected' : ''?>>Others</option>
                        
                    </select>
                    
                    

                    </td>

                    <td width="146">

                    <select class="form-select form-select-sm "
                            name="status" id="status"  value="<?php echo $rows['status'];?>">
                        <option value="Single" <?php echo $rows['status'] == 'Single' ? 'selected' : ''?>>Single</option>
                        <option value="Married" <?php echo $rows['status'] == 'Married' ? 'selected' : ''?>>Married</option>
                        <option value="Separated" <?php echo $rows['status'] == 'Separated' ? 'selected' : ''?>>Separated</option>
                        <option value="Divorced" <?php echo $rows['status'] == 'Divorced' ? 'selected' : ''?>>Divorced</option>
                        <option value="Widowed" <?php echo $rows['status'] == 'Widowed' ? 'selected' : ''?>>Widowed</option>
                        
                    </select>


                    </td>

                    <td>
                    <div class="mt-1 mb-0 input-group-sm">
                    <input type="text" 
                        class="form-control" 
                        name="address" required
                        id="address"
                        value="<?php echo $rows['address'];?>"
                        placeholder="House Number, Street Name, Barangay, City/Municipality, Province"
                    >
                    </div>
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
           
            <textarea class="form-control" id="c_illness" rows="1" name="c_illness"><?php echo $rows['c_illness'];?> </textarea>
   
                  </td>
                    
            <td>
                  
                    <textarea class="form-control" id="m_problems" rows="1" name="m_problems"><?php echo $rows['m_problems'];?> </textarea>
                   
        </td>
       </tr>
       <tr>
         <th>Current Medication</th>
         <th>Reason/s for visiting</th>
       </tr>
       <tr>

        <td>
        <textarea class="form-control" id="medication" rows="1" name="medication"><?php echo $rows['medication'];?> </textarea>
        </td>
          <td>
          
            <textarea class="form-control" id="reason" rows="1" name="reason"><?php echo $rows['reason'];?> </textarea>
           
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
                
         <label class="d1">Deceased:</label> 
          <select class="form-select form-select-sm" style="width: 100px; margin-top: -20px; margin-left: 145px;"
                            name="father" id="father"  value="<?php echo $rows['father'];?>">
                        <option value="YES" <?php echo $rows['father'] == 'YES' ? 'selected' : ''?>>YES</option>
                        <option value="NO" <?php echo $rows['father'] == 'NO' ? 'selected' : ''?>>NO</option>
                        
                        
                    </select>

                    
                    
                      <label for="f_age" class="fage">If YES, age of death: </label> 
                      <input type="text" 
                      class="f_age" 
                      size="2"
                      name="f_age"
                      id="f_age"
                      value="<?php echo $rows['f_age'];?>" > 

                      <label for="m_cause" class="fcause">Cause of death: </label> 
                      <input type="text"
                      class="f_cause" 
                      name="f_cause"
                      id="f_cause"
                      value="<?php echo $rows['f_cause'];?>" >
                      
                      
            </td>

            <td class="fam" width="550">
            <label class="d2">Deceased:</label> 
         
           <select class="form-select form-select-sm" style="width: 100px; margin-top: -55px; margin-left: 145px;"
                            name="mother" id="mother"  value="<?php echo $rows['mother'];?>">
                        <option value="YES" <?php echo $rows['mother'] == 'YES' ? 'selected' : ''?>>YES</option>
                        <option value="NO" <?php echo $rows['mother'] == 'NO' ? 'selected' : ''?>>NO</option>
                        
                        
                    </select>
                   
                      <label for="m_age" class="mage">If YES, age of death: </label> 
                      <input type="text" 
                      class="m_age" 
                      size="2"
                      name="m_age"
                      id="m_age"
                      value="<?php echo $rows['m_age'];?>" > 

                      <label class="mcause1">Cause of death: </label> 
                      <input type="text"
                      class="m_cause1" 
                      name="m_cause"
                      id="m_cause"
                      value="<?php echo $rows['m_cause'];?>" >
                      

                        
            </td>
         
       </tr>

       <tr>
          <th>Diseases that runs in the family </th>
          <th>Other diseases</th>
       </tr>
       <tr>
       <td>
      <textarea class="form-control" id="disease" name="disease" rows="1" ><?php echo $rows['disease'];?></textarea>
      </td>

          <td>
          <label for="">Are there any other diseases that run in the family?</label> <br>
          <textarea class="form-control" id="other" name="other" rows="1" ><?php echo $rows['other'];?></textarea>

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
      <textarea class="form-control" id="drug" name="drug" rows="1" ><?php echo $rows['drug'];?></textarea>
      </td>

      <td>
      <textarea class="form-control" id="reaction" rows="1" name="reaction"><?php echo $rows['reaction'];?> </textarea>
      
      </td>


      </tr>
     </table>      


     <?php  }?>

     

     <div class="d-grid gap-2 col-3 mx-auto mb-3" >
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
           
     <script src="script.js"></script>
            
  <?php
  if(isset($_GET['delete']))
  {
       $id = $_GET['delete'];
       echo "<script language = javascript>
       Swal.fire({
        icon: 'warning',
        title: 'Are you sure you want to delete this record?',
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: 'Yes',
        denyButtonText: `No`,
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
               
            window.location.href = 'del.php?delete=$id';
          
        } else if (result.isDenied) {
          Swal.fire('Changes are not saved', '', 'info')
          .then((result) => {
                    
            window.location.href = 'view.php?view=$id';
          });
        }
      })
            </script>";
       
       
  }
  ?>

            
    </form>
  </section>

  <?php }else{
	header("Location: index.php");
} ?>