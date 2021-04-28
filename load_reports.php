<?php
require_once  "db.php";

$sql="SELECT city as 'City',COUNT(name) as 'Reports' FROM reportproblem GROUP BY city ORDER BY COUNT(name) DESC";
$result = $conn->query($sql);
$cities=array();
$reports=array();
while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['City']."</td>";
    echo "<td>".$row['Reports']."</td>";
    echo "</tr>";

    $cities[]=$row['City'];
    $reports[]=$row['Reports'];
}





?>