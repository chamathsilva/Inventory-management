<?php
require("../../models/DB/Db.class.php");
$db = new Db();


if(isset($_POST["id"])){
    $id = $_POST["id"];
    $lessons = $db->query("SELECT * FROM `lesson` WHERE `lesson_id` <>".$id);
}





foreach ($lessons as $row) {
    $id = $row['lesson_id'];
    $name = $row['name'];
    $lecture = $row['lecture'];
    $src_path = '../../../data/uploaded_lessons/'.$id.'/slides/1.jpg';

    echo '<li class="media">';
    echo '<div class="col-lg-7 col-md-7 col-xs-7">';
    echo '<a class="pull-left" href="lessonPlay.php?id='."$id".'" >';
    echo '<img class="img-responsive" src='."$src_path".' alt="">';
    echo '</div>';

    echo '<p class="media-heading">'."$name".'</p>';
    //echo '<p class="by-author">'."By "."$lecture".'</p>';
    echo'</a>';

    echo '<li>';
}
?>



