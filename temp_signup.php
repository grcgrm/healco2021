<?php
//##########################################################################
// ITEXMO SEND result API - PHP - CURL-LESS METHOD
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

session_start();
$connect = mysqli_connect("localhost", "root", "", "medicare");

 if(isset($_GET['confirmID'])){
      $cid = $_GET['confirmID'];

      $api = "TR-LIZET294140_5JRTN";
      $apipw = "iwbkd#@mt1";


      $sql1 = mysqli_query($connect, "SELECT * FROM temp_users WHERE `ID`='$cid'");

      if(mysqli_num_rows($sql1) > 0){
          $row = mysqli_fetch_assoc($sql1);
          $un = $row['Username'];
          $fn = $row['FirstName'];
          $mn = $row['MiddleName'];
          $ln = $row['LastName'];
          $age = $row['Age'];
          $dob = $row['DoB'];
          $gen = $row['Gender'];
          $con = $row['Contact'];
          $add = $row['Address'];
          $email = $row['Email'];
          $pw = $row['Password'];
          $role = $row['role'];
      }
      

      $sql2 = mysqli_query($connect, "INSERT INTO users`(Username`,`FirstName`,`MiddleName`,`LastName`,`Age`,`DoB`,`Gender`,`Contact`,`Address`,`Email`,`Password`,`role`)VALUES('$un', '$fn' , '$mn' , '$ln' , '$age' , '$dob' , '$gen' , '$con' , '$add' , '$email' , '$pw' , '$role')");


      $sql3 = mysqli_query($connect, "DELETE FROM temp_users WHERE `ID`='$cid'");

      $full_name = $row['LastName'] . ", " . $row['FirstName']. " " .  $row['MiddleName'];

      $text = "Dear" . $full_name . ", you are successfully registered.";

      $result = itexmo($con, $text, $api, $apipw);

    
if ($result == ""){
echo "iTexMo: No response from server!!!
Please check the METHOD used (CURL or CURL-LESS). If you are using CURL then try CURL-LESS and vice versa.	
Please CONTACT US for help. ";	
}else if ($result == 0){
    
echo "Message Sent!";
}
else{	
echo "Error Num ". $result . " was encountered!";
}


      echo '<script>alert("User is successfully verified.");</script>';
 }
 $query = "SELECT * FROM temp_users ORDER BY ID ASC";  
 $result = mysqli_query($connect, $query);  
 ?>  
 <!DOCTYPE html>  
 <html>  
      <head>  
           <title> Resident Information </title>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>  
           <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>            
           <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />  
      </head>  
      <body>  
           <br /><br />  
           <div class="container">  
                <h3 align ="center"> Resident Information </h3>  
                <br />  
                <div class="table-responsive">  
                     <table id="residents" class="table table-striped table-bordered">  
                          <thead>  
                               <tr>  
                                    <td>Fist Name</td>  
                                    <td>Middle Name</td>  
                                    <td>Last Name</td>  
                                    <td>Date of Birth</td>  
                                    <td>Proof</td>  
                                    <td>Action</td>  
                               </tr>  
                          </thead>  
                          
                          <?php while($row = mysqli_fetch_assoc($result))   {  ?>
                         
                                 
                               <tr>  
                                    <td class="text-center"><?php echo $row['FirstName'] ?></td>  
                                    <td class="text-center"><?php echo $row['MiddleName'] ?></td>  
                                    <td class="text-center"><?php echo $row['LastName'] ?></td>  
                                    <td class="text-center"><img src="../images/<?php echo $row['Image'] ?>" alt="Avatar" width="300px" height="100px" ></td>  
                                    <td class="text-center"><?php echo $row['DoB'] ?></td> 
                                    <td class="text-center">
                                   <a href="ResidentProfile.php?confirmID=<?php echo htmlentities($row['ID']); ?>" class="btn btn-success btn-sm"> Confirm</a>
                                   </td>
                               </tr>  
                             
                         <?php  
                          }
                         ?>  
                        
                     </table>  
                </div>  
           </div>  
      </body>  
 </html>  
 <script>  
 $(document).ready(function(){  
      $('#residents').DataTable();  
 });  
 </script>