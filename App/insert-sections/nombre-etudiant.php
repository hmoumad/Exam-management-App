<?php 
ob_start();

session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}

require('../includes/connection.php');
$result ="";
$submit =true;
if($_SERVER['REQUEST_METHOD']=="GET"){
    if(isset($_GET['filiere'])){

        $filiere = $_GET['filiere'];
        $codeFiliere = $_GET['code_filiere'] ;

        $query = "SELECT COUNT(DISTINCT COD_ETD) AS Netd FROM etudiant WHERE CODE_FIL LIKE '$codeFiliere'";
        $result = mysqli_query($conn,$query);
        $codeSEMSETRE = $codeFiliere;
        $codeSEMSETRE  = str_split($codeSEMSETRE,1);
        $numberSemestre = $codeSEMSETRE[4];
        $semstre = 'S'.$numberSemestre;
        $row = mysqli_fetch_assoc($result);
        $numberEtudiant = $row['Netd'];

    }if(isset($_GET['submit'])){
        $submit=false;
        $codeFiliere = $_GET['codeFiliere'];

        $query = "DELETE FROM etd_section";
        mysqli_query($conn,$query);
        $query = "ALTER TABLE etd_section AUTO_INCREMENT=1;";
        mysqli_query($conn,$query);
        $query = "SELECT DISTINCT COD_ETD,CIN,NOM,PRENOM,SECTION,FILIERE,SEMESTRE FROM etudiant WHERE CODE_FIL LIKE '$codeFiliere' order by NOM ";
        $res  = mysqli_query($conn,$query);

        $nombreEtudiant = $_GET['nombreEtudiant'];
        
        $nombreSection = $_GET['nombreSection'];
        $nbrEtdParSection = (int) $nombreEtudiant / $nombreSection;
        $nbrEtdParSection = ceil( $nbrEtdParSection);


        


        $query = "INSERT INTO etd_section(COD_ETD,filiere,semster) SELECT DISTINCT COD_ETD,FILIERE,SEMESTRE FROM etudiant WHERE CODE_FIL like '$codeFiliere' order by NOM ";
        mysqli_query($conn,$query);

        $nb1= $nbrEtdParSection;
        $nb2 = $nb1 * 2 ;
        $nb3 = $nb1 * 3;
        $nb4 = $nb1 * 4;


        if($nombreSection == 1 ){
          $query = "UPDATE etd_section set section = null  ";
          mysqli_query($conn,$query);
      }else if($nombreSection == 2){
        $query ="UPDATE etd_section set section ='SECTION A ' WHERE id between 0 AND '$nb1'";
        mysqli_query($conn,$query);
        $query ="UPDATE etd_section set section ='SECTION B ' WHERE id between '$nb1' AND '$nb2'";
        mysqli_query($conn,$query);
    }else if($nombreSection == 3){
        $query ="UPDATE etd_section set section ='SECTION A ' WHERE id between 0 AND '$nb1'";
        mysqli_query($conn,$query);
        $query ="UPDATE etd_section set section ='SECTION B ' WHERE id between '$nb1' AND '$nb2'";
        mysqli_query($conn,$query);
        $query ="UPDATE etd_section set section ='SECTION C ' WHERE id between '$nb2' AND '$nb3'";
        mysqli_query($conn,$query);
        
    }else if($nombreSection == 4){
        $query ="UPDATE etd_section set section ='SECTION A ' WHERE id between 0 AND '$nb1'";
        mysqli_query($conn,$query);
        $query ="UPDATE etd_section set section ='SECTION B ' WHERE id between '$nb1' AND '$nb2'";
        mysqli_query($conn,$query);
        $query ="UPDATE etd_section set section ='SECTION C ' WHERE id between '$nb2' AND '$nb3'";
        mysqli_query($conn,$query);
        $query ="UPDATE etd_section set section ='SECTION D ' WHERE id between '$nb3' AND '$nb4'";
        mysqli_query($conn,$query);   
    }
    
    $query = "SELECT * FROM etd_section";
    $res= mysqli_query($conn,$query);
    if(!$res){
        echo "error";
    }
    while($row = mysqli_fetch_assoc($res)){
        $f = $row['filiere'];
        $s= $row['semster'];
        $section = $row['section'];
        $COD_ETD = $row['COD_ETD'];
        $query="UPDATE etudiant SET SECTION = '$section' WHERE FILIERE = '$f' AND SEMESTRE ='$s' AND COD_ETD = '$COD_ETD'";

        mysqli_query($conn,$query); 
    }
    
    $_SESSION['INSERTION-COMPLETED'] = "LES SECTION SONT AJOUTE SANS AUCUN PROBLEM";
    header('location:insert-section.php');
    

}


}
else{
    header('location:../admin-login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .nombre-etudiant_container{
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 500px;
        flex-direction: column;
        min-width: 500px;

        
        
        
    }
    div>.nbr-section{
        display: grid;
        grid-template-columns: 3fr 2fr;
        justify-content: center;
        align-items: center;
    }
    div>.nbr-section>select{
        height: 30px;
        border-radius: 4px;
        font-size: 1rem;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        text-transform: capitalize;
    }
    div>.nbr-section>label{
        border-radius: 4px;
        font-family: 'Montserrat', sans-serif;
        text-transform: capitalize;
        font-size: 1.1rem;
        color: rgba(0, 0, 0, 0.582);
        margin-right: 8px;
    }
    div>.buttons{
        margin-top: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    div>.buttons>button{
       min-width: 200px;
       height: 32px;
       background: #ffe3e0e0;
       font-size: 1rem;
       font-style: 'Montserrat', sans-serif;
       border-radius: 6px;
       border-width: 1px;
       font-weight: bold;
       letter-spacing: 1px;
       text-transdiv: capitalize;
       margin: 10px;


   }
   div>.buttons>button:hover{
    color: white;
    background: #1f7f226b;
}

.premier>p{
    font-family: 'Montserrat', sans-serif;
    text-transform: capitalize;
    color: rgba(0, 0, 0, 0.582);
    margin-bottom:20px ;
    text-align: start;
}
</style>
</head>
<body>
    <?php

    if($submit){

        

        
        
        ?>

        <div class="nombre-etudiant_container">

            <div class="premier">
                <p>le nombre des etudiant dans la filiere <?php echo $filiere.' '.$semstre .' est '.$numberEtudiant ; ?></p></div>
                <div> 
                    <div >
                        <div class="nbr-section">
                            <label for="">choisir le nombre des section</label>
                            
                            
                            <input type="text" value="<?php echo $codeFiliere;?>" id="codeFiliere" hidden>
                            <input type="text" value="<?php echo $codeFiliere;?>" id="FILIERE" hidden>
                            
                            <input type="text" value="<?php echo $semstre; ?>" id="SEMESTRE" hidden>
                            <input type="text" value="<?php echo $numberEtudiant; ?>" id="nombreEtudiant" hidden>
                            <select id="nombreSection"  class="div-select" aria-label="Default select example">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                        </div>
                        <div class="buttons">
                            <button  onclick="section()">return</button>
                            <button onclick="affectSection()" class="btn btn-primary">submit</button>
                           
                       </div>
                       
                   </div>
               </div>
               
           </div>

           <?php
           
       }
       ?>
       
       
   </body>
   </html>