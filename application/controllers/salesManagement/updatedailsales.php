<?php

require_once("../../controllers/DBfunctions/DbFunctions.php");

//echo $_POST['CurrentDate'];
//Sanitize input data using PHP filter_var().
$Ref_id      = filter_var($_POST["refname"], FILTER_SANITIZE_STRING);
$datestart        = filter_var($_POST["CurrentDate"], FILTER_SANITIZE_STRING);

$dateYM = date('Y-m',strtotime($datestart)); // for month search


$productinfo = getProductInfo();

$dailySales = $db->query("SELECT * FROM Transaction WHERE DATE_FORMAT(Time_Stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$dateYM,"ref_id"=>$Ref_id));

$missing = $db->query("SELECT * FROM Missing WHERE DATE_FORMAT(Time_Stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$dateYM,"ref_id"=>$Ref_id));

$advance = $db->query("SELECT * FROM Advances WHERE DATE_FORMAT(Time_stamp,'%Y-%m') = :yermonth and ref_id = :ref_id",array("yermonth"=>$dateYM,"ref_id"=>$Ref_id));


?>



<div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Sales/Returns</a></li>
        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Advance</a></li>
        <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Missings</a></li>
    </ul>

    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade in active" style="margin-top: 30px;" id="home">

<table class="table table-striped table-hover" id="tabledata1"">
    <thead>
    <tr>
        <th class="product-name">id</th>
        <th class="product-name">Date</th>
        <th class="product-name">Product</th>
        <th class="product-name">Sales</th>
        <th class="product-name">Return</th>
        <th class="product-name">Commision</th>
        <th class="product-quantity">Action</th>
    </tr>
    </thead>
    <tbody >

    <?php

    //$product = $db->query("SELECT * FROM Product");
    $temp = 1;
    foreach ($dailySales as $row) {
        $id = $row['Transaction_id'];
        $productIDD = $row['product_id'];
        $name = $productinfo[$productIDD]['Product_Name'];
        $sales = $row['selles'];
        $return = $row['returns'];
        $commision =  number_format($row['commission'], 2, '.', '');
        $date = date('Y-m-d',strtotime($row['Time_Stamp']));

        $deleteButton =
            '<a class="btn btn-danger btn-sm"  onclick="deleteSales('.$id.','.$productIDD.','.$sales.','.$return.')" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'.
            '<!--a class="btn btn-success btn-sm disabled"  data-toggle="modal" data-target="#myModaledit'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a-->'

            .'<!--  remove Modal edit -->
                                <div class="modal fade" id="myModaledit'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Edit Sales info</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">


                                          <div class="form-group">
                                            <label for="Name">Sales</label>
                                            <input type="text" class="form-control" name="Sales'.$id.'" id="Sales'.$id.'" value = "'.$sales.'"  placeholder="Sales">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Returns</label>
                                            <input type="text" class="form-control" name="Returns'.$id.'" id="Returns'.$id.'" value = "'.$return.'" placeholder="Returns">
                                          </div>

                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "updateProduct('.$id.')" class="btn btn-primary" data-dismiss="modal">Update</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'

        ;

        echo '<tr>';
        echo '<td>' . $temp . '</td>';
        echo '<td>' . $date . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $sales . '</td>';
        echo '<td>' . $return . '</td>';
        echo '<td>' . $commision . '</td>';
        echo '<td>' . $deleteButton . '</td>';
        $temp += 1;
        echo '</tr>';
    }

    ?>
</tbody>
</table>


        </div>
        <div role="tabpanel" class="tab-pane fade" id="profile" style="margin-top: 30px;">
            <table class="table table-striped table-hover" id="tabledata2">
                <thead>
                <tr>
                    <th class="product-name">Id</th>
                    <th class="product-name">Date</th>
                    <th class="product-name">Amount</th>
                    <th class="product-quantity">Action</th>
                </tr>
                </thead>
                <tbody >

                <?php

                $temp = 1;
                foreach ($advance as $row) {
                    $id = $row['Advance_id'];
                    $date = date('Y-m-d',strtotime($row['Time_stamp']));
                    $amount =  number_format($row['Amount'], 2, '.', '');

                    $deleteButton =
                        '<a class="btn btn-danger btn-sm"  onclick="deleteAdvace('.$id.')" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'.
                        '<!--a class="btn btn-success btn-sm disabled"  data-toggle="modal" data-target="#myModaledit'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a-->'


                        .'<!--  remove Modal edit -->
                                <div class="modal fade" id="myModaledit'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Edit Advance</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="Amount'.$id.'" id="Amount'.$id.'" value = "'.$amount.'" placeholder="Amount">
                                          </div>



                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "updateProduct('.$id.')" class="btn btn-primary" data-dismiss="modal">Update</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'

                    ;

                    echo '<tr>';
                    echo '<td>' . $temp . '</td>';
                    echo '<td>' . $date . '</td>';
                    echo '<td>' . $amount . '</td>';
                    echo '<td>' . $deleteButton . '</td>';
                    $temp += 1;
                    echo '</tr>';
                }

                ?>
                </tbody>
            </table>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="messages" style="margin-top: 30px;">
            <table class="table table-striped table-hover" id="tabledata3">
                <thead>
                <tr>
                    <th class="product-name">Id</th>
                    <th class="product-name">Date</th>
                    <th class="product-name">Product</th>
                    <th class="product-name">Amount</th>
                    <th class="product-name">Total Deduction</th>
                    <th class="product-quantity">Action</th>
                </tr>
                </thead>
                <tbody >

                <?php

                $temp = 1;
                foreach ($missing as $row) {
                    $id = $row['Missing_id'];
                    $date = date('Y-m-d',strtotime($row['Time_Stamp']));
                    $productID = $row['Product_id'];
                    $name = $productinfo[$productID]['Product_Name'];
                    $amount = $row['NoOfItem'];
                    $totaldeduction = number_format($row['totalMissingcost'], 2, '.', '');

                    $deleteButton =
                        '<a class="btn btn-danger btn-sm"  onclick="deletMissings('.$id.','.$productID.','.$amount.')" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'.
                        '<!-- a class="btn btn-success btn-sm disabled"  data-toggle="modal" data-target="#myModaledit'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a -->'

                        .'<!--  remove Modal edit -->
                                <div class="modal fade" id="myModaledit'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Edit Missing</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="Amount'.$id.'" id="Amount'.$id.'" value = "'.$amount.'" placeholder="Amount">
                                          </div>




                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "updateMissings('.$id.','.$amount.')" class="btn btn-primary" data-dismiss="modal">Update</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'



                    ;

                    echo '<tr>';
                    echo '<td>' . $temp . '</td>';
                    echo '<td>' . $date . '</td>';
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $amount . '</td>';
                    echo '<td>' . $totaldeduction . '</td>';
                    echo '<td>' . $deleteButton . '</td>';
                    $temp += 1;
                    echo '</tr>';
                }

                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script>

    $(document).ready(function() {
        $('#tabledata1').DataTable();
        $('#tabledata2').DataTable();
        $('#tabledata3').DataTable();
    } );


</script>