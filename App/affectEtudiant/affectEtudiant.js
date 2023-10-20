function getCalendrie(){
    let spinner = document.querySelector("#co");
spinner.style.display="flex";
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            spinner.style.display="none";
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../affectEtudiant/calendrie.php" ,true);
    xmlhttp.send();

}