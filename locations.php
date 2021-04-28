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

<form action="create_location.php" method="POST" id="form">
<div class="col-8 justify-content-center mx-auto" id="main_form" >
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
<input type="text" class="form-control" name="barangay" id="barangay" placeholder="Enter Barangay" style="text-transform:uppercase">
</div><!--col2-->

</div><!--row-->

<div class="col-md-12 d-flex justify-content-center">
<button type="submit" class="btn btn-primary" name="submit" id="submit" style="border-radius:0.6">Submit</button>
</div>



</div><!--col2-->



</div><!--form-control-->

</div><!--main_form-->
</form>


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