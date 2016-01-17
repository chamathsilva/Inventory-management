
<table class="table table-striped table-hover" id="salesItems">
    <thead>
    <tr>
        <th class="product-name">id</th>
        <th class="product-name">Product Name</th>
        <th class="product-quantity">Sales</th>
        <th class="product-quantity">Return</th>
    </tr>
    </thead>
    <tbody >

    <?php
    require("../../models/DB/Db.class.php");
    $db = new Db();
    $product = $db->query("SELECT * FROM Product");
    $temp = 1;
    foreach ($product as $row) {
        $id = $row['Product_id'];
        $name = $row['Product_Name'];

        echo '<tr>';
        echo '<td>' . $temp . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td><input type="text" id="sales'.$id.'" name="sales'.$id.'" value="0"></td>';
        echo '<td><input type="text" id="retrun'.$id.'" name="return'.$id.'" value="0"></td>';
        $temp += 1;
        echo '</tr>';
    }

    ?>
    </tbody>
</table>






<script>

    function mytest(){
        if (!$('#userUploadForm').valid()) {
            alert("form is invalid");
            return false;
        }
        alert("form is valid");
    }


    $("#userUploadForm").validate({
        rules: {
            refname: {
                required: true

            },

            CurrentDate: {
                required: true

            }


        }

    });

    $(document).ready(function() {
        var table = $('#salesItems').DataTable();

        $('#daliysubmit_btn').click( function() {


            var m_data = table.$('input, select').serialize()+ "&CurrentDate=" + document.getElementById("CurrentDate" ).value + "&refname=" + document.getElementById("refname" ).value;

            $("#results").html(m_data);
            //Ajax post data to server
            $.ajax({
                url: '../../controllers/salesManagement/addDailySales.php',
                beforeSend : mytest,
                data: m_data,
                processData: false,
                contentType: false,
                type: 'GET',
                dataType:'json',
                success: function(response){
                    //load json data from server and output message
                    if (response.type == "text"){
                        $("#results").html(response.text);
                        document.getElementById("userUploadForm").reset();
                    }else{
                        $("#results").html(response.text);

                    }
                }


            })
                // using the fail promise callback
                .fail(function(data) {

                    // show any errors
                    // best to remove for production
                    console.log(data);
                });

            return false;
        } );
    } );

</script>
