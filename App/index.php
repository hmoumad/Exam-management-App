<?php 
include_once('includes/connection.php');
include_once('includes/function.php');
session_start();

if(isset($_POST['submit'])){
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);
    $result = mysqli_query($conn,"SELECT * FROM admin WHERE username ='$username' AND  password ='$password' limit 1 ");
    $count = mysqli_num_rows($result);
    if($count == 1){
        
        $_SESSION['username'] = $username;
        header("location:log/log-in.php");
    }else{
        $_SESSION['msg-error'] = '<div class="error-container"><div class="error"><p>s\'l vous plais , verifié votre input et ressayer </p></div></div>';
        header("location:index.php");
    }
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
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container{
            background: wheat;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            width: 100%;
        }
        .form-container{
            border-radius: 7px 71px;
            height: 201px;
            width: 400px;
            background-color: #618585;
            border:solid black 0.5px;
            box-shadow: 8px 13px 0px 3px  #12121270;
            font-weight: 500;
            margin: 73px;
        }
        .input-container{
            padding: 15px;
            grid-template-rows: 58px 40px;
            display: grid;
            margin: 18px 0 0 0;
        }
        .button-container{
            display: flex;
            align-items: center;
            justify-content: center;

        }
        input{
            width: 90%;
            margin: 0 auto;
            height: 30px;
            font-size: 1.1em;
            border-radius: 3px;
            font-weight: 400;
            border: solid #5a4848 1.5px;
            background: #eeefeffa;
            text-align: center;
            /* color: #241313; */
            font-size: 1.0em;
            font-family: cursive;
            outline: palegreen;
        }
        button{
            width: 156px;
            height: 33px;
            border:solid black 0.5px;
            border-radius: 4px;
            background-color: #618585;
            color: wheat;
            border: solid #6c6969 0.5px;
            font-size: 1.1em;
            text-transform: uppercase;
            letter-spacing: 3px;
            font-variant: all-petite-caps;
            /* font-stretch: expanded; */
            font: menu;
            font-kerning: initial;
            font-family: cursive;
        }
        button:hover{
            color:brown;
            background-color: white;
            box-shadow: 5px 6px 3px 5px #12121270;
        }

        /*start of spinner csss*/
 .loader {
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite; /* Safari */
  animation: spin 2s linear infinite;

  
 
 
  
}
#co{

background-color: #0000009e;
    position: absolute;
    display: flex;
    top: 0;
    left: 0;
    position: fixed;
    height: 100vh;
    z-index: 100;
    width: 100%;
    justify-content: center;
    align-items: center;
  
  }
  @keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/*end of spinner css*/
/*stayle of the error*/
.error-container{
   position: absolute;
    justify-content: center;
    align-items: center;
    width: 100%;
    display: flex;
    background-color: wheat;
}
.error{width: 500px;height: 61px;background-color: #618585;display: flex;justify-content: center;align-items: center;border-radius: 0px 0px 98px 98px;color: lightyellow;font-size: larger;font-variant: all-small-caps;
animation: displayError 1s  linear;}
@keyframes displayError{
    0%{height: 0;}
    100%{height: 61px;}
}


    </style>
</head>
<body onload="stopSpinner()">
    <?php
    if(!empty($_SESSION['msg-error'])){
        echo $_SESSION['msg-error'];
    }
        

    
     ?>
     <!--start  of spinner code -->

     <div id="co" class="co"><div class="loader" ></div></div>

     <!--end of spinner code -->
     <form action="" method="post">
         <div class="container">
        <div class="form-container">
            <div class="input-container">
                <input type="text" placeholder="username" name="username">
                <input type="password" name="password" placeholder="password">
            </div>
            <div class="button-container">
                <button name="submit">log in </button>
            </div>
        </div>
    </div>
     </form>
    
    
</body>
<script>
    function stopSpinner(){
        document.getElementById("co").style.display="none";
    }
</script>
</html>