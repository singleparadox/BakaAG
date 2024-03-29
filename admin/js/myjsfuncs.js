function chPage() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	document.getElementById("products-tab").innerHTML = "<center><img height=200 width=200 src="+"img/loading.gif"+"></center>";
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("products-tab").innerHTML = this.responseText;
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
  prod_feature = document.getElementById("prod-feature-"+id).value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	//document.getElementById("modal-test").innerHTML = "<center><img height=200 width=200 src="+"img/loading.gif"+"></center>";
    if (this.readyState == 4 && this.status == 200) {
    document.getElementById("modal-alert-"+id).classList.remove("hidden");
    //document.getElementById("modal-test").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "pages/backend/updateproduct.php?id="+id+"&prod_name="+prod_name+"&prod_desc="+prod_desc+"&prod_genre="+prod_genre+"&prod_type="+prod_type+"&prod_price="+prod_price+"&prod_stock="+prod_stock+"&inv_id="+inv_id+"&prod_discount="+prod_discount+"&prod_feature="+prod_feature, true);
  xhttp.send();
}

function resetAlert(x) {
	document.getElementById("modal-alert-"+x).classList.add("hidden");
}

function chcngordstat(id){
  var order_stat = document.getElementById("sel-stat-"+id).value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(order_stat);
  xhttp.open("GET", "pages/backend/updateordstat.php?id="+id+"&orderstat="+order_stat, true);
  xhttp.send();
}

function chcaccess(id){
  var newaccess = document.getElementById("chcaccess").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(newaccess);
  xhttp.open("GET", "pages/backend/chcaccess.php?id="+id+"&newaccess="+newaccess, true);
  xhttp.send();
}

function cour_shipped(id){
  var order_stat = document.getElementById("deliver-"+id).value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(order_stat);
  xhttp.open("GET", "pages/backend/updateordstat.php?id="+id+"&orderstat="+order_stat, true);
  xhttp.send();
}

function cour_cancel(id){
  var order_stat = 4
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(order_stat);
  xhttp.open("GET", "pages/backend/updateordstat.php?id="+id+"&orderstat="+order_stat, true);
  xhttp.send();
}

function apprv(id){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(id);
  xhttp.open("GET", "pages/backend/apprvorder.php?id="+id, true);
  xhttp.send();
}

function send_trans(id){
  var name = document.getElementById("receipt-name").value;
  var address = document.getElementById("receipt-address").value;
  var amt = document.getElementById("receipt-amt").value;
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(id);
  xhttp.open("GET", "pages/backend/sendreceipt.php?id="+id+"&name="+name+"&address="+address+"&amt="+amt, true);
  xhttp.send();
}
function sndcour(id){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("main-page").innerHTML = this.responseText;
    }
  };
  console.log(id);
  xhttp.open("GET", "pages/backend/sendcour.php?id="+id, true);
  xhttp.send();
}