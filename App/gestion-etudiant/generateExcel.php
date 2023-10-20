<?php 


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
$res =mysqli_query($conn,"SHOW COLUMNS FROM etudiant");
$output = array();
while($row = mysqli_fetch_assoc($res)){
 $output[] = $row['Field']; 
}
for($j=1;$j < sizeof($output);$j++){
  $sheet->setCellValueByColumnAndRow($j,1,$output[$j]);
  
}

while($row= mysqli_fetch_assoc($result)){

  $cod_etd = $row['COD_ETD'];
  $cin = $row["CIN"];
  $cne = $row["CNE"];
  $nom = $row['NOM'];
  $module = $row['MODULE'];

  $sheet->setCellValueByColumnAndRow(1,$i+1,$cod_etd);
  $sheet->setCellValueByColumnAndRow(2,$i+1,$cne);
  $sheet->setCellValueByColumnAndRow(3,$i+1,$nom);
  $sheet->setCellValueByColumnAndRow(4,$i+1,$row['PRENOM']);
  $sheet->setCellValueByColumnAndRow(5,$i+1,$row['DATE_NAISSANCE']);
  $sheet->setCellValueByColumnAndRow(6,$i+1,$cin);
  $sheet->setCellValueByColumnAndRow(7,$i+1,$row['CODE_FIL']);
  $sheet->setCellValueByColumnAndRow(8,$i+1,$row['MODULE']);
  $sheet->setCellValueByColumnAndRow(9,$i+1,$row['SECTION']);
  $sheet->setCellValueByColumnAndRow(10,$i+1,$row['FILIERE']);
  $sheet->setCellValueByColumnAndRow(11,$i+1,$row['SEMESTRE']);
  $i++;
}

$writer = new Xlsx($spreadsheet); 
$fileName = 'Etudiant.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
$writer->save('php://output');

// Save .xlsx file to the files directory 
  //$writer->save('C:\My Web Sites\demo.xlsx'); 
?>