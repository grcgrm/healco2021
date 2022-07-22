


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
$city = true;
$specialty = true;
$viewsched = true;
$clinic = true;
$gcash = true;
$paymaya = true;
$card = true;

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

  $sql = "DELETE FROM appointment_list WHERE id=".$_GET['del'];
  $result = mysqli_query($conn, $sql);
    
  header("Location: appointment.php");
 
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
    
     $id = $_GET['edit'];
     
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

}

if(isset($_POST['saves'])){
     extract($_POST);
     

     foreach($check as $key => $val){
    

          
     $id = $_GET['sched'];
    $days=$_POST['days'][$key];
    $time_from= $_POST['time_from'][$key];
    $time_to= $_POST['time_to'][$key];
     
 

    $query=mysqli_query($conn,"SELECT * FROM doctors_schedule WHERE day='$days' and doctor_id = '$id'");        
    $count=mysqli_num_rows($query);

    if ($count>0)
{

     mysqli_query($conn,"UPDATE doctors_schedule SET time_from='$time_from', time_to='$time_to', day='$days' 
                         WHERE doctor_id = '$id' AND day='$days'");
                          echo "<script language = javascript>
                          Swal.fire(
                              'Success!',
                              'Schedule is Updated',
                              'success'
                          ).then((result) => {
                            window.location.href = 'doctors.php?view=$id';
                          });
                      </script>"; 
}   

else {


     mysqli_query($conn,"INSERT INTO doctors_schedule(doctor_id, day, time_from, time_to) 
				VALUES('$id', '$days','$time_from','$time_to')");

      
          echo "<script language = javascript>
          Swal.fire(
              'Success!',
              'Schedule is Set',
              'success'
          ).then((result) => {
            window.location.href = 'doctors.php?view=$id';
          });
      </script>"; 
}
}
                          
}  
     

if(isset($_GET['view']))
{
     $view = false;
}

if(isset($_GET['gcash']))
{
     $gcash = false;
}

if(isset($_GET['paymaya']))
{
     $paymaya = false;
}

if(isset($_GET['card']))
{
     $card = false;
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
               $value_cbc = $row['value_cbc'];
               $ref_range = $row['ref_range'];
               
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
     if(isset($_GET['city']))
     {
          $city = false;
          $users = true;
     }

     if(isset($_GET['specialty']))
     {
          $city = true;
          $users = true;
          $specialty = false;
     }

 if(isset($_GET['viewsched']))
{
     $viewsched = false;

     $sql = "SELECT * FROM doctors_list WHERE id=".$_GET['viewsched'];
     $res = mysqli_query($conn, $sql);
     if($res == true)
     {
          
          $row = mysqli_fetch_assoc($res);
          $cname = $row['cname'];
          $name = $row['name'];
          $name_pref = $row['name_pref'];
         

          
     }
}

if(isset($_GET['clinic']))
{
     $clinic = false;
     
}

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


if(isset($_POST['submit']))
{

$id = $_GET['card'];
$card_num = $_POST['card_num'];
$card_name = $_POST['card_name'];
$card_expi = $_POST['card_expi'];
$card_cvv = $_POST['card_cvv'];



mysqli_query($conn,"UPDATE patient SET card_num = '$card_num', card_name = '$card_name', card_expi = '$card_expi', card_cvv = '$card_cvv' WHERE id = $id");
  echo "<script language = javascript>
  Swal.fire(
      'Good job!',
      'Payment Updated Succesfully',
      'success'
    ).then((result) => {
            
      window.location.href = 'profile.php';
    });
  </script>";
  }

  if(isset($_POST['gcash']))
{

echo "<script language = javascript>
  Swal.fire(
      'Good job!',
      'Payment Updated Succesfully',
      'success'
    ).then((result) => {
            
      window.location.href = 'profile.php';
    });
  </script>";
  }

  if(isset($_POST['paymaya']))
  {
  
  echo "<script language = javascript>
    Swal.fire(
        'Good job!',
        'Payment Updated Succesfully',
        'success'
      ).then((result) => {
              
        window.location.href = 'profile.php';
      });
    </script>";
    }


?>
<style>
     body{
          background-color: rgb(10, 103, 156);
          font-family: 'Courier New', Courier, monospace;
     }
</style>

