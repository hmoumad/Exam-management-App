window.addEventListener('load', ()=> {
   let spinner = document.querySelector("#co");
spinner.style.display="none";
});

function functionn(){
 let spinner = document.getElementById("co");
spinner.style.display="none";
}



function section(){
    document.querySelector("#co").style.display="flex";
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            spinner.style.display="none";
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../insert-sections/insert-section.php" ,true);
    xmlhttp.send();

}
let closed = false;
function closeSection(){
    if(closed == false){
       document.querySelector("body > div.container > div.sections").style.display="none";
    document.querySelector("body > div.container > div.generated-content").style.gridColumn="1/13";
    document.querySelector("body > div.container > button").innerText=">>"; 
    closed=true;
}else{
       document.querySelector("body > div.container > div.sections").style.display="grid";
    document.querySelector("body > div.container > div.generated-content").style.gridColumn="3/13"; 
    document.querySelector("body > div.container > button").innerText="<<";
    closed=false;

}
    

}

function populate(s1,s2){
            var s1 = document.getElementById('s1');
            var s2 = document.getElementById('s2');
            /*
            s2.innerHTML =" ";
            if(s1.value == "DRF"  ){
                arrayOption= ["|","PFF11%|S1","PFF12%|S2","PFF23%|S3","PFF24%|S4","PFF35%|S5","PFF36%|S6"];
            }else if(s1.value == "SMA")
            {
                arrayOption =  ["|","PFA23%|S3","PFA24%|S4","PFA35%|S5","PFA36%|S6"];
            }
            else if(s1.value== "SMI" ){
                arrayOption =  ["|","PFI23%|S3","PFI24%|S4","PFI35%|S5","PFAI6%|S6"];

            }
            else if(s1.value=="SMIA"){
                arrayOption = ["|","PFA11%|S1","PFA12%|S2"];
            }else if(s1.value =="SMC"){
                arrayOption =  ["|","PFC23%|S3","PFC24%|S4","PFC35%|S5","PFAC6%|S6"];

            }else if(s1.value == "SMP"){
                arrayOption =  ["|","PFP23%|S3","PFP24%|S4","PFP35%|S5","PFP36%|S6"];
            }
            else if(s1.value =="SMPC"){
                arrayOption = ["|","PFC11%|S1","PFC12%|S2"];
            }
            else if(s1.value =="SVI"){
                arrayOption= ["|","PFU11%|S1","PFU12%|S2","PFV23%|S3","PFV24%|S4","PFV35%|S5","PFV36%|S6"];
            }

            for( var option in arrayOption){
                var pair = arrayOption[option].split('|');
                var newOption = document.createElement('option');
                newOption.value = pair[0];
                newOption.innerHTML = pair[1];
                s2.options.add(newOption);
            }



*/
 let spinner = document.querySelector("#co");
spinner.style.display="flex";
            var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        spinner.style.display="none";

        if (this.readyState==4 && this.status==200) {
            document.getElementById("s2").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../log/semestre.php?filiere="+s1.value ,true);
    xmlhttp.send();


        }


// this nombreEtudiant part
function nombreEtudiant(){
    let spinner = document.querySelector("#co");
spinner.style.display="flex";
    var filiere = document.getElementById('s1').selectedOptions[0].value;
    console.log(filiere);
    var semestre = document.getElementById('s2').selectedOptions[0].value;
    console.log(semestre);
     var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        

        if (this.readyState==4 && this.status==200) {
            spinner.style.display="none";
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../insert-sections/nombre-etudiant.php?filiere="+filiere+"&code_filiere="+semestre ,true);
    xmlhttp.send();
}
function affectSection(){
    let spinner = document.getElementById("co");
spinner.style.display="flex";
    console.log("hallo");
   var  codeFiliere= document.getElementById('codeFiliere').value;
   console.log(codeFiliere);
   var nombreEtudiant = document.getElementById('nombreEtudiant').value;
   var nombreSection = document.getElementById('nombreSection').selectedOptions[0].value;
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            spinner.style.display="none";

            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../insert-sections/nombre-etudiant.php?codeFiliere="+codeFiliere+"&nombreEtudiant="+nombreEtudiant+"&nombreSection="+nombreSection+"&submit=true" ,true);
    xmlhttp.send();
   

}


function ajouterFil(){
    let spinner = document.getElementById("co");
     var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../add-filiere/add-filiere.php" ,true);
    xmlhttp.send();
}


function gestionEtudiant(){
     let spinner = document.getElementById("co");
spinner.style.display="flex";
     var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            spinner.style.display="none";
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../gestion-etudiant/edit-etudiant.php" ,true);
    xmlhttp.send();
}

function getSurveillance(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status==200){
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../surviellent/surviellent.php");
    xmlhttp.send();
}
function getpv(){
       var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status==200){
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../pv/interface.php");
    xmlhttp.send();
}