function showHint( str) {
	if(str.length == 0) {
		document.getElementById('hintBox').style.display = 'none';
		document.getElementById('txtHint').innerHTML = "";
		return;
  }
  else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var txtHint = JSON.parse(this.responseText);
        var display = "";
        for (var i = 0; i < txtHint.length; i++) {
          display += "<li id ='hint' onclick='writeHint(this.innerHTML)'>" + txtHint[i].name+ "</li>";
        }
        document.getElementById('hintBox').style.display = 'block';
        document.getElementById('txtHint').innerHTML = display;
      }

    };
    xmlhttp.open("GET",'../action/searchHint.php?q=' + str, true);
    xmlhttp.send();
  }
}

function writeHint(hint) {
  document.getElementsByName('query')[0].value = hint;
}

