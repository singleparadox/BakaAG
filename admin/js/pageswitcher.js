function chPage() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	document.getElementById("main-page").innerHTML = "<center><img height=200 width=200 src="+"img/loading.gif"+"></center>";
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "pages/products.php", true);
  xhttp.send();
}