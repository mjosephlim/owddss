<?php
require 'db.php';
$sql = "SELECT * from cities ORDER BY id";
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()){

echo '<option value="'.$row['city'].'">'.$row['city'].'</option>';
}
$conn->close();
?>