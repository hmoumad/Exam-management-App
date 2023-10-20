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






$query = "SELECT * FROM calendrie";
$result = mysqli_query($conn, $query);
$i = 1;


  $sheet->setCellValueByColumnAndRow(1,1,"date");
  $sheet->setCellValueByColumnAndRow(2,1,"heure");
  $sheet->setCellValueByColumnAndRow(3,1,"Code_Filiere");
  $sheet->setCellValueByColumnAndRow(4,1,"Filiere");
  $sheet->setCellValueByColumnAndRow(5,1,"Semestre");
  $sheet->setCellValueByColumnAndRow(6,1,"Section");
  $sheet->setCellValueByColumnAndRow(7,1,"Module");
  $sheet->setCellValueByColumnAndRow(8,1,"Responsable de Module");
  $sheet->setCellValueByColumnAndRow(9,1,"Effective");
  $sheet->setCellValueByColumnAndRow(10,1,"locaux");

  


while($row= mysqli_fetch_assoc($result)){

  $date = $row['Date'];
  $heure = $row["Heure"];
  $Code_Filiere = $row["code"];
  $Filière = $row['Filière'];
  $module = $row['Module'];
  $semstre = $row['Sem'];
  $section=$row['section'];
  $responsable=$row['Responsable_module'];
  $effective = $row['effective'];

                            
  $query_locaux = "SELECT * FROM resv_loc WHERE id_module = '$Code_Filiere' and section = '$section' and `date`='$date' and heure='$heure' ORDER BY last asc";
  $result_locaux = mysqli_query($conn,$query_locaux);
  $nomlocal = "";
  $rowcount = mysqli_num_rows($result_locaux);
      if($rowcount != 0){
        $nomlocal = "";
        $j = 0;
        while($row_locaux = mysqli_fetch_assoc($result_locaux) ){
          $j++;
          $local = $row_locaux['nom'];
          $nomlocal .= $local;
          if($j != $rowcount){
            $nomlocal .= " , ";
          }

        }
        $nomlocal .= " ";
       $nomlocal;
      }

  $sheet->setCellValueByColumnAndRow(1,$i+1,$date);
  $sheet->setCellValueByColumnAndRow(2,$i+1,$heure);
  $sheet->setCellValueByColumnAndRow(3,$i+1,$Code_Filiere );
  $sheet->setCellValueByColumnAndRow(4,$i+1,$Filière);
  $sheet->setCellValueByColumnAndRow(5,$i+1,$semstre);
  $sheet->setCellValueByColumnAndRow(6,$i+1,$section);
  $sheet->setCellValueByColumnAndRow(7,$i+1,$module);
   
  $sheet->setCellValueByColumnAndRow(8,$i+1,$responsable);
  $sheet->setCellValueByColumnAndRow(9,$i+1,$effective );
  $sheet->setCellValueByColumnAndRow(10,$i+1,$nomlocal);
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