<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Oldies Water District</title>
    
    <?php include "includes.php";?>
        
</head>
<body>
<?php include "./components/nav.php";?>
<div class="container-fluid">

<?php include "alert.php";?>

<form action="create.php" method="POST" id="form">
<div class="col-8 justify-content-center mx-auto" id="main_form" >

<div class="form-control card border-primary mb-3">
<div class="card-header">
<h1 class="card-title">Report Problem</h1>

</div>

<div class="mb-3" style="margin-top:20px">
<label for="Name" class="form-label">Name</label>
<input type="text" class="form-control" id="name" name="name"placeholder="Enter Name">
</div>

<div class="mb-3">
<label for="Address" class="form-label">Address</label>
<input type="text" class="form-control" id="address" name="address" placeholder="Address"></input>
</div>

<div class="row">

<div class="col mb-3">
<label for="city" class="form-label">City/Municipality</label>
<select class="form-control form-select" id="city" name="city">
<option value="NA">Choose City/Municipality</option>
<?php include "select-city.php";?>

</select>
</div><!--col-->

<div class="col mb-3">
<label for="barangay" class="form-label">Barangay</label>
<select class="form-control form-select" id="barangay" name="barangay" >

<?php include "select-barangay.php";?>
</select>
</div><!--col2-->

</div><!--row-->

<div class="mb-3">
<label for="email" class="form-label">Email</label>
<input type="text" class="form-control" id="email" name="email" placeholder="Enter Email"></input>
</div>

<div class="row">
<div class="col mb-3">
<label for="landline" class="form-label">Landline</label>
<input type="text" class="form-control" id="landline" name="landline" placeholder="" maxlength="9"></input>
</div>


<div class="col mb-3">
<label for="mobile" class="form-label">Mobile No.</label>
<input type="text" class="form-control" id="mobile" name="mobile" placeholder="" maxlength="11"></input>
</div>


</div><!--row numbers-->

<div class="mb-3">
<label for="issueclarification" class="form-label">Issue Classification</label>
<select class="form-control form-select" name="issueclarification" id="issueclarification" >
<option value="Dirty Water">Dirty Water</option>
<option value="Water Service Interruption">Water Service Interruption</option>
<option value="No Water Area (Part of Outage)">No Water Area (Part of Outage)</option>
<option value="Water Quality (Others)">Water Quality (Others)</option>
<option value="Water Availability">Water Availability</option>



</select>
</div>
<div class="mb-3">
<label for="issuedetails" class="form-label">Details</label>
<input type="text" class="form-control" id="issuedetails" name="issuedetails" placeholder="Enter Details.."></input>
</div>
<div class="col-md-12 d-flex justify-content-end">
<button type="submit" class="btn btn-primary" name="submit" id="submit" style="border-radius:0.6">Submit</button>
</div>

</div><!--col2-->



</div><!--form-control-->

</div><!--main_form-->



</div><!--container-fluid-->
</body>

<script type="text/javascript">
$(document).ready(function() {
    $('.close').click(function(){
     $("#messages").removeClass('show').addClass('hide').hide();
});

$('#city').change(function(event){
        var city_id = $("#city").val();
        event.preventDefault();
        $.get("select-barangay.php",{city_id:city_id},
        function(res,status,data){
          
           $("#barangay").html(res);
        });
    });


});


</script>
</html>