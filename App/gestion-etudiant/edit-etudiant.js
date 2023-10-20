

 
function edit(id){
             console.log("halo");
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("wow").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","../gestion-etudiant/edit-etudiant-data2.php?id="+id,true);
            xmlhttp.send();
        }

        let isSHOW = true;
        function toggle(){
            if(isSHOW == true){
                let modal = document.getElementsByClassName("modal")[0];
                modal.style.display="none";
                isSHOW = false;
            }else{
                let modal = document.getElementsByClassName("modal")[0];
                modal.style.display="flex";
                isSHOW = true;
            }
            

        }

function suggest(){
let searched = document.getElementById("search"); 
        searched.addEventListener('input',()=>{
            console.log(searched.value);});
        codeEtudiant = searched.value;
            
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("data").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","../gestion-etudiant/edit-etudiant-data.php?codeEtudiant="+codeEtudiant ,true);
            xmlhttp.send();
}
function suggest2(codeEtudiant){ 
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("data").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","../gestion-etudiant/edit-etudiant-data.php?codeEtudiant="+codeEtudiant ,true);
            xmlhttp.send();
}
function modifieEtd(){
    let id= document.getElementById('id').value;
    console.log(id);
    let COD_ETD = document.getElementById('COD_ETD').value;
    console.log(COD_ETD);
    let NOM  = document.getElementById('NOM').value;
    let PRENOM =  document.getElementById('PRENOM').value;
    let CNE =document.getElementById('CNE').value;
    let CIN  = document.getElementById('CIN').value;
    let FILIERE  = document.getElementById('FILIERE').value;
    let SEMESTRE  = document.getElementById('SEMESTRE').value;
    let SECTION  = document.getElementById('SECTION').value;
    let MODULE  = document.getElementById('MODULE').value;
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
            if (this.readyState==4 && this.status==200) {
                 suggest2(COD_ETD);
        }
     }
    xmlhttp.open("GET","../gestion-etudiant/modifiedata.php?id="+id+"&COD_ETD="+COD_ETD+"&NOM="+NOM+"&PRENOM="+PRENOM+"&CNE="+CNE+"&CIN="+CIN+"&FILIERE="+FILIERE+"&SEMESTRE="+SEMESTRE+"&SECTION="+SECTION+"&MODULE="+MODULE ,true);
     xmlhttp.send();
     toggle();

 }


