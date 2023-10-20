<?php
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
		.input{
			display: flex;
			justify-content: center;
			align-items: center;
			margin: 10px;
		}
		
		
		input{
			
			  display: block;
    height: 25px;
    width: 300px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
		}
		input:focus{
			border: solid #1000f76b 1px;
		    box-shadow: 1px 3px 1px 3px #1000f76b;
		    outline: none;
		}
	</style>
</head>
<body>
	<h1 style="text-align: center;">INTERFACE TEMP POUR VERIFY IF WHAT WE DID IS CORRECT </h1>
	<div class="input">
		<input type="text" id="prof" placeholder="search by prof" oninput="suggests()"></input>
	</div>

	<div id="checkcontent"></div>
	

</body>
<script type="text/javascript">
	

</script>
</html>