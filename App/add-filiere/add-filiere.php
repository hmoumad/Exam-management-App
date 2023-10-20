<?php 
require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
$result  = false;
$query ="CREATE TABLE Codes(
id int NOT NULL AUTO_INCREMENT,
filiereName varchar(10),
filiereCode varchar(10),
semestreName varchar(30),
semestreCode varchar(30),
PRIMARY KEY (id) )";

mysqli_query($conn,$query);

$result = mysqli_query($conn,"SELECT * FROM Codes")


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
	.add-filiere_container{
		margin: 10px;
		

	}
	.add-filiere_container>.table-container{
		width: 90%;
		margin: 0 auto;

	}
	.add-filiere_container>.table-container table{
		border-collapse: collapse;
		width: 100%;
	}
	table >thead{
		background-color: #91c1bde0;
	}
	table>tbody{
		background-color: #dfdfdf;
	}
	th{
		text-transform: uppercase;
	}
	td ,th{
		border: solid black 1px;
		height: 30px;
		text-align: center;
		font-family: 'Montserrat', sans-serif;


	}

	/*this is random shit */
	.add-filiere_container{
		position: relative;
	}
	.modal{
	background-color: #0000009e;
    position: absolute;
    display: none;
    top: 0;
    left: 0;
    position: fixed;
    height: 100vh;
    width: 100%;
    justify-content: center;
    align-items: center;
	}
	.modal_content{
		width: 420px;
		height: 400px;
		background-color: #e8eeecf5;
		border-radius: 5px;
	}
	.modal_content h1{
		margin-top: 20px;
		text-align: center;
		font-style: 'Montserrat', sans-serif;
		color: rgba(0, 0, 0, 0.582);

	}
	.modal_header {
		position: relative;
	}

	.times{
		position: absolute;
		top: -25px;
		right: 10px;
		font-size: 2.5rem;
		cursor: pointer;
	}
	.modal-champs{
		width: 90%;
		margin: 20px auto;


	}
	.modal-champs>div{
		margin:20px  5px ;
		display: grid;
		grid-template-columns:5fr;
		grid-gap: 10px;
		justify-content: center;
		align-items: center;
	}
	.modal-champs>div>label{
		border-radius: 4px;
		    font-family: 'Montserrat', sans-serif;
		    font-weight: bold;
		    color: rgba(0, 0, 0, 0.582);
	}
	.modal-champs>div>input{
			height: 30px;
		    border-radius: 4px;
		    border: solid black 1px;
		    font-size: 1rem;
		    text-align: center;
		    font-family: 'Montserrat', sans-serif;
		    text-transform: capitalize;
	}
	.button{
		display: flex;
		justify-content: center;
		align-items: center;

	}
	.button>button,.table-container>div>button{
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
	.button>button:hover,.table-container>div>button:hover{
		color: white;
		background: #1f7f226b;
	}
	.table-container>div{
		display: flex;
		justify-content: flex-end;
		margin: 15px 0;

	}
	/*button{
		margin: 5px;
	 min-width: 100px;
			    height: 28px;
			    background: #ffe3e0e0;
			    font-size: 1rem;
			    font-style: 'Montserrat', sans-serif;
			    border-radius: 6px;
			    border-width: 1px;
			    text-transform: capitalize;
	}*/
	.modifie{
		background-color: #11e5198a;
		margin: 5px;
	 min-width: 100px;
			    height: 28px;
			    background: #ffe3e0e0;
			    font-size: 1rem;
			    font-style: 'Montserrat', sans-serif;
			    border-radius: 6px;
			    border-width: 1px;
			    text-transform: capitalize;
	}
	.delete{
		margin: 5px;
	 min-width: 100px;
			    height: 28px;
			    background: #ffe3e0e0;
			    font-size: 1rem;
			    font-style: 'Montserrat', sans-serif;
			    border-radius: 6px;
			    border-width: 1px;
			    text-transform: capitalize;
		background-color: #ff5a5a;
	}
	.table-container>.populatefiliere{
		justify-content: center;
	}
	
	

	
</style>
</head>
<body >

		<div class="add-filiere_container">
			<p style="font-style: 'Montserrat', sans-serif;text-align: center;font-size: 1.1rem;text-transform: capitalize;    color: rgba(0, 0, 0, 0.582);
">ici vous pouvez ajouter des branches à la base de données</p>
			
			<div class="table-container">
				<div>
				<button onclick="openModal()">ajouter</button>
			</div>
				<table>
					<thead>
						<tr>
							<th>id</th>
							<th>filiere Name</th>
							<th>SEMESTRE</th>
							<th>code Module</th>
							<th>editer</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if($result){
							$i = 1;
							while($row = mysqli_fetch_assoc($result)){
								?>
								<tr>
								<td>
									<?php echo $row['id']; ?>
								</td>
								<td>
									<?php echo $row['filiereName']; ?>
								</td>
							
								<td>
									<?php echo $row['semestreName']; ?>
								</td>
								<td>
									<?php echo $row['semestreCode']; ?>
								</td>
								<td>
									<button id="<?php echo $i;$i++; ?>"  class="modifie" onclick="openModal2(this.id)">modifie</button>
									<button class="delete" onclick="deletet(<?php echo $row['id'];?>)" >delete</button>
								</td>
								</tr>



								<?php

							}	
						}
						?>
					</tbody>
				</table>
				<div class="populatefiliere">
					<button onclick="populatefiliere()">INSERT FILIERE</button>
				</div>
			

			</div>
			<div class="modal" id="modal">
				<div class="modal_content">
					<div class="modal_header">
						<div class="modal_header_title">
							<h1>AJOUTE</h1>
						</div>
						<div class="times" onclick="toggle()">&times</div>
					</div>
					<div class="modal-champs">
						<div class="1">
							<input type="text" id="filiereName" placeholder="entre le nom de filiere ex:SMI">
						</div>
						<div class="1">
							
							<input type="text" id="semestreName" placeholder="entree le nom de semestre ex:S1">
						</div>
						
						<div class="1">
						
							<input type="text" id="semestreCode" placeholder="entre le code de cette semestre ex:PFA11%">
						</div>
					</div>
					<div class="button">
						<button onclick="addfiliereData()">Ajouter</button>
					</div>
				</div>
			</div>
			<div class="modal" id="modal2">
				<div class="modal_content">
					<div class="modal_header">
						<div class="modal_header_title">
							<h1>UPDATE</h1>
						</div>
						<div class="times" onclick="toggle2()">&times</div>
					</div>
					<div class="modal-champs">
						<input type="text" id="id" hidden>
						<div class="1">
							<input type="text" id="filiereName2" placeholder="entre le nom de filiere ex:SMI">
						</div>
						<div class="1">
							
							<input type="text" id="semestreName2" placeholder="entree le nom de semestre ex:S1">
						</div>
						
						<div class="1">
						
							<input type="text" id="semestreCode2" placeholder="entre le code de cette semestre ex:PFA11%">
						</div>
					</div>
					<div class="button">
						<button onclick="updatefiliereData2(document.getElementById('id').value )">update</button>
					</div>
				</div>
			</div>
		</div>
		
		



		
	
	
	



	
</body>

</html>