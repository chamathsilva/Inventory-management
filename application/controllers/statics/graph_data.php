<?php
require("../../models/DB/Db.class.php");
$db = new Db();


function totalView($lessonid,$dbnew){
    $stat = $dbnew->query("SELECT SUM(view_count) AS VIEWS FROM viewcount WHERE lesson_id = :id",array("id"=>$lessonid));
    $stat =  $stat[0]["VIEWS"];
    if ($stat == false){
        return 0;
    }
    return $stat;
}


function countView($lessonid,$days,$dbnew){

    $date = date('Y-m-d');
    $lday = date_create($date);
    date_sub($lday,date_interval_create_from_date_string("$days days"));
    $lastday = date_format($lday,"Y-m-d");
    /*echo $lastday,$date;*/
    $stat = $dbnew->query("SELECT SUM(view_count) AS VIEWS FROM viewcount WHERE lesson_id = :id and v_date<=:tday and v_date >:lastday",array("id"=>$lessonid,"tday"=>$date,"lastday"=>$lastday));
    $stat =  $stat[0]["VIEWS"];
    if ($stat == false){
        return 0;
    }
    return $stat;
}


//fix as single query

$statmant = $db->query("SELECT lesson_id FROM lesson");
$statmentname = $db->query("SELECT name FROM lesson");


$data_array  = array();
foreach ($statmant as $lesson ){
    $data_array[] = $lesson['lesson_id'];
}

$name_array  = array();
foreach ($statmentname as $lessonname ){
$name_array[] = $lessonname['name'];
}





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
                text: 'Monthly Views'
            },
            credits: false,
            xAxis: {
                categories: [
                    <?php for($x=0; $x<count($data_array); $x++){
                        echo "'".$name_array[$x]."'";
                        echo ",";
                    }
                    ?>

                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Views'
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
                name: 'Views',
                data: [
                    <?php for($x=0; $x<count($data_array); $x++)
                            {
                                echo countView($data_array[$x],30,$db);
                                echo ",";
                            }

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
                text: 'Total views'
            },
            credits: false,
            xAxis: {
                categories: [
                    <?php for($x=0; $x<count($data_array); $x++){
                        echo "'".$name_array[$x]."'";
                        echo ",";
                    }
                    ?>

                ]
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Views'
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
                name: 'Views',
                color: 'Orange',
                data: [
                    <?php for($x=0; $x<count($data_array); $x++)
                            {
                                echo totalView($data_array[$x],$db);
                                echo ",";
                            }

                    ?>
                ]
            }]
        });
    });

</script>