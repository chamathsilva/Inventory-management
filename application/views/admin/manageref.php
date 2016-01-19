<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");
?>

<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Manage <small>ref info</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Manage ref info
            </li>
        </ol>

        <div class="container" >

            <div class="col-md-8 col-md-offset-1">

                <form class="form-horizontal" id="getinfo" method = "POST" action="../../controllers/Advance/Advance.php" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <div id="datetimepickerinfo" class="input-append date">
                                    <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                                    <input data-format="yyyy-MM-dd hh:mm:ss" id="CurrentDate" name="CurrentDate" type="text"> </input>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
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

                        <div class="col-md-4 ">
                            <div class="form-group " style="margin-left: 50px; margin-top: 25px;">
                                <button type="button"  id = "getrefinfo" name="getrefinfo" class="btn btn-info" >search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>



                <div class="row">
                    <div class="col-md-12 ">
                        <div id = "results"></div>
                    </div>
                </div>

        </div>
    </div>
</div><!--do not remove -->

<script>

    $("#getinfo").validate({
        rules: {
            refname: {
                required: true

            },

            CurrentDate: {
                required: true

            }
        }

    });

    function beforeSubmit(){
        if (!$('#getinfo').valid()) {
            alert("form is invalid");
            return false;
        }
        alert("form is valid");
        return true;

    }

    $(document).ready(function() {

        $("#getrefinfo").click(function() {
            if (beforeSubmit() == true){

                var m_data = new FormData();
                m_data.append( 'CurrentDate',  document.getElementById("CurrentDate" ).value);
                m_data.append( 'refname', document.getElementById("refname").value);

                $.ajax({
                    data: m_data,
                    type: "post",
                    processData: false,
                    contentType: false,
                    url: "../../controllers/salesManagement/updatedailsales.php",
                }).done(function(data){
                    $("#results").html(data);

                });





            } //end of the true

        });


    });







</script>

<script type="text/javascript">
    $(function() {
        $('#datetimepickerinfo').datetimepicker({
            language: 'us',
            pickTime: false
        });
    });


</script>


