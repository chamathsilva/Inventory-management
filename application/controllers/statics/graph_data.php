<?php
require("../../models/DB/Db.class.php");
$db = new Db();



//fix as single query

$statmant = $db->query("SELECT * FROM Product");
//$statmentname = $db->query("SELECT name FROM lesson");
/*
foreach ($statmant as $row){
    echo'<pre>';
    var_dump($row['Product_Name']);
    var_dump($row['currentStock']);
    echo'</pre>';
}
*/

?>



<div class="col-sm-6">
    <div id = "test"> </div>
</div>
<div class="col-sm-6">
    <div id = "test2"> </div>
</div>

<script>
    $(function () {
        $('#test').highcharts({
            chart: {
                type: 'line'
            },
            title: {
                text: 'Stock'
            },
            credits: false,
            xAxis: {
                categories: [

                    <?php
                    foreach ($statmant as $row){
                            echo "'".$row['Product_Name']."'";
                            echo ",";
                        }


                /*
                    for($x=0; $x<count($data_array); $x++){
                        echo "'".$name_array[$x]."'";
                        echo ",";
                    }*/
                    ?>

                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stock'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                line: {
                    dataLabels:{
                        enabled:true
                    },
                    enableMouseTracking:false
                }
            },
            series: [{
                name: 'Stock',
                data: [
                    <?php

                    foreach ($statmant as $row){
                            echo $row['currentStock'];
                            echo ",";
                        }


                    /*

                    for($x=0; $x<count($data_array); $x++)
                            {
                                echo countView($data_array[$x],30,$db);
                                echo ",";
                            }*/

                    ?>
                ]
            }]

        });
    });

</script>


<script>
    $(function () {
        $('#test2').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Current Stock'
            },
            credits: false,
            xAxis: {
                categories: [
                    <?php

                      foreach ($statmant as $row){
                            echo "'".$row['Product_Name']."'";
                            echo ",";
                        }
                    ?>

                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Stock'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Stock',
                color: 'Orange',
                data: [
                    <?php

                    foreach ($statmant as $row){
                            echo $row['currentStock'];
                            echo ",";
                        }



                    ?>
                ]
            }]
        });
    });

</script>