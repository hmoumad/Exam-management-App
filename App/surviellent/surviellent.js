function surveillentDeleteDatabase(site){
		document.querySelector("#co").style.display="flex";
		    var xmlhttp=new XMLHttpRequest();
		    xmlhttp.onreadystatechange=function() {
		        if (this.readyState==4 && this.status==200) {
		            document.querySelector("#co").style.display="none";
		            getSurveillance();
		        }
		    }
		    xmlhttp.open("GET",site ,true);
		    xmlhttp.send();
}
