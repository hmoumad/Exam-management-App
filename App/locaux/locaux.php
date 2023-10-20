
	<?php 
	require('../includes/connection.php');
	session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
	$result = "";
	$rowcount ="";
	$result1="";
	$date = "SELECT DISTINCT date FROM calendrie";
	$res_date = mysqli_query($conn,$date);
	$heure = "SELECT DISTINCT Heure FROM calendrie";
	$res_heure = mysqli_query($conn,$heure);

	if(isset($_GET['idresv_loc'])){
		$idresv_loc  = $_GET['idresv_loc'];
		$query_idresv_loc  =  "DELETE FROM resv_loc WHERE id = '$idresv_loc'";
		$result_idresv_loc = mysqli_query($conn,$query_idresv_loc);  
	}
	if(isset($_GET['date']) && isset($_GET['heure']) && isset($_GET['id_module']) && isset($_GET['idLocal'])){
		echo "okay";
		$date = $_GET['date'];
		$section = $_GET['section'];
		$heure = $_GET['heure'];
		$idModule = $_GET['id_module'];
		$idLocal = $_GET['idLocal'];
		$queryModuleName = "SELECT DISTINCT Module FROM calendrie WHERE code = '$idModule'";
		$resModuleName = mysqli_query($conn,$queryModuleName);
		$row = mysqli_fetch_assoc($resModuleName);
		$ModuleName = $row['Module'];
		$ModuleName = str_replace("'", "\'", $ModuleName);
		$q = "SELECT * FROM locaux WHERE id ='$idLocal'";
		$res = mysqli_query($conn,$q);
		$row = mysqli_fetch_assoc($res);
		$localname=$row['Local'];
		$false = "false";
		if(isset($_GET['last'])){
			$last = $_GET['last'];
			$query = "INSERT INTO resv_loc(Module,idLocal,nom,date,heure,id_module,section,last) VALUES('$ModuleName','$idLocal','$localname','$date','$heure','$idModule','$section','$last')";
		}else{
			$query = "INSERT INTO resv_loc(Module,idLocal,nom,date,heure,id_module,section,last) VALUES('$ModuleName','$idLocal','$localname','$date','$heure','$idModule','$section','$false')";
		}
		
		$result = mysqli_query($conn,$query) or die(mysql_error());
		if(!$result){
			
			echo "error"; 
		}
	}


	?>

	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Fruktur&family=Sora:wght@100;300;400&display=swap" rel="stylesheet">
		<style>


		body{
			font-family: 'Sora', sans-serif;
		}
		.locaux{
			height: 20px;
			align-items: center;
		}
		#p{	
			text-align: center;
			font-size: 30px;
			position: sticky;
			width: 100%;
			background-color:#ababab;
			top: 0;

		}
		#p span{
			color: white;
		}
		form{
			display: grid;
			grid-template-columns: 2fr 2fr;
			align-items: center;
			justify-content: center;
		}
		th{
			text-transform: capitalize;
		}
		select{
		margin-top:100px;
		height: 50px;
		width: 182px;
		
		margin: 20px;
		list-style-type: none;
			

		box-shadow: 0px 2px 5px 2px #535254ad;
		outline: none;
		
		background-color: #e5e5df;

		height: 30px;
		border-radius: 4px;
		font-size: 1rem;
		text-align: center;
		font-family: 'Montserrat', sans-serif;
		text-transform: capitalize;

		}
		option{
			height: 50px;
			border-radius: 20px;
			width: 150px;
			text-align: center;

		}
		
		.rest-container {
			height: 50px;
			width: 100%;
		}
		.center {
			display: flex;
			justify-content: center;
		}
		
	</style>
	<script type="text/javascript">
		

	</script>
	</head>
	<body>
		<p id="p">the text goes here</p>
		<div>
			<div class="containe">
				<div class="center">
					<form action="" method="post">
					<select id="date" name="date" onchange="checkifselected()">
						<option value="selectDate" disabled selected>CHOISIR DATE</option>
						<?php 

						while($row = mysqli_fetch_assoc($res_date)){
							?>
							<option  value="<?php echo $row['date'] ?>"><?php echo $row['date'] ?></option>
							<?php 
						}
						?>
					</select>

					<select id="heure" name="heure" onchange="checkifselected()">
						<option value="selectHeure" disabled selected> CHOISIR HEURE</option>
						<?php 

						while( $row = mysqli_fetch_assoc($res_heure) ){
							?>
							<option value="<?php echo $row['Heure'] ;?>"><?php echo $row['Heure'] ;?></option>
							<?php 
						}
						?>
					</select>
				</form>
				</div>

				<p id="p"></p>
				<div id="div">

				</div>
			</div>

		</body>

		</html>