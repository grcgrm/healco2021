<?php  

if (isset($_SESSION['username']) && isset($_SESSION['id'])) {

    if(isset($_GET['view']))
    {
        $id = $_GET['view'];
        $sql = "SELECT * FROM patient WHERE id= $id";
        $res = mysqli_query($conn, $sql);
    
    }
    
    
}else{
	header("Location: index.php");
} 