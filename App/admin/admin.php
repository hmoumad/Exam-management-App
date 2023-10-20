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
    <link rel="stylesheet" href="../log/style.css">
    <link rel="stylesheet" href="style.css">
   
</head>
<body onload="document.getElementById('co').style.display='none'">
 <!--start  of spinner code -->


    <div id="co" class="co"><div class="loader" ></div></div>

<!--end of spinner code -->
    <div class="container">
        <div class="header ">
            <div class="espaceAdmin">
                <img src="../log/include/images/admin.png" alt=""><p>Espace Admin</p>
            </div>
            <div class="nav">
                <div class="nav-items"><a href="../log/log-in.php">Accueil</a></div>
                <div class="nav-items"><a href="">Gestion Admin</a></div>
                <div class="nav-items"><a href="">Contactez-nous</a></div>
            </div>
            <div class="log-out">
                <img src="include/images/log-out.png" alt="">
                <form action="deconnecter.php">
                    <button >Déconnexion</button>
                </form>
                
            </div>
            
        </div>

















































        <div class="generated-content">
            <div id="content">
                <fieldset>
                    <legend>Upload Etudiant database </legend>
                    <div class="images-container">
                        <img src="../log/include/images/uploadEtudiant.png" width="100%">
                    </div><br>

                    <form class="form-group" method="post" action="importEtudiant.php" enctype="multipart/form-data">
                    <div >
                        <label for="exampleInputFile">File Upload</label>
                        <input type="file" name="file" class="form-control" id="exampleInputFile">
                        <button type="submit" name="uploadEtudiant" class="btn btn-primary">Submit</button>
                    </div>
                    
                    </form>
                </fieldset>



                <fieldset>
                    <legend>Upload calendrie database </legend>
                    <div class="images-container2">
                        <img src="../log/include/images/uploadCalendrie.png" class="image2" >
                    </div><br>

                    <form class="form-group" method="post" action="importEtudiant.php" enctype="multipart/form-data">
                    <div >
                        <label for="exampleInputFile">File Upload</label>
                        <input type="file" name="file2" class="form-control" id="exampleInputFile">
                        <button type="submit" name="uploadcalendrie" class="btn btn-primary">Submit</button>
                    </div>
                    
                    </form>
                </fieldset>

                <fieldset>
                    <legend>Upload local database </legend>
                    <div class="images-container2">
                        <img src="../log/include/images/locals.png" class="image2" >
                    </div><br>

                    <form class="form-group" method="post" action="importEtudiant.php" enctype="multipart/form-data">
                    <div >
                        <label for="exampleInputFile">File Upload</label>
                        <input type="file" name="file3" class="form-control" id="exampleInputFile">
                        <button type="submit" name="uploadlocal" class="btn btn-primary">Submit</button>
                    </div>
                    
                    </form>
                </fieldset>
                
            </div>

        </div>
        <div class="footer"> this is the footer</div>
    </div>

        
    
</body>
</html>