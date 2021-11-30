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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
      
  <div class="text">Patients Records</div>
  <form action="" method="GET">
  
  <div class="search">
         <input type="text" class="form-control shadow-sm ps-3" style="border-color: white; height: 45px; width: 260px"
                name="username" 
                placeholder="Search by username"
                value="<?php if(isset($_GET['username'])){echo $_GET['username'];} ?>">
  </div>

  
    <button type="submit" class="btn btn-primary" style="margin-left: 320px; margin-top: 20px; height: 45px">Search    <i class='mt-0 bx bx-search'></i></button>
                                

  </form>


  <a href="addpatient.php" class="btn btn-success" style="margin-left: 1150px; margin-top: -90px;">ADD PATIENT</a>
   <a href="records.php" class="btn" style="margin-top: -90px;">Refresh</a>

<form class="border shadow rounded-20" style="background-color: #fff; margin-top: 20px; padding-top: -10px; width: 99%; margin-right:auto; margin-left:auto;" action="view.php">

<?php 
     if(isset($_GET['username']))
{
     $username = $_GET['username'];


     $query = "SELECT * FROM patient WHERE username='$username'";
     $query_run = mysqli_query($conn, $query);

        if(mysqli_num_rows($query_run) > 0)
         {
            foreach($query_run as $rows)
            {
         ?>
         <div class="text1"
style="font-family: Poppins; font-size: 18px; margin-left: 40px; margin-top: 20px; margin-bottom: -15px; color: rgb(29, 161, 84);"
> <i>Search Result:</i> </div>
         <table >
           <thead>
              <tr>
                <th>PATIENT ID</th>
                <th>NAME</th>
                <th>USERNAME</th>
                <th>PHONE NUMBER</th>
                <th>EMAIL ADDRESS</th>
                <th>ADDRESS</th>
                <th>ACTION</th>
              </tr>
            </thead>
            <tbody>
              <tr style="background-color:#d3ffce;">
                <th><?=$rows['id']?></th>
                <td><?=$rows['name']?></td>
                <td><?=$rows['username']?></td>
                <td><?=$rows['phone']?></td>
                <td><?=$rows['email']?></td>
                <td><?=$rows['address']?></td>
                <td>
                

                <div class="update">
              <a href="view.php?view=<?=$rows['id']?>"><b>VIEW</b></a>
                    </div>
                    
                </td>
              </tr>
              </tbody>
        </table>

         <?php
            }
         }
             else
              {
               echo "<p class='echo'>No Record Found</p>";
               }
         }
          
?>
<div class="text1"
style="font-family: Poppins; font-size: 23px; margin-left: 40px; margin-top: 20px; margin-bottom: 20px;"
>List of Patients</div>

<?php include 'php/members.php';
if (mysqli_num_rows($res) == 0) {?>
<p class='echo'> <i>Records empty</i> </p>
<?php  }?>
<?php
                 if (mysqli_num_rows($res) > 0) {?>


<table style="margin-bottom: 40px;" cellspacing="0" id="list">
              <thead>
              <tr>
                <th scope="col">PATIENT ID</th>
                <th scope="col">NAME</th>
                <th scope="col">USERNAME</th>
                <th scope="col">PHONE NUMBER</th>
                <th scope="col">EMAIL ADDRESS</th>
                <th scope="col">ADDRESS</th>
                <th scope="col">ACTION</th>
              </tr>
              
              </thead>
            
        
          <?php 
          
          while ($rows = mysqli_fetch_assoc($res)) {?>
          <tbody>
          <tr>
            <td><?=$rows['id']?></td>
            <td><?=$rows['name']?></td>
            <td><?=$rows['username']?></td>
            <td><?=$rows['phone']?></td>
            <td><?=$rows['email']?></td>
            <td><?=$rows['address']?></td>
            
            <td>
              
              <div class="update">
              <a href="view.php?view=<?=$rows['id']?>"><b>VIEW</b></a>
                    </div>
             
                    
            </td>

          </tr>
          </tbody>
          <?php  }?>
        
      </table>
      <?php  }?>

      

</form>
<script src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

<script>
  $(document).ready(function() {
    $('#list').DataTable( {
        scrollY:        '74vh',
        searching: false,
        paging:         false,
    } );
} );
</script>

   

</section>

  <script src="script.js"></script>
        
   
</body>
</html>
<?php }else{
	header("Location: index.php");
} ?>