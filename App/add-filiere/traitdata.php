<?php 
require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
if(isset($_GET['ajouter'])){
	echo "halloworld";
	$filiereName = $_GET['filiereName'];
	$semestreName = $_GET['semestreName'];
	$semestreCode = $_GET['semestreCode'];
	mysqli_query($conn,"INSERT INTO codes(filiereName,semestreName,semestreCode) VALUES ('$filiereName','$semestreName','$semestreCode')");
}
if(isset($_GET['modifie'])){
	$filiereName = $_GET['filiereName'];
	$semestreName = $_GET['semestreName'];
	$semestreCode = $_GET['semestreCode'];
	$id=$_GET['id'];
	mysqli_query($conn,"UPDATE codes set filiereName='$filiereName' , semestreName='$semestreName',semestreCode='$semestreCode' WHERE id='$id' ");
}
if(isset($_GET['delete'])){
	$id=$_GET['id'];
	mysqli_query($conn,"DELETE FROM codes WHERE id='$id'");
}
?>