<?php
include 'db.php';

$sql = "SELECT * FROM reportproblem ORDER BY id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()){
    echo "<tr>";
    echo "<td>".$row['name']."</td>";
    echo "<td>".$row['address']."</td>";
    echo "<td>".$row['city']."</td>";
    echo "<td>".$row['barangay']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['landline']."</td>";
    echo "<td>".$row['mobile']."</td>";
    echo "<td>".$row['issueclarification']."</td>";
    echo "<td>".$row['issuedetails']."</td>";
    echo "</tr>";
}
$conn->close();
?>