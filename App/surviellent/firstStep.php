<?php


require('../includes/connection.php');
session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}


$query = "SELECT * FROM resv_loc r INNER JOIN locaux l ON r.idLocal = l.id INNER JOIN calendrie c ON r.id_module = c.code AND c.section = r.SECTION ;";
        $result = mysqli_query($conn,$query);
        if(!$result){

        }


        $query2 = "CREATE TABLE oc( 
        id int NOT NULL AUTO_INCREMENT,
        date varchar(33),
        heure varchar(33),
        id_module varchar(8),
        local varchar(10),
        responsable varchar(20),
        section varchar(20),
        surv varchar(50) default '',
        PRIMARY KEY (id)
    ) ";
    $result2 = mysqli_query($conn,$query2);
    if(!$result2){

    }


    $query2 = "CREATE TABLE resv_prof( 
    id int NOT NULL AUTO_INCREMENT,
    date varchar(33),
    heure varchar(33),
    id_module varchar(8),
    ocupee varchar(20),
    PRIMARY KEY (id)
    ) ";
    $result2 = mysqli_query($conn,$query2);
    if(!$result2){

    }

     while($row = mysqli_fetch_assoc($result)){
        $number_of_occurence = $row['Nom_srv'];

        $date = $row['date'];

        $heure =$row['heure'];

        $id_module =$row['id_module'];

        $local = $row['Local'];
        $section = $row['section'];
        echo $section;
        $responsable = $row['Responsable_module'];
        $responsable = strtoupper($responsable);
        for($i = 0 ; $i< $number_of_occurence ; $i++){
            $query = "INSERT INTO `oc`(`date`, `heure`, `id_module`, `local`, `responsable`,`section`) VALUES ('$date','$heure','$id_module','$local','$responsable','$section')";
            $r = mysqli_query($conn,$query);
            if(!$r){
                        //echo "the fuck is ha";
            }
        }
    }



    $query = "SELECT DISTINCT date ,heure,id_module,responsable FROM oc;";
    $result3 = mysqli_query($conn,$query);

    while($row = mysqli_fetch_assoc($result3)){


        $date = $row['date'];

        $heure =$row['heure'];

        $id_module =$row['id_module'];

        $responsable = $row['responsable'];
        $responsable = strtoupper($responsable);
        $query1 = "INSERT INTO resv_prof (date,heure,id_module,ocupee ) VALUES ('$date','$heure','$id_module','$responsable') ";
        mysqli_query($conn,$query1);

    }




?>