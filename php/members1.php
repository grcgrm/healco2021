<?php  

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
    
    $sql = "SELECT * FROM patient WHERE username= '".$_SESSION['username']."' ORDER BY id ASC ";
    $res = mysqli_query($conn, $sql);
}else{
	header("Location: index.php");
} 