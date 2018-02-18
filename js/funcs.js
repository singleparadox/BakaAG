function addtocart(id){
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	document.getElementById("user-cart").innerHTML;
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("user-cart").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "backend/addcart.php?id="+id, true);
  xhttp.send();

}

function removefrcart(id){
	var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	document.getElementById("user-cart").innerHTML;
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("user-cart").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "backend/remvcart.php?id="+id, true);
  xhttp.send();
}