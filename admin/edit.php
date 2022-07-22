<script src="jquery-3.6.0.min.js"></script>
<script src="sweetalert2.all.min.js"></script>  


<?php
require('../db_conn.php');

$clinic = true;
$patient = true;

if(isset($_GET['clinic']))
{
     $clinic= false;
}

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
     $id = $_GET['del'];
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
            
           window.location.href = 'del.php?del=$id' ;
       }
     
     });
          </script>";
     
}

if(isset($_GET['patient']))
{
     $patient = false;
}



?>

