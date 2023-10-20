<?php 
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
require('../includes/connection.php');
if(isset($_GET['filiere'])){
	$filiere = $_GET['filiere'];
	$result = mysqli_query($conn,"SELECT DISTINCT SEMESTRE,CODE_FIL FROM etudiant where FILIERE ='$filiere' group by SEMESTRE");
	?>
	<option value=""></option>
	<?php
	while($row = mysqli_fetch_assoc($result)){
		$code = str_split($row['CODE_FIL'],5);
		$cod = $code[0]."%";
		?>

		<option value="<?php echo $cod;?>"><?php echo $row['SEMESTRE'];?> </option>
		<?php
	}
}
?>