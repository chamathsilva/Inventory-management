<div class="col-sm-12 text">
    <h3 id="topic">History</h3>
    <div id="recentLesson"></div>
</div>

<div class="col-sm-12 text" id="result_wrap">

    <?php
    require("../../models/DB/Db.class.php");
    $db = new Db();
    session_start();


    //$user_id =  $_SESSION["user"];
    $user_id = filter_var($_POST["uid"],FILTER_SANITIZE_STRING);
    //$user_id = 13;

    $lessons = $db->query("SELECT * FROM history WHERE user_id = :uid ORDER BY time_stamp" ,array("uid" => $user_id));


    foreach ($lessons as $row) {
        $id = $row['lesson_id'];
        $time = $row['time_stamp'];
        $name = $row['lesson_name'];
        $src_path = '../../../data/uploaded_lessons/'.$id.'/slides/1.jpg';

        /*
        echo '<li class="media">';
        echo '<div class="col-lg-7 col-md-7 col-xs-7">';
        echo '<a class="pull-left" href="../lessonsplay/lessonPlayLater.php?id='."$id".'&time='.$time.'" >';
        echo '<img class="img-responsive" src='."$src_path".' alt="">';
        echo '</div>';
        echo '<p class="media-heading">'."$name".'</p>';
        //echo '<p class="by-author">'."By "."$lecture".'</p>';
        echo'</a>';
        echo '<li>';
        */
        echo '<div class="col-lg-3 col-md-4 col-xs-6 text2">';
        echo '<a onclick="myFunction('.$id.')" class="thumbnail" href="../lessonplay/lessonPlay.php?id='."$id".'" >';
        echo '<img class="img-responsive" src='."$src_path".' alt="">';
        echo '<h4>'."$name".'</h4></a><span style="margin-right:10px;float:right" class="btn btn-danger btn-sm" onclick = "deleteHistory('.$id.')" > <span class="glyphicon glyphicon-trash" aria-hidden="true"></span> </span>'.'</h4>';
        echo'</a>';
        echo'</div>';
    }

    if (count($lessons) == 0){
        echo "<div>This list has no lessons.<div>";
    }
    ?>

    <div>




