<div class="col-sm-12 text">
    <h3 id="topic">Search Result</h3>
    <div id="recentLesson"></div>
</div>

<div class="col-sm-12 text" id="result_wrap">


<?php
//When search button click remove all content in fullBoday.above html part for fill it
require("../../models/DB/Db.class.php");
$db = new Db();

$keyWord = filter_var($_POST["srch-term"],FILTER_SANITIZE_STRING);

if (empty($keyWord)){
    Die("<div>Please Enter key word<div>");

}

//make case insensitive
$keyWord =strtolower($keyWord);;

// search by lesson name or description
$lessons1=  $db->query("SELECT * FROM lesson WHERE LOWER(description) LIKE '%".$keyWord."%' OR LOWER(name) LIKE '%".$keyWord."%' ");

//search by lesson subject
$lessons2=  $db->query("SELECT * FROM lesson INNER JOIN subjects ON lesson.lesson_id=subjects.lesson_id WHERE LOWER(subjects.subject) LIKE '%".$keyWord."%'");



foreach ($lessons1 as $row) {
    $id = $row['lesson_id'];
    $name = $row['name'];
    $src_path = '../../../data/uploaded_lessons/'.$id.'/slides/1.jpg';

    echo '<div class="col-lg-3 col-md-4 col-xs-6 ">';
    echo '<a onclick="myFunction('.$id.')" class="thumbnail" href="../lessonplay/lessonPlay.php?id='."$id".'" >';
    echo '<img class="img-responsive" src='."$src_path".' alt="">';
    //echo '<h6>basic configurations</h6>';
    echo '<h4>'."$name".'</h4>';
    echo'</a>';
    echo'</div>';

}

foreach ($lessons2 as $row) {
    $id = $row['lesson_id'];
    $name = $row['name'];
    $src_path = '../../../data/uploaded_lessons/'.$id.'/slides/1.jpg';

    echo '<div class="col-lg-3 col-md-4 col-xs-6 ">';
    echo '<a onclick="myFunction('.$id.')" class="thumbnail" href="../lessonplay/lessonPlay.php?id='."$id".'" >';
    //echo '<img class="img-responsive" src='."$src_path".' alt="">';
    echo '<h6>basic configurations</h6>';
    echo '<h4>'."$name".'</h4>';
    echo'</a>';
    echo'</div>';

}

if (empty($lessons1) && empty($lessons2)){
    echo '<div>No Search Result Found<div>';

}
?>

</div>


