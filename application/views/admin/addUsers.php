<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Register <small>users</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Register users
            </li>
        </ol>

        <div class="container" >
            <h2>Bulk Registration</h2>


            <form class="form-horizontal" id="userUploadForm" method = "POST" action="../../controllers/Bulkregistration/readUserFile.php" enctype="multipart/form-data">


                <div class="form-group">
                    <label class="control-label col-sm-2" for="lessonTitle">upload file<span class="required"></span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="FileInput1" id="FileInput1"  >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-9">
                        <button type="button" onclick="upload_form()" id = "submit_btn" name="submit_btn" class="btn btn-info" value="Submit">Submit</button>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div id="progressbox" ><div id="progressbar" class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%; max-height:15px; "><div id="statustxt">0%</div ></div></div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div id="output"></div>
                </div>
            </div>
        </div>
    </div>
</div><!--do not remove -->


<script type="text/javascript">

    $("#userUploadForm").validate({
        rules: {
            FileInput1: {
                required: true

            }

        },
        messages:{

            "FileInput1":{
                required: "Please select a file"
                // extension:"Invalid extension Please select mp4 file "
            }

        },
        errorClass: 'help-block',
        highlight: function(element){
            $(element)
                .closest('.form-group')
                .addClass('has-error');
        },

        unhighlight: function(element){
            $(element)
                .closest('.form-group')
                .removeClass('has-error');
        },
        errorPlacement: function(error,element){
            if (element.prop('type') === 'checkbox'){
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
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

    }

    //function to check file size before uploading.


    function beforeSubmit(){
        if (!$('#userUploadForm').valid()) {
            alert("form is invalid");
            return false;
        }
        alert("form is valid");
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
