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
<div class="col-12 justify-content-center mx-auto">
<div class="form-control card border-primary mt-3 mb-3">
<div class="card-header">
<h1 class="card-title">List of Reported Issues/Problems</h1>

</div>



<table id="myTable" class="display table table-striped mt-5">
    <caption></caption>
<thead>
<tr>
    <th scope="col">Name</th>
    <th scope="col">Address</th>
    <th scope="col">City</th>
    <th scope="col">Barangay</th>
    <th scope="col">Email</th>
    <th scope="col">Landline</th>
    <th scope="col">Mobile</th>
    <th scope="col">Issue Classification</th>
    <th scope="col">Details</th>
</tr>
</thead>
<tbody>
<?php include "read.php";?>

</tbody>

</table>
</div>
</div>
</body>

<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
</html>