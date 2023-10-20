<?php

require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
if($_SERVER['REQUEST_METHOD']=="GET"){
	if(isset($_GET['prof'])){
		$prof = $_GET['prof'];
		//$result= mysqli_query($conn,"SELECT * FROM oc  WHERE surv='$prof' OR responsable='$prof' ");
		$prof = "%".$prof."%";
		$result=mysqli_query($conn,"SELECT DISTINCT c.date,c.heure,Module,responsable,id_module FROM oc c INNER JOIN calendrie ON code = id_module AND c.section = calendrie.section WHERE  responsable like '$prof' ORDER BY c.date asc,c.heure desc ");
		$result2=mysqli_query($conn,"SELECT distinct  id,c.date,c.heure,Module,responsable,local,surv FROM oc  INNER JOIN calendrie c ON code = id_module and oc.section = c.section WHERE  surv like '$prof'  ORDER BY c.date asc,c.heure desc ");

	}
}
 ?>

 	<style>
 	.con{
 		width: 90%;
 			margin: 0 auto;
 	}
 	
 		 table{
		border-collapse: collapse;
		width: 100%;
		margin:0 0 50px 0;
	}
	table >thead{
		background-color:#91c1bde0;
	}
	table>tbody{
		background-color: #dfdfdf;

	}
	
	th{
		text-transform: capitalize;
		color: #272525;
	}
	td ,th{
		border: solid black 1px;
		height: 30px;
		text-align: center;
		font-family: 'Montserrat', sans-serif;


	}
 	</style>


 	<div class="con">
 		<table>
 			<thead>
		 				<tr>
		 			<th colspan="4">RESPONSABLE</th>
		 		</tr>
		 		<tr>
		 			<th>responsable</th>
		 			<th>DATE</th>
		 			<th>HEURE</th>
		 			<th>MODULE</th>
		 		</tr>
 			</thead>
 		<tbody>
	 			<?php
		 		while($raw = mysqli_fetch_assoc($result)){
		 			?>
		 			<tr>
		 				<td><?php echo $raw['responsable'];?></td>
		 				<td><?php echo $raw['date']; ?></td>
		 				<td><?php echo $raw['heure'];?></td>
		 				<td><?php echo $raw['Module'];?></td>
		 			</tr>
		 			<?php
		 		}
	 			?>
 		</tbody>
 		
 	</table>
 	<h1>nombre surveillie <?php echo mysqli_num_rows($result2); ?></h1>
 		<table>
 			<thead>
		 				<tr>
		 			<th colspan="5">Surveillient</th>
		 		</tr>
		 		<tr>
		 			<th>surv</th>

		 			<th>DATE</th>
		 			<th>HEURE</th>
		 			<th>MODULE</th>
		 			<th>local</th>
		 			
		 			 			
		 		</tr>
 			</thead>
 			<tbody>
		 				<?php
			 		while($raw = mysqli_fetch_assoc($result2)){
			 			?>
			 			<tr>
			 				
			 				<td><?php echo $raw['surv'];?></td>
			 				<td><?php echo $raw['date']; ?></td>
			 				<td><?php echo $raw['heure'];?></td>
			 				<td><?php echo $raw['Module'];?></td>
			 				<td><?php echo $raw['local'];?></td>
			 				
			 				
			 				
			 			</tr>
			 			<?php
			 		 
			 		}
		 		?>
 			</tbody>
 		
 		
 	</table>





 		<table>
 			<thead>
		 				<tr>
		 			<th colspan="5">Surveillient</th>
		 		</tr>
		 		<tr>
		 			<th>count</th>

		 			<th>surv</th>
		 			
		 			
		 			 			
		 		</tr>
 			</thead>
 			<tbody>
		 				<?php
		 				$result3 = mysqli_query($conn,"SELECT COUNT(*) as count,ocupee FROM resv_prof GROUP by ocupee HAVING COUNT(*)<12");
			 		while($raw = mysqli_fetch_assoc($result3)){
			 			?>
			 			<tr>
			 				
			 				<td><?php echo $raw['count'];?></td>
			 				<td><?php echo $raw['ocupee']; ?></td>
			 				
			 				
			 				
			 				
			 			</tr>
			 			<?php
			 		 
			 		}
		 		?>
 			</tbody>
 		
 		
 	</table>
 		
 	</div>
 	
 	
 	




 </body>
 </html>


