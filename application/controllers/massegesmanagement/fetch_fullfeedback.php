<?php
require("../../models/DB/Db.class.php");
$db = new Db();
$lessons = $db->query("SELECT * FROM feedback");


//remove the on click event no need this
foreach ($lessons as $row) {;
    $id = $row['id'];
    $name  = $row['user_name'];
    $date  = $row['time_stamp'];
    $topic = $row['topic'];
    $comment = $row['comment'];

    //this yan use Reformat date and time
    $date2 = date('M j Y g:i A', strtotime($date));



    echo '<a data-toggle="modal" data-target="#myModal'.$id.'" class="list-group-item ">';
    echo '<div class="checkbox"><label><input type="checkbox"></label></div>';
    echo '<span class="glyphicon glyphicon-star"></span>';
    echo '<span class="name" style="min-width: 120px; display: inline-block;">'.$name.'</span> <span class="">'.$topic.'</span>';
    echo '<span class="text-muted" style="font-size: 11px;">-'.$comment.'</span>';
    echo '<span class="badge">'.$date2.'</span>';
    echo '</a>';
    echo '<div class="modal fade" id="myModal'.$id.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">View Messages</h4>
            </div>
            <div class="modal-body">
            From : '.$name.'<br>Topic : '.$topic.'<br><br>'.$comment.'</div>
            <div class="modal-footer">
                <button type="button" onclick = deleteMasseges('.$id.') class="btn btn-default" data-dismiss="modal">Delete</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>';



}

if (count($lessons) == 0){
    echo'<span class="text-center">This tab is empty.</span>';
}
?>


