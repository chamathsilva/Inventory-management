<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");
?>

<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Remove <small>Missing</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Remove Missing
            </li>
        </ol>

        <div class="container" >

            <div class="col-sm-8 col-sm-offset-1">


                <form class="form-horizontal" id="userUploadForm" method = "POST" action="../../controllers/addMissing/removemissings.php" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Date</label>
                        <div id="datetimepicker1" class="input-append date">
                            <span class=" add-on glyphicon glyphicon-time " aria-hidden="true"></span>
                            <input data-format="yyyy-MM-dd hh:mm:ss" id="CurrentDate" name="CurrentDate" type="text"> </input>
                        </div>
                    </div>

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


                    <div class="form-group">
                        <label for="refname">Product</label>
                        <select class="form-control" id="productname" name="productname">
                            <option value="">Selet Product</option>
                            <?php  $productList = getProductList();
                            foreach($productList as $product){
                                echo '<option value="'.$product['Product_id'].'">'.$product['Product_Name'].'</option>';
                            }

                            ?>
                        </select>
                    </div>




                    <div class="form-group">
                        <label for="exampAmountleInputPassword1">No of items</label>
                        <input type="text" class="form-control" id="Amount"  name="Amount" placeholder="No of items">
                    </div>

                    <div class="form-group">
                        <button type="button" onclick="upload_form()" id = "submit_btn" name="submit_btn" class="btn btn-info" value="Submit">Submit</button>
                    </div>
                </form>



                <div class="row">
                    <div id="progressbox" ><div id="progressbar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%; max-height:15px; "><div id="statustxt">0%</div ></div></div>
                </div>

                <div class="row">
                    <div class="text-center">
                        <div id="output"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div><!--do not remove -->


<script type="text/javascript">

    $("#userUploadForm").validate({
        rules: {
            refname: {
                required: true

            },

            productname: {
                required: true

            },


            Amount: {
                required: true,
                number :true
                // need to add positive number only
            },

            CurrentDate: {
                required: true

            }


        }

    });

    var options = {
        target:   '#output',   // target element(s) to be updated with server response
        beforeSubmit:  beforeSubmit,  // pre-submit callback
        success:       afterSuccess,  // post-submit callback
        uploadProgress: OnProgress, //upload progress callback
        resetForm: true        // reset the form after successful submit


    };

    function upload_form(){
        $('#userUploadForm').ajaxSubmit(options);
        return false;
    }


    //function after succesful file upload (when server response)
    function afterSuccess()
    {
        $('#submit_btn').show(); //hide submit button
        $('#loading-img').hide(); //hide submit button
        $('#progressbox').delay( 1000 ).fadeOut(); //hide progress bar
        //$('#output').delay( 1000 ).empty(); //empty return  text

    }

    //function to check file size before uploading.


    function beforeSubmit(){
        if (!$('#userUploadForm').valid()) {
            //alert("form is invalid");
            return false;
        }
        //alert("form is valid");
    }


    //progress bar function
    function OnProgress(event, position, total, percentComplete)
    {
        //Progress bar
        $('#progressbox').show();
        $('#progressbar').width(percentComplete + '%'); //update progressbar percent complete
        $('#statustxt').html(percentComplete + '%'); //update status text
        if(percentComplete>50)
        {
            $('#statustxt').css('color','#000'); //change status text to white after 50%
        }
    }

    //function to format bites bit.ly/19yoIPO
    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Bytes';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }



</script>


<script type="text/javascript">
    $(function() {
        $('#datetimepicker1').datetimepicker({
            language: 'us',
            pickTime: false
        });
    });


</script>

