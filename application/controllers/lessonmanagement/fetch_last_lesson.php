<?php
require("../../models/DB/Db.class.php");


$db = new Db();
$user_id = filter_var($_POST["uid"],FILTER_SANITIZE_STRING);

$lessonid = $db->query("SELECT lesson_id FROM recentlesson WHERE user_id = :uid ",array("uid"=>$user_id));
$lessonid =  $lessonid[0]["lesson_id"];

$lessons = $db->query("SELECT * FROM lesson WHERE lesson_id = :lid;",array("lid"=>$lessonid));

foreach ($lessons as $row) {
    $id = $row['lesson_id'];
    $name = $row['name'];
    $src_path = '../../../data/uploaded_lessons/'.$id.'/slides/1.jpg';

    echo '<div class="col-md-5 col-xs-8 col-md-offset-3 text2">';
    echo '<a onclick="myFunction('.$id.')" class="thumbnail" href="../lessonplay/lessonPlay.php?id='."$id".'" >';
    echo '<img class="img-responsive" src='."$src_path".' alt="">';
    echo '<h4>'."$name".'</h4>';
    echo'</a>';
    echo'</div>';
}
?>



