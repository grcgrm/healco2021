<?php 
//##########################################################################
// ITEXMO SEND SMS API - PHP - CURL-LESS METHOD
// Visit www.itexmo.com/developers.php for more info about this API
//##########################################################################
function itexmo($number,$message,$apicode,$passwd){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => $apicode, 'passwd' => $passwd);
		$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			),
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
}
//##########################################################################


?>

<?php
require('db_conn.php');

$appoint = true;
if(isset($_GET['id']))
{

  $sql = "DELETE FROM doctors_list WHERE id=".$_GET['id'];
  $result = mysqli_query($conn, $sql);
    header("Location: doctors.php");
 
}

if(isset($_GET['delete']))
{

  $sql = "DELETE FROM patient WHERE id=".$_GET['delete'];
  $result = mysqli_query($conn, $sql);
    
  echo "<script language = javascript>
  Swal.fire('Record Deleted', '', 'info')
.then((result) => {
          
  window.location.href = 'records.php';
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

  $sql = "DELETE FROM cbc WHERE id=".$_GET['delc'];
  $result = mysqli_query($conn, $sql);
    
  header("Location: laboratory.php?cbc=".$_GET['cbc']."");
 
}

if(isset($_GET['delcho']))
{

  $sql = "DELETE FROM cholesterol WHERE id=".$_GET['delcho'];
  $result = mysqli_query($conn, $sql);
    
  header("Location: laboratory.php?chol=".$_GET['chol']."");
 
}

if(isset($_GET['appoint']))
{
     $appoint = false;
}

if(isset($_POST['appoints'])){

  $schedule = $_POST['date'] . '.' . $_POST['time'];
  $status = $_POST['status'];
  $id = $_GET['appoint'];
  $sql = "UPDATE appointment_list SET status = '$status', schedule = '$schedule' WHERE id = $id";
  $result = mysqli_query($conn, $sql);

  if ($result) {

    echo "<script language = javascript>
    Swal.fire(
        'Success!',
        'Appointment is Updated',
        'success'
    ).then((result) => {
                         
      window.location.href = 'appointment.php';
    });
    </script>";

   if($status == '1'){
       $appoint = $_GET['appoint'];
       $list = "SELECT * FROM appointment_list WHERE id='".$appoint."'";
       $res = mysqli_query($conn, $list);
       $row=mysqli_fetch_assoc($res);
       $id = $row['patient_id'];
       $cname = $row['clinic'];
       $schedule = date("l M d, Y h:i A",strtotime($row['schedule']));

       $list1 = "SELECT * FROM patient WHERE id = $id";
       $res1 = mysqli_query($conn, $list1);
       $row1=mysqli_fetch_assoc($res1);
       $phone = $row1['phone'];
       

            $apicode = "ST-HEALC117601_YNVGC";
            $apipw = "vjs4]3mu81";

            $text = "Your Appointment Schedule is confirmed by " . $cname . " on ". $schedule .".";

                     $result = itexmo($phone,$text,$apicode, $apipw);
                         if ($result == ""){
                             echo "<script language = javascript>
                                 Swal.fire(
                                     'Sorry!',
                                     'No response from server. Please try again.',
                                     'error'
                                 )
                             </script>";
                             }else if ($result == 0){
        
                                 echo "<script language = javascript>
                                 Swal.fire(
                                     'Success',
                                     'Confirmation is sent to $phone',
                                     'success'
                                   ).then((result) => {
                         
                                     window.location.href = 'appointment.php';
                                   });
                             </script>";
                             
                             
                             } 
                             else{	
                                 echo "<script language = javascript>
                                 Swal.fire(
                                     'Sorry!',
                                     'Error Number #'. $result . 'was encountered! Contact our customer support.',
                                     'error'
                                 ).then((result) => {
                         
                                     window.location.href = 'appointment.php';
                                   });
                             </script>";
                             
                             }
        }
            }
  } 
?>