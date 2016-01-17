<table class="table table-striped table-hover" id="tabledata">
    <thead>
    <tr>
        <th class="product-name">id</th>
        <th class="product-name">Name</th>
        <th class="product-price">lecture</th>
        <th class="product-quantity">category</th>
        <th class="product-quantity">type</th>
        <th class="product-quantity">Action</th>
    </tr>
    </thead>
    <tbody >

    <?php
    require("../../models/DB/Db.class.php");
    $db = new Db();
    $lessons = $db->query("SELECT * FROM lesson");
    $temp = 1;
    foreach ($lessons as $row) {
        $id = $row['lesson_id'];
        $name = $row['name'];
        $lecture = $row['lecture'];
        $no0fslid = $row['no_of_slides'];
        $category = $row['category'];
        $type = $row['type'];
        $deleteButton = '<a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModal'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>'.
            '<a class="btn btn-danger btn-sm" onclick = "deletelesson('.$id.')" > <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>'
            .'<!-- Modal -->
                                <div class="modal fade" id="myModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel'.$id.'">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel'.$id.'">Update infromation</h4>
                                      </div>
                                      <div class="modal-body">

                                      <form id = "updateform'.$id.'">
                                          <div class="form-group">
                                            <label for="Name">Name</label>
                                            <input type="text" class="form-control" name="Name" id="Name'.$id.'" placeholder="Name" value="'.$name.'">
                                          </div>

                                          <div class="form-group">
                                            <label for="Lecture">Lecture</label>
                                            <input type="text" class="form-control"  name="Lecture" id="Lecture'.$id.'" placeholder="Lecture" value="'.$lecture.'">
                                          </div>

                                           <div class="form-group">
                                            <label for="Category">Category</label>
                                            <input type="text" class="form-control" name="Category" id="Category'.$id.'" placeholder="Category" value="'.$category.'">
                                          </div>

                                           <div class="form-group">
                                            <label for="Type">Type</label>
                                            <input type="text" class="form-control" name="Type" id="Type'.$id.'" placeholder="Type" value="'.$type.'">
                                          </div>

                                      </form>

                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" onclick = "updatedata('.$id.')" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>'
        ;

        echo '<tr>';
        echo '<td>' . $temp . '</td>';
        echo '<td>' . $name . '</td>';
        echo '<td>' . $lecture . '</td>';
        echo '<td>' . $category . '</td>';
        echo '<td>' . $type . '</td>';
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