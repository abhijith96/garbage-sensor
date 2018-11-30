
var userposition=null;
var mymap=null;
// window load function
function myfunc(){
	mymap = L.map('mapid').fitWorld();
	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 18,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);

	 if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(getposition, errorPosition);
    }
    else{
	 errorPosition();
	}
}

function test() {
   document.getElementById("demo").innerHTML = "Paragraph changed.";
}

// get user cordinates
function getposition(position){
	userposition=position;
	getmap( position.coords.latitude, position.coords.longitude);
}

// get cordinates of first bin from database
function errorPosition(error){
	alert("location denied");
	 // var oReq = new XMLHttpRequest(); //New request object
	 // XMLHttpRequest.responseType = "json";
  //   oReq.onload = function() {
  //       //This is where you handle what to do with the response.
  //       //The actual data is found on this.responseText
  //       alert(this.response);
  //       var res=JSON.parse(this.response);
  //       getmap(res["latitude"]-40, res["longitude"]);
  //        //Will alert: 42
  //   };
  //   oReq.open("get", "getdata.php", true);
  //   oReq.send();
}

// display the map using cordinates
function getmap(lat, long){
	mymap.setView([lat, long], 12);
	getBin(mymap);
}

// get Bin locations from database
function getBin(mymap){
	var oReq = new XMLHttpRequest;
	XMLHttpRequest.responseType="json";
	oReq.onload = function(){
		alert(this.response);
		var res=JSON.parse(this.response);
		addMarker(mymap, res);
	};
	oReq.open("get", "get_garbage_bin_cordinates.php");
	oReq.send();
}

// add markers to bin locations
function addMarker(mymap, binArray){
	binArray.forEach(function(obj){
		L.marker([obj["latitude"],obj["longitude"]]).addTo(mymap).bindPopup("Level: "+obj["level"]+" .")
    	.openPopup();
	});
}

function getLoc(){
	if(userposition){
		mymap.setView([userposition.coords.latitude, userposition.coords.longitude],16);
		var oReq = new XMLHttpRequest(); //New request object
	    XMLHttpRequest.responseType = "json";
   		oReq.onload = function() {
        //This is where you handle what to do with the response.
        //The actual data is found on this.responseText
        var res=JSON.parse(this.response);
        var circle = L.circle([res["lat"], res["long"]], {
						    color: 'red',
						    fillColor: '#f03',
						    fillOpacity: 0.5,
						    radius: 50,
						}).addTo(mymap);
        alert(this.response);
    	};
    oReq.open("post", "getnearestbin.php", true);
    oReq.setRequestHeader("Content-Type", "application/json");
    var data = JSON.stringify({"lat": userposition.coords.latitude, "long": userposition.coords.longitude});
    oReq.send(data);
	}
	else{
		alert("geolocation not avaliable");
	}
}

var scanner;
function qrScanner(){
	 scanner = new Instascan.Scanner({ video: document.getElementById('preview'),refractoryPeriod:2000 });
      scanner.addListener('scan', function (content) {
        console.log(content);
        var qrReq=new XMLHttpRequest;
        XMLHttpRequest.responseType="json";
        qrReq.onload = function(){
        	alert(this.response);
        	//var res=JSON.parse(this.response);
        }
        var data=JSON.stringify({"id":content});
        qrReq.open("post", "getpromocode.php", true);
    	qrReq.setRequestHeader("Content-Type", "application/json");
    	qrReq.send(data);
      });

	  document.getElementById("preview").className="preview2";
	  document.getElementById("sclose").className="scannerclose";
	  document.getElementById("main").className="main2";
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          console.error('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });
}

function closeScanner(){
	scanner.stop().then(function(){
		document.getElementById("preview").className="preview";
		document.getElementById("sclose").className="scannerclose2";
		document.getElementById("main").className="main";
	
	})
	

}