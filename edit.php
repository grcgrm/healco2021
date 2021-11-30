<?php 
   session_start();
   
   include "db_conn.php";
   if (isset($_SESSION['username']) && isset($_SESSION['id'])) {   ?>

<!DOCTYPE html>
<html>
<head>
<title>HealCo | Profile</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<meta charset="UTF-8">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
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


  <?php

include 'db_conn.php';
error_reporting(0);

if(isset($_POST['submit']))
{
    $id = $_GET['edit'];
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $file = addslashes(file_get_contents($_FILES['image']['tmp_name'])) ;

		
    $sql = "UPDATE patient SET name='$name', username = '$username', email = '$email', phone = '$phone', address = '$address', image = '$file' WHERE id = $id ";
    $result = mysqli_query($conn, $sql);
    
    if($result)
    {
      move_uploaded_file($_FILES["image"]["tmp_name"],"uploads/" . $_FILES["image"]["name"]);

                  echo "<script language = javascript>
                  Swal.fire(
                      'Good job!',
                      'Profile Updated Succesfully',
                      'success'
                    ).then((result) => {
                            
                      window.location.href = 'profile.php';
                    });
                  </script>";

    }
			  
        }

?>

  <section class="home-section1">
  <form class="border shadow rounded-20 ms-5 text-center" style="height: 665px; background-color: white; width: 400px; margin-top:-23px; margin-bottom: -15px;" method="POST" action="" enctype="multipart/form-data">

  <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="100px" height="100px">';
         } else{
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="100px" height="100px" style="margin-top: 20px; border-radius:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"/>';

         }
        
         ?>
<div class="mt-3 input-group-sm" style="width: 250px; margin: auto;">
              <input required type="file" class="form-control" name="image" id="image"  onchange="displayImg(this,$(this))">
            </div>
                
            <p class="text-left ms-5 mb-0 mt-2" style="font-weight: 500; font-size: 12px">Name:</p>
                        <input class="form-control mt-1" type="text"style="width: 300px; margin: auto;" name="name" value="<?php echo $row['name']?>">
            <p class="text-left ms-5 mb-0 mt-2" style="font-weight: 500; font-size: 12px">Userame:</p> 
                        <input class="form-control mt-1" type="text"style="width: 300px; margin: auto;" name="username" value="<?php echo $row['username']?>">

          <hr class="bg-info" style=" margin-left: auto;
          margin-right: auto;
          width: 80%;">

<p class="text-left ms-4 mb-0 mt-4" style="font-weight: 500; font-size: 14px">Email Address:</p>
                        <input class="form-control" type="text"style="width: 350px; margin: auto;" name="email" value="<?php echo $row['email']?>">
                        

                         <p class="text-left ms-4 mb-0 mt-3 " style="font-weight: 500; font-size: 14px">Contact Number:</p>
                         <input class="form-control" type="text"style="width: 350px; margin: auto;" name="phone" value="<?php echo $row['phone']?>">
                        
                          
                          <p class="text-left ms-4 mb-0 mt-3 " style="font-weight: 500; font-size: 14px">Complete Address:</p>
                          <input class="form-control" type="text"style="width: 350px; margin: auto;" name="address" value="<?php echo $row['address']?>">


            
          
                          <button type="submit" name="submit" class="btn btn-info mt-4">SAVE PROFILE</button>
              
</form>
                        
<?php }?>
                        
                        <?php }?>
                        <?php  }?>   
                        
                        <?php
                        $sql = "SELECT * FROM patient WHERE username= '".$_SESSION['username']."'";
		                    $result = mysqli_query($conn, $sql); 
                        
                        if($result)
                        {
                          if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
 
     <form class="border shadow rounded-20 text-center" style="height: 670px; background-color: white; width: 400px; margin-top:-665px; margin-bottom: -10px; margin-left: 480px ;" method="POST" action="" enctype="multipart/form-data">
    
    <h4 style="margin-top: 40px;">Payment Information</h4>
    <img src="img/visa.png" width="50" height="50">
    <img src="img/1156750_finance_mastercard_payment_icon.png" width="50" height="50" class="ms-3">

        <hr class="bg-info mb-4" style=" margin-left: auto;
                            margin-right: auto;
                            width: 80%;">

          <p class="text-left ms-5 mb-2 mt-4" style="font-weight: 500;">Card Holder:</p>
                <h6 class="text-left ms-5 text-muted mb-4"><?php echo $row['card_name']?></h6>

          <p class="text-left ms-5 mb-2 mt-3" style="font-weight: 500;">Card Number:</p>
                <h6 class="text-left ms-5 text-muted mb-4"><?php echo $row['card_num']?></h6>

          <p class="text-left ms-5 mb-2 mt-3" style="font-weight: 500;">Expiry Date/Valid Thru:</p>
                <h6 class="text-left ms-5 text-muted mb-4">
                  <?php
                      if(empty($row['card_expi']))
                      { echo "";}
                      else{echo date("m/y",strtotime($row['card_expi']));}
                  ?></h6>

          <p class="text-left ms-5 mb-2 mt-3" style="font-weight: 500;">Card CVV:</p>
                <h6 class="text-left ms-5 text-muted mb-3"><?php echo $row['card_cvv']?></h6>
    

          <p style="font-size: 13px;" class=" text-justify m-2 p-3 text-muted ">Note: We are commited in keeping your information secure in HealCo. We have a robust security framework that is regularly viewed and updated to safeguard your transaction.</p>
 
          <a href="editpayment.php?edit=<?=$_SESSION['id']?>" class="btn btn-info text-white" style=" margin-bottom: 10px; margin-top: 20px;">EDIT PAYMENT DETAILS</a>
              	
    
    
        </form>
    <?php }?>
                        
                        <?php }?>
                        <?php  }?>                    

                        <form class="border shadow rounded-20 text-center bg-info text-white" style="height: 270px; width: 400px; margin-top:-620px; margin-bottom: 50px; margin-left: 940px ;" method="POST" action="" enctype="multipart/form-data">
    
    <h5 style="margin-top: 50px;">Active Appointment</h5>
                <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT * FROM appointment_list WHERE patient_id=$id AND status =1 OR status=2 OR status=3";
		                    $result = mysqli_query($conn, $sql); 
                        $row = mysqli_fetch_assoc($result);
                        $rowcount = mysqli_num_rows( $result );

                        if($result)
                        {
                          
                            
                                    echo "<p style='font-size: 65px;' class=' mt-4 mb-0'>$rowcount</p>";
                                    echo "<p style='font-size: 15px;' class='mb-2'>Appointment/s</p>";

                                    if($row['status'] == 3)
                                  {
                                    echo "<p style='font-size: 25px;' class='mt-4'>You have no active appointment.</p>";
                                   }
          
                        } ?>

              
    
        </form>  
        
        
        <form class="border shadow rounded-20 text-center bg-success text-white" style="height: 270px; width: 400px; margin-top:40px; margin-bottom: 18px; margin-left: 940px ;" method="POST" action="" enctype="multipart/form-data">
    
    <h5 style="margin-top: 50px; margin-bottom: 20px">Appointment Schedule</h5>
                <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT * FROM appointment_list WHERE patient_id=$id AND status =1 OR status=2";
		                    $result = mysqli_query($conn, $sql); 

                       ?>
<table>
<?php while($row = mysqli_fetch_assoc($result)): ?>
                      <tr>
                       <p style="font-size: 16px; margin-top: 10px" class="mb-0">Date: <?php echo date("D, M d Y g:i A",strtotime($row['schedule'])) ?></p>
                       <p style="font-size: 16px; margin-top: 4px" class="mb-0">Clinic Name: <?php echo $row['clinic']?></p>
                       </tr>
                       <?php endwhile;?>
</table>
                       
                      
   </form>  
  </section>
  


  <script src="script.js"></script>
        
  		    
			  
			
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>