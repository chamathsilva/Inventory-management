<?php

require("../../models/DB/Db.class.php");
$db = new Db();
echo "hello world";

echo $_POST['CurrentDate'];?>


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
        <th class="product-name">Product Name</th>
        <th class="product-name">Current Stock</th>
        <th class="product-name">Cost</th>
        <th class="product-name">Selling price</th>
        <th class="product-name">Commision</th>
        <th class="product-quantity">Action</th>
    </tr>
    </thead>
    <tbody >

    <?php

    $product = $db->query("SELECT * FROM Product");
    $temp = 1;
    foreach ($product as $row) {
        $id = $row['Product_id'];
        $name = $row['Product_Name'];
        $current_stock = $row['currentStock'];
        $cost = number_format($row['Cost'], 2, '.', '');
        $sellingPrice =  number_format($row['Selling_price'], 2, '.', '');
        $commision =number_format($row['Commision'], 2, '.', '');
        $deleteButton = '<a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModalAdd'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>'.
            '<a class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModalremove'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'.
            '<a class="btn btn-success btn-sm"  data-toggle="modal" data-target="#myModaledit'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>'
            .'<!--  Add Modal -->
                                <div class="modal fade" id="myModalAdd'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Add '.$name.' To Stock</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "Addform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="addamount'.$id.'" id="addamount'.$id.'" placeholder="Amount">
                                          </div>
                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "addItemToStock('.$id.')" class="btn btn-primary" data-dismiss="modal">Add New Stock</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
            .'<!--  remove Modal -->
                                <div class="modal fade" id="myModalremove'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Remove '.$name.' from Stock</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "Removeform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="removeamount'.$id.'" id="removeamount'.$id.'" placeholder="Amount">
                                          </div>
                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "removeItemFromStock('.$id.')" class="btn btn-primary" data-dismiss="modal">Remove from current Stock</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
            .'<!--  remove Modal edit -->
                                <div class="modal fade" id="myModaledit'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Edit '.$name.'</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Product Name</label>
                                            <input type="text" class="form-control" name="ProductName'.$id.'" id="ProductName'.$id.'" value = "'.$name.'" placeholder="Product Name">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Cost</label>
                                            <input type="text" class="form-control" name="Cost'.$id.'" id="Cost'.$id.'" value = "'.$cost.'"  placeholder="Cost">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Selling Price</label>
                                            <input type="text" class="form-control" name="SellingPrice'.$id.'" id="SellingPrice'.$id.'" value = "'.$sellingPrice.'" placeholder="Selling Price">
                                          </div>


                                          <div class="form-group">
                                            <label for="Name">Commision</label>
                                            <input type="text" class="form-control" name="Commision'.$id.'" id="Commision'.$id.'" value = "'.$commision.'" placeholder="Commision">
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
        echo '<td>' . $name . '</td>';
        echo '<td>' . $current_stock . '</td>';
        echo '<td>' . $cost . '</td>';
        echo '<td>' . $sellingPrice . '</td>';
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
                    <th class="product-name">id</th>
                    <th class="product-name">Product Name</th>
                    <th class="product-name">Current Stock</th>
                    <th class="product-name">Cost</th>
                    <th class="product-name">Selling price</th>
                    <th class="product-name">Commision</th>
                    <th class="product-quantity">Action</th>
                </tr>
                </thead>
                <tbody >

                <?php
                $product = $db->query("SELECT * FROM Product");
                $temp = 1;
                foreach ($product as $row) {
                    $id = $row['Product_id'];
                    $name = $row['Product_Name'];
                    $current_stock = $row['currentStock'];
                    $cost = number_format($row['Cost'], 2, '.', '');
                    $sellingPrice =  number_format($row['Selling_price'], 2, '.', '');
                    $commision =number_format($row['Commision'], 2, '.', '');
                    $deleteButton = '<a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModalAdd'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>'.
                        '<a class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModalremove'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'.
                        '<a class="btn btn-success btn-sm"  data-toggle="modal" data-target="#myModaledit'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>'
                        .'<!--  Add Modal -->
                                <div class="modal fade" id="myModalAdd'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Add '.$name.' To Stock</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "Addform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="addamount'.$id.'" id="addamount'.$id.'" placeholder="Amount">
                                          </div>
                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "addItemToStock('.$id.')" class="btn btn-primary" data-dismiss="modal">Add New Stock</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
                        .'<!--  remove Modal -->
                                <div class="modal fade" id="myModalremove'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Remove '.$name.' from Stock</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "Removeform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="removeamount'.$id.'" id="removeamount'.$id.'" placeholder="Amount">
                                          </div>
                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "removeItemFromStock('.$id.')" class="btn btn-primary" data-dismiss="modal">Remove from current Stock</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
                        .'<!--  remove Modal edit -->
                                <div class="modal fade" id="myModaledit'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Edit '.$name.'</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Product Name</label>
                                            <input type="text" class="form-control" name="ProductName'.$id.'" id="ProductName'.$id.'" value = "'.$name.'" placeholder="Product Name">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Cost</label>
                                            <input type="text" class="form-control" name="Cost'.$id.'" id="Cost'.$id.'" value = "'.$cost.'"  placeholder="Cost">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Selling Price</label>
                                            <input type="text" class="form-control" name="SellingPrice'.$id.'" id="SellingPrice'.$id.'" value = "'.$sellingPrice.'" placeholder="Selling Price">
                                          </div>


                                          <div class="form-group">
                                            <label for="Name">Commision</label>
                                            <input type="text" class="form-control" name="Commision'.$id.'" id="Commision'.$id.'" value = "'.$commision.'" placeholder="Commision">
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
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $current_stock . '</td>';
                    echo '<td>' . $cost . '</td>';
                    echo '<td>' . $sellingPrice . '</td>';
                    echo '<td>' . $commision . '</td>';
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
                    <th class="product-name">id</th>
                    <th class="product-name">Product Name</th>
                    <th class="product-name">Current Stock</th>
                    <th class="product-name">Cost</th>
                    <th class="product-name">Selling price</th>
                    <th class="product-name">Commision</th>
                    <th class="product-quantity">Action</th>
                </tr>
                </thead>
                <tbody >

                <?php

                $product = $db->query("SELECT * FROM Product");
                $temp = 1;
                foreach ($product as $row) {
                    $id = $row['Product_id'];
                    $name = $row['Product_Name'];
                    $current_stock = $row['currentStock'];
                    $cost = number_format($row['Cost'], 2, '.', '');
                    $sellingPrice =  number_format($row['Selling_price'], 2, '.', '');
                    $commision =number_format($row['Commision'], 2, '.', '');
                    $deleteButton = '<a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModalAdd'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>'.
                        '<a class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModalremove'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'.
                        '<a class="btn btn-success btn-sm"  data-toggle="modal" data-target="#myModaledit'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-edit" aria-hidden="true"></span></a>'
                        .'<!--  Add Modal -->
                                <div class="modal fade" id="myModalAdd'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Add '.$name.' To Stock</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "Addform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="addamount'.$id.'" id="addamount'.$id.'" placeholder="Amount">
                                          </div>
                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "addItemToStock('.$id.')" class="btn btn-primary" data-dismiss="modal">Add New Stock</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
                        .'<!--  remove Modal -->
                                <div class="modal fade" id="myModalremove'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Remove '.$name.' from Stock</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "Removeform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Amount</label>
                                            <input type="text" class="form-control" name="removeamount'.$id.'" id="removeamount'.$id.'" placeholder="Amount">
                                          </div>
                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "removeItemFromStock('.$id.')" class="btn btn-primary" data-dismiss="modal">Remove from current Stock</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
                        .'<!--  remove Modal edit -->
                                <div class="modal fade" id="myModaledit'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'"> Edit '.$name.'</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">

                                          <div class="form-group">
                                            <label for="Name">Product Name</label>
                                            <input type="text" class="form-control" name="ProductName'.$id.'" id="ProductName'.$id.'" value = "'.$name.'" placeholder="Product Name">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Cost</label>
                                            <input type="text" class="form-control" name="Cost'.$id.'" id="Cost'.$id.'" value = "'.$cost.'"  placeholder="Cost">
                                          </div>

                                          <div class="form-group">
                                            <label for="Name">Selling Price</label>
                                            <input type="text" class="form-control" name="SellingPrice'.$id.'" id="SellingPrice'.$id.'" value = "'.$sellingPrice.'" placeholder="Selling Price">
                                          </div>


                                          <div class="form-group">
                                            <label for="Name">Commision</label>
                                            <input type="text" class="form-control" name="Commision'.$id.'" id="Commision'.$id.'" value = "'.$commision.'" placeholder="Commision">
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
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $current_stock . '</td>';
                    echo '<td>' . $cost . '</td>';
                    echo '<td>' . $sellingPrice . '</td>';
                    echo '<td>' . $commision . '</td>';
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