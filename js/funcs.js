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

function incrdecr(id){
  var quant;
  var currttl;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("total-price").innerHTML = this.responseText;
    }
  };
  quant = document.getElementById("prod-quant-"+id).value;
  currttl = document.getElementById("total-price").innerHTML;
  xhttp.open("GET", "backend/quantchcg.php?id="+id+"&quant="+quant+"&currttl="+currttl, true);
  xhttp.send();
}

function payuscard(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("card-modal-content").innerHTML = this.responseText;
    }
  };
  var totalprice = document.getElementById("total-price").innerHTML;
  console.log(totalprice);
  xhttp.open("GET", "backend/pay-card.php?totalprice="+totalprice, true);
  xhttp.send();
}