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


var a = document.getElementById('search-btn');
var removeHiddenClassForSearch = document.getElementById('search_container');

var close = document.getElementById('close-search');

a.onclick = function(e) {
  removeHiddenClassForSearch.classList.remove('hidden');
  removeHiddenClassForSearch.classList.toggle('fade');
}


close.onclick = function(e) {
  removeHiddenClassForSearch.classList.add('hidden');
  removeHiddenClassForSearch.classList.toggle('fade');

}