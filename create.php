<?php
require "db.php";

if (isset($_POST["submit"])){
    $name=$_POST["name"];
    $address=$_POST["address"];
    $city=$_POST["city"];
    $barangay=$_POST["barangay"];
    $email=$_POST["email"];
    $landline=$_POST["landline"];
    $mobile=$_POST["mobile"];
    $issueclarification = $_POST["issueclarification"];
    $issuedetails = $_POST["issuedetails"];


    $sql="INSERT INTO reportproblem(name,address,city,barangay,email,landline,mobile,issueclarification,issuedetails) 
    VALUES('$name','$address','$city','$barangay','$email','$landline','$mobile','$issueclarification','$issuedetails')";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
   
   
    
     $redirect = "index.php?message=successful";
           die( "<script type='text/javascript'>window.location.href='$redirect';</script>" );
              exit;
}

 $conn->close();



?>