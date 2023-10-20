
function getlocaux(){
		 let spinner = document.querySelector("#co");
spinner.style.display="flex";
			var xmlhttp=new XMLHttpRequest();

			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					spinner.style.display="none";

					document.getElementById("content").innerHTML=this.responseText;
				}
			}
			console.log("j = " + j);
			xmlhttp.open("GET","../locaux/locaux.php",true);

			xmlhttp.send();
}

var j=0;
		function checkifselected(){
			var date = document.getElementById("date").value;
			var heure = document.getElementById("heure").value;
			if (date != "selectDate" && heure  != "selectHeure") {

				showUser(date,heure);	

			}

		}
		function increament(){
			j++;
			var date = document.getElementById("date").value;
			var heure = document.getElementById("heure").value;
			if (date != "selectDate" && heure  != "selectHeure") {
				showUser(date,heure);

			}	
		}

		function decreace(){
			j--;
			var date = document.getElementById("date").value;
			var heure = document.getElementById("heure").value;
			if (date != "selectDate" && heure  != "selectHeure") {
				showUser(date,heure);
			}
		}

		function showUser(str,str2) {
			if (str=="" || str2 == "") {
				document.getElementById("div").innerHTML="";
				return;
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					document.getElementById("div").innerHTML=this.responseText;
				}
			}
			console.log("j = " + j);
			xmlhttp.open("GET","../locaux/affiche.php?date="+str + "&heure="+str2 + "&id="+j,true);

			xmlhttp.send();

			i = 0;
			somme = 0;
			effective = 0;
			rest = 0;
			document.getElementById("p").innerHTML = "les places servis est  " + somme ;


		}



		var i = 0;
		var somme = 0;
		var effective = 0;
		rest = 0;

		function numbre(id) {

			if( i == 0){
				effective = document.getElementById("effect").innerHTML;
				rest = effective;
			}
			i++;




			var selected = document.getElementById(id);
			if(selected.checked == true){
				somme = parseInt(document.getElementById(id).value) + somme ;
				rest = rest - parseInt(document.getElementById(id).value) ;
			}else{
				somme = somme - parseInt(document.getElementById(id).value);
				
				rest = rest + parseInt(document.getElementById(id).value);

			}
			if(rest < 0){
				alert("you already filled all check if the margin is ok ");
			}

			document.getElementById("p").innerHTML = "les places servis est  " + somme + " Nombre des places restant est 	<span>"+ rest+"</span>";

		}
		function filled_resv_loc(){
			var date = document.getElementById("date").value;
			var heure = document.getElementById("heure").value;
			if (date=="" || heure == "") {
				document.getElementById("div").innerHTML="";
				return;
			}
			let spinner = document.querySelector("#co");
			spinner.style.display="flex";

			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					spinner.style.display="none";
					//document.getElementById("div").innerHTML=this.responseText;
				}
			}
			var length  = document.getElementsByClassName("locals").length;
			for(var k = 0 ; k<= length ; k++){
				//var selected  =  document.getElementsByTagName("input")[radio][k];
				var selected  =  document.getElementsByClassName("locals")[k];
				let last = document.getElementsByClassName("last")[k];


				//let id = document.getElementsByTagName("input")[k].id;
				let id = document.getElementsByClassName("locals")[k].id;
				let idModule = document.getElementById("code").innerText;
				let section = document.getElementById("section").innerText;
				let tr = "true";
				if(selected.checked == true &&  last.checked == false){
					console.log(k);
					xmlhttp.open("GET","../locaux/locaux.php?date="+date + "&heure="+heure  +"&idLocal="+ id + "&id_module="+idModule+"&section="+section,true);
					xmlhttp.send();
					sleep(500);


				}else if(selected.checked == true &&  last.checked == true){
					xmlhttp.open("GET","../locaux/locaux.php?date="+date + "&heure="+heure  +"&idLocal="+ id + "&id_module="+idModule+"&last="+true+"&section="+section,true);
					xmlhttp.send();
					sleep(500);


				}
				checkifselected();
		}}
		function sleep(milliseconds) {
			const date = Date.now();
			let currentDate = null;
			do {
				currentDate = Date.now();
			} while (currentDate - date < milliseconds);
		}
		function deletelocal(id){
			console.log(id);
			var date = document.getElementById("date").value;
			var heure = document.getElementById("heure").value;
			if (date=="" || heure == "") {
				document.getElementById("div").innerHTML="";
				return;
			}
			var xmlhttp=new XMLHttpRequest();
			xmlhttp.onreadystatechange=function() {
				if (this.readyState==4 && this.status==200) {
					//document.getElementById("div").innerHTML=this.responseText;
				}
			}
			//xmlhttp.open("GET","delete.php?idresv_loc="+id +"&date="+date+"&heure" + heure,true);
			xmlhttp.open("GET","../locaux/locaux.php?idresv_loc="+id,true);
			xmlhttp.send();
			
			checkifselected();


		}