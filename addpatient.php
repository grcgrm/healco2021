
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

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
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
          <i class='bx bx-search' ></i>
         <input type="text" placeholder="Search...">
         <span class="tooltip">Search</span>
      </li>
      
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

     <li>
       <a href="users.php">
         <i class='bx bx-clinic' ></i>
         <span class="links_name">Clinics</span>
       </a>
       <span class="tooltip">Clinics</span>
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
           echo '<img src="uploads/default.png" width="20px" height="20px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="20px" height="20px" />

    <?php     }
        
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
      
      
      
          
 <?php
include 'db_conn.php';
error_reporting(0);

if(isset($_POST['submit']))
{
    $last = $_POST['last'];
    $first = $_POST['first'];
    $middle = $_POST['middle'];
    $username = $_POST['username'];
    $age = $_POST['age'];
    $birth = $_POST['birth'];
    $sex = $_POST['sex'];
    $status = $_POST['status'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $cdata = $_POST['c_illness'];
    $mdata = $_POST['m_problems'];
    $father = $_POST['father'];
    $f_age = $_POST['f_age'];
    $f_cause = $_POST['f_cause'];
    $mother = $_POST['mother'];
    $m_age = $_POST['m_age'];
    $m_cause = $_POST['m_cause'];
    $ddata = $_POST['disease'];
    $odata = $_POST['other'];
    $data = $_POST['drug'];
    $rdata = $_POST['reaction'];
    $redata = $_POST['reason'];
    $medata = $_POST['medication'];
    $clinic = $_SESSION['cname'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    
    if ($password == $cpassword) {
		$sql = "SELECT * FROM patient WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
    
        
		if (!$result->num_rows > 0) {
			$sql = "INSERT INTO patient (last, first, middle, username, email, password, phone, address, age, birth, sex, status, c_illness, m_problems, father, f_age, f_cause, mother, m_age, m_cause, disease, other, drug, reaction, medication, reason, clinic)
					VALUES ('$last', '$first', '$middle', '$username', '$email', '$password', '$phone', '$address', '$age', '$birth', '$sex', '$status', '$cdata', '$mdata' , '$father', '$f_age', '$f_cause', '$mother', '$m_age', '$m_cause', '$ddata', '$odata',  '$data', '$rdata', '$redata', '$medata', '$clinic')";
			$result = mysqli_query($conn, $sql);

      
			if ($result) {
				echo "<script language = javascript>
                Swal.fire(
                    'Good job!',
                    'Patient added Succesfully',
                    'success'
                  )
            </script>";
                $last = "";
                $first = "";
                $middle = "";
                $username = "";
				        $email = "";
                $phone = "";
                $address = "";
                $age = "";
                $sex = "";
                $status = "";
                $birth = "";
                $c_illness = "";
                $m_problems = "";
                $medication = "";
                $reason = "";
                $father = "";
                $f_age = "";
                $f_cause = "";
                $mother = "";
                $m_age = "";
                $m_cause = "";
                $disease = "";
                $other = "";
                $drug = "";
                $reaction = "";
				$_POST['password'] = "";
				$_POST['cpassword'] = "";
 
               
			} else {
				echo "<script language = javascript>
                Swal.fire(
                    'Oops!',
                    'Something Went Wrong',
                    'error'
                  )
            </script>";
			}
		} else {
			echo "<script language = javascript>
                Swal.fire(
                    'Oops!',
                    'Username/Email Already Exist. Please try again.',
                    'error'
                  )
            </script>";
		}
		
	} else {
		echo "<script language = javascript>
                Swal.fire(
                    'Try Again',
                    'Password DO NOT Matched!',
                    'error'
                  )
            </script>";
	}
}

    ?>
    
      <form class="border shadow rounded-20" action="" method="POST">
      <div class="text1">Adding to: <?=$_SESSION['cname']?> No. <?=$_SESSION['id']?></div>
      
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
                    <input type="text"
                    class="form-control" 
                    name="last" required
                    id="last"
                    value="<?php echo $last?>"
                    >   
	             </div>
                </td>


                <td>
                <div class="mt-1 mb-0 input-group-sm">
                    <input type="text"
                    class="form-control" 
                    name="first" required
                    id="first"
                    value="<?php echo $first?>"
                    >   
	             </div>
                </td>

                <td>
                <div class="mt-1 mb-0 input-group-sm">
                    <input type="text"
                    class="form-control" 
                    name="middle" required
                    id="middle"
                    value="<?php echo $middle?>"
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
                    value="<?php echo $username?>"
                    >
		        </div>
                </td>

                

                <td width="80">
                <div class="mt-1 mb-0 input-group-sm">
                    <input type="text" 
                    class="form-control" 
                    name="age" required
                    id="age"
                    value="<?php echo $age?>"
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
                    value="<?php echo $phone?>"
                >
		        </div>
                </td>

                <td>
                <div class="mt-1 mb-0 input-group-sm"> 
                <input type="email" 
                    class="form-control" 
                    name="email" required
                    id="email"
                    value="<?php echo $email?>"
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
                        value="<?php echo $birth?>"
                    >
                    </div>
                    </td>

                    <td width="140">
                    
                    <select class="form-select form-select-sm "
                            name="sex" id="sex"  value="<?php echo $sex?>">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Others">Others</option>
                        
                    </select>
                    
                    

                    </td>

                    <td width="146">

                    <select class="form-select form-select-sm "
                            name="status" id="status"  value="<?php echo $status?>">
                        <option value="Single">Single</option>
                        <option value="Married">Married</option>
                        <option value="Separated">Separated</option>
                        <option value="Divorced">Divorced</option>
                        <option value="Widowed">Widowed</option>
                        
                    </select>


                    </td>

                    <td>
                    <div class="mt-1 mb-0 input-group-sm">
                    <input type="text" 
                        class="form-control" 
                        name="address" required
                        id="address"
                        value="<?php echo $address?>"
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
           <div class="form-outline">
            <textarea class="form-control" id="c_illness" rows="1" name="c_illness"><?php echo $cdata['c_illness'];?> </textarea>
            
          </div>
                  </td>
                    
            <td>
                    <div class="form-outline">
                    <textarea class="form-control" id="m_problems" rows="1" name="m_problems"><?php echo $mdata['m_problems'];?> </textarea>
                    
                  </div>
        </td>
       </tr>
       <tr>
         <th>Current Medication</th>
         <th>Reason/s for visiting</th>
       </tr>
       <tr>

        <td>
        <div class="form-outline" >
            <textarea class="form-control" id="medication" rows="1" name="medication"><?php echo $medata['medication'];?> </textarea>
            
          </div>
        </td>
          <td>
          <div class="form-outline">
            <textarea class="form-control" id="reason" rows="1" name="reason"><?php echo $redata['reason'];?> </textarea>
            
          </div>
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
            </td>

            <td class="fam" width="550">
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
            </td>
         
       </tr>

       <tr>
          <th>Diseases that runs in the family </th>
          <th>Other diseases</th>
       </tr>
       <tr>
          <td >
          <div class="form-outline">
            <textarea class="form-control" id="disease" rows="1" name="disease"><?php echo $ddata['disease'];?> </textarea>
            
          </div>
      

          </td>

          <td>
          <label for="">Are there any other diseases that run in the family?</label> <br>
          <div class="form-outline">
            <textarea class="form-control" id="other" rows="1" name="other"> <?php echo $odata['other'];?></textarea>
            
          </div>

          </td>
       </tr>

 
     </table>
     
     <div class="text2">Allergies to Medication</div>
     <table>
     <tr>

        <th>Name of the drug</th>
        <th>Reactions you had</th>

      </tr>
      <tr>

      <td>
      <textarea class="form-control" id="drug" name="drug" rows="1" ><?php echo $data['drug'];?></textarea>
      </td>

      <td>
      <textarea class="form-control" id="reaction" rows="1" name="reaction"><?php echo $rdata['reaction'];?> </textarea>
      </td>


      </tr>
     </table>
			  
            

            

           
     <div class="text2">Set Password</div>
            <table>

            <tr>
                <th>
                <label for="password" 
                        >Password</label>
                </th>

                <th>
                <label for="cpassword" 
                >Confirm Password</label>
                </th>

            </tr>

            <tr>
              <td>
              <div class="input-group-sm">
                <input type="password" 
                    class="form-control" 
                    name="password" required
                    id="password"
                    title="Password must contain: Minimum of 8 characters atleast 1 letter and 1 number"
                    required pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$"
                    placeholder="Minimum of 8 characters atleast 1 letter and 1 number"
                    value="<?php echo $_POST['password']?>"
                > 
		    </div>
              </td>
              <td>
              <div class="input-group-sm">
                <input type="password" 
                    class="form-control" 
                    name="cpassword" required
                    id="cpassword"
                    value="<?php echo $_POST['cpassword']?>"
                    > 
		    </div>
              </td>
            
            </tr>

            </table>
            

            

            <div class="d-grid gap-2 col-3 mx-auto mb-4 mt-3" >
            <button type="submit" name="submit"
            class="btn btn-primary">ADD PATIENT</button>
            </div>
        

    
    
    </form>
  </section>
  
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <script>
        $(document).ready(function(){
            $(".mul-select").select2({
                    placeholder: "Select here", //placeholder
                    tags: true,
                    tokenSeparators: ['/',',',';'," "] ,
                    theme: "classic"
                });
            })
    </script>
        
  		    
			  
  <script src="script.js"></script>
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>