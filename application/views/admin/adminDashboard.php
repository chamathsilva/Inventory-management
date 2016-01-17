<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Dashboard <small>Statistics Overview</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Dashboard
            </li>
        </ol>






        <div class="col-sm-12">
            <div id="graph">
                <img style="margin-left:30px;" src="../../../assets/images/ajax-loader.gif">
                Loading...
            </div>
        </div>

        <hr/>

        <div class="col-sm-12">
            <div class="clearfix" style="margin-left: 100px; margin-top: 40px;">
                <div id="clock" style="margin-left: 50px;"class="red "></div>
                <div id="UCSC" style="margin-left: 50px;"class="yellow "></div>
                <div id="BIT" style="margin-left: 50px;"class="orange "></div>
                <div id="GENARAL" style="margin-left: 50px;"class="purple "></div>
                <div id="ACTIVE" style="margin-left: 50px;"class="BLUE "></div>
            </div>

        </div>
        <div class="col-sm-12">
            <div class="col-sm-offset-2">
                <div id="clock"  class="col-sm-2">Clock</div>
                <div id="UCSC" class="col-sm-2">UCSC</div>
                <div id="BIT"  class="col-sm-2">BIT</div>
                <div id="GENARAL"  class="col-sm-3">Genaral</div>
                <div id="ACTIVE"  class="col-sm-2">Active</div>
            </div>

        </div>

    </div>

</div><!--do not remove -->
<?php

    require_once("../../controllers/DBfunctions/DbFunctions.php");
?>

<script>
    $("#graph").load("../../controllers/statics/graph_data.php");

    $(function(){
        $("[id$='circle']").percircle();

        $("#clock").percircle({
            perclock: true

        });


        $("#UCSC").percircle({
            percent: <?php echo getPresentage(getUCSCUserCount(),getFullUserCount());?>
        });

        $("#BIT").percircle({
            percent: <?php echo getPresentage(getBITUserCount(),getFullUserCount());?>
        });

        $("#GENARAL").percircle({
            percent: <?php echo getPresentage(getGeneralserCount(),getFullUserCount());?>
        });

        $("#ACTIVE").percircle({
            percent: <?php echo getPresentage(getCurrentActiveUsers(),getFullUserCount());?>
        });
    });
</script>