<?php
require_once  "db.php";

$sql_issues="SELECT COUNT(issueclarification) AS 'Total' ,issueclarification AS 'Classification'  
FROM reportproblem 
GROUP BY issueclarification 
ORDER BY COUNT(issueclarification) ";

$issues_result = $conn->query($sql_issues);
$issues=array();
$issues_count=array();
while ($row2 = $issues_result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row2['Classification']."</td>";
    echo "<td>".$row2['Total']."</td>";
    echo "</tr>";

    $issues_count[]=$row2['Total'];
    $issues[]=$row2['Classification'];
}





?>