<?php 

$conn = mysqli_connect("localhost","root","","gestion_exam");
$result1=null;
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}

if(isset($_GET['id'])){

	$id = $_GET['id'];
	$query1  = "SELECT * FROM etudiant WHERE id='$id'";
	$result1 = mysqli_query($conn,$query1);
	$rowcount1 = mysqli_num_rows($result1);
	$row1 = mysqli_fetch_assoc($result1);
	
}

?>

<div class="modal" id="modal">
				<div class="modal_content">
					<div class="modal_header">
						<div class="modal_header_title">
							<h1>Modifie</h1>
						</div>
						<div class="times" onclick="toggle()">&times</div>
					</div>
					<div class="modal-champs">
						<input type="text" id="id" value="<?php echo $id;?>" hidden>
						<div class="a1">
							<label>Code Apojee</label>
							<input type="text" id="COD_ETD" value="<?php echo $row1['COD_ETD'];?>">
						</div>
						<div class="a1">
							<label>Nom</label>
							<input type="text" id="NOM" value="<?php echo $row1['NOM'];?>">
						</div>
						<div class="a1">
							
							<label>PRENOM</label>
				<input type="text" id="PRENOM" value="<?php echo $row1['PRENOM'];?>">
						</div>
						
						<div class="a1">
						
							<label>CNE</label>
				<input type="text" id="CNE" value="<?php echo $row1['CNE'];?>">
						</div>
						<div class="a1">
						
								<label>CIN</label>
				<input type="text" id="CIN" value="<?php echo $row1['CIN'];?>">
						</div>
						<div class="a1">
						
						<label>FILIERE</label>
				<input type="text" id="FILIERE" value="<?php echo $row1['FILIERE'];?>">
						</div>
						<div class="a1">
						
							<label>SEMESTRE</label>
				<input type="text" id="SEMESTRE" value="<?php echo $row1['SEMESTRE'];?>">
						</div>
						
						<div class="a1">
						
							<label>	SECTION</label>
				<input type="text" id="SECTION" value="<?php echo $row1['SECTION'];?>">
						</div>
						<div class="a1">
						
							<label>MODULE</label>
				<input type="text" id="MODULE" value="<?php echo $row1['MODULE'];?>">
						</div>

					</div>
					<div class="button">
						<button onclick="modifieEtd()">Submit</button>
					</div>
				</div>
			</div>
