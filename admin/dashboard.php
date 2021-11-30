<?php 
   session_start();
   
   include "../db_conn.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
   
    <title>Healco | Admin</title>
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
       <a href="dashboard.php">
         <i class='bx bx-user' ></i>
         <span class="links_name">Dashboard</span>
       </a>
       <span class="tooltip">Dashboard</span>
     </li>

     <li>
       <a href="clinic.php">
         <i class='bx bx-plus-medical' ></i>
         <span class="links_name">Clinics</span>
       </a>
       <span class="tooltip">Clinics</span>
     </li>

     
     <li>
       <a href="patient.php">
         <i class='bx bx-folder' ></i>
         <span class="links_name"> Patients</span>
       </a>
       <span class="tooltip">Patients</span>
     </li>

     


     
     
     <li class="profile">
         <div class="profile-details">
         <img src="../uploads/default.png" alt="" width="20px" height="20px">';
        
           <div class="name_job">
             <div class="name">HealCo</div>
             <div class="job">Admin</div>
           </div>
         </div>
         <div class="logout"><a href="logout.php" class='bx bx-log-out' type='solid' id="log_out" ></a></div>
         
     </li>
    </ul>
  </div>

  <section class="home-section1">
  <form class="border shadow rounded-20 bg-white p-3" style="height: 190px; width: 400px; margin-top:0px; margin-bottom: 50px; margin-left: 70px; border-radius: 20px" method="POST" action="" enctype="multipart/form-data">
      

                  <?php
                          $sql = "SELECT * FROM patient";
                          $result = mysqli_query($conn, $sql); 
                          
                          $rowcount = mysqli_num_rows( $result );
                         ?>
                <img src="../img/patient.png" style="width: 80px; height: 80px; margin-left: 50px; margin-top: 39px">
              <p class="text-left" style="font-size: 75px; font-family: Rajdhani; font-weight: 500; color: #5A5A5A; margin-top: -110px; margin-left: 170px"><?php echo $rowcount?></p>
              <p class="text-left text-muted" style="font-size: 20px; font-family: Poppins; font-weight: 400; color: #5A5A5A; margin-top: -40px; margin-left: 170px">Patients</p>
      
      
      
          </form>

 <form class="border shadow rounded-20 bg-white p-3" style="height: 190px; width: 400px; margin-top:-240px; margin-bottom: 50px; margin-left: 510px; border-radius: 20px" method="POST" action="" enctype="multipart/form-data">
      

      <?php
              $sql = "SELECT * FROM users";
              $result = mysqli_query($conn, $sql); 
              
              $rowcount = mysqli_num_rows( $result );
             ?>
    <img src="../img/hospital.png" style="width: 80px; height: 80px; margin-left: 50px; margin-top: 39px">
  <p class="text-left" style="font-size: 75px; font-family: Rajdhani; font-weight: 500; color: #5A5A5A; margin-top: -110px; margin-left: 170px"><?php echo $rowcount?></p>
  <p class="text-left text-muted" style="font-size: 20px; font-family: Poppins; font-weight: 400; color: #5A5A5A; margin-top: -40px; margin-left: 170px">Clinics</p>



</form>
  
<form class="border shadow rounded-20 bg-white p-3" style="height: 190px; width: 400px; margin-top:-240px; margin-bottom: 50px; margin-left: 950px; border-radius: 20px" method="POST" action="" enctype="multipart/form-data">
      

      <?php
              $sql = "SELECT * FROM doctors_list";
              $result = mysqli_query($conn, $sql); 
              
              $rowcount = mysqli_num_rows( $result );
             ?>
    <img src="../img/stethoscope.png" style="width: 80px; height: 80px; margin-left: 50px; margin-top: 39px">
  <p class="text-left" style="font-size: 75px; font-family: Rajdhani; font-weight: 500; color: #5A5A5A; margin-top: -110px; margin-left: 170px"><?php echo $rowcount?></p>
  <p class="text-left text-muted" style="font-size: 20px; font-family: Poppins; font-weight: 400; color: #5A5A5A; margin-top: -40px; margin-left: 170px">Doctors</p>


</form>


<div class="text ms-5 mb-3">Patients</div>
<form class="bg-white border shadow p-4  mb-3" style="border-radius: 20px; width: 1300px; font-family: Poppins; margin: auto;">

<?php
              $sql = "SELECT * FROM patient";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>

<table class="table" style="width:1150px; margin: auto;">
<thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td width="6%">
                             ID
                         </td>
                         <td width="25%">
                            Patient
                         </td>
                         <td width="12%">
                             Username
                         </td>
                         <td width="12%">
                             Phone
                         </td>
                         <td width="25%">
                             Email Address
                         </td>
                         <td width="8%">
                            Plan
                         </td>
                         <td width="7%">
                            Action
                         </td>
                     </tr>
                 </thead>
</table>
<div style="width:100%;overflow:auto; max-height:300px;">
             <table class="table table-hover" style="width:1150px; margin: auto;">
                 

                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">
          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">
            <td width="6%"><?=$rows['id']?></td>
            <td width="25%">
            <?php if(empty($rows['image']))
       {
         echo '<img src="../uploads/default.png" alt="" width="20px" height="20px" style="margin-right: 10px">';
       } else{
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['image'] ).'" width="30px" height="30px" style="border-radius:40px; margin-right: 10px"/>';

       } ?> 
            <?=$rows['name']?>
        
            </td>
            <td width="12%"><?=$rows['username']?></td>
            <td width="12%"><?=$rows['phone']?></td>
            <td width="25%"><?=$rows['email']?></td>
            <td width="8%">
                
             
                
                <?php if($rows['plan'] == 0): ?>
                    <span class="badge badge-warning">Basic</span>
                <?php endif ?>
                <?php if($rows['plan'] == 1): ?>
                    <span class="badge badge-success">Premium</span>
                <?php endif ?>
                
            
            </td>
            
            <td width="7%">
              
             <a href="patient.php?id=<?=$rows['id']?>" class="btn btn-sm btn-info">Edit</a>
            </td>

          </tr>
          <?php  }?>
          </tbody>
          
             </table>
</div>
</form>

<div class="text ms-5 mb-3 mt-2">Clinics</div>
<form class="bg-white border shadow p-4 text-left" style="border-radius: 20px; width: 1300px; font-family: Poppins; margin: auto;">

<?php
              $sql = "SELECT * FROM users order by id asc";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>

<table class="table text-left" style="width:1150px; margin: auto;">
<thead style="font-weight: 500; color: #5A5A5A; border: none">
                     <tr style="border: none">
                         <td width="4%">
                             ID
                         </td>
                         <td width="30%">
                            Clinic
                         </td>
                         <td width="13%">
                             Username
                         </td>
                         <td width="12%">
                             Phone
                         </td>
                         <td width="25%">
                             Email Address
                         </td>
                         <td width="9%">
                            Status 
                         </td>
                         <td width="8%">
                            Action
                         </td>
                     </tr>
                 </thead>
</table>
<div style="width:100%;overflow:auto; max-height:300px; margin: auto;">


             <table class="table table-hover" style="width:1150px; margin: auto;" cellspacing="0" id="list">
                 
                 
          <tbody style="font-weight: 400; color: #4C4C4C; border: none">
          <?php while ($rows = mysqli_fetch_assoc($result)) {?>
          <tr style="border: none">

            <td width="5%"><?=$rows['id']?></td>

            <td width="30%">

           <?php if(empty($rows['image']))
       {
         echo '<img src="../uploads/default.png" alt="" width="20px" height="20px" style="margin-right: 10px">';
       } else{
        echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['image'] ).'" width="30px" height="30px" style="border-radius:40px; margin-right: 10px"/>';

       } ?>
           
            <?=$rows['cname']?></td>
            <td width="13%"><?=$rows['username']?></td>
            <td width="12%"><?=$rows['phone']?></td>
            <td width="25%"><?=$rows['email']?></td>
            <td width="9%">
                
             
                
                <?php if($rows['status'] == 0): ?>
                    <span class="badge badge-danger">Pending</span>
                <?php endif ?>
                <?php if($rows['status'] == 1): ?>
                    <span class="badge badge-success">Active</span>
                <?php endif ?>
                
            
            </td>
            
            <td width="7%">
              
             <a href="clinic.php?id=<?=$rows['id']?>" class="btn btn-sm btn-info">Edit</a>
            </td>

          </tr>
          <?php  }?>
          </tbody>
          
             </table>
</div>
</form>

<div class="text ms-5 mb-3 mt-3">Doctors</div>
<form class="bg-white border shadow p-4" style="height: 380px; border-radius: 20px; width: 1300px; font-family: Poppins; margin: auto;">

<?php
              $sql = "SELECT * FROM doctors_list order by id asc";
              $result = mysqli_query($conn, $sql); 
              $row = mysqli_num_rows($result);
             ?>


  

    <div style="width:100%;overflow:auto; margin:auto; max-height:400px; max-width:1200px;">

    <table>
      <tr>

      
    <?php while ($rows = mysqli_fetch_assoc($result)) {?>
      <td>
      
      <div class="p-3 border shadow text-center" style="margin-right: 30px; border: none; width: 220px;height: 300px">
        
        <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $rows['image'] ).'" width="120px" height="120px" style="border-radius: 60px"/>';?>
        <br>
        <br>
        <label class="form-label" style="font-size: 18px; color: #5A5A5A;"><?=$rows['name']?></label> <br>
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

<script src="../script.js"></script>
<script src="js/main.js"></script>

</body>


</html>
