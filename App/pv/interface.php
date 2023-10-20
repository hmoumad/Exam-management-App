<?php
require('../includes/connection.php');

session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		.section-container{
			display:grid;
			justify-content:center;
			overflow: hidden;
			min-height:500px;
			align-items:center;


		}
		.section-container>.content{
			display: grid;
			grid-gap:20px ;


		}
		.section-container>.content>div {
			min-width: 600px;
			display: grid;
			grid-template-columns: 5fr 5fr;
			justify-content: center;
			align-items: center;
		}
		.section-container>.content>div>label{
			 border-radius: 4px;
		    font-family: 'Montserrat', sans-serif;
		    font-weight: bold;
		    color: rgba(0, 0, 0, 0.582);
		}
		.section-container>.content>div>select , #s3 select {
			width: 353px;
			height: 30px;
		    border-radius: 4px;
		    font-size: 1rem;
		    text-align: center;
		    font-family: 'Montserrat', sans-serif;
		    text-transform: capitalize;
		}
		#s3 select {
			margin-top: 20px;
		}
		.section-container>.content>div>select:focus , #s3 select:focus{
			width: 353px;
			
		}
		.section-container>.content>.button{
			display: flex;
			justify-content: center;
			align-items: center;
		}
		.section-container>.content>.button>button{
			    min-width: 200px;
			    height: 32px;
			    background: #ffe3e0e0;
			    font-size: 1rem;
			    font-style: 'Montserrat', sans-serif;
			    border-radius: 6px;
			    border-width: 1px;
			    font-weight: bold;
			    letter-spacing: 1px;
			    text-transform: capitalize;
		}
		.section-container>.content>.button>button:hover{
			color: white;
			background: #1f7f226b;
		}

	</style>
</head>
<body>
	<div class="section-container">
		<div class="content">
			<div>
				<label for="">Sélectionner un filiere :</label>
				<select name="filiere" class="form-select" aria-label="Default select example" id="s1" onchange ="populate(this.id,'s2')">
					<option disabled selected>click pour choisir une  filiere</option>
					<?php 
					$res =mysqli_query($conn,"SELECT DISTINCT FILIERE from etudiant");
					while($row = mysqli_fetch_assoc($res)){
						?>
						<option value="<?php echo $row['FILIERE'];?>"><?php echo $row['FILIERE'];?></option>
						<?php
					}
					?>
					
				</select>
			</div>
			<div>
				<label >Sélectionner Un Semstre :</label>
				<select id="s2" class="form-select" aria-label="Default select example" name="code_filiere" onchange="populate2()"></select>
			</div>
			<div id="s3">
				
			</div>

			<br>
			<div class="button">
				<button name="section-number" class="btn btn-primary" onclick="downloadpv()">DOWNLOAD</button>
			</div>
			
	

	</div>
</body>


</html>
			
			




