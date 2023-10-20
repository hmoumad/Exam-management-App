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
 	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 	<title>Document</title>
 	<style>
 	.surviellent-container{
width: 90%;
margin: 20px auto;
 	}
 		table{
 			
 			width: 100%;
 			height: 500px;
 			border-collapse: collapse;
            background: #897272b5;
 		padding: 50px;
 		}
 		td{border: solid black 1px;
 			text-align: center;
 		}
        .buttons{
            padding: 8px;
    border-radius: 6px;
    border: solid black 3px;
    border-style: double;
    border-block-color: ths;
    background: #03e7d2;
        }
 	</style>
 </head>
 <body>
 	<div class="surviellent-container">
 		<table>
            <caption>the order is important</caption>
 		<tbody>
 			<tr>
 				<td>
 					<button class="buttons" onclick="surveillentDeleteDatabase('../surviellent/deletedatabases.php')" >click Me! </button>
 				</td>
 				<td>
 					<p>delete databases </p>
 				</td>
 			</tr>
 			<tr>
 				<td>
 					<button class="buttons"  onclick="surveillentDeleteDatabase('../surviellent/firststep.php')">click Me! </button>
 				</td>
 				<td>
 					<p>create and populate databases oc and resv prof with the initial values  </p>
 				</td>
 			</tr>
 			<tr>
 				<td><button class="buttons" onclick="surveillentDeleteDatabase('../surviellent/SecondStep.php')">click Me!</button></td>
 				<td>
 					<p>alloue a chaque responsable 2 seances</p>
 				</td>
 			</tr>
 			<tr>
 				<td><button class="buttons" onclick="surveillentDeleteDatabase('../surviellent/Stepthree.php')" >click Me! </button></td>
 				<td>
 					<p>complete a chaque proffessier son 12 seances</p>
 				</td>
 			</tr>
 			<tr>
 				<td><button class="buttons"  onclick="surveillentDeleteDatabase('../surviellent/finalstep.php' )">click Me! </button></td>
 				<td>
 					<p>completé aves les doctorant ou les prof qui ne sont pas responsable de module</p>
 				</td>
 			</tr>
 		</tbody>
 	</table>
 		
 	</div>
 	

 	
 </body>
 </html>