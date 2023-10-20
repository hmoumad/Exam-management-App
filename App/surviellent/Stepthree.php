<?php
require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
$res =mysqli_query($conn,"SELECT DISTINCT responsable FROM oc");
        while($row = mysqli_fetch_assoc($res)){
            $responsable =  $row['responsable'];
          
            //first we have to check if there they have more than 12 occurence in resv_prof table if we do we move to the next teacher 
            //after finding that the prof has less than 12 hours we should give him all the possible times that 
            //we sheck the day where he has no fucking seance in hitax deja fatna had lproplim fi lawal 
            //and than khasna n3tiwh 2 dyal l7issas 
            //walking ila kan ghir hisa wahd li khawya 
            //iwa axe ghadi ndiro fi dik l7ala 
            //2 - ila kan lprof dipassa hadik l3iba li 9alna khaso maydipassihax 
            /* 

                1-khasna njobo kola responsable                                           ex:biniz
                2-khasna n7asbo ch7al mn mara kayn fi array dyal responsable prof         ex:7
                3-khasna njobo days li l prof 3ando fihoum module
                4-khasna njibo 9a3 les dates o n7aydo manhoum lyam li 3and lprof fihoum module 
                hna 3andna lprof 3ando 6 dyal hissas matalan idan b9aw lih 6    :               12 - 6
                5-anchado 9a3 liyam li lprof ma3ando hta hissa fihoum o andiro
                  05-03-2021   
                khasna njibo 9a3 les tranche li kaynin fih matalan 9:00 10:30        etc
                ila kan resultat dyal l query >0 alors kayna blassa khawya lih 
                        dik sa3a ghadi na3tiwh l seance o ghadi ndozo l tranche 2 
                        ila kant khawya ghadi na3tiwh hissa akhra 
                        o dik sa3a khas douz nhar tani hitax sf darna 2 seances 
                        !!!!!
                        mais ila kant hadik l value li khasha t incrementa kol mara texecuta fiha lquery kbar man 12 khas kolxi i7bas 
                        else dakxi mzyan 
                        fi l cas dyalna ghadi ndozo l nhar tani 
                        o n3awdo
                        !!!!



    

            */
            $resultPROF  = mysqli_query($conn,"SELECT DISTINCT date,heure,ocupee FROM resv_prof WHERE ocupee = '$responsable'");
            $nbrOcurrenceProf = mysqli_num_rows($resultPROF);
           
            $nbrRest  = 12 - $nbrOcurrenceProf;
            
            
            //gets all dates from db
            $dates  = array();
            $dbALLdates = mysqli_query($conn,"SELECT DISTINCT date FROM oc ");
            while($row = mysqli_fetch_assoc($dbALLdates)){
                array_push($dates,$row['date']);
            }
            //gets all the days that the prof have seance or just has one seance in it 
            $profDates=array();
            $dbprofdates = mysqli_query($conn,"SELECT DISTINCT date FROM oc WHERE surv ='$responsable' OR responsable='$responsable'");
            while($row = mysqli_fetch_assoc($dbprofdates)){
                array_push($profDates,$row['date']);
            }
            $dates = array_values(array_diff($dates,$profDates));
            
            foreach ($dates as $day) {
               
                //get all the tranches in that day 
                $restranche = mysqli_query($conn,"SELECT DISTINCT heure FROM oc WHERE surv='' AND date='$day'");
                $i=0;
                if(mysqli_num_rows($restranche) >= 2 ){
                    while($row = mysqli_fetch_assoc($restranche)){
                        if($nbrRest > 0  AND $i<2  ){
                            $heure = $row['heure'];
                        
                        $theone = mysqli_query($conn,"SELECT * FROM oc  WHERE surv='' AND date='$day' AND heure='$heure' limit 1" );
                        $theone = mysqli_fetch_assoc($theone);
                        $id = $theone['id'];
                        $id_module =$theone['id_module'];
                        


                        mysqli_query($conn,"UPDATE oc SET surv = '$responsable' WHERE id='$id'");
                        $chek = mysqli_query($conn,"INSERT INTO resv_prof(date,heure,id_module,ocupee) VALUES ('$day','$heure','$id_module','$responsable')");
                        $i++;
                        $nbrRest--;  


                        }else{
                            break;
                        }
                                          
                        
                    }

                }

                // code...
            }







           
        }

?>