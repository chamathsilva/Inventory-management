<table class="table table-striped table-hover" id="tabledata">
    <thead>
    <tr>
        <th class="product-name">id</th>
        <th class="product-name">Product Name</th>
        <th class="product-name">Current Stock</th>
        <th class="product-quantity">Action</th>
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
        $current_stock = $db->query("SELECT currentStock FROM Product WHERE Product_id = :pid ",array("pid" => $id));
        $current_stock = $current_stock[0]["currentStock"];
        $deleteButton = '<a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModalAdd'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span></a>'.
            '<a class="btn btn-danger btn-sm"  data-toggle="modal" data-target="#myModalremove'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span></a>'
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






        ;

        echo '<tr>';
        echo '<td>' . $temp . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $current_stock . '</td>';
        echo '<td>' . $deleteButton . '</td>';
        $temp += 1;
        echo '</tr>';
    }

    ?>
    </tbody>
</table>

<script>

    $(document).ready(function() {
        $('#tabledata').DataTable();
    } );


</script>