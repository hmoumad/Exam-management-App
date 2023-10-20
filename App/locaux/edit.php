
<?php 
$conn = mysqli_connect("localhost","root","","gestion_exam");
$query ="SELECT * FROM locaux";
$result = mysqli_query($conn,$query);
$rowcount = mysqli_num_rows($result);
if(isset($_GET['id']) && isset($_GET['NombreServeillent']) && isset($_GET['local']) && isset($_GET['capacity']) && isset($_GET['update'])){
	$id = $_GET['id'];
	$NombreServeillent = $_GET['NombreServeillent'];
	$local = $_GET['local'];
	$capacity = $_GET['capacity'];
	$query1 ="UPDATE locaux SET Local='$local',Nom_srv = '$NombreServeillent' , Places_examens = '$capacity' WHERE id= '$id'";
	$result1  = mysqli_query($conn,$query1);


}
if(isset($_GET['NombreServeillen']) && isset($_GET['loca']) && isset($_GET['capacit']) && isset($_GET['insert'])){
	echo "sjriogjjgrjrijgr";
	$NombreServeillent = $_GET['NombreServeillen'];
	$local = $_GET['loca'];
	$capacity = $_GET['capacit'];
	$query2 = "INSERT INTO locaux (Local,Nom_srv,Places_examens) VALUES ('$local','$NombreServeillent','$capacity')";
	$result2  = mysqli_query($conn,$query2);

}
if(isset($_GET['id']) && isset($_GET['delete'])){
	
	$id = $_GET['id'];
	$query3 = " DELETE FROM locaux WHERE id='$id'";
	$result3  = mysqli_query($conn,$query3);

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
	*{
		margin: 0;
		padding: 0;
		border-size: border-box;
		font-family: 'Sora', sans-serif;
	}
	table{
		border-collapse: collapse;
	}
		
		td, th {
    border: solid black 1px;
    width: 150px;
    height: 69px;
    text-align: center;
}		.modal{
			position: absolute;
			height: 100vh;
			width: 100%;
			justify-content: center;
			align-items: center;
			z-index: 10;
			background-color: #3931318a;
			
			display: none;
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
		
			.relative {
    position: absolute;
    top: 6px;
    right: 17px;
    font-size: 1.8em;
    cursor: pointer;
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
			text-align: center;
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
			display: hidden;
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
			.containerr{
		width: 100%;
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr ;
	}
	table{
		grid-column: 2/12;
		margin: 10px 0 50px 0 ;
		background: #fcededa8;
	}
		.th {
	    background-color: #e4d5d5;
	    text-align: center;
	    text-transform: capitalize;
	    color: #050505;
	}
.buttons{
	display: flex;
	width: 100%;
	justify-content: space-evenly;
	align-items: center;
}
#add-modal{
	display: none;
}
.delete-btn{
	background-color: #f05a5ae3;
}
.update-btn{
	background-color: #5fd864;
}
.add{
	grid-column: 10/12;
	margin: 25px 0 25px 0;

}
.add-btn{
	width: 100%;
	background-color: #c2ecff;
}
	</style>
	<script defer>


		function sleep(milliseconds) {
			const date = Date.now();
			let currentDate = null;
			do {
				currentDate = Date.now();
			} while (currentDate - date < milliseconds);
		}


		let isSHOW = false;
		function toggle(){
			if(isSHOW == true){
				let modal = document.getElementsByClassName("modal")[0];
				modal.style.display="none";
				isSHOW = false;
			}else{
				let modal = document.getElementsByClassName("modal")[0];
				modal.style.display="flex";
				isSHOW = true;
			}
			

		}

		function toggle2(){
			if(isSHOW ==true){
				let modal = document.getElementsByClassName("add-modal")[0];
				modal.style.display="none";
				isSHOW = false;
			}else{
				let modal = document.getElementsByClassName("add-modal")[0];
				modal.style.display="flex";
				isSHOW = true;
			}
			
		}
function showUpdateModal(id) {
			
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					document.getElementById("modal").innerHTML=this.responseText;
				}
			}
			
			xmlhttp.open("GET","modals.php?id="+id,true);
			
			xmlhttp.send();
			
			toggle();

		}

		function update(id) {
			
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					//document.getElementById("modal").innerHTML=this.responseText;
				}
			}

			let NombreServeillent=document.getElementById("NombreServaint").value;
			let capacity = document.getElementById("capacity").value;
			let local = document.getElementById("local").value;
			xmlhttp.open("GET","?update="+update+"&id="+id+"&NombreServeillent="+NombreServeillent+"&capacity="+capacity+"&local="+local,true);
			
			xmlhttp.send();
			
			toggle();
			sleep(1000);
			window.location.reload(true); 

		}


		function add(){
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					//document.getElementById("modal").innerHTML=this.responseText;
				}
			}

			let NombreServeillent=document.getElementById("NombreServain").value;
			let capacity = document.getElementById("capacit").value;
			let local = document.getElementById("loca").value;
			let insert ="true";
			console.log("local = " + local +"capacity = " + capacity +" nob " +NombreServeillent );
			xmlhttp.open("GET","?insert="+insert+"&NombreServeillen="+NombreServeillent+"&capacit="+capacity+"&loca="+local,true);
			
			xmlhttp.send();
			
			toggle();
			sleep(1000);
			window.location.reload(true); 
		}


		function delet(id){
			console.log(id);
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					//document.getElementById("modal").innerHTML=this.responseText;
				}
			}
			let supprimer = "true";


			xmlhttp.open("GET","?id="+id+"&delete="+supprimer,true);
			
			xmlhttp.send();
			
			toggle();
			sleep(1000);
			window.location.reload(true);
		}

		

		
</script>
</head>
<body>
<div class=" containerr">
	<div class="add">
		<button class="add-btn" onclick="toggle2()">add local</button>
	</div>

	<table>
		<?php 
		if($rowcount != 0){
			?>
			<tr class="th">
				<td>id</td>
				<td>local</td>
				<td>Nbr_servaint</td>
				<td>capacity</td>
				<td>Edit</td>
			</tr>
			<?php 
			while($row = mysqli_fetch_assoc($result)){
				?>
				<tr>
					<td><?php echo $row['id'] ;?></td>
					<td><?php echo $row['Local'] ;?></</td>
					<td><?php echo $row['Nom_srv'];?></td>
					<td ><?php echo $row['Places_examens'];?></td>
					<td class="buttons" >
						<button class="delete-btn" id="<?php echo $row['id'] ;?>" onclick="delet(this.id)" >delete</button>
						<button class="update-btn" id="<?php echo $row['id'] ;?>" onclick="showUpdateModal(this.id)"  >update</button>
					</td>
				</tr>
				<?php
			}

		}

		?>
		
	</table>

</div>
</body>
</html>



<div class="modal" id="modal">
</div>
<div class="modal add-modal" id="add-modal" >
	<div class="dialogue">
		<p class="relative" onclick="toggle2()">&times</p>
		<div class="modal-container">
			<div class="modal-container_title">
				<h1>Add Local</h1>
			</div>
			<div class="localname">
				<label>Local Nom</label>
				<input type="text" width="100%" id="loca" >
			</div>
			<div class="localname local1">
				<label>Capacity</label>
				<input type="text" width="100%" id="capacit">
			</div>
			<div class="localname local2">
				<label>Nombre serviance</label>
				<input type="text" width="100%" id="NombreServain">
			</div>
			<div class="localname local3">
				<button onclick="add()">add</button>
			</div>
			

			
		</div>
	</div>
</div>