function updateStat() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("status").innerHTML = this.responseText;
	}
  };
  xhttp.open("POST", "/php/lightStat.php", true);
  xhttp.send();
}
function updateAuto() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
	  document.getElementById("auto").innerHTML = this.responseText;
	}
  };
  xhttp.open("GET", "/php/serviceStatus.php", true);
  xhttp.send();
}
function lightToggle(num, state, bri) {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("alert").innerHTML = this.responseText;
		document.getElementById("alert").style.opacity = 1;
		window.setTimeout(fade,3000);
		window.setTimeout(updateStat,3000);
	}
  };
  xhttp.open("POST", "/php/light.php/?num=" + num + "&state=" + state + "&bri=" + bri + "", true);
  xhttp.send();
}
function groupToggle(num, state, bri) {
	
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		document.getElementById("alert").innerHTML = this.responseText;
		document.getElementById("alert").style.opacity = 1;
		window.setTimeout(fade,3000);
		window.setTimeout(updateStat,3000);
	}
  };
  xhttp.open("POST", "/php/groupLight.php/?num=" + num + "&state=" + state + "&bri=" + bri + "", true);
  xhttp.send();
}
function fade() {
	document.getElementById("alert").style.opacity = 0;
}
updateAuto();
updateStat();
