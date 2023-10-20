<?php
require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
        //i want to know all the theacher that are responsable of each module 
$res =mysqli_query($conn,"SELECT COUNT(*) as count,ocupee FROM resv_prof GROUP BY ocupee;");
$profs = array();
        $somme = 0;

while($row = mysqli_fetch_assoc($res)){
    $responsable = $row['ocupee'];
    $count = $row['count'];
    $somme = $somme + (12 - $count);
}


$res = mysqli_query($conn,"SELECT COUNT(*)as count FROM oc WHERE surv =''");
$row = mysqli_fetch_assoc($res);
$count = $row['count'];

$count = $count - $somme;
$count = ceil($count / 12);

$r =mysqli_query($conn,"SELECT DISTINCT ocupee FROM resv_prof GROUP BY `ocupee` having count(*)<12");
while($row = mysqli_fetch_assoc($r)){
    $o = $row['ocupee'];
    array_push($profs,$o);

}



$m =mysqli_query($conn,"SELECT distinct prof from listprof WHERE prof NOT IN (SELECT DISTINCT ocupee FROM resv_prof GROUP BY `ocupee` having count(*)>=12 ) LIMIT $count");
        //$count = $count - $somme to know how much we really need to 
        //$count = seil($count / 12)
        // to find how many person we want 
        //select all the prof after removing the prof that has a count of 12 atleast 
        //limit $count 
if($m){
        while($row = mysqli_fetch_assoc($m)){
        $o = $row['prof'];
        array_push($profs,$o);
    }
}



$dates  = array();
 $datess=mysqli_query($conn,"SELECT DISTINCT date FROM oc order by date asc");
 while($row = mysqli_fetch_assoc($datess)){
    array_push($dates,$row['date']);
 }

foreach($profs as $prof){
    $nbrOcurrenceProf = 0;
    $resultPROF  = mysqli_query($conn,"SELECT * FROM resv_prof WHERE ocupee = '$prof'");
    if($resultPROF){
        $nbrOcurrenceProf = mysqli_num_rows($resultPROF);
    }else{
        $nbrOcurrenceProf = 0;
    }
    

    $nbrRest  = 12 - $nbrOcurrenceProf;
    


   
    foreach($dates as $date){

        
        
        $heures = mysqli_query($conn,"SELECT DISTINCT heure FROM oc WHERE (date='$date') AND (responsable='$prof' OR surv = '$prof')");

        $allheures = mysqli_query($conn,"SELECT DISTINCT heure FROM oc WHERE date='$date'");
        $arALLhours = array();
        while($row = mysqli_fetch_assoc($allheures)){
            $h = $row['heure'];
           
            array_push($arALLhours,$h);
        }
        $affectedhours = array();


        if($heures){
            while($row = mysqli_fetch_assoc($heures)){
            $h=$row['heure'];
           
            array_push($affectedhours ,$h);
        }

        }
        



        $numberofaffectedrows  = sizeof($affectedhours);
        if($numberofaffectedrows >= 2){
            break;
        }else{
            $allrows = sizeof($arALLhours);
            $i = $allrows - $numberofaffectedrows;

            $notaffectedhours = array_values(array_diff($arALLhours,$affectedhours));
            print_r($notaffectedhours);
            
            $j = 0;
            foreach($notaffectedhours as $heure){
                if($i > 2){
                    $i=2;
                }
                if($nbrRest > 0 AND $j != $i){
                    
                    $theone = mysqli_query($conn,"SELECT * FROM oc  WHERE surv='' AND date='$date' AND heure='$heure' limit 1" );

                        //new code 
                    if(mysqli_num_rows($theone)!=0){
                        $theone = mysqli_fetch_assoc($theone);
                        $id = $theone['id'];
                        $id_module =$theone['id_module'];
                        
                      


                        $chek = mysqli_query($conn,"UPDATE oc SET surv = '$prof' WHERE id='$id'");
                        if($chek){
                           mysqli_query($conn,"INSERT INTO resv_prof(date,heure,id_module,ocupee) VALUES ('$date','$heure','$id_module','$prof')");
                           $j++;
                           $nbrRest--;

                       }
                       

                   }
                }else{
                    break;
                }
                


        }
    }


}
}

?>
