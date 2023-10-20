<?php 
require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
if(isset($_GET['id'])){
    $idETD = $_GET['id'];
    $CNE = $_GET['CNE'];
    $PRENOM = $_GET['PRENOM'];
    $NOM = $_GET['NOM'];
   
    $SEMESTRE = $_GET['SEMESTRE'];
    $SECTION = $_GET['SECTION'];
    $MODULE = $_GET['MODULE'];
    $FILIERE = $_GET['FILIERE'];
    $CIN = $_GET['CIN'];
    $query = "UPDATE etudiant SET CNE='$CNE',NOM='$NOM',PRENOM='$PRENOM',CIN='$CIN',MODULE='$MODULE',SECTION='$SECTION',FILIERE='$FILIERE',SEMESTRE='$SEMESTRE' WHERE id = '$idETD'"; 
    mysqli_query($conn,$query);
   $url = 'edit-etudiant.php?apojee='.$_POST['COD_ETD'];
   echo '<script type="text/javascript"> window.location="'.$url.'";</script>';
}

?>