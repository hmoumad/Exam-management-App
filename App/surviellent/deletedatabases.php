<?php


require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}

$query = "DROP TABLE oc";
$r = mysqli_query($conn,$query);
        
$query = "DROP TABLE resv_prof";
$r1 = mysqli_query($conn,$query);

 ?>