<?php
include_once('../includes/connection.php');
require('../includes/vendor/autoload.php');
$zip = new ZipArchive();
$zipFile = tempnam('/tmp', 'zip');
$zip->open($zipFile, ZipArchive::CREATE);
$section="";

$id_module = $_GET['idmodule'];
$section = $_GET['section'];
if($section != ""){
  $querylocals = "SELECT nom,date,heure,id_module,Module,places_examens as capacity,last FROM resv_loc INNER JOIN locaux ON resv_loc.idLocal = locaux.id AND resv_loc.id_module ='$id_module'  AND section = '$section' ORDER BY last;";
$resultLocals = mysqli_query($conn,$querylocals);
$queryEtudiant = "SELECT * FROM etudiant WHERE CODE_FIL = '$id_module' AND section='$section'";
$resultEtudiant =mysqli_query($conn,$queryEtudiant);


$querylocalstemp = "SELECT nom,date,heure,id_module,Module,places_examens as capacity,last FROM resv_loc INNER JOIN locaux ON resv_loc.idLocal = locaux.id AND resv_loc.id_module ='$id_module' AND section = '$section' ORDER BY last;";
$resultLocalstemp = mysqli_query($conn,$querylocals);
$queryEtudianttemp = "SELECT * FROM etudiant WHERE CODE_FIL = '$id_module' AND section='$section'";
$resultEtudianttemp =mysqli_query($conn,$queryEtudiant);
$raw1=mysqli_fetch_assoc($resultEtudianttemp);
$fil = $raw1['FILIERE'];
$module = $raw1['MODULE'];
$raw2 = mysqli_fetch_assoc($resultLocalstemp);
$date=$raw2['date'];
$heure = $raw2['heure'];
$semes = $raw1['SEMESTRE'];  
}




if($section == ""){
    $section = $_GET['section'];
$querylocals = "SELECT nom,date,heure,id_module,Module,places_examens as capacity,last FROM resv_loc INNER JOIN locaux ON resv_loc.idLocal = locaux.id AND resv_loc.id_module ='$id_module'  ORDER BY last;";
$resultLocals = mysqli_query($conn,$querylocals);
$queryEtudiant = "SELECT * FROM etudiant WHERE CODE_FIL = '$id_module' ";
$resultEtudiant =mysqli_query($conn,$queryEtudiant);


$querylocalstemp = "SELECT nom,date,heure,id_module,Module,places_examens as capacity,last FROM resv_loc INNER JOIN locaux ON resv_loc.idLocal = locaux.id AND resv_loc.id_module ='$id_module'  ORDER BY last;";
$resultLocalstemp = mysqli_query($conn,$querylocals);
$queryEtudianttemp = "SELECT * FROM etudiant WHERE CODE_FIL = '$id_module' ";
$resultEtudianttemp =mysqli_query($conn,$queryEtudiant);
$raw1=mysqli_fetch_assoc($resultEtudianttemp);
$fil = $raw1['FILIERE'];
$module = $raw1['MODULE'];
$raw2 = mysqli_fetch_assoc($resultLocalstemp);
$date=$raw2['date'];
$heure = $raw2['heure'];
$semes = $raw1['SEMESTRE'];
}
while($rowlocals = mysqli_fetch_assoc($resultLocals)){
    $loc = $raw2['nom'];

    $j = 0;
    $body = '<br>
            <div class="p">
                <table>
                    <tr>
                        <th>N°ORD</th>
                        <th>N°APOJEE</th>
                        <th>CNE</th>
                        <th>Nom</th>
                        <th>PRENOM</th>
                        <th>Local</th>
                        <th>OBSERVATION</th>
                    </tr>';
                

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
                    
                    $body.='<tr><td>'.($j+1).'</td>
                     <td>'.$apojee.'</td>
                      <td>'.$CNE.'</td> 
                      <td>'.$nom.'</td> 
                      <td>'.$prenom.'</td>
                       <td>'.$local.'</td>
                       <td></td>
                    </tr>;';

                }
                $j++;
            }
            $body .='</table>
            </div>'; 

$html ='<body>
<div class="container">
    <table class="header">
        <tr>
            <td><p>Université Sultan Moulay Slimane<br>
                Faculté Polydisciplinaire<br>
            Béni Mellal</p></td>
            <td><img src="../includes/assets/images/fpbmlogo.png" width="100px" height="100px"></td>
            <td><p dir="rtl">جامعة السلطان مولاي سليمان </p></br><p dir="rtl">الكلية المتعددة التخصصات </p></br>
<p dir="rtl">بني ملال</p>
</td>
        </tr>
    </table>
    <hr>

    
        <div class="generale_Information">
            <p>A.U : 2021/2022</p>
            <p>FICHE D\'ABSENSE</p>
            <p>CENTRE :BENI MELLAL</p>
            <p>Filière : '.$fil.'</p>
            <p>Module: '.$module.'</p>
        </div>
        <div class="general_information2">
            <table>

                <tr>
                    <td class"first-child">local:'.$local.'</td>
                    <td></td>

                    <td class="last-child"></td>
                </tr>
                <tr>
                    <td first-child>Semestre:'.$semes.'</td>
                    <td></td>

                    <td last-child>Date:'.$date.'</td>
                </tr>
                <tr>
                    <td first-child></td>
                    <td></td>

                    <td last-child>Heure: '.$heure.' </td>
                </tr>
                <tr>
                    <td first-child>Durée:....................</td>
                    <td></td>

                    <td last-child></td>
                </tr>
            </table>
         </div>
         <div class="section3">
             <table>
                 <tr>
                        <th>N_ord</th>
                         <th>Nom Prénom</th>
                         <th>C.N.E</th>
                         <th>N_ord</th>
                         <th>Nom Prénom</th>
                         <th>C.N.E</th>
             </tr>
                 <tr class="last-child"> <td></td>
                         <td><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td></td></tr>
             </table>
         </div>
         <div class="section4">
             <p>Nombre de présents :..........................................</p>

             <p>Nombre des absents :...........................................</p>
             <p>Surveilliants:</p>
             <table>
                 <tr>
                     <th>Nom</th>
                     <th>Prénom</th>
                     <th>Teléphone</th>
                     <th>Emargement</th>
                 </tr>
                 <tr>
                     <td><br></td>
                     <td></td>
                     <td></td>
                     <td></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td><br></td>
                     <td></td>
                     <td></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td></td>
                     <td><br></td>
                     <td></td>
                 </tr>
                 <tr>
                    <td></td>
                 <td></td>
                 <td></td>
                 <td><br></td>
             </tr>
             </table>
             <p>Observation</p>
             <p>..................................................................................................................................................................................</p><p>..................................................................................................................................................................................</p>
         </div>
        

    </div>
    


</body>';
$header = '

<div class="container2">
    <table class="table1">
        <tr class="first-child">
            <td>UNIVERSITE SULTAN MOULAY SLIMANE <br> FACULTE POLYDISCIPLINAIRE <br>BENI MELLAL</td>
            <td>A.U: 2019/2020</td>
            
        </tr>
        <tr>
            <td><br></td>
        </tr>
        <tr class="last-child">
            <td colspan="2">Filiere:'.$fil.'<br>Semestre:'.$semes.'<br>SECTION:'.$section.'<br>Module : '.$module.'</td>
            
        </tr>
    </table>
</div>';



$mpdf= new \Mpdf\Mpdf(['mode' => 'utf-8','format' => 'A4','margin_left' => 0,'margin_right' => 0,'margin_top' => 0,'margin_bottom' => 20,'margin_header' => 0,'margin_footer' => 0]); //use this customization

$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;
$stylesheet = file_get_contents('pv.css');
$mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
$mpdf->WriteHTML($html);
$mpdf->defaultheaderline = 0;
$mpdf->setHeader($header);
/*$mpdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        5, // margin_left
        5, // margin right
       0, // margin top
       30, // margin bottom
        0, // margin header
        0);
        */
$mpdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        5, // margin_left
        5, // margin right
       45, // margin top
       30, // margin bottom
        0, // margin header
        0);

$mpdf->WriteHTML($body);
ob_clean(); 
$i = $date.'-'.$fil.'--'.$module.'--'.$local;
/*$mpdf->Output("pdf.pdf",'D');*/
$pdfData = $mpdf->Output("", \Mpdf\Output\Destination::STRING_RETURN);
        $zip->addFromString("{$i}.pdf", $pdfData);

}

 $zip->close();
    $zipname=$fil.'-'.$module.'-'.$section;
    header("Content-type: application/zip");
    header('Content-Disposition: attachment; filename='.$zipname.'.zip'); 
    readfile($zipFile);
    unlink($zipFile);
    exit;


?>