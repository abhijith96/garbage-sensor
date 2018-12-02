<?php
//connecct
$servername = "localhost";
$username= "abhijith";
$password= "password";
$dbname = "garbage";
$conn = new mysqli($servername, $username, $password, $dbname);
//mysql_select_db($dbname, $conn);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "<p>Connected successfully</p>";

$sql = "SELECT * FROM garbage_bins";
$result = $conn->query($sql);

$binlist=array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()){
    	$binlist[$row["id"]]=$row;
   	} 	
}    
echo json_encode($binlist);
$conn->close();
?>