<?php


/*

require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}

$queryCodeModule ="SELECT DISTINCT id_module FROM resv_loc";
$resCodeModule = mysqli_query($conn,$queryCodeModule);
while($row = mysqli_fetch_assoc($resCodeModule)){
	$id_module = $row['id_module'];
	$querylocals = "SELECT nom,date,heure,id_module,Module,places_examens as capacity,last FROM resv_loc INNER JOIN locaux ON resv_loc.idLocal = locaux.id AND resv_loc.id_module ='$id_module' ORDER BY last;
	";
	$resultLocals = mysqli_query($conn,$querylocals);
	$queryEtudiant = "SELECT * FROM etudiant WHERE CODE_FIL = '$id_module'";
	$resultEtudiant =mysqli_query($conn,$queryEtudiant);

	while($rowlocals = mysqli_fetch_assoc($resultLocals)){


		$i = 0;
	
		$capacity = $rowlocals['capacity'];
		
			while( $i <$capacity){
			$rowEtudiant = mysqli_fetch_assoc($resultEtudiant);
			if($rowEtudiant){
			$local = $rowlocals['nom'];
			$date = $rowlocals['date'];
			$heure = $rowlocals['heure'];
			$module = $rowlocals['Module'];
			$nom = $rowEtudiant['NOM'];
			$prenom = $rowEtudiant['PRENOM'];
			$apojee = $rowEtudiant['COD_ETD'];
			$CNE = $rowEtudiant['CNE'];
			
				$queryInsert = "INSERT INTO affectation (apojee,local,module,date,heure,CNE,code) VALUES ('$apojee','$local','$module','$date','$heure','$CNE','$id_module')";
					$resultInsert = mysqli_query($conn,$queryInsert);
			}
			
			$i++;

		}
		


	}

	}
	
	



	






?>
*/



require('../includes/connection.php');

$result ="";
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
	header("location:../index.php");
}

require '../includes/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();





$query = "SELECT * FROM etudiant";
$result = mysqli_query($conn, $query);
$i = 1;
$sheet->setCellValueByColumnAndRow(1,1,"date");
$sheet->setCellValueByColumnAndRow(2,1,"heure");
$sheet->setCellValueByColumnAndRow(3,1,"nom");
$sheet->setCellValueByColumnAndRow(4,1,"prenom");
$sheet->setCellValueByColumnAndRow(5,1,"apjee");
$sheet->setCellValueByColumnAndRow(6,1,"cne");
$sheet->setCellValueByColumnAndRow(7,1,"Code_Filiere");
$sheet->setCellValueByColumnAndRow(8,1,"Filiere");
$sheet->setCellValueByColumnAndRow(9,1,"Semestre");
$sheet->setCellValueByColumnAndRow(10,1,"Module");
$sheet->setCellValueByColumnAndRow(11,1,"locaux");
$queryCodeModule ="SELECT DISTINCT id_module FROM resv_loc";
$resCodeModule = mysqli_query($conn,$queryCodeModule);


while($row = mysqli_fetch_assoc($resCodeModule)){
	$id_module = $row['id_module'];
	$querylocals = "SELECT nom,date,heure,id_module,Module,places_examens as capacity,last FROM resv_loc INNER JOIN locaux ON resv_loc.idLocal = locaux.id AND resv_loc.id_module ='$id_module' ORDER BY last;";
	$resultLocals = mysqli_query($conn,$querylocals);
	$queryEtudiant = "SELECT * FROM etudiant WHERE CODE_FIL = '$id_module'";
	$resultEtudiant =mysqli_query($conn,$queryEtudiant);
	while($rowlocals = mysqli_fetch_assoc($resultLocals)){


			$j = 0;

			$capacity = $rowlocals['capacity'];

			while( $j <$capacity){
				$rowEtudiant = mysqli_fetch_assoc($resultEtudiant);

				if($rowEtudiant){
					$local = $rowlocals['nom'];
					$date = $rowlocals['date'];
					$heure = $rowlocals['heure'];
					$module = $rowlocals['Module'];
					$nom = $rowEtudiant['NOM'];
					$prenom = $rowEtudiant['PRENOM'];
					$apojee = $rowEtudiant['COD_ETD'];
					$CNE = $rowEtudiant['CNE'];
					$semestre = $rowEtudiant['SEMESTRE'];
					$filiereName = $rowEtudiant['FILIERE'];

					$sheet->setCellValueByColumnAndRow(1,$i+1,$date);
					$sheet->setCellValueByColumnAndRow(2,$i+1,$heure);
					$sheet->setCellValueByColumnAndRow(3,$i+1,$nom);
					$sheet->setCellValueByColumnAndRow(4,$i+1,$prenom);
					$sheet->setCellValueByColumnAndRow(5,$i+1,$apojee);
					$sheet->setCellValueByColumnAndRow(6,$i+1,$CNE);
					$sheet->setCellValueByColumnAndRow(7,$i+1,$id_module );
					$sheet->setCellValueByColumnAndRow(8,$i+1,$filiereName);
					$sheet->setCellValueByColumnAndRow(9,$i+1,$semestre);
					$sheet->setCellValueByColumnAndRow(10,$i+1,$module);
					$sheet->setCellValueByColumnAndRow(11,$i+1,$local);

					$i++;

				}
				$j++;
			}

		}
	}

	$writer = new Xlsx($spreadsheet); 
	$fileName = 'Etudiant.xlsx';
	header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
	$writer->save('php://output');

// Save .xlsx file to the files directory 
  //$writer->save('C:\My Web Sites\demo.xlsx'); 

?>