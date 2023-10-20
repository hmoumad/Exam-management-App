function openModal(){
		let modal = document.getElementById("modal");
		modal.style.display="flex";

}
function sleep(milliseconds) {
			const date = Date.now();
			let currentDate = null;
			do {
				currentDate = Date.now();
			} while (currentDate - date < milliseconds);
		}
function openModal2(id){
	let modal = document.getElementById("modal2");
	modal.style.display="flex";
	document.getElementById("id").value = id;
	document.getElementById("filiereName2").value =document.querySelector("#content > div > div.table-container > table > tbody > tr:nth-child("+id+") > td:nth-child(2)").innerText;
	document.getElementById("semestreName2").value =document.querySelector("#content > div > div.table-container > table > tbody > tr:nth-child("+id+") > td:nth-child(3)").innerText;
	document.getElementById("semestreCode2").value =document.querySelector("#content > div > div.table-container > table > tbody > tr:nth-child("+id+") > td:nth-child(4)").innerText;
	modal.style.display="flex";
}
function toggle(){
	let modal = document.getElementById("modal");
	modal.style.display="none";
}
function toggle2(){
	let modal = document.getElementById("modal2");
	modal.style.display="none";
}

function section(){
            console.log("hallo");
    var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
            document.getElementById("content").innerHTML=this.responseText;
        }
    }
    xmlhttp.open("GET","../insert-sections/insert-section.php" ,true);
    xmlhttp.send();

}

function addfiliereData(){
	  var xmlhttp=new XMLHttpRequest();
	  let filiereName = document.getElementById("filiereName").value;
	  let semestreName=document.getElementById("semestreName").value;
	  let semestreCode = document.getElementById("semestreCode").value;
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {

            document.getElementById("content").innerHTML=this.responseText;
            ajouterFil();

        }
    }
    xmlhttp.open("GET","../add-filiere/traitdata.php?ajouter=true"+"&filiereName="+filiereName+"&semestreName="+semestreName+"&semestreCode="+semestreCode ,true);
    xmlhttp.send();
    toggle();


}
function updatefiliereData2(id){
 var xmlhttp=new XMLHttpRequest();
	  let filiereName = document.getElementById("filiereName2").value;
	  let semestreName=document.getElementById("semestreName2").value;
	  let semestreCode = document.getElementById("semestreCode2").value;
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {

            document.getElementById("content").innerHTML=this.responseText;
            ajouterFil();

        }
    }
    xmlhttp.open("GET","../add-filiere/traitdata.php?modifie=true"+"&id="+id+"&filiereName="+filiereName+"&semestreName="+semestreName+"&semestreCode="+semestreCode ,true);
    xmlhttp.send();
    toggle();
}
function deletet(id){
	var xmlhttp=new XMLHttpRequest();
	 
    xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {

            ajouterFil();

        }
    }
    xmlhttp.open("GET","../add-filiere/traitdata.php?delete=true"+"&id="+id ,true);
    xmlhttp.send();
    toggle();
}
function populatefiliere(){ 

    document.getElementById("co").style.display="flex";

	var xmlhttp=new XMLHttpRequest();
    xmlhttp.onreadystatechange=function() {
       
        if (this.readyState==4 && this.status==200) {
            document.getElementById("co").style.display="none";
        }
    }
    
    xmlhttp.open("GET","../add-filiere/insert-filliere.php?insert-filiere=true" ,true);
    xmlhttp.send();
    toggle();
}



