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
<!-- <?php include "load_trend.php";?> -->
<div class="container-fluid">

<div class="row mt-5 justify-content-center">
<div class="card-header text-center mb-3">
<h2>Report Per City/Municipality</h2>
</div>
    <div class="col-4">
        <div class="card form-control" style="height:500px;width:500px">
            
                    <table id="myTable">
                    <caption></caption>
                    <thead>
                    <tr>
                    <th scope="col">City</th>
                    <th scope="col">Reports</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php include "load_reports.php";?>

                    </tbody>

                    </table>

         </div>
    </div><!--col-5-1-->
    <div class="col-4">
        <div class="card" style="height:500px;width:500px">
        <canvas id="myChart" width="400" height="400"></canvas>
        </div>
    </div>
    
</div>

</div>


<div class="row mt-5 justify-content-center">
<div class="card-header text-center mb-3">
<h2>Total Issues By Classification</h2>
</div>
    <div class="col-4">
        <div class="card form-control" style="height:500px;width:500px">
            
                    <table id="issuesTable">
                    <caption></caption>
                    <thead>
                    <tr>
                    <th scope="col">Classification</th>
                    <th scope="col">Total</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php include "load_issues.php";?>

                    </tbody>

                    </table>

         </div>
    </div><!--col-5-1-->
    <div class="col-4">
        <div class="card" style="height:500px;width:500px">
        <canvas id="issuesChart" width="400" height="400"></canvas>
        </div>
    </div>
    
</div>

</div>

<!-- <div class="row mt-5 justify-content-center">
    <div class="col-12">
        <div class="card mx-auto" style="height:500px;width:500px">
        <canvas id="trendLine" width="400" height="400"></canvas>
        </div>
    </div>
</div> -->

<div class="row mt-5 justify-content-center">
<div class="card-header text-center mb-3">
<h2>Breakdown of Issues/Problems Per City</h2>
</div>


<?php
require_once 'db.php';

$selectcities="SELECT *  FROM cities";
$res_cities = $conn->query($selectcities);

?>



<div class="col-10 ">
    <form action="" class="form-control row" method="GET">
    <div class="form-group d-flex ">
    <label class="align-content-center mt-2" for="filter">Filter Cities</label>
      <select class="form-control mx-3" id="filter" name="filter" style="max-width:30vw">
        <?php
        while ($row_cities = $res_cities->fetch_assoc()){
           echo "<option value='".$row_cities['city']."'>".$row_cities['city']."</option>";
        }
        ?>
      </select>
      <button id="submit" name="submit"class="btn btn-primary">Submit</button>
    </div>
    </form>
    
    <?php
    require_once  "db.php";
    if(isset($_GET['submit'])){
        $getCity=$_GET['filter'];
    }else{
        $getCity="Makati";
    }
    
    
    $sqlGetCity="SELECT COUNT(id) AS 'Total',issueclarification,city from reportproblem where city='".$getCity."'
    GROUP BY issueclarification";
    
    $getCityResult = $conn->query($sqlGetCity);
    $getResultTable= $conn->query($sqlGetCity);
    $resTotal=array();
    $issueDetail=array();
    $cityName=array();
    while ($rowGetCity = $getCityResult->fetch_assoc()){
        
        $citydisplay=$rowGetCity['city'];
        $resTotal[]=$rowGetCity['Total'];
        $issueDetail[]=$rowGetCity['issueclarification'];
        $cityName[]=$rowGetCity['city'];
    }
    
    
    ?>

    
    
   
    <div class="row mt-5 justify-content-center">
    <div class="col-4">
        
        <div class="card form-control" style="height:500px;width:500px">
            
                    <table id="breakdownTable">
                    <?php
                        echo "<h3 class='text-center'>".$citydisplay."</h3>";
                    ?>
                    <caption></caption>
                    <thead>
                    <tr>
                    <th scope="col">Classification</th>
                    <th scope="col">Total</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    while ($rowGetTable = $getResultTable->fetch_assoc()){
                        echo "<tr>";
                        echo "<td>".$rowGetTable['issueclarification']."</td>";
                        echo "<td>".$rowGetTable['Total']."</td>";
                        echo "</tr>";
                    }
                    ?>

                    </tbody>

                    </table>

         </div>
    </div><!--col-5-1-->

    <div class="col-8">
        <div class="card mx-auto" style="height:500px;width:500px">
        <canvas id="breakdownGraph" width="400" height="400"></canvas>
        </div>
    </div>

</div>
</div>


</div><!--container-fluid-->
</body>

<script>
     $(document).ready( function () {
    $('#myTable').DataTable({searching: false, paging: true, info: false,order: [
        [1, 'desc']
    ]});
    $('#issuesTable').DataTable({searching: false, paging: true, info: false,order: [
        [1, 'desc']
    ]});

    $('#breakdownTable').DataTable({searching: false, paging: true, info: false,order: [
        [1, 'desc']
    ]});
} );
</script>

<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var reportsJson=<?php echo json_encode($reports); ?>;
    var citiesJson=<?php echo json_encode($cities); ?>;
    var data1=[],data2=[];
    for(var i =0;i<reportsJson.length;i++){
        data1.push([reportsJson[i]]);
        data2.push([citiesJson[i]]);
    }

    var myChart = new Chart(ctx,{
        type:"bar",
        data:{
            labels:[],
            datasets:[{ 
                label:[],
                data:[],
                barThickness:20,
                backgroundColor: [],
                hoverBackgroundColor:[],
            }],
            
            
        },
        
        options:{
            indexAxis: 'y',
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
                },

                title: {
                display: true,
                text: 'Reports per City Chart'
                }
            }
            
        }
    });


    for(var k=0;k<reportsJson.length;k++){
    let random = Math.floor(Math.random() * 255);

    console.log(data2[k]+"("+data1[k]+")")
    myChart.data.labels.push(data2[k]);
    myChart.data.datasets.forEach((dataset) => {
        dataset.label.push(data2[k]);
        dataset.data.push(data1[k]);
        dataset.backgroundColor.push("hsl("+random+", 59%, 50%)");
        dataset.hoverBackgroundColor.push("hsl("+random+", 90%, 50%)")
    });
   
 }


 

 window.myChart.update();
</script>

<script type="text/javascript">
    var ctx2 = document.getElementById('issuesChart').getContext('2d');
    var classification=<?php echo json_encode($issues); ?>;
    var total=<?php echo json_encode($issues_count); ?>;
    var data3=[],data4=[];
    for(var i =0;i<classification.length;i++){
        data3.push([classification[i]]);
        data4.push([total[i]]);
    }

    console.log(data4)

    

    var issuesChart = new Chart(ctx2,{
        type:"doughnut",
        data:{
            labels:[],
            datasets:[{ 
                label:[],
                data:[],
                barThickness:90,
                backgroundColor: [],
                hoverBackgroundColor:[],
            }],
            
            
        },
        
        options:{
                       
        }
    });

    for(var v=0;v<classification.length;v++){
    let random2 = Math.floor(Math.random() * 255);
    issuesChart.data.labels.push(data3[v]);
    issuesChart.data.datasets.forEach((dataset) => {
        dataset.label.push(data3[v]);
        dataset.data.push(data4[v]);
        dataset.backgroundColor.push("hsl(20"+random2*v+v+", 59%, 50%)");
        dataset.hoverBackgroundColor.push("hsl(20"+random2*v+v+", 90%, 50%)");
    });
    }
   
 


 window.issuesChart.update();
</script>

<!-- <script type="text/javascript">
    var ctx3 = document.getElementById('trendLine').getContext('2d');


    var dirty=<?php echo json_encode($dirty); ?>;
    var dirtyTotal=<?php echo json_encode($dirty_total); ?>;
    
    var interruption=<?php echo json_encode($interruption); ?>;
    var interruptionTotal=<?php echo json_encode($interruption_total); ?>;
    
    var outage=<?php echo json_encode($outage); ?>;
    var outageTotal=<?php echo json_encode($outage_total); ?>;
    
    var others=<?php echo json_encode($dirty); ?>;
    var othersTotal=<?php echo json_encode($dirty_total); ?>;
  

    var dirtyLabel=[],dirtyValues=[];
    var interLabel=[],interValues=[];
    var outageLabel=[],outageValues=[];
    var othersLabel=[],othersValues=[];

    

    for(var l =0;l<dirty.length;l++){
        dirtyLabel.push([dirty[l]]);
        dirtyValues.push([dirtyTotal[l]]);
    }

    for(var m =0;m<interruption.length;m++){
        interLabel.push([interruption[m]]);
        interValues.push([interruptionTotal[m]]);
    }

    for(var n =0;n<dirty.length;n++){
        outageLabel.push([outage[n]]);
        outageValues.push([outageTotal[l]]);
    }

    for(var o =0;o<dirty.length;o++){
        othersLabel.push([others[o]]);
        othersValues.push([othersTotal[o]]);
    }

    console.log()
    
    var months = ['Jan','Feb','March','April','May','June','July'];
    var trendLine = new Chart(ctx3,{
        type:"bar",
        data:{
            labels:[],
            datasets: [
            {
                label: 'Interruption',
                data: [],
                borderColor: 'rgb(75, 192, 192)',
            },
            ]
            
            
        },
        option:{
           
        }
        
    });
for(var v=0;v<interruption.length;v++){
    console.log(interLabel[v])
    trendLine.data.labels.push(interLabel[v]);
    trendLine.data.datasets.forEach((dataset)=>{
        dataset.data.push(interValues[v]);
    });
    
}
   
 

 window.trendLine.update();
</script> -->

<script>
    var ctx4 = document.getElementById('breakdownGraph').getContext('2d');
    var bkTotal=<?php echo json_encode($resTotal); ?>;
    var issueDetail=<?php echo json_encode($issueDetail); ?>;
    var cityName = <?php echo json_encode($cityName); ?>;
    var totalArray=[],detailArray=[],cityArray=[];
    for(var p =0;p<bkTotal.length;p++){
        totalArray.push([bkTotal[p]]);
        detailArray.push([issueDetail[p]]);
        cityArray.push([cityName[p]]);
    }

    var breakdownGraph = new Chart(ctx4,{
        type:"bar",
        data:{
            labels:[],
            datasets:[{ 
                label:[],
                data:[],
                barThickness:40 ,
                backgroundColor: [],
                hoverBackgroundColor:[],
            }],
            
            
        },
        
        options:{
            plugins: {
                legend: {
                    display: false,
                    labels: {
                        color: 'rgb(255, 99, 132)'
                    }
                },

                title: {
                display: true,
                text: 'Breakdown of Issues/Problem'
                }
            }
            
        }
    });


    for(var g=0;g<totalArray.length;g++){
    let random = Math.floor(Math.random() * 255);

    console.log(totalArray[g]+"("+detailArray[g]+")")
    breakdownGraph.data.labels.push(detailArray[g]);
    breakdownGraph.data.datasets.forEach((dataset) => {
        // dataset.label.push(data2[k]);
        dataset.data.push(totalArray[g]);
        dataset.backgroundColor.push("hsl("+random+", 59%, 50%)");
        dataset.hoverBackgroundColor.push("hsl("+random+", 90%, 50%)")
        
    });
    breakdownGraph.options.plugins.title.text = 'Breakdown of Issues/Problem in '+cityArray[0];
    console.log(detailArray[g])
    console.log(totalArray[g])
   console.log(cityArray[0])
 }


 

 window.breakdownGraph.update();
</script>

</html>