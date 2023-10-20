
	function gestCheckInterface(){
            
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("content").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","../check/checkInterface.php",true);
            xmlhttp.send();
    }

    function suggests(){
            var input = document.getElementById("prof").value;
            console.log("hallo from suggests");
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                    document.getElementById("checkcontent").innerHTML=this.responseText;
                }
            }
            xmlhttp.open("GET","../check/checkdata.php?prof="+input ,true);
            xmlhttp.send();
    }