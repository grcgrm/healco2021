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


  <section class="home-section1">
    
  <form class="border shadow rounded-20 ms-4 text-center" style="height: 680px; background-color: white; width: 400px; margin-top:-23px; margin-bottom: -18px;" method="POST" action="" enctype="multipart/form-data">

  <?php 
         if(empty($row['image']))
         {
           echo '<img src="uploads/default.png" alt="" width="200px" height="200px">';
         } else{
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" width="200px" height="200px" style="margin-top: 20px; border-radius:100px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);"/>';

         }
        
         ?>

                  

                    		<h2 style="font-size: 22px;" class=" mt-4 mb-1"><?php echo $row['cname']?></h2>
                    		<p>@<?php echo $row['username']?></p>
<hr class="bg-info" style=" margin-left: auto;
        margin-right: auto;
        width: 80%;">
                       

                        <p class="text-left ms-4 mb-0 mt-4" style="font-weight: 500;">Email Address:</p>
                           		<h6 class="text-left ms-4 text-muted"><?php echo $row['email']?></h6>

                         <p class="text-left ms-4 mb-0 mt-4 " style="font-weight: 500;">Contact Number:</p>
                           		<h6 class="text-left ms-4 text-muted"><?php echo $row['phone']?></h6>
                          
                          <p class="text-left ms-4 mb-0 mt-4 " style="font-weight: 500;">Complete Address:</p>
                              <h6 class="text-left ms-4 text-muted"><?php echo $row['address']?> - <?php echo $row['city']?></h6>


              <?php 
								$list = $conn->query("SELECT * FROM doctors_list WHERE cname='".$_SESSION['cname']."' ORDER BY id ASC");
              ?>

                          <p class="text-left ms-4 mb-0 mt-4 " style="font-weight: 500;">Categories</p>
                               <?php while($row=$list->fetch_assoc()):?>
                          	  <h6 class="text-left ms-4 text-muted"><?php echo $row['specialty_ids'] ?></h6>
                                <?php endwhile; ?>
            
               <a href="edit1.php?edit1=<?=$_SESSION['id']?>" class="btn btn-info" style=" margin-bottom: 20px; margin-top: 10px;">EDIT PROFILE</a>
              	
</form>
<?php }?>
                        
                        <?php }?>
                        <?php  }?>  
  

                        <?php
                        $sql = "SELECT * FROM users WHERE username= '".$_SESSION['username']."'";
		                    $result = mysqli_query($conn, $sql); 
                        
                        if($result)
                        {
                          if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) { ?>
 
     <form class="border shadow rounded-20 text-center" style="height: 670px; background-color: white; width: 400px; margin-top:-675px; margin-bottom: -18px; margin-left: 480px ;" method="POST" action="" enctype="multipart/form-data">
    
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
 
          <a href="editpayment1.php?edit1=<?=$_SESSION['id']?>" class="btn btn-info" style=" margin-bottom: 10px; margin-top: 20px;">EDIT PAYMENT DETAILS</a>
              	
    
    
        </form>
    <?php }?>
                        
                        <?php }?>
                        <?php  }?>  


       <form class="border shadow rounded-20 text-center bg-info text-white" style="height: 270px; width: 400px; margin-top:-620px; margin-bottom: 50px; margin-left: 940px ;" method="POST" action="" enctype="multipart/form-data">
    
    <h5 style="margin-top: 50px;">Number of Patients registered:</h5>
                <?php
                        $sql = "SELECT * FROM patient WHERE clinic= '".$_SESSION['cname']."'";
		                    $result = mysqli_query($conn, $sql); 
                        
                        $rowcount = mysqli_num_rows( $result );
                       ?>

            <p style="font-size: 75px;" class="mb-0"><?php echo $rowcount?></p>
            <p class="mt-0">Patient/s</p>
    
    
        </form>


        <form class="border shadow rounded-20 text-center bg-success text-white" style="height: 270px; width: 400px; margin-top:40px; margin-bottom: 18px; margin-left: 940px ;" method="POST" action="" enctype="multipart/form-data">
    
    <h5 style="margin-top: 50px;">Number of Doctors:</h5>
                <?php
                        $sql = "SELECT * FROM doctors_list WHERE cname= '".$_SESSION['cname']."'";
		                    $result = mysqli_query($conn, $sql); 
                        
                        $rowcount = mysqli_num_rows( $result );
                       ?>

            <p style="font-size: 75px;" class="mb-0"><?php echo $rowcount?></p>
            <p class="mt-0">Doctor/s</p>
    
    
        </form>
  </section>
  


  <script src="script.js"></script>
        
  		    
			  
		
      
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>