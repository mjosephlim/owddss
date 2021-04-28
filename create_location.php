<?php
require "db.php";

if (isset($_POST["submit"])){
    
    $city=$_POST["city"];
    $barangay=$_POST["barangay"];
    


    $sql="INSERT INTO locations(city,barangay) 
    VALUES('$city','$barangay')";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $redirect = "locations.php?message=successful";
    die( "<script type='text/javascript'>window.location.href='$redirect';</script>" );
    exit;
}
    $conn->close();
    





?>