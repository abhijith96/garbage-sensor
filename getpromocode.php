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
$binid=(int)$v["id"];
$sql = "SELECT level, prevlevel FROM garbage_bins WHERE id =".$binid;
$result = $conn->query($sql);
$returnval="sorry no promocodes for now";
$oldcount=0;
$oldid=-1;
$status=false;
$minabs=9999;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $levelchan = $row["level"]-$row["prevlevel"];
    if($levelchan>0){
        $sql2="SELECT * FROM coupon_details";
        $result2=$conn->query($sql2);
        if($result2->num_rows>0){
            
            while($row2 = $result2->fetch_assoc()){
            $diff=abs($row2["levelchange"]-$levelchan);
            if($diff<$minabs && $row2["levelchange"]<$levelchan && $row2["count"]>0){
                $minabs=$diff;
                $returnval=$row2["offercode"];
                $oldcount=$row2["count"];
                $oldid=$row2["id"];

            }
    }   
        }
    }
 } 

 if($minabs<9999){
    $oldcount=$oldcount-1;
    $sql3="UPDATE coupon_details SET count=$oldcount WHERE id = $oldid";
    if ($conn->query($sql3) === TRUE) {
       // echo "Record updated successfully";
        $status=true;

    } 
 }    

 
// build a PHP variable from JSON sent using GET method
//$v = json_decode(stripslashes($_GET["data"]));
// encode the PHP variable to JSON and send it back on client-side

$res["promocode"]=$returnval;
$res["status"]=$status;
echo json_encode($res);

//echo "<p>".$binlat.$binlong."</p>";
$conn->close();

?>
	