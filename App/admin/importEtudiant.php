

<?php
// (A) CONNECT TO DATABASE - CHANGE SETTINGS TO YOUR OWN!


require('../includes/connection.php');
require '../includes/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();


ini_set('memory_limit', '-1');
if(isset($_POST['uploadEtudiant'])){
    mysqli_query($conn,"DELETE FROM etudiant");
   $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

$d=$spreadsheet->getSheet(0)->toArray();

echo count($d);

$sheetData = $spreadsheet->getActiveSheet()->toArray();

$i=1;
unset($sheetData[0]);

foreach ($sheetData as $t ) {
 // process element here;
    echo $i."---".$t[0].",".$t[4]." <br>";
    $t[2]  = str_replace("'","\'",$t[2]);
    $t[3] = str_replace("'","\'",$t[3]);
    $t[7] = str_replace("'","\'",$t[7]);
    $result = mysqli_query($conn,"INSERT INTO etudiant (id,COD_ETD,CNE,NOM,PRENOM,DATE_NAISSANCE,CIN,CODE_FIL,MODULE,SECTION,FILIERE,SEMESTRE) VALUES ('$i','$t[0]','$t[1]','$t[2]','$t[3]','$t[4]','$t[5]','$t[6]','$t[7]','$t[8]','$t[9]','$t[10]')");
    if(!$result){
        $result2 = mysqli_query($conn,"INSERT INTO etudiant (id,COD_ETD,CNE,NOM,PRENOM,DATE_NAISSANCE,CIN,CODE_FIL,MODULE,SECTION,FILIERE,SEMESTRE) VALUES ('$i','$t[0]','$t[1]','$t[2]','$t[3]','$t[4]','$t[5]','$t[6]','$t[7]','$t[8]','$t[9]','$t[10]')");
        if(!$result2){
            echo 'error ';
        }
    }

    $i++;
} 
}

if(isset($_POST['uploadcalendrie'])){
      $spreadsheet = $reader->load($_FILES['file2']['tmp_name']);
      if(isset($_FILES['file2']['tmp_name'])){
        mysqli_query($conn,"DELETE FROM calendrie");
        mysqli_query($conn,"DELETE FROM resv_loc");
        sleep(5);
      }
      $d=$spreadsheet->getSheet(0)->toArray();

     echo count($d);

     $sheetData = $spreadsheet->getActiveSheet()->toArray();

    $i=1;
    unset($sheetData[0]);

foreach ($sheetData as $t ) {
 // process element here;
    //echo $i."---".$t[0].",".$t[4]." <br>";
    $t[0] = str_replace("\\","-",$t[0]);
     $t[5] = str_replace("'","\'",$t[5]);
    $t[6] = str_replace("'","\'",$t[6]);
    $t[7] =  str_replace("9h00-10h30","09h00-10h30",$t[7]);
    $result = mysqli_query($conn,"INSERT INTO calendrie (`Date`,`code`,`Filière`,`Sem`,`section`,`Module`,`Responsable_module`,`Heure`,`effective`) VALUES ('$t[0]','$t[1]','$t[2]','$t[3]','$t[4]','$t[5]','$t[6]','$t[7]','$t[8]')");
    if(!$result){
    
            echo  "Error: "  . "<br>" . mysqli_error($conn);
    }

    $i++;
    

        
        $str = $t[9];
        $strArray = explode("+",$str);
        print_r($strArray);
        $n = sizeof($strArray);
        echo "-----------------".$n."---------------</br>";
        $n = $n-1;

        for($j=0;$j<$n;$j++){

            $module = $t[5];
            $result = mysqli_query($conn,"INSERT INTO resv_loc (`Module`,`nom`,`date`,`heure`,`id_module`,`section`,`last`) values ('$t[5]','$strArray[$j]','$t[0]','$t[7]','$t[1]','$t[4]','false')");
            if(!$result){
                            echo  "Error: "  . "<br>" . mysqli_error($conn);

            }


        }
        mysqli_query($conn,"INSERT INTO resv_loc (`Module`,`nom`,`date`,`heure`,`id_module`,`section`,`last`) values ('$t[5]','$strArray[$n]','$t[0]','$t[7]','$t[1]','$t[4]','true')");


}

    $resultats = mysqli_query($conn,"SELECT * FROM locaux");
    while($row = mysqli_fetch_assoc($resultats)){
        $nom = $row['Local'];
        $id= $row['id'];
        mysqli_query($conn,"UPDATE resv_loc SET idLocal='$id' WHERE nom = '$nom'");
    }
}


if(isset($_POST['uploadlocal'])){
      $spreadsheet = $reader->load($_FILES['file3']['tmp_name']);
      if(isset($_FILES['file3']['tmp_name'])){
        mysqli_query($conn,"DELETE FROM locaux");
      }
      $d=$spreadsheet->getSheet(0)->toArray();

     echo count($d);

     $sheetData = $spreadsheet->getActiveSheet()->toArray();

    $i=1;
    unset($sheetData[0]);

foreach ($sheetData as $t ) {
 

    $result = mysqli_query($conn,"INSERT INTO locaux (`id`,`Local`,`Nom_srv`,`Places_examens`) VALUES ('$i','$t[0]','$t[1]','$t[2]')");
    if(!$result){
    
            echo  "Error: "  . "<br>" . mysqli_error($conn);
    }

    $i++;
} 
}

?>