<?php
// Handling data in JSON format on the server-side using PHP
//
$servername = "localhost";
$username= "abhijith";
$password= "password";
$dbname = "garbage";
$conn = new mysqli($servername, $username, $password, $dbname);


// build a PHP variable from JSON sent using POST method
$sta1 =$_POST['status'];
$sta2=$_POST['station'];
$binid=$sta2;
$data=(int)$sta1;
echo "helloworld";
echo "$data";

$binid="";


$sql3="UPDATE garbage_bins SET level=$data WHERE id = 2";
if ($conn->query($sql3) === TRUE) {
  echo "Record updated successfully";
  $status=true;

 } 

     


 
// build a PHP variable from JSON sent using GET method
//$v = json_decode(stripslashes($_GET["data"]));
// encode the PHP variable to JSON and send it back on client-side


$res["status"]=$status;
$res["data"]=$data;
//echo ($res);
//echo ($data);
//echo ($binid);

//echo "<p>".$binlat.$binlong."</p>";


?>
	