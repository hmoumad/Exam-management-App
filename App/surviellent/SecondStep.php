<?php

require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}



 $query = "SELECT DISTINCT date FROM oc";
    $dates  = mysqli_query($conn,$query);
    if(!$dates){
        echo "dates does not working ";
    }

            //

    while($rowDates = mysqli_fetch_assoc($dates)){
        $date = $rowDates['date'];
      

        $query = "SELECT DISTINCT responsable FROM oc WHERE date='$date'";
        $responsables = mysqli_query($conn,$query);
        if(!$responsables){
            
        }else{

            while($rowResponsable = mysqli_fetch_assoc($responsables)){
                $responsable = $rowResponsable['responsable'];
                $artimes = array();
                $arProfOcupee = array();
              
                $res = mysqli_query($conn,"SELECT DISTINCT heure FROM calendrie WHERE date='$date'");
                while ($row = mysqli_fetch_assoc($res)) {
                    array_push($artimes,$row['heure']);
                }

                $res = mysqli_query($conn,"SELECT DISTINCT heure FROM resv_prof WHERE date='$date' AND ocupee = '$responsable'");
                while ($row = mysqli_fetch_assoc($res)) {
                    array_push($arProfOcupee,$row['heure']);
                }

                $artimes = array_values(array_diff($artimes,$arProfOcupee));
                        //$artimes represent only the times that the prof is not occupied 
                $i = 0;
                $counter = 0;
                

                while($i<2 AND $counter < sizeof($artimes)){


                    $res =mysqli_query($conn,"SELECT * FROM oc WHERE date='$date' and heure='$artimes[$counter]' and surv=''");
                            //means atles on result found 
                    if(mysqli_num_rows($res) != 0){
                        $row = mysqli_fetch_assoc($res);
                        $id  = $row['id'];

                        $heure =$row['heure'];

                        $id_module =$row['id_module'];

                        mysqli_query($conn,"UPDATE oc SET surv = '$responsable' WHERE id='$id'");
                        mysqli_query($conn,"INSERT INTO resv_prof(date,heure,id_module,ocupee) VALUES ('$date','$heure','$id_module','$responsable')");

                        $i++;
                    }
                    $counter++;


                }




            }
        }
    }

?>