function populate2(){
       var xmlhttp = new XMLHttpRequest();
      let idmodule =document.getElementById('s2').value;
    xmlhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status==200){
            document.getElementById("s3").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../pv/traitdata.php?idmodule="+idmodule,true);
    xmlhttp.send();
}
function downloadpv(){
    /* var xmlhttp = new XMLHttpRequest();
      
    xmlhttp.onreadystatechange=function(){
        if(this.readyState == 4 && this.status==200){
           // document.getElementById("s3").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../pv/pv.php?idmodule="+idmodule,true);
    xmlhttp.send();*/
    console.log("salam");
    let section = document.getElementById('section').value;
    let idmodule =document.getElementById('d').value;
    let url =  "../pv/pv.php?idmodule="+idmodule+"&section="+section;
    console.log(url)
    window.location.href = url;

}