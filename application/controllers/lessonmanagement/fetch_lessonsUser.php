<?php
require("../../models/DB/Db.class.php");
$db = new Db();
$item_per_page = 4;

//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

//get current starting point of records
$position = ($page_number * $item_per_page);

//Limit our results within a specified range. 

$lessons = $db->query("SELECT * FROM lesson ORDER BY lesson_id DESC LIMIT :pos,:item" ,array("pos" => $position, "item" => $item_per_page));



foreach ($lessons as $row) {
    $id = $row['lesson_id'];
    $name = $row['name'];
    $src_path = '../../../data/uploaded_lessons/'.$id.'/slides/1.jpg';

    echo '<div class="col-lg-3 col-md-4 col-xs-6 text2">';
    echo '<a onclick="myFunction('.$id.')" class="thumbnail" href="../lessonplay/lessonPlay.php?id='."$id".'" >';
    echo '<img class="img-responsive" src='."$src_path".' alt="">';
    echo '<h4>'."$name".'</h4>';
    echo'</a>';
    echo'</div>';

}


?>

