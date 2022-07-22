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

  <section class="home-section1">

  <?php require_once 'delete.php'; ?>
  <?php 
              if($clinic == false):?>

<form class="bg-white border shadow p-4" style="border-radius: 20px; width: 1300px; font-family: Poppins; margin: auto;">

<?php

            $view = $_GET['clinic'];
              $sql = "SELECT * FROM users WHERE id = $view";
              $result = mysqli_query($conn, $sql); 
              
             ?>


<div style="width:100%;overflow:auto; max-height:300px; margin: auto; text-align: left">


             <table class="table table-hover" style="width:1150px; margin: auto;" cellspacing="0" id="list">
             <thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td>
                             ID
                         </td>
                         <td>
                            Clinic
                         </td>
                         <td>
                             Username
                         </td>
                         <td>
                             Phone
                         </td>
                         <td>
                             Email Address
                         </td>

                         <td>
                             Location
                         </td>
                 </thead>     
                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">
          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">

            <td width="5%"><?=$rows['id']?></td>

            <td class="text-left">

            <?php 
         if(empty($rows['image']))
         {
           echo '<img src="uploads/default.png" width="20px" height="20px" style="border-radius: 40px; margin-right: 10px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $rows['image']?>" width="30px" height="30px" style="border-radius:40px; margin-right: 10px"/>

    <?php     }
        
         ?>

           
            <?=$rows['cname']?></td>
            <td ><?=$rows['username']?></td>
            <td><?=$rows['phone']?></td>
            <td><?=$rows['email']?></td>
            
            <td ><?=$rows['address']?> - <?=$rows['city']?></td>
            

          </tr>
         
          </tbody>
          
             </table>

             <table style="width: 900px;">
<?php  $cname = $rows['cname']; } 
                
                $sql = "SELECT * FROM doctors_list WHERE cname = '$cname'";
                $result1 = mysqli_query($conn, $sql); 
               
          ?>

          
          <tr style="background-color: #e7e9f2; color: #4C4C4C;">

         
               <td width = "15%" style="font-weight:500; ">
                   Doctor/s: 
               </td> 
               <?php while ($rows = mysqli_fetch_assoc($result1)) {
                                                                ?>
                <td>
                Dr. <?=$rows['name']?>, <?=$rows['name_pref']?>
                </td>
                <td>
                <?=$rows['specialty_ids']?>
                </td>

                    <?php } ?>
          </tr>
</table>
</div>


</form>


<?php endif; ?>

    
<div class="text ms-5 mb-3 mt-0">Clinics</div>
<form class="bg-white border shadow p-4" style="border-radius: 20px; width: 1300px; font-family: Poppins; margin: auto;">

<?php
              $sql = "SELECT * FROM users order by id asc";
              $result = mysqli_query($conn, $sql); 
              
             ?>


<div style="width:100%;overflow:auto; max-height:300px; margin: auto; text-align: left">


             <table class="table table-hover" style="width:1150px; margin: auto;" cellspacing="0" id="list">
             <thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td>
                             ID
                         </td>
                         <td>
                            Clinic
                         </td>
                         <td>
                             Username
                         </td>
                         <td>
                             Phone
                         </td>
                         <td>
                             Email Address
                         </td>

                         <td>
                            Action
                         </td>
                     </tr>
                 </thead>     
                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">
          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">

            <td width="5%"><?=$rows['id']?></td>

            <td width="30%" class="text-left">

            <?php 
         if(empty($rows['image']))
         {
           echo '<img src="uploads/default.png" width="20px" height="20px" style="border-radius: 40px; margin-right: 10px">';
         } else{ ?>
          
          <img src="uploads/<?php echo $rows['image']?>" width="30px" height="30px" style="border-radius:40px; margin-right: 10px"/>

    <?php     }
        
         ?>

           
            <?=$rows['cname']?></td>
            <td width="13%"><?=$rows['username']?></td>
            <td width="12%"><?=$rows['phone']?></td>
            <td width="25%"><?=$rows['email']?></td>
            
            
            <td width="7%">
              
            <a href="users.php?clinic=<?=$rows['id']?>" class="btn btn-sm btn-info">View</a>
            </td>

          </tr>
          <?php  }?>
          
          </tbody>
          
             </table>
</div>
</form>

<div class="text ms-5 mb-3 mt-3">Doctors</div>
<form class="bg-white border shadow" style="height: 400px; border-radius: 20px; width: 1300px; font-family: Poppins; margin: auto;">

<?php
              $sql = "SELECT * FROM doctors_list order by id asc";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>


  

    <div style="width:100%;overflow:auto; margin:auto; max-height:400px; max-width:1200px;">

    <table class="table p-0" style="border: none">
      <tr>

      
    <?php while ($rows = mysqli_fetch_assoc($result)) {?>
      <td style="border: none; width: 250px">
      
      <div class="p-3 border shadow text-center" style="border: none; width: 240px; height: 300px">
        
      <img src="uploads/<?php echo $rows['image']?>" width="100px" height="100px" style="border-radius:80px;"/>

        <br>
        <br>
        <label class="form-label" style="font-size: 18px; color: #5A5A5A;">Dr. <?=$rows['name']?></label> <br>
        <label class="form-label mb-0" style="font-size: 15px; color: #5A5A5A;"><?=$rows['cname']?></label> <br>
        <label class="form-label mt-0" style="font-size: 15px; color: #5A5A5A;"><?=$rows['specialty_ids']?></label>
        </div>
        
       
      </td>
      <?php }?>
      </tr>
      
    </table>
        


      </div> 

      </div>

</form>

</section>


<script src="script.js"></script>

  <?php }else{
	header("Location: index.php");
} ?>