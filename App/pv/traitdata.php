<?php 
require('../includes/connection.php');

session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}

$id_module = $_GET['idmodule'];
$result =mysqli_query($conn,"SELECT DISTINCT Module,CODE_FIL FROM etudiant WHERE CODE_FIL like '$id_module'");
$result2 = mysqli_query($conn,"SELECT DISTINCT SECTION FROM etudiant WHERE CODE_FIL like '$id_module'");

?>
<label >Sélectionner Un Module :</label>
<select id="d" class="form-select" aria-label="Default select example" name="code_filiere">
					
				
<option></option><?php
while($row = mysqli_fetch_assoc($result)){
	?>
<option value="<?php echo $row['CODE_FIL'] ;?>"><?php echo $row['Module'];?></option>

	<?php
}

?>
</select >
<label for="">SECTION</label>
<select id="section" class="form-select" aria-label="Default select example">
	<option value=""></option>
	<?php

	while($row = mysqli_fetch_assoc($result2)){
		?>
		<option value="<?php echo $row['SECTION'] ;?>"> <?php echo $row['SECTION'] ;?> </option>

		<?php
	}	
	 ?>
	
</select>

<?php




?>