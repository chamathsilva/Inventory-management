
<div class="row "> <!--do not remove this -->


<div class="col-lg-12">
    <h1 class="page-header" style="margin:50px 0px 20px">
        Manage <small>stock</small>
    </h1>

    <ol class="breadcrumb">
        <li class="active">
            <i class="fa fa-dashboard"></i> Manage stock
        </li>
    </ol>


    <div class="col-md-10 col-md-offset-1">
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

        //alert("add item :" + id);
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
        $('#myModalremove' + id).on('hidden.bs.modal', function () {
            viewData()

        });


        //alert("Remove item :" + id);
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


    function updateProduct(id){
        $('#myModaledit' + id).on('hidden.bs.modal', function () {
            viewData()

        });


        //alert("Remove item :" + id);
        //get input field values data to be sent to server
        var m_data = new FormData();
        m_data.append( 'Pid',  id);
        m_data.append( 'ProductName',  document.getElementById("ProductName" + id).value);
        m_data.append( 'Cost',  document.getElementById("Cost" + id).value);
        m_data.append( 'SellingPrice',  document.getElementById("SellingPrice" + id).value);
        m_data.append( 'Commision',  document.getElementById("Commision" + id).value);

        //Ajax post data to server
        $.ajax({
            url: '../../controllers/ManageStock/updateproduct.php',
            data: m_data,
            processData: false,
            contentType: false,
            type: 'POST',
            dataType:'json',
            success: function(response){
                //load json data from server and output message
                if (response.type == "text"){
                    $("#results").html(response.text);
                    document.getElementById("updateform" + id).reset();
                }else{
                    $("#results").html(response.text);

                }
            }
        });

    }

</script>




