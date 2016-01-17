<?php
require("../../models/DB/Db.class.php");
$db = new Db();
$lessons = $db->query("SELECT * FROM feedback LIMIT 4");


//remove the on click event no need this
foreach ($lessons as $row) {;
    $name  = $row['user_name'];
    $date  = $row['time_stamp'];
    $topic = $row['topic'];

    //this yan use Reformat date and time
    $date2 = date('M j Y g:i A', strtotime($date));



    echo '<li class="message-preview">';
    echo '<a onclick="loadmasseges()">';
    echo '<div><strong>'.$name.'</strong><span class="pull-right text-muted"><em>'.$date2.'</em></span></div>';
    echo'<div>'.$topic.'</div>';
    echo'</a>';
    echo'</li>';

}

if (count($lessons) == 0){
    echo'<li class="message-footer"><a href="#">No Messages</a></li>';
}else{
    echo'<li class="message-footer"><a onclick="loadmasseges()">Read All Messages</a></li>';
}

?>


