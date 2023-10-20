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
$date = $_GET['date'];
$heure = $_GET['heure'];
if(!empty($_GET['id'])){
	$id= $_GET['id'];
}

else{
	$id = 0 ;
	?>
<?php
}
if($id == 0){
	$query = "SELECT Date,filière,sem,code,Module,Heure,effective,section FROM calendrie WHERE date ='$date' AND Heure ='$heure' ORDER BY effective DESC limit 1 ";
}
else{

	$query = "SELECT Date,filière,sem,code,Module,Heure,effective,section FROM calendrie WHERE date ='$date' AND Heure ='$heure' ORDER BY effective  DESC limit $id ,1 ";
}

$result = mysqli_query($conn,$query);
$rowcount = mysqli_num_rows($result);
$query1 = "SELECT SUM(effective) as somme FROM calendrie WHERE date ='$date' AND Heure ='$heure' ";
$result1 = mysqli_query($conn,$query1);
$query2 ="SELECT * FROM locaux WHERE id NOT IN (SELECT idLocal from resv_loc WHERE date='$date' AND heure = '$heure') ";
$result2 = mysqli_query($conn,$query2);
$query3 = "SELECT Date,filière,sem,Module,Heure,effective FROM calendrie WHERE date ='$date' AND Heure ='$heure' ORDER BY effective DESC";
$result3 =  mysqli_query($conn,$query3);
$rowcount3 = mysqli_num_rows($result3);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	
	<style>
	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}
	
	.locaux{
		display: grid;
		height: 30px;
		grid-template-columns: 2fr 1fr 1fr 1fr;
		width: 200px;
		border-bottom: solid black 1px;
		width: 100%;
	}
	p{
		font-weight: 400;
		font-size: 1.1em;

	}
	.locaux .places {
		margin-bottom:0 ;
		/*width: 10%;*/
	}
	.locaux input{
		align-items: center;
	}
	.locaux lable {
		grid-column: 1/3;
	}
	.button-btn{
		display: flex;
		justify-content: center;
		align-items: center;
		height: 100vh;
		width: 10%;
	}		
	.containerr{
		width: 100%;
		display: grid;
		grid-template-columns: 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr 1fr ;
	}
	table{
		grid-column: 2/12;
	}
	.button-btn1{
		grid-column: 1/2;
		display: flex;
		align-items: center;
		justify-content: center;
	}
	.button-btn2{
		grid-column: 12/13;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.button3 {
		display: inline-block;
		padding: 0.3em 1.2em;
		margin: 0 0.3em 0.3em 0;
		border-radius: 2em;
		box-sizing: border-box;
		text-decoration: none;
		font-weight: 400;
		/* background-color: #4eb5f1; */
		background: #fffa65;
		text-align: center;
		transition: all 0.2s;
		height: 43px;
		width: 88px
		;}
		@media all and (max-width:30em){
			.button3{
				display:block;
				margin:0.2em auto;
			}
		}

		
		.btn-submit{
			display: flex;
			align-items: center;
			justify-content: center;
			height: 100px;
		}
		input[type="checkbox"]:last-child{
			color: red;
			border-bottom: none;
		}
		.selected_locaux{
			display: grid;
			grid-template-columns: repeat(12, 1fr);
			margin-bottom: 150px;
		}
		
		.delete_button{
			border: 1px solid black;
			border-radius: 2em;
			height: 2em;
			width: 5em;
			shape-outside: border-box;
			background-color: #fffa65;
			box-shadow: -1px -4px 4px 1px #535254ad;
			outline: none;
		}
		.delete_button:hover{
			background-color: red;
			box-shadow: 0px 0px 0px 0px red;

		}
		.locals , .last,.places ,.p{
			display: flex;
			align-items: center;
			justify-content: center;
			width: 100%;
		}

		/* table css */
		 table{
		border-collapse: collapse;
		width: 100%;
	}
	table >thead{
		background-color:#91c1bde0;
	}
	table>tbody{
		background-color: #dfdfdf;
	}
	tr{
		height: 50px;
	}
	th{
		text-transform: capitalize;
		color: #272525;
	}
	td ,th{
		border: solid black 1px;
		height: 50px;
		height: 30px;
		text-align: center;
		font-family: 'Montserrat', sans-serif;


	}
		/* end of table css */
		
		

	</style>

	



</head>

	<div>
		<div class="containerr">
			<div class="button-btn1">
				<?php 
				if($id != 0){
					?>

					<button class="button3" onclick="decreace()">previous</button>

					<?php
				}
				?>
			</div>


			<table>
				<thead>
						<tr>
						<th>date</th>
						<th>filiere</th>
						<th>SEMESTRE</th>
						<th>section</th>
						<th>code</th>
						<th>Module</th>
						<th>effective</th>
						<th>somme</th>
						<th>les locaux</th>
						</tr>
				</thead>
				<tbody>
					
				
				<?php 
				if($rowcount){
					$row1 = mysqli_fetch_assoc($result1);
					$i=0;
					while($row = mysqli_fetch_assoc($result)){
						?>


						<tr>
							<td><?php echo $row['Date'] ;?></td>
							<td><?php echo  $row['filière'] ;?></td>
							<td ><?php echo  $row['sem'] ;?></td>
							<td id="section"><?php echo $row['section'] ;?></td>
							<td id="code" value="<?php echo  $row['code'] ;?>"><?php echo  $row['code'] ;?></td>
							<td><?php echo  $row['Module'] ;?></td>
							<td value="<?php echo $row['effective'];?>"><p id="effect" ><?php echo $row['effective']  ;?></p></td>
							<?php 
							if($i == 0){
								?>
								<td rowspan="<?php echo $rowcount ; ?>"><?php echo $row1['somme']  ;?></td>
								<?php 	
							}
							?>
							<td>
								<div class="locaux">
								
										<p >local</p>
										<p class="p">select</p>
										<p class="p">last</p>
										<p class="p">capacity</p>
									</div>
									
								<?php
								$i;
								while($row = mysqli_fetch_assoc($result2)){
									?>
									<div class="locaux" >

										<label><?php echo $row['Local'];?></label>
										<input  type="checkbox" name="<?php echo $row['Local'];?>" id="<?php echo $row['id'];?>" class="locals" value="<?php echo $row['Places_examens'];?>" onchange="numbre(this.id)" >

										<input  type="checkbox" class="last" >

										<p class="places"><?php echo $row['Places_examens'];?></p>


									</div>

									<?php 
									$i++;
								}

								?>
							</td>


						</tr>
						</tbody>
				

						<?php
						$i++;
					}
				}

				?>

			</table>
			<div class="button-btn2">
				<?php 
				if($id != $rowcount3 -1 ){
					?>


					<button class="button3" onclick="increament()">next</button>


					<?php
				}
				?>
			</div>


		</div>	
		<div class="btn-submit">

			<button class="button3" name="submit" onclick="filled_resv_loc()">submit</button>


		</div>

	</div>
	<?php

	$query_selectedlocals="SELECT * FROM resv_loc WHERE date='$date' AND heure='$heure' ORDER BY last asc;";
	$result_selectedlocals=mysqli_query($conn,$query_selectedlocals);
	if(!$result_selectedlocals){
		echo "what the heck";
	}
	$rowcount_selectedlocals = mysqli_num_rows($result_selectedlocals);


	 ?>
	<div class="selected_locaux">
		<?php 
		echo $rowcount_selectedlocals ;
			if($rowcount_selectedlocals != 0){
			?>
			<table>
				<thead>
					
				
				<tr class="th">
				<th>Module</th>
				<th>Local</th>
				<th>code module</th>
				<th>date</th>
				<th>heure</th>
				<th>delete</th>
			
				</tr>
			</thead>
			<tbody>
				
			
				<?php 

					while ($row = mysqli_fetch_assoc($result_selectedlocals)) {

						?>
						<tr>
							<td><?php echo $row['Module'];?></td>
							<td><?php echo $row['nom'] ; ?></td>
							<td><?php echo $row['id_module'] ; ?></td>
							<td><?php echo $row['date'] ; ?></td>
							<td><?php echo $row['heure'] ; ?></td>
							<td><button class="delete_button" id="<?php echo $row['id'] ; ?>" onclick="deletelocal(this.id)">delete</button>

							</td>

						</tr>



						<?php
					}

				?>
				</tbody>
			</table>




			<?php 

			}


		?>
		
	</div>