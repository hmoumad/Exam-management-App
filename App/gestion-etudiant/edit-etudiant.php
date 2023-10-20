<?php 
require('../includes/connection.php');
$result ="";
$rowcount =0;


session_start();
if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_SESSION['username'])){

}else{
    header("location:../index.php");
}
if(isset($_POST['search'])){
    $searchedValue=$_POST['searchedValue']; 
    $query = "SELECT * FROM etudiant WHERE COD_ETD = '$searchedValue'";
    $result = mysqli_query($conn,$query);
    $rowcount = mysqli_num_rows($result);

}
if(isset($_POST['affiche'])){
    $CODE_FIL = $_POST['code_filiere'];
    if(!isset($_POST['SECTION'])){
     $query = "SELECT * FROM etudiant WHERE CODE_FIL  LIKE '$CODE_FIL' ";
     $result = mysqli_query($conn,$query);
     $rowcount = mysqli_num_rows($result);
 }else{
    $SECTION = $_POST['SECTION'];
    $query = "SELECT * FROM etudiant WHERE CODE_FIL  LIKE '$CODE_FIL'  AND SECTION = '$SECTION'";
    $result = mysqli_query($conn,$query);
    $rowcount = mysqli_num_rows($result);
}



}

if(isset($_GET['apojee']) && !isset($_POST['search'])){
    $searchedValue=$_GET['apojee'];
    $query = "SELECT * FROM etudiant WHERE COD_ETD = '$searchedValue'";
    $result = mysqli_query($conn,$query);
    $rowcount = mysqli_num_rows($result);

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
    table{
        border-collapse: collapse;
        width: 100%;

    }
    table >thead{
        background-color: #91c1bde0;
    }
    table>tbody{
        background-color: #dfdfdf;
    }
    th{
        text-transform: uppercase;
    }
    td ,th{
        border: solid black 1px;
        height: 30px;
        text-align: center;
        font-family: 'Montserrat', sans-serif;


    }
    .champ{
        margin: 30px 0 30px 0 ;
        display: flex;
        justify-content: center;
    }
    .champ1>label{
        border-radius: 4px;
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        color: rgba(0, 0, 0, 0.582);
    }
    .champ1>select,.champ1>input{
        height: 30px;
        border-radius: 4px;
        font-size: 1rem;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        text-transform: capitalize;
        min-width: 140px;
         border: solid #1000f76b 1px;
        
    }
    .edit-etudiant-container{
        width: 90%;
        margin: 10px auto;
        
    }
    .champ1{
        /*display: flex;
        align-items: center;*/
    }


    /*this is going weird */
    .modal{
        background-color: #0000009e;
        position: absolute;
        display: none;

        height: 100vh;
        width: 100%;
        left: 0;
        position: fixed;
        justify-content: center;
        align-items: center;
        display: flex;
        top: 0;
    }
    .modal_content{
        width: 400px;
        height: 600px;
        background-color: #e8eeecf5;
        border-radius: 5px;
    }
    .modal_content h1{
        margin-top: 20px;
        text-align: center;
        font-style: 'Montserrat', sans-serif;
        color: rgba(0, 0, 0, 0.582);

    }
    .modal_header {
        position: relative;
    }
    .times{
        position: absolute;
        top: -25px;
        right: 10px;
        font-size: 2.5rem;
        cursor: pointer;
    }
    .modal-champs{
        width: 90%;
        margin: 20px auto;


    }
    .modal-champs>div{
        margin:20px  5px ;
        grid-gap: 10px;
        justify-content: center;
        align-items: center;
    }
    .modal-champs>div>label{
        border-radius: 4px;
        font-family: 'Montserrat', sans-serif;
        font-weight: bold;
        color: rgba(0, 0, 0, 0.582);
    }
    .modal-champs>div>input{
        height: 30px;
        border-radius: 4px;
        font-size: 1rem;
        text-align: center;
        font-family: 'Montserrat', sans-serif;
        text-transform: capitalize;
        border: solid black 1px;


    }
    .button{
        display: flex;
        justify-content: center;
        align-items: center;

    }
    .button>button,.table-container>div>button{
     min-width: 200px;
     height: 32px;
     background: #ffe3e0e0;
     font-size: 1rem;
     font-style: 'Montserrat', sans-serif;
     border-radius: 6px;
     border-width: 1px;
     font-weight: bold;
     letter-spacing: 1px;
     text-transform: capitalize;
 }
 .button>button:hover,.table-container>div>button:hover{
    color: white;
    background: #1f7f226b;
}
.table-container>div{
    display: flex;
    justify-content: flex-end;
    margin: 15px 0;

}
/*button{
    margin: 5px;
    min-width: 100px;
    height: 28px;
    background: #ffe3e0e0;
    font-size: 1rem;
    font-style: 'Montserrat', sans-serif;
    border-radius: 6px;
    border-width: 1px;
    text-transform: capitalize;
}*/
.modifie{
    background-color: #11e5198a;
}
.delete{
    background-color: #ff5a5a;
}
.table-container>.populatefiliere{
    justify-content: center;
}
.relative{
    position: relative;
}
.a1{
    display: grid;
    grid-template-columns: 3fr 3fr;
}

.button-container{
    display: flex;
    
   align-items: center;
}
.form-control{
    display: block;
    height: 25px;
    width: 300px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857;
    color: #555;
    background-color: #fff;
    background-image: none;
    /*border: 1px solid #ccc;*/
    border: none;
    border-radius: 4px;
    border: solid #1000f76b 1px;
    box-shadow: 1px 3px 1px 3px #1000f76b;
    outline: none;
}
.form-control:focus{
    border: solid #1000f76b 1px;
    box-shadow: 1px 3px 1px 3px #1000f76b;
    outline: none;
}
.button-container>img{
    width: 40px;
    margin: 0 20px;
}
.button-container>a{
    text-decoration: none;
     font-size: 1.1rem;
    font-style: 'Montserrat', sans-serif;
    border-radius: 6px;
    border-width: 1px;
    text-transform: capitalize;
     color: white;
     font-weight: bold;
}
#data{
    padding: 0 5px;
}
.editbutton{
    margin: 5px;
    min-width: 100px;
    height: 28px;
    background: #ffe3e0e0;
    font-size: 1rem;
    font-style: 'Montserrat', sans-serif;
    border-radius: 6px;
    border-width: 1px;
    text-transform: capitalize;
}
</style>

</head>
<body class="relative">


    <header>
        <div class="edit-etudiant-container">
            <div class="champ">
                <div class="search champ1">
                    <!--<input type="search" class="input" name="searchedValue" placeholder="code apojee"> -->

                    <input type="text" class="form-control" placeholder="SEARCH BY" id="search" name="searchedValue" oninput="suggest()">

                </div>
            </div>
            <div class="button-container">
                <img src="../log/include/images/excel.png" alt="">
                <a href="../gestion-etudiant/generateExcel.php" name="afficheALL"  class="btn btn-primary">generate Excel file</a>
            </div>
</div>
    </header>
       
    </body>
    </html>
      <div id="wow"></div>
    <div id="data"></div> 