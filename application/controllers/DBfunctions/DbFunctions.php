<?php
    require("../../models/DB/Db.class.php");
    $db = new Db();


    //for debug
    function d($v,$t)
        {
            echo '<pre>';
            echo '<h1>' . $t. '</h1>';
            var_dump($v);
            echo '</pre>';
        }


    function test(){
        global $db;
        $result_set = $db->query("SELECT * FROM users");
        return $result_set;
    }

    //return all rows given table
    function seletAll($table){
        global $db;
        $result_set = $db->query("SELECT * FROM "."$table");
        return $result_set;
    }


    //for index page
    function getTotalpages(){
        global $db;
        $item_per_page = 4; //need to put this configuration file
        $lessons = $db->query("SELECT COUNT(*) FROM lesson");
        $get_total_rows = $lessons[0]["COUNT(*)"];
        //break total records into pages
        $total_pages = ceil($get_total_rows/$item_per_page);
        return $total_pages;
    }


    //lesson play releted functions
    function getLessonById($lesson_id){
        global $db;
        $lessons = $db->query("SELECT * FROM lesson WHERE lesson_id = :lid ",array("lid" => $lesson_id));
        return $lessons[0];
    }

    function getAllBySortOrder($lesson_id){
        global $db;
        $sliddata = $db->query("SELECT * FROM configdata WHERE lesson_id = :lid ORDER BY slide_id",array("lid" => $lesson_id));
        return $sliddata;
    }

    function getTpoicsById($lesson_id){
        global $db;
        $topic = $db->query("SELECT * FROM subtitles WHERE lesson_id = :lid ORDER BY slide_id",array("lid" => $lesson_id));
        return $topic;
    }

    // update resent view
    // update user history
    // update statistic

    function insertresentLesson($lesson_id,$userId){
        global $db;
        $result = $db->query("UPDATE recentlesson SET lesson_id = :lid WHERE user_id = :uid",array("lid" => $lesson_id,"uid" => $userId));
        $result = $db->query("INSERT INTO history (lesson_id,user_id,time_stamp) VALUES (:lid, :uid, CURRENT_TIMESTAMP) ON DUPLICATE KEY UPDATE `time_stamp` = CURRENT_TIMESTAMP",array("lid" => $lesson_id,"uid" => $userId));
        $result = $db->query("INSERT INTO viewcount (lesson_ID,v_date,view_count) VALUES(:lid, CURRENT_TIMESTAMP,1) ON DUPLICATE KEY UPDATE view_count = view_count+1",array("lid" => $lesson_id));
        return $result;

    }


    function getFullUserCount(){
        global $db;
        $userCount = $db->query("SELECT COUNT(*) FROM users");
        return $userCount[0]["COUNT(*)"];
    }

    function getUCSCUserCount(){
        global $db;
        $userCount = $db->query("SELECT COUNT(*) FROM users where type = 2");
        return $userCount[0]["COUNT(*)"];
    }

    function getBITUserCount(){
        global $db;
        $userCount = $db->query("SELECT COUNT(*) FROM users where type = 3");
        return $userCount[0]["COUNT(*)"];
    }
    function getGeneralserCount(){
        global $db;
        $userCount = $db->query("SELECT COUNT(*) FROM users where type = 1");
        return $userCount[0]["COUNT(*)"];
    }

    function getCurrentActiveUsers(){
        global $db;
        $userCount = $db->query("SELECT COUNT(*) FROM sessions");
        return $userCount[0]["COUNT(*)"];

    }

    function getPresentage($variable1,$variable2){
        return round((($variable1/$variable2) * 100),2);


    }

    function getProductStock($pid){
        global $db;
        $userCount = $db->query("SELECT currentStock FROM Product WHERE Product_id = :pid ",array("pid" => $pid));
        return $userCount[0]["currentStock"];

    }

    function getRefList(){
        global $db;
        $reflist = $db->query("SELECT * FROM Ref");
        return $reflist;
    }

    function getProductId(){
        global $db;
        $productlist = $db->query("SELECT Product_id FROM Product");
        $data_array = array();
        foreach ($productlist as $product ){
            $data_array[] = $product['Product_id'];
        }
        return $data_array;
    }

    function getProductInfo(){
        global $db;
        $productlist = $db->query("SELECT * FROM Product");
        $data_array = array();
        foreach ($productlist as $product ){
            $data_array[$product["Product_id"]][] = $product["Commision"];
        }
        return $data_array['5'];

    }






    //  99 - admin
    //  1 - general user
    //  2 - ucsc user
    //  3 - bit user


    //d(getLessonById("108"),"getLessonById");
    //d(test(),"hello");
    //d(seletAll("users"),"hello2");
    //d(getAllBySortOrder("108"),"getAllBySortOrder");
    //d(getTpoicsById("108"),"getTpoicsById");
    //d(insertresentLesson("108","18"),"insertresentLesson");

      //d(getFullUserCount(),"getFullUserCount");
      //d(getUCSCUserCount(),"getUCSCUserCount");
      //d(getBITUserCount(),"getBITUserCount");
      //d(getGeneralserCount(),"getGeneralserCount");
      //d(getCurrentActiveUsers(),"getCurrentActiveUsers");

        //d(getPresentage(getUCSCUserCount(),getFullUserCount()),"getPresentage");

        //d(getProductStock(6),"Productstock");

    //d(getRefList(),"getRefList");
    //d(getProductId(),"getProductId");
    d(getProductInfo(),"getProductInfo");