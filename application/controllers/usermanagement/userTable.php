<table class="table table-striped table-hover" id="tabledata">
    <thead>
    <tr>
        <th class="product-name">Id</th>
        <th class="product-name">Username</th>
        <th class="product-price">First Name</th>
        <th class="product-quantity">Last Name</th>
        <th class="product-quantity">Email</th>
        <th class="product-quantity">Type</th>
        <th class="product-quantity">Action</th>
    </tr>
    </thead>
    <tbody >

    <?php
    require("../../models/DB/Db.class.php");
    $db = new Db();
    $lessons = $db->query("SELECT * FROM users");
    $temp = 1;
    foreach ($lessons as $row) {
        $id = $row['id'];
        $firstname = $row['firstName'];
        $lastname = $row['Lastname'];
        $username = $row['username'];
        $email = $row['email'];
        $type = $row['type'];
        $deleteButton = '<a class="btn btn-warning btn-sm"  data-toggle="modal" data-target="#myModal'.$id.'" style = "margin-right:10px;"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>'.
            '<a class="btn btn-danger btn-sm" onclick = "deleteuser('.$id.')" > <span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>'
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
                                            <label for="Name">Username</label>
                                            <input type="text" class="form-control" name="Name" id="Name'.$id.'" placeholder="Username" value="'.$username.'">
                                          </div>

                                          <div class="form-group">
                                            <label for="Lecture">First Name</label>
                                            <input type="text" class="form-control"  name="Lecture" id="Lecture'.$id.'" placeholder="First Name" value="'.$firstname.'">
                                          </div>

                                           <div class="form-group">
                                            <label for="Category">Last Name</label>
                                            <input type="text" class="form-control" name="Category" id="Category'.$id.'" placeholder="Last Name" value="'.$lastname.'">
                                           </div>

                                           <div class="form-group">
                                            <label for="Category">Email Address</label>
                                            <input type="text" class="form-control" name="Category" id="Category'.$id.'" placeholder="Email Address" value="'.$email.'">
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
        echo '<td>' . $username . '</td>';
        echo '<td>' . $firstname . '</td>';
        echo '<td>' . $lastname . '</td>';
        echo '<td>' . $email . '</td>';
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