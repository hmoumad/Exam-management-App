<?php 
require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
if(!$conn){
echo "shit this is not working sma7 lina a si dris ";
}
$rowcount = "";
/* effective de tous les etudiant dans chaque module d'examen */
$query = "SELECT date FROM calendrie group by date ORDER BY date asc ";
$result = mysqli_query($conn,$query);
$rowcount = mysqli_num_rows($result);

$q = "SELECT COUNT(*) as effective , CODE_FIL,SECTION FROM etudiant GROUP BY CODE_FIL,SECTION";
$res = mysqli_query($conn,$q) ;

while($row = mysqli_fetch_assoc($res)){
    $effective = $row['effective'];
    $CODE_FIL = $row['CODE_FIL'];
    $SECTION = $row['SECTION'];
    $q = "UPDATE calendrie SET effective  = '$effective' WHERE code = '$CODE_FIL' AND SECTION='$SECTION'" ;
    mysqli_query($conn,$q);
}

?>

<style>

	*{
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}


		
        .containerr{
            width: 90%;
            margin: 0 auto;
            margin-bottom: 50px;
        }
      
        .containerr table td,.containerr table th{
            font-size :16px;
        }
        /*---------------------*/
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
        /*----------------------*/


        .button-container{
        	margin: 20px 0;
        	display: flex;
        	align-items: center;
        }
        .button-container>img{
        	width: 40px;
        	margin: 0 20px;
        }
        .button-container>a{
        	text-decoration: none;
        	font-size: 1.1rem;
        	font-style: 'Montserrat', sans-serif;
        	border-radius: 6px;
        	border-width: 1px;
        	text-transform: capitalize;
        	color: white;
        	font-weight: bold;
        }
        .button-container2{
            flex-direction: column;
        }
        .a{
            border: solid black 0.1px;
            margin: 17px;
            padding: 15px;


        }
        .a:hover{
            background-color: #175a54;
            color: white;
            box-shadow: 5px 6px 6px 2px black;

        }

		</style>



</head>
<body>
    <div class="containerr">
    	<div class="button-container">
                <img src="../log/include/images/excel.png" alt="">
                <a href="../affectEtudiant/generateExcel.php" name="afficheALL"  class="btn btn-primary">generate Excel file</a>
            </div>

   
    <table>
    	<thead>
        <tr class="th">
            <th>date</th>
            <th>filiere</th>
            <th>semestre</th>
            <th>section</th>
            <th>MODULE</th>
            <th>Responsable de module </th>
            <th>heure</th>
            <th>effective</th>
            <th>locaux</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $rowcount1 = "0";
        while($row = mysqli_fetch_assoc($result)){
            ?>
            
            <tr>

                <?php
                $date = $row['date'] ;
                $query1 ="SELECT date,Filière,sem,section,Module,Responsable_module,Heure,effective,code FROM calendrie WHERE date = '$date' ORDER BY heure asc";
                

                $result1 = mysqli_query($conn,$query1);
                if(!$result1){
                    echo 'what the hck';
                }
                $rowcount1 = mysqli_num_rows($result1);

                ?>
                <td rowspan ="<?php echo $rowcount1; ?>"><?php echo $row['date'] ?></td>
                <?php 
                while($row1 = mysqli_fetch_assoc($result1)){
                    ?>
                    <td><?php echo  $row1['Filière'] ;?></td>
                    <td><?php echo $row1['sem'] ;?></td>
                     <td><?php echo $row1['section'] ;?></td>
                    <td><?php echo $row1['Module'] ;?></td>
                    <td><?php echo $row1['Responsable_module'] ;?></td>
                    <td><?php echo $row1['Heure'] ;?></td>
                    <td><?php echo $row1['effective'] ;?></td>
                    <td>
                        <?php 
                            $heure = $row1['Heure'];
                            $section = $row1['section'];
                            $code = $row1['code'];
                            $query_locaux = "SELECT * FROM resv_loc WHERE id_module = '$code' && date='$date' && heure='$heure' and section = '$section'  ORDER BY last asc";
                            $result_locaux = mysqli_query($conn,$query_locaux);
                             $rowcount = mysqli_num_rows($result_locaux);
                            if($rowcount != 0){
                                $nomlocal = "";
                               
                                $i = 0;
                                while($row_locaux = mysqli_fetch_assoc($result_locaux) ){
                                    $i++;
                                    $local = $row_locaux['nom'];
                                    $nomlocal .= $local;
                                    if($i != $rowcount){
                                        $nomlocal .= " , ";
                                    }
                                    
                                }
                                $nomlocal .= " ";
                                echo $nomlocal;
                            }
                        ?>
                    </td>
                </tr>
                <?php
            }
            ?>
            <?php 
        }
        
        
        ?>
        </tbody>
    </table>
    <div class="button-container2 button-container">
        <p>appuyer sur le button , si vous etre d'accord avec les resultal affiché dans la calendrie  </p>
        <a class="a" href="../affectEtudiant/duffisionLocalSurEtudiant.php">Affect Etudiant </a>
    </div>
    </div>
    
</body>
</html>