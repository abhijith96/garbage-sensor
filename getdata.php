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

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
}    
$conn->close();
?>