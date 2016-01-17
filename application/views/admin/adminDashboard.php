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




    </div>

</div><!--do not remove -->
<?php

    require_once("../../controllers/DBfunctions/DbFunctions.php");
?>

<script>
    $("#graph").load("../../controllers/statics/graph_data.php");

</script>