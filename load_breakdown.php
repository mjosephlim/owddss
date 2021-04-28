<?php
require_once  "db.php";
if(isset($_GET['submit'])){
    $getCity=$_GET['filter'];
}else{
    $getCity="SAN JUAN CITY";
}


$sqlGetCity="SELECT COUNT(id) AS 'Total',issueclarification,city from reportproblem where city='".$getCity."'
GROUP BY issueclarification";

$getCityResult = $conn->query($sqlGetCity);
$resTotal=array();
$issueDetail=array();
while ($rowGetCity = $getCityResult->fetch_assoc()){

    $resTotal[]=$rowGetCity['Total'];
    $issueDetail[]=$rowGetCity['issueclarification'];
}


?>