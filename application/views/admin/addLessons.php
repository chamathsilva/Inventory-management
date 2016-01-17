<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header">
            Publish <small>lessons</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Publish lessons
            </li>
        </ol>

        <div class="container" >
            <h2>Upload lessons</h2>



            <form class="form-horizontal" id="MyUploadForm" method = "POST" action="../../controllers/uploadLesson/uploadLesson.php" enctype="multipart/form-data">

                <div class="form-group" >
                    <label class="control-label col-sm-2" for="lessonTitle">Lesson Title <span class="required"></span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Lesson Title" required="true">
                    </div>
                </div>

                <div class="form-group" >
                    <label for="field5" class="control-label col-sm-2">Description <span class="required"></span></label>
                    <div class="col-sm-9">
                        <textarea class="form-control" rows="4" name="description" id="description"  placeholder="Enter Description" required="true"></textarea>
                    </div>
                </div>

                <div class="form-group" >
                    <label class="control-label col-sm-2" for="lessonTitle">Lecturer <span class="required"></span></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="lecturer" id="lecturer" placeholder="Enter Lecturer Name" required="true">
                    </div>
                </div>

                <div class="form-group col-sm-6 ">
                    <label class="control-label col-sm-2 col-md-offset-2" for="subject" >Subject <span class="required"></span></label>
                    <div class="col-sm-offset-2 col-sm-4">
                        <div class="checkbox">
                            <label><input type="checkbox" value="Algorithm" name="subject[]">Algorithm </label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="Networking" name="subject[]">Networking</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="Enhancement" name="subject[]">Enhancement</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="Programming" name="subject[]">Programming</label>
                        </div>
                    </div>
                </div>

                <div class="form-group col-sm-6">
                    <label class="control-label col-sm-2"   for="users">Users <span class="required"></span></label>
                    <div class="col-sm-offset-2 col-sm-4">
                        <div class="checkbox">
                            <label><input type="checkbox" value="UCSC" name="users[]" id="1"> UCSC</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="BIT" name="users[]" id="2"> BIT</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="public" name="users[]" id="3"> public</label>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" value="visitor" name="users[]" id="3"> visitor</label>
                        </div>
                    </div>
                </div>

                <div class="form-group" >
                    <label class="control-label col-sm-2" for="OtherSubjects">Other Subjects </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="othersubjects" id="othersubjects" placeholder="Enter Other subjects">
                    </div>
                </div>

                <div class="form-group" >
                    <label class="control-label col-sm-2" for="SearchTags">Search Tags </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="searchtags" id="searchtags" placeholder="Enter Tags To Search">
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-sm-2" for="lessonTitle">upload videos <span class="required"></span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="FileInput1" id="FileInput1"  >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="lessonTitle">upload slides <span class="required"></span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="files[]" id="FileInput2" multiple="multiple" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-2" for="lessonTitle">upload config <span class="required"></span></label>
                    <div class="col-sm-9">
                        <input type="file" class="form-control" name="FileInput3" id="FileInput3" >
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-9">
                        <button type="button" onclick="upload_form()" id = "submit_btn" name="submit_btn" class="btn btn-info" value="Submit">Submit</button>
                    </div>
                </div>


                <div class="form-group ">
                    <img src="../../../assets/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
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
    //check which field is required and validate them

    $("#MyUploadForm").validate({
        rules: {
            name: {
                required: true

            },
            description: {
                required: true
            },
            lecturer: {
                required: true
            },
            FileInput1: {
                required: true,
                //extension: "mp4",
            },
            'files[]': {
                required: true,
                //extension: "png",
            },

            FileInput3: {
                required: true,
                //extension: "txt",
            },
            "subject[]":{
                required: true,
                minlength:1,
            },
            "users[]":{
                required: true,
                minlength:1,
            }

        },
        //if there are errors show messages
        messages:{
            "subject[]":"Please select at least one checkbox",
            "FileInput1":{
                required: "Please select mp4 file",
                extension:"Invalis extension Please select mp4 file "
            },
            "files[]":{
                required: "Please select jpeg/png files"
                // extension:"Invalis extension Please select mp4 file "
            },
            "FileInput3":{
                required: "Please select txt file"
                // extension:"Invalis extension Please select mp4 file "
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
        $('#MyUploadForm').ajaxSubmit(options);
        // always return false to prevent standard browser submit and page navigation
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
        //Check form is valid or not in the front end
        if (!$('#MyUploadForm').valid()) {
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