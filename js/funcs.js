function addtocart(id){
var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
  	document.getElementById("user-cart").innerHTML;
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("user-cart").innerHTML = this.responseText;
      setTimeout(function(){
        document.getElementById("success").style.display = 'none';
     }, 3000);
      document.getElementById("success").style.display = 'block';
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
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("totprce").value = this.responseText;
    }
  };
  var quant = document.getElementById("prod-quant-"+id).value;
  console.log(quant);
  xhttp.open("GET", "backend/quantchcg.php?id="+id+"&quant="+quant, true);
  xhttp.send();
}

function payuscard(){
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("card-modal-content").innerHTML = this.responseText;
    }
  };
  var totalprice = document.getElementById("totprce").value;
  document.getElementById("pay-card-chckout").style.visibility = "hidden";
  console.log(totalprice);
  xhttp.open("GET", "backend/pay-card.php?totalprice="+totalprice, true);
  xhttp.send();
}

function showSearchHint(str) {
    if (str.length == 0) { 
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "php/backend_search.php?q=" + str, true);
        xmlhttp.send();
    }
}

var string = "search.php?q=";

document.getElementById("search_button").onclick = function (e) {
  document.getElementById("search_button").href = string + document.getElementById("search_input").value;

}


var addToWishlist = document.getElementById("addToWishlist");

addToWishlist.onclick = function (e) {
  var xhttp = new XMLHttpRequest();
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("prod_id").value;
  var params = "uid="+getUID+"&pid="+getPID;

  xhttp.open("POST", "backend/addToWishlist.php", true);

  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == '1') {
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        addToWishlist.remove();
        document.getElementById("success").style.display = 'block';
      } else {
        setTimeout(function(){
            document.getElementById("error").style.display = 'none';
        }, 3000);
        document.getElementById("error").style.display = 'block';
      }    
     
    }
  };
  
  xhttp.send(params);
}

function remove_row(str) {
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("prod_id").value;
  var params = "uid="+getUID+"&pid="+getPID;

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/removeFromWishlist.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.status);
      document.getElementById(str).remove(); 
     
    }
  };
  xhttp.send(params);
}
/*
var thumbnailA = document.getElementById("thumbA");
var thumbnailB = document.getElementById("thumbB");
var thumbnailC = document.getElementById("thumbC");
var thumbnailD = document.getElementById("thumbD");
var main_image = document.getElementById("main-image");

var originalThumb = main_image.style.backgroundImage;

thumbnailA.onclick = function(e) {
  main_image.style.backgroundImage = this.style.backgroundImage;
}
thumbnailB.onclick = function(e) {
  main_image.style.backgroundImage = this.style.backgroundImage;
}
thumbnailC.onclick = function(e) {
  main_image.style.backgroundImage = this.style.backgroundImage;
}
thumbnailD.onclick = function(e) {
  main_image.style.backgroundImage = this.style.backgroundImage;
}

main_image.onclick = function(e) {
  main_image.style.backgroundImage = originalThumb.style.backgroundImage;
}*/

var rate_btn1 = document.getElementById("rate-btn-1");
var rate_btn2 = document.getElementById("rate-btn-2");
var rate_btn3 = document.getElementById("rate-btn-3");
var rate_btn4 = document.getElementById("rate-btn-4");
var rate_btn5 = document.getElementById("rate-btn-5");

rate_btn1.onclick = function (e) {
  //console.log(this.text);
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("inv_id").value;
  var getRating = this.text;
  var params = "uid="+getUID+"&pid="+getPID+"&rating="+getRating;

  //console.log(getUID);
  //console.log(getPID);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/rating.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);

      if (this.responseText == '1' || this.responseText == '0') {
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        document.getElementById("success").style.display = 'block';
      }
     
    }
  };
  xhttp.send(params);
}

rate_btn2.onclick = function (e) {
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("inv_id").value;
  var getRating = this.text;
  var params = "uid="+getUID+"&pid="+getPID+"&rating="+getRating;

  //console.log(getUID);
  //console.log(getPID);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/rating.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);

      if (this.responseText == '1' || this.responseText == '0') {
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        document.getElementById("success").style.display = 'block';
      }
     
    }
  };
  xhttp.send(params);
}
rate_btn3.onclick = function (e) {
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("inv_id").value;
  var getRating = this.text;
  var params = "uid="+getUID+"&pid="+getPID+"&rating="+getRating;

  //console.log(getUID);
  //console.log(getPID);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/rating.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);

      if (this.responseText == '1' || this.responseText == '0') {
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        document.getElementById("success").style.display = 'block';
      }
     
    }
  };
  xhttp.send(params);
}
rate_btn4.onclick = function (e) {
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("inv_id").value;
  var getRating = this.text;
  var params = "uid="+getUID+"&pid="+getPID+"&rating="+getRating;

  //console.log(getUID);
  //console.log(getPID);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/rating.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);

      if (this.responseText == '1' || this.responseText == '0') {
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        document.getElementById("success").style.display = 'block';
      }

    }
  };
  xhttp.send(params);
}
rate_btn5.onclick = function (e) {
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("inv_id").value;
  var getRating = this.text;
  var params = "uid="+getUID+"&pid="+getPID+"&rating="+getRating;

  //console.log(getUID);
  //console.log(getPID);

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/rating.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);

      if (this.responseText == '1' || this.responseText == '0') {
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        document.getElementById("success").style.display = 'block';
      }
     
    }
  };
  xhttp.send(params);
}

var add_comment = document.getElementById("add-comment");

add_comment.onclick = function(e) {

  var comment_container = document.getElementById("comment-container");
  var getUID = document.getElementById("acc_id").value;
  var getPID = document.getElementById("prod_id").value;
  var getCommentBoxText = document.getElementById("comment-box").value;
  var params = "uid="+getUID+"&pid="+getPID+"&comment="+getCommentBoxText;

  var xhttp = new XMLHttpRequest();

  xhttp.open("POST", "backend/comments.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        comment_container.innerHTML = this.responseText;
        setTimeout(function(){
            document.getElementById("success").style.display = 'none';
        }, 3000);
        document.getElementById("success").style.display = 'block';
        getCommentBoxText.value = '';
    }
  };
  xhttp.send(params);

}

var viewAll = document.getElementById("view-all");

viewAll.onclick = function (e) {
    document.getElementById("all-comments").style.display="block";
}

var closeViewAll = document.getElementById("close-view-all");

closeViewAll.onclick = function (e) {
    document.getElementById("all-comments").style.display="none";
}