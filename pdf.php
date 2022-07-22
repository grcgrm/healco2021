<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<?php

if(isset($_POST['submit']))

{
echo readfile('C:\Users\USER\Documents\Thesis\healco\uploadsParents_Guardians_Consent_for_the_Conduct_of_Face_to_Face_Classes.pdf');
}
?>

<form action="" method="POST">

<button type="submit" name="submit"> VIEW PDF </button>
</form>

</body>
</html>