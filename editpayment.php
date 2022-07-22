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
           echo '<img src="uploads/default.png" width="20px" height="20px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="20px" height="20px" />

    <?php     }
        
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
  <form class="border shadow rounded-20 ms-5 text-center" style="height: 665px; background-color: white; width: 400px; margin-top:-23px; margin-bottom: -15px;" method="POST" action="" enctype="multipart/form-data" >

  <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="100px" height="100px" style="margin-top: 20px; border-radius:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
         } else{ ?>
          
          <img src="uploads/<?php echo $row['image']?>" width="100px" height="100px" style="margin-top: 20px; border-radius:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"/>

    <?php     }
        
         ?>

                

                      <h2 style="font-size: 22px;" class=" mt-4 mb-1"><?=$_SESSION['name']?></h2>
                      <p>@<?=$_SESSION['username']?></p>
<hr class="bg-info" style=" margin-left: auto;
      margin-right: auto;
      width: 80%;">
                     
                     <p class="text-left ms-4 mb-0 mt-4" style="font-weight: 500;">Patient ID:</p>
                             <h6 class="text-left ms-4 text-muted">#<?php echo $row['id']?></h6>

                     <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Age:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['age']?></h6>

                      <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Birthdate:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo date("F d, Y",strtotime($row['birth']))?></h6>

                      <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Gender:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['sex']?></h6>
                      
                      <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Email Address:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['email']?></h6>

                       <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Contact Number:</p>
                             <h6 class="text-left ms-4 text-muted"><?php echo $row['phone']?></h6>
                        
                        <p class="text-left ms-4 mb-0 mt-2" style="font-weight: 500;">Complete Address:</p>
                            <h6 class="text-left ms-4 text-muted mb-2"><?php echo $row['address']?></h6>

            
          
                            <a href="edit.php?edit=<?=$_SESSION['id']?>" class="btn btn-info text-white" style=" margin-bottom: 10px; margin-top: 10px;">EDIT PROFILE</a>
              
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



    
 
     <form class="border shadow rounded-20 text-center" style="height: 670px; background-color: white; width: 400px; margin-top:-665px; margin-bottom: -18px; margin-left: 480px ;" method="POST" action="" enctype="multipart/form-data" >
    
    <h4 style="margin-top: 40px;">Payment Information</h4>
    <img src="img/visa.png" width="50" height="50">
    <img src="img/1156750_finance_mastercard_payment_icon.png" width="50" height="50" class="ms-3">
    <img src="img/GCash_Logo.png" width="60" height="40" class="ms-3" style="border-radius: 10px;">
    <img src="img/paymaya.png" width="60" height="20" class="ms-3" style="border-radius: 10px;">

        <hr class="bg-info mb-4" style=" margin-left: auto;
                            margin-right: auto;
                            width: 80%;">

<?php require 'delete.php'; ?>
<?php if($gcash == false): ?>

  <h4 style="margin-top: 40px;">HEALCO GCASH ACCOUNT</h4>

  <h4 class="" style="margin-top: 40px; font-size: 16px">Scan this QR Code to pay</h4>

           <img src="img/pay.jpg" style="width: 250px; height: 300px;" alt="HealCo GCash Account"> <br> 

           <button name="gcash" class="btn btn-info mt-3">Okay</button>
 <?php else: ?> 

  <?php if($paymaya == false): ?>

    <h4 style="margin-top: 40px;">HEALCO PAYMAYA ACCOUNT</h4>

    <h4 class="" style="margin-top: 40px; font-size: 16px">Scan this QR Code to pay</h4>

<img src="img/myqr_1639358695443_1.jpg" style="width: 300px; height: 300px;"  alt="HealCo PAYMAYA Account"><br>

<button name="paymaya" class="btn btn-info mt-3">Okay</button>
<?php else: ?>
 

          <p class="text-left ms-4 mb-1 mt-4" style="font-weight: 500;">Card Holder:</p>
          <div class="col-md-12">
        <input class="form-control" type="text" name="card_name" id="" aria-describedby="help" value="<?=$row['card_name']?>">
        <small id="help" class="text-center form-text text-muted">Enter the name written on the card.</small>
      </div>

          <p class="text-left ms-4 mb-1 mt-2" style="font-weight: 500;">Card Number:</p>
          <div class="col-md-12" >
        <input class="form-control" id="cc" name="card_num" aria-describedby="help" placeholder="----  ----  ----  ----" onkeypress="return checkDigit(event)" value="<?=$row['card_num']?>">
        <small id="help" class="form-text text-muted">We'll never share your information with anyone else.</small>
      </div>

          <p class="text-left ms-4 mb-1 mt-2" style="font-weight: 500;">Expiry Date/Valid Thru:</p>
          <div class="col-md-12" id="datepicker">
        <input class="form-control" type="month" name="card_expi" id="datepicker" aria-describedby="help" value="<?=$row['card_expi']?>">
        <small id="help" class="form-text text-muted">Expiry date is written with this format MM/YY.</small>
      </div>

          <p class="text-left ms-4 mb-2 mt-2" style="font-weight: 500;">Card CVV:</p>
          <div class="col-md-12">
        <input class="form-control" type="text" name="card_cvv" aria-describedby="help" onkeypress="return isNumberKey(event)" maxlength="4" value="<?=$row['card_cvv']?>">
        <small id="help" class="form-text text-muted">3 or 4 digits usually found on the back of the card.</small>
      </div>
      <button type="submit" name="submit" class="btn btn-info mt-3">Okay</button>
 
      <?php endif; ?>
      <?php endif; ?>

      <input type="hidden" value="<?php echo date("l M d, Y h:i A")?>" name="datepay">   
      
          
              	
         
    
        </form>
    <?php }?>
                        
                        <?php }?>
                        <?php  }?> 
                        
                        

                        <form class="border shadow rounded-20 text-center bg-light" style="height: 270px; width: 400px; margin-top:-620px; margin-bottom: 50px; margin-left: 940px ;" method="POST" action="" enctype="multipart/form-data" id="manage-doctor">
    
                        <h5 style="margin-top: 20px;">HMO</h5>
                <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT * FROM patient WHERE id=$id";
		                    $result = mysqli_query($conn, $sql); 
                        $row = mysqli_fetch_assoc($result);
                        ?>

<?php if (empty($row['hmo'])) { ?>

<div class="mt-3 input-group-sm" style="width: 250px; margin: auto;">
<input required type="file" class="form-control" name="image" id="image"  accept="image/jpg, image/jpeg">
</div>

<?php } else { ?>

<img src="uploads/<?php echo $row['hmo'] ?>" width="250" height="200">

<?php } ?>
    
        </form>  
        
        
        <form class="border shadow rounded-20 text-center bg-info text-white" style="height: 270px; width: 400px; margin-top:40px; margin-bottom: 18px; margin-left: 940px ;" method="POST" action="" enctype="multipart/form-data" id="manage-doctor">
    
    <h5 style="margin-top: 50px; margin-bottom: 20px">Appointment Schedule</h5>
                <?php
                        $id = $_SESSION['id'];
                        $sql = "SELECT * FROM appointment_list WHERE patient_id=$id AND status =1";
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
  <script src="card.js"></script>      
  		    
			  
			
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>