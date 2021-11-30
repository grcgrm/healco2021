


<script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script> 

<?php

require('db_conn.php');

$update = true;
$sched = true;
$view = true;
$cbc = true;
$chol = true;
$id = 0;
$users = true;


if(isset($_GET['id']))
{
     $id = $_GET['id'];
     echo "<script language = javascript>
     Swal.fire({
          icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Yes'
     }).then((result) => {
       /* Read more about isConfirmed, isDenied below */
       if (result.isConfirmed) {
            
           window.location.href = 'del.php?id=$id' ;
       }
     
     });
          </script>";
     
}

if(isset($_GET['del']))
{
     $del = $_GET['del'];
     echo "<script language = javascript>
     Swal.fire({
          icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Yes'
     }).then((result) => {
       /* Read more about isConfirmed, isDenied below */
       if (result.isConfirmed) {
            
           window.location.href = 'del.php?del=$del' ;
       } elseif
       {
          window.location.href = 'appointment.php' ;
       }
     
     });
          </script>";
     
}

if(isset($_GET['delc']))
{
     $delc = $_GET['delc'];
     $cbc = false;
     echo "<script language = javascript>
     Swal.fire({
          icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Yes'
     }).then((result) => {
       /* Read more about isConfirmed, isDenied below */
       if (result.isConfirmed) {
            
           window.location.href = 'del.php?delc=$delc' ;
       } elseif
       {
          window.location.href = 'laboratory.php' ;
       }
     
     });
          </script>";
     
}

if(isset($_GET['delcho']))
{
     $delcho = $_GET['delcho'];
     $chol = false;
     echo "<script language = javascript>
     Swal.fire({
          icon: 'warning',
            title: 'Are you sure you want to delete this record?',
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: 'Yes'
     }).then((result) => {
       /* Read more about isConfirmed, isDenied below */
       if (result.isConfirmed) {
            
           window.location.href = 'del.php?delcho=$delcho' ;
       } elseif
       {
          window.location.href = 'laboratory.php' ;
       }
     
     });
          </script>";
     
}



if(isset($_GET['edit']))
{
    
     
     $sql = "SELECT * FROM doctors_list WHERE id=".$_GET['edit'];
     $res = mysqli_query($conn, $sql);
     if($res == true)
     {
          $update = false;
          $row = mysqli_fetch_assoc($res);
          $name = $row['name'];
          $name_pref = $row['name_pref'];
          $email = $row['email'];
          $contact = $row['contact'];
          $specialty_ids = $row['specialty_ids'];
          $file = $row['image'];
          
     }
     
 
}

if(isset($_GET['sched']))
{
     $sched = false;
     
     $qry = $conn->query("SELECT * FROM doctors_schedule where doctor_id =".$_GET['sched']);
     $c = $qry->num_rows;
while($row=$qry->fetch_assoc()){
	$id[$row['day']] = $row['id'];
	$from[$row['day']] = date("H:i",strtotime($row['time_from']));
	$to[$row['day']] = date("H:i",strtotime($row['time_to']));

    
  }
}

if(isset($_POST['save'])){
     extract($_POST);
     $check = $_POST['check'];

     foreach($check as $key => $val){
    


       $id = $_GET['sched'];
    $days=$_POST['days'][$key];
    $time_from= $_POST['time_from'][$key];
    $time_to= $_POST['time_to'][$key];
     
    if(isset($check[$key])){
     if($check[$key]>0){
     $save= "UPDATE doctors_schedule set day = '$days', doctors_id = '$id', time_from = '$time_from', time_to = '$time_to'  where id =".$check[$key];
     echo "<script language = javascript>
     Swal.fire(
         'Success!',
         'Schedule is Updated',
         'success'
     ).then((result) => {
       window.location.href = 'doctors.php?view=$id';
     });
 </script>"; }
else{
     $save= "INSERT INTO doctors_schedule set (`doctor_id`, `day`, `time_from`, `time_to`)
     VALUES ('$id', '$days','$time_from','$time_to')"; 
      
     echo "<script language = javascript>
     Swal.fire(
         'Success!',
         'Schedule is Set',
         'success'
     ).then((result) => {
       window.location.href = 'doctors.php?view=$id';
     });
 </script>"; }
}
     

}
                     
}  
     

if(isset($_GET['view']))
{
     $view = false;
}





 if(isset($_GET['cbc']))
     {
          $cbc = false;
          
     }

     if(isset($_GET['cbc']))
     {
         
          
          
          $sql = "SELECT * FROM cbc WHERE id=".$_GET['cbc'];
          $res = mysqli_query($conn, $sql);
          if($res == true)
          {
               
               $row = mysqli_fetch_assoc($res);
               $patient_id = $row['patient_id'];
               $patient = $row['patient'];
               $parameter = $row['parameter'];
               $value = $row['value'];
               $range = $row['range'];
               
          }
          
      
     }

if(isset($_GET['chol']))
     {
          $chol = false;
          
     }
     if(isset($_GET['chol']))
     {
         
          
          
          $sql = "SELECT * FROM cholesterol WHERE id=".$_GET['chol'];
          $res = mysqli_query($conn, $sql);
          if($res == true)
          {
               
               $row = mysqli_fetch_assoc($res);
               $patient_id = $row['patient_id'];
               $patient = $row['patient'];
               $test_name = $row['test_name'];
               $result_cho = $row['result_cho'];
               $units_cho = $row['units_cho'];
               $normal = $row['normal_values'];
               
          }
          
      
     }
 if(isset($_GET['users']))
     {
          $users = false;
          
     }
?>
<style>
     body{
          background-color: rgb(10, 103, 156);
          font-family: 'Courier New', Courier, monospace;
     }
</style>

