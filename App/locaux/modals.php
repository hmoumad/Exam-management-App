<?php 

$conn = mysqli_connect("localhost","root","","gestion_exam");
$result1=null;

if(isset($_GET['id'])){

	$id = $_GET['id'];
	echo $id;
	$query1  = "SELECT * FROM locaux WHERE id='$id'";
	$result1 = mysqli_query($conn,$query1);
	$rowcount1 = mysqli_num_rows($result1);
	$row1 = mysqli_fetch_assoc($result1);
	$local = $row1['Local'];
}else{
	echo "the id is not set you must pass by edit.php";
}
echo $local;
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
			.modal{
			position: absolute;
			height: 100vh;
			width: 100%;
			justify-content: center;
			align-items: center;
			z-index: 10;
			background-color: #3931318a;
			position: fixed;

		}
		body{
			position: relative;
			background-color: #7e7eff1c;
		}
		.dialogue{
			background-color: #e8eeecf5;
			width: 400px;
			height: 500px;
			position: relative;
			grid-gap: 20px;

		}
		.relative{
			position: absolute;
			top: 5px;
			right: 12px;
			font-size: 1.4em;
			cursor: pointer;
			transition-duration: 0.5s;

		}
		.relative:hover{
			font-size: 1.8rem;
			color: black;
			font-weight: 500;
		}
		.modal-container{
			display: grid;
			grid-template-columns: repeat(13, 1fr);
			grid-template-rows: repeat(5, 1fr);
			height: 100%;
			width: 100%;
		}
		.modal-container_title{
			grid-column: 1/14;
			display: flex;
			justify-content: center;
			align-items: center;

		}
		.localname {
		    grid-column: 2/13;
		    grid-row: 2/3;
		}
		input{
			width: 100%;
			height: 40px;
			border: solid #8c8b8b 2px;
			outline: none;
			border-radius: 6px;
		}
		.modal-container_title h1{
			color: #3a3a3a;
			
			font-size: 1.5rem;
			border-bottom: black 1px solid;
		}
		label{
			font-size: 1em;
			font-weight: 500;
			    color: #3a3a40;

		}
		.modal{
			display: flex;
		}
		.local1{

		    grid-row: 3/4;
		}
		.local2{
			grid-row: 4/5;
		}
		.local3{
			grid-row: 5/6;
			display: flex;
			justify-content: center;
			justify-items: center;
			align-items: center;
		}
		button{
		    height: 43px;
		    width: 132px;
		    border-radius: 10px;
		    background: #cfcfcf;
		    font-size: 16px;
		    font-weight: 500;
		    outline: none;
		}
	</style>
</head>
<body>
	
</body>
</html>

<div class="modal" id="modal">
	<div class="dialogue">
		<p class="relative" onclick="toggle()" title="close">&times</p>
		<div class="modal-container">
			<div class="modal-container_title">
				<h1>Edit Local</h1>
			</div>
			<div class="localname">
				<label>Local Nom</label>
				<input type="text" width="100%" id="local" value="<?php echo $row1['Local'];?>">
			</div>
			<div class="localname local1" >
				<label>Capacity</label>
				<input type="text" width="100%" id="capacity" value="<?php echo $row1['Places_examens'];?>">
			</div>
			<div class="localname local2">
				<label>Nombre serviance</label>
				<input type="text" width="100%" id="NombreServaint" value="<?php echo $row1['Nom_srv'];?>">
			</div>
			<div class="localname local3">
				<button onclick="update(<?php echo $row1['id'];?>)">Update</button>
			</div>
			

			
		</div>
	</div>
</div>

