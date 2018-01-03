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

function update(id) {
  prod_name = document.getElementById("prod-name-"+id).value;
  prod_desc =  document.getElementById("prod-desc-"+id).value;
  prod_genre = document.getElementById("prod-genre-"+id).value;
  prod_type = document.getElementById("prod-type-"+id).value;
  inv_id = document.getElementById("prod-inv-"+id).value;
  prod_price = document.getElementById("prod-price-"+id).value;
  prod_stock = document.getElementById("prod-stock-"+id).value;
  prod_discount = document.getElementById("prod-discount-"+id).value;
  console.log(prod_genre);
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	//document.getElementById("modal-test").innerHTML = "<center><img height=200 width=200 src="+"img/loading.gif"+"></center>";
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("modal-alert-"+id).classList.remove("hidden");
    //document.getElementById("modal-test").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "pages/backend/updateproduct.php?id="+id+"&prod_name="+prod_name+"&prod_desc="+prod_desc+"&prod_genre="+prod_genre+"&prod_type="+prod_type+"&prod_price="+prod_price+"&prod_stock="+prod_stock+"&inv_id="+inv_id+"&prod_discount="+prod_discount, true);
  xhttp.send();
}

function resetAlert(x) {
	document.getElementById("modal-alert-"+x).classList.add("hidden");
}

