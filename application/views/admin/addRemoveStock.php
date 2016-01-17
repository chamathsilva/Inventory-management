
<div class="row "> <!--do not remove this -->


<div class="col-lg-12">
    <h1 class="page-header" style="margin:50px 0px 20px">
        Manage <small>Lessons</small>
    </h1>

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Manage lessons
        </li>
    </ol>


    <div class="col-lg-12">
        <div id = "results"></div>
        </br>
        <div id= "lesson_table"></div>
    </div>

</div>

</div><!--do not remove -->

<script>
    viewData();
    function viewData(){
        $.ajax({
            type: "GET",
            url: "../../controllers/ManageStock/addRemoveStockTable.php"
        }).done(function(data){
            $("#lesson_table").html(data);

        });
    }

    function addItemToStock(id){

        $('#myModalAdd' + id).on('hidden.bs.modal', function () {
            viewData()

        });

        alert("add item :" + id);
        //get input field values data to be sent to server
        var m_data = new FormData();
        m_data.append( 'Pid',  id);
        m_data.append( 'Amount',  document.getElementById("addamount" + id).value);

        //Ajax post data to server
        $.ajax({
            url: '../../controllers/ManageStock/addStock.php',
            data: m_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){
                //load json data from server and output message
                if (response.type == "text"){
                    $("#results").html(response.text);
                    document.getElementById("Addform" + id).reset();
                }else{
                    $("#results").html(response.text);

                }
            }
        });
    }



    function removeItemFromStock(id){
        $('#myModal' + id).on('hidden.bs.modal', function () {
            viewData()

        });


        alert("Remove item :" + id);
        //get input field values data to be sent to server
        var m_data = new FormData();
        m_data.append( 'Pid',  id);
        m_data.append( 'Amount',  document.getElementById("removeamount" + id).value);

        //Ajax post data to server
        $.ajax({
            url: '../../controllers/ManageStock/removeStock.php',
            data: m_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){
                //load json data from server and output message
                if (response.type == "text"){
                    $("#results").html(response.text);
                    document.getElementById("Addform" + id).reset();
                }else{
                    $("#results").html(response.text);

                }
            }
        });

    }

</script>




