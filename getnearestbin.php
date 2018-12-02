
<?php
// Handling data in JSON format on the server-side using PHP
//

$servername = "localhost";
$username= "abhijith";
$password= "password";
$dbname = "garbage";
$conn = new mysqli($servername, $username, $password, $dbname);

header("Content-Type: application/json");
// build a PHP variable from JSON sent using POST method
$v = json_decode(stripslashes(file_get_contents("php://input")), true);
$threshold=80;
$lat = $v["lat"];
$long = $v["long"];
$sql = "SELECT * FROM garbage_bins";
$result = $conn->query($sql);
$min=99999;
$binlat="nill";
$binlong="nill";
$binid;
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
    	$xdiff=$row["latitude"]-$lat;
    	$ydiff=$row["longitude"]-$long;
    	$level=$row["level"];
    	$temp=sqrt(pow($xdiff,2)-pow($ydiff,2));
    	if($temp<$min && $level<=$threshold){
    		$min=$temp;
    		$binlat=$row["latitude"];
    		$binlong=$row["longitude"];
    		$binid=$row["id"];
    	
    	}
   	} 	
}  
// build a PHP variable from JSON sent using GET method
//$v = json_decode(stripslashes($_GET["data"]));
// encode the PHP variable to JSON and send it back on client-side
$res["lat"]=$binlat;
$res["long"]=$binlong;
$res["id"]=$binid;
$res["distance"]=$min;
echo json_encode($res);
//echo "<p>".$binlat.$binlong."</p>";
$conn->close();

?>
	