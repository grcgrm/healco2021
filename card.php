<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>HealCo | Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css">

</head>
<body>


<?php 
include "db_conn.php";
error_reporting(0);

if(isset($_POST['submit']))
{
    
  $card_num = $_POST['card_num'];
  $card_name = $_POST['card_name'];
  $card_expi = $_POST['card_expi'];
  $card_cvv = $_POST['card_cvv'];
	$code = $_GET['code'];
	

	$sql = "UPDATE `users` SET card_num = '$card_num', card_name = '$card_name', card_expi = '$card_expi', card_cvv = '$card_cvv'  WHERE username = '".$code."'";
  $result = mysqli_query($conn,$sql);
	if($result)
	{
					
  header("Location: submit.php?code=".$_GET['code']."");			
  }
	
		       
  }

  if(isset($_POST['gcash']))
{
    

	$code = $_GET['code'];
	

	$sql = "UPDATE `users` SET payment = 'gcash' WHERE username = '".$code."'";
  $result = mysqli_query($conn,$sql);
	if($result)
	{
					
  header("Location: submit.php?code=".$_GET['code']."");			
  }
	
		       
  }

  if(isset($_POST['paymaya']))
  {
      
  
    $code = $_GET['code'];
    
  
    $sql = "UPDATE `users` SET payment = 'paymaya' WHERE username = '".$code."'";
    $result = mysqli_query($conn,$sql);
    if($result)
    {
            
    header("Location: submit.php?code=".$_GET['code']."");			
    }
    
             
    }

?>


<?php require 'delete.php'; ?>

<form method="POST" class="p-4 border-shadow rounded-20 mb-5" style="width: 500px; margin: auto; margin-top: 45px">
<div class="form-group">
    <h3 class="text-center" style="font-size: 24px; color: rgb(25, 135, 180); font-weight: 500">Payment Information</h3>
    
    <img src="img/visa.png" style="margin-top:-7px; margin-left: 20px;">
    <img src="img/1156750_finance_mastercard_payment_icon.png" style="margin-top:-7px; margin-left: 50px;">
    <img src="img/GCash_Logo.png" width="60" height="40" class="ms-5" style="border-radius: 10px;">
    <img src="img/paymaya.png" width="60" height="20" class="ms-5" style="border-radius: 10px;">
    <br>

<div class="text-center">

<a href="card.php?card=<?=$_SESSION['id']?>" class="btn btn-info text-white ms-4" style=" margin-bottom: 10px; margin-top: 20px;">CREDIT CARD</a>                             

<a href="card.php?gcash=<?=$_SESSION['id'];?>" class="btn btn-info text-white ms-4" style=" margin-bottom: 10px; margin-top: 20px;">GCASH</a>
       
 <a href="card.php?paymaya=<?=$_SESSION['id']?>" class="btn btn-info text-white ms-4" style=" margin-bottom: 10px; margin-top: 20px;">PAYMAYA</a>

 
</div>
     
    
 <?php if($gcash == false): ?>


<h4 class="text-center" style="margin-top: 40px; font-size: 16px">Scan this QR Code to pay</h4>

<div class="text-center mb-0">
         <img src="img/pay.jpg" style="width: 250px; height: 280px;" alt="HealCo GCash Account"> <br> 
         </div>

    <div class="d-grid gap-2 col-6 mx-auto mt-0" >
            <button class="btn btn-primary" name="gcash" type="submit" id="submit">Pay Php 700.00</button>
                </div>  

<?php else: ?> 

<?php if($paymaya == false): ?>

  <h4 class="text-center" style="margin-top: 40px; font-size: 16px">Scan this QR Code to pay</h4>

<div class="text-center mb-0">
         <img src="img/myqr_1639358695443_1.jpg" style="width: 250px; height: 250px;" alt="HealCo GCash Account"> <br> 
         </div>

    <div class="d-grid gap-2 col-6 mx-auto mt-0" >
            <button class="btn btn-primary" name="paymaya" type="submit" id="submit">Pay Php 700.00</button>
                </div>  
<?php else: ?>

  <?php if($card == false): ?>


        <p class="text-left ms-4 mb-1 mt-4" style="font-weight: 500;">Card Holder:</p>
        <div class="col-md-12">
      <input class="form-control" type="text" name="card_name" id="" aria-describedby="help" value="<?=$row['card_name']?>">
      <small id="help" class="text-center form-text text-muted">Enter the name written on the card.</small>
    </div>

        <p class="text-left ms-4 mb-1 mt-2" style="font-weight: 500;">Card Number:</p>
        <div class="col-md-12" >
      <input class="form-control" id="cc" name="card_num" aria-describedby="help" placeholder="----  ----  ----  ----" onkeypress="return checkDigit(event)" value="<?=$row['card_num']?>">
      <small id="help" class="form-text text-muted">We'll never share your information with anyone else.</small>
    </div>

        <p class="text-left ms-4 mb-1 mt-2" style="font-weight: 500;">Expiry Date/Valid Thru:</p>
        <div class="col-md-12" id="datepicker">
      <input class="form-control" type="month" name="card_expi" id="datepicker" aria-describedby="help" value="<?=$row['card_expi']?>">
      <small id="help" class="form-text text-muted">Expiry date is written with this format MM/YY.</small>
    </div>

        <p class="text-left ms-4 mb-2 mt-2" style="font-weight: 500;">Card CVV:</p>
        <div class="col-md-12">
      <input class="form-control" type="text" name="card_cvv" aria-describedby="help" onkeypress="return isNumberKey(event)" maxlength="4" value="<?=$row['card_cvv']?>">
      <small id="help" class="form-text text-muted">3 or 4 digits usually found on the back of the card.</small>
    </div>
  
    <div class="d-grid gap-2 col-6 mx-auto mt-3" >
            <button class="btn btn-primary" name="submit" type="submit" id="submit">Pay Php 700.00</button>
                </div>
    <?php endif; ?>

    <?php endif; ?>

    <?php endif; ?>

  
</form>

<script src="card.js"></script>
</body>
</html>