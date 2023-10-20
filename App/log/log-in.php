<?php
session_start();
if(isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>gestion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body >
 <!--start  of spinner code -->


    <div id="co" class="co"><div class="loader" ></div></div>

<!--end of spinner code -->
    <div class="container">
        <div class="header ">
            <div class="espaceAdmin">
                <img src="include/images/admin.png" alt=""><p>Espace Admin</p>
            </div>
            <div class="nav">
                <div class="nav-items"><a href="">Accueil</a></div>
                <div class="nav-items"><a href="../admin/admin.php">Gestion Admin</a></div>
                <div class="nav-items"><a href="">Contactez-nous</a></div>
            </div>
            <div class="log-out">
                <img src="include/images/log-out.png" alt="">
                <form action="deconnecter.php">
                    <button >Déconnexion</button>
                </form>
                
            </div>
            
        </div>










































        <button class="specielButton" onclick="closeSection()"><<</button>
        <div class="sections">
            <div onclick="ajouterFil()">Ajouté Filiere</div>
            <div onclick="gestionEtudiant()">Gestion D'étudiant</div>
            <div onclick="section()">les sections</div>
            <div onclick="getlocaux()">les locaux</div>
            <div onclick="getCalendrie()">Calendrie</div>
            <div onclick="gestCheckInterface()">check interface</div>
            <div onclick="getSurveillance()">surveillance</div>
            <div onclick="getpv()">pv</div>
            <div ><a href="../locaux/edit.php">edit locaux</a></div>

        </div>




















        <div class="generated-content">
            <div id="content"></div>
        </div>
        <div class="footer"> this is the footer</div>
    </div>

        
    
</body>

<script src="script.js"></script>
<script src="../add-filiere/addfiliere.js"></script>
<script src="../gestion-etudiant/edit-etudiant.js"></script>
<script src="../locaux/locaux.js"></script>
<script src="../affectEtudiant/affectEtudiant.js"></script>
<script src="../check/check.js"></script>
<script src="../surviellent/surviellent.js"></script>
<script  src="../pv/pv.js"></script>
</html>