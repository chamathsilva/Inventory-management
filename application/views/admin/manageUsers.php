
<div class="row "> <!--do not remove this -->


    <div class="col-lg-12">
        <h1 class="page-header" style="margin:50px 0px 20px">
            Manage <small>users</small>
        </h1>

        <ol class="breadcrumb">
            <li class="active">
                <i class="fa fa-dashboard"></i> Manage users
            </li>
        </ol>


        <div class="col-lg-12">
            <div id = "results"></div>
            </br>
            <div id= "lesson_table"></div>
        </div>

    </div>

</div><!--do not remove -->


<!-- function need to change according to user update -->

<script>
    viewData();
    function viewData(){
        $.ajax({
            type: "GET",
            url: "../../controllers/usermanagement/userTable.php"
        }).done(function(data){
            $("#lesson_table").html(data);

        });
    }


    function updatedata(id){

        //reload table after the mode closed.
        $('#myModal' + id).on('hidden.bs.modal', function () {
            viewData()

        });


        //get input field values data to be sent to server
        var m_data = new FormData();
        m_data.append( 'id',  id);
        m_data.append( 'Name',  document.getElementById("Name" + id).value);
        m_data.append( 'Lecture', document.getElementById("Lecture" + id).value);
        m_data.append( 'Category', document.getElementById("Category" + id).value);
        m_data.append( 'Type', document.getElementById("Type" + id).value);

        // var user_name = document.getElementById("username").value;
        // var password = document.getElementById("password").value;


        //Ajax post data to server
        $.ajax({
            url: '../../controllers/lessonmanagement/updateLessons.php',
            data: m_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){
                //load json data from server and output message
                if (response.type == "text"){
                    $("#results").html(response.text);
                }else{
                    $("#results").html(response.text);

                }
            }
        });

    }



    function deleteuser(id){
        var r = confirm("Are you sure !");
        if (r == true) {
            var m_data = new FormData();
            m_data.append('id', id);

            //Ajax post data to server
            $.ajax({
                url: '../../controllers/usermanagement/delete_users.php',
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
                    viewData();
                }
            });
        }

    }


</script>

