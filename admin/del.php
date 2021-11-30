<?php
require('../db_conn.php');


if(isset($_GET['id']))
{

  $sql = "DELETE FROM users WHERE id=".$_GET['id'];
  $result = mysqli_query($conn, $sql);
    header("Location: clinic.php");
 
}

if(isset($_GET['del']))
{

  $sql = "DELETE FROM patient WHERE id=".$_GET['del'];
  $result = mysqli_query($conn, $sql);
    header("Location: patient.php");
 
}

?>