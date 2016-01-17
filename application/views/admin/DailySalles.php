<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");
?>

<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Daily <small>sales</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Daily sales
            </li>
        </ol>


        <div class="col-lg-12">
            <div id = "results"></div>
            </br>
        </div>




        <form class="form" id="userUploadForm" >

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="exampleInputEmail1">Date</label>
                    <div id="datetimepicker1" class="input-append date">
                        <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                        <input data-format="yyyy-MM-dd hh:mm:ss" id="CurrentDate" name="CurrentDate" type="text"> </input>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label for="refname">Ref Name</label>
                    <select class="form-control" id="refname" name="refname">
                        <option value="">Select Ref Name</option>
                        <?php  $refList = getRefList();
                        foreach($refList as $ref){
                            echo '<option value="'.$ref['Ref_id'].'">'.$ref['Ref_Name'].'</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

        </form>

        <div class="row">
            <div class="col-lg-8">
                <div style="margin-top: 50px;" id= "product_table"></div>
            </div>

            <div class="col-lg-8 text-right " style="margin-top: 50px;">
                <div class="form-group">
                    <button type="button" id = "daliysubmit_btn" name="daliysubmit_btn" class="btn btn-info" value="Submit">Submit</button>
                </div>
            </div>
        </div>

    </div>
</div><!--do not remove -->



<script>
    viewData();
    function viewData(){
        $.ajax({
            type: "GET",
            url: "../../controllers/salesManagement/salesProductTable.php"
        }).done(function(data){
            $("#product_table").html(data);

        });
    }

</script>


<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            language: 'us'
        });
    });


</script>



