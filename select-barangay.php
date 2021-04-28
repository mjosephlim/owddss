<?php
require 'db.php';

$city_id = $_GET['city_id'];


$sql2 = "SELECT * from locations WHERE city='$city_id' ORDER BY id";
   
$result2 = $conn->query($sql2);

while ($row2 = $result2->fetch_assoc()){
    
echo '<option value="'.$row2['barangay'].'">'.$row2['barangay'].'</option>';    

}

$conn->close();
?>