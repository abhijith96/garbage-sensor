 <!DOCTYPE html>
<html>
<head>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css" type=text/css>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
   integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
   crossorigin=""/>
   <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
   integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
   crossorigin=""></script>
   <script src="script.js"></script>
   <script type="text/javascript" src="adapter.js"></script>
   <script src="instascan.min.js"></script>
   <style type="text/css">
	   #mapid{
	   	height:50vh;
	   }
	</style>
		
<?php
//connecct
$servername = "localhost";
$username= "abhijith";
$password= "password";
$dbname = "garbage";
$conn = new mysqli($servername, $username, $password, $dbname);
$stat="";
//mysql_select_db($dbname, $conn);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
$stat="connection successfull";

?>

</head>

<body onload="myfunc()">
  <div class="container">
    <div id =main class="main1">
    <div class=header>
      <h1>Garbage Manager</h1>
    </div>  
    <div class="content">
  	<p id="demo"><?php echo "$stat" ?></p>
  	<button onclick="test()">Hehe</button>
  <?php

  //query

  $sql = "SELECT * FROM garbage_bins";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
      // output data of each row
      echo "<table>";
      while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["id"]."</td>"."<td>".$row["latitude"]."</td>"."<td>".$row["longitude"]."</td>"."<td>".$row["level"]."</td></tr>";
      }
      echo "</table>";
  } else {
      echo "0 results";
  }

  // // declare a string, double and integer
  // $test = "kundsmen";
  // $res=strpos($test, "myr");
  // if($res===0){
  // 	print("<p>found at pos 0. </p>");
  // }
  // elseif($res==0){
  // 	print("<p>Hello not found</p>");
  // }	
  // $testDouble = 79.2;
  // $testInteger = 12;
  // $sub2=trim($test);
  // $sub=substr($test, 3);
  // print("<p>substring trim is .$sub2 </p>");
  // print("<p>substring is $sub </p>");

  $conn->close();
  ?><!-- end PHP script -->
  </div>
  <div id="mapid"></div>
  
  <div class="button-container">
    <button onclick="getLoc()">GetLoc</button>
    <button onclick="qrScanner()">Scan QR Code</button>
  </div>
</div>
<div class="video-container">
    <video class="preview1" id="preview"></video>
    <button id="sclose" class="scannerclose2" onclick="closeScanner()">Close</button>
  </div>
 </div>
</body>
</html> 
