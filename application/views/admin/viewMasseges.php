<div class="row"> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            View <small>masseges</small>
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> View masseges
            </li>
        </ol>

        <!--->
        <div class="container">
                <div class="col-sm-9 col-md-10">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#home" onclick="loadFullfeedbackrequest()" data-toggle="tab"><span class="glyphicon glyphicon-inbox"></span>Request</a></li>
                        <li><a href="#profile" onclick="loadFullfeedback()" data-toggle="tab"><span class="glyphicon glyphicon-user"></span>Bug reports</a></li>
                    </ul>


                    <!-- Tab panes -->
                    <div class="tab-content">

                        <div class="tab-pane fade in active" id="home">
                            <div class="list-group" id="request"></div>
                        </div>


                        <div class="tab-pane fade in" id="profile">
                            <div class="list-group" id = "bug"></div>
                        </div>
                </div>
            </div>
        </div>
        <!--->
    </div>
</div><!--do not remove -->

<script>
    loadFullfeedbackrequest();

    //reload table after the mode closed.




    function loadFullfeedback(){
        var feedback = $("#bug");
        feedback.empty();
        feedback.prepend('<span class="text-center"><img style="margin-left:30px;" src="../../../assets/images/ajax-loader.gif" /> Loading....</span>');
        feedback.load("../../controllers/massegesmanagement/fetch_fullfeedback.php");
    }

    function loadFullfeedbackrequest(){
        var feedback = $("#request");
        feedback.empty();
        feedback.prepend('<span class="text-center"><img style="margin-left:30px;" src="../../../assets/images/ajax-loader.gif" /> Loading....</span>');
        feedback.load("../../controllers/massegesmanagement/fetch_fullfeedback.php");
    }

    function deleteMasseges(id){

        $('#myModal' + id).on('hidden.bs.modal', function () {
            loadFullfeedback();
            loadFullfeedbackrequest();

        });

        var r = confirm("Are you sure !");
        if (r == true) {
            var m_data = new FormData();
            m_data.append('id', id);
            //Ajax post data to server
            $.ajax({
                url: '../../controllers/massegesmanagement/delete_masseges.php',
                data: m_data,
                processData: false,
                contentType: false,
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    //load json data from server and output message
                    if (response.type == "text") {
                        $("#results").html(response.text);
                    } else {
                        $("#results").html(response.text);

                    }



                }
            });
        }

    }


</script>




