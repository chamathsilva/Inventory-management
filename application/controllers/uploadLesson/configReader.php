<?php

function readConfigFile($id,$name){

    require_once("../../models/DB/Db.class.php");
    $db = new Db();
    $lineCount=0;
    $newLine=0;
    //open uploaded file from the correct destination
    $myfile = fopen("../../../data/uploaded_lessons/$id/$name", "r") or die("Unable to open file!");

    //read until end of the file
    while(!feof($myfile)){
        //get the return line from the fgets
        $currentLine = fgets($myfile);
        if(trim($currentLine) != ''){
            //separate values of the row by comma
            $currentLine = explode(',', $currentLine);
            //i times stamp has given do following
            if (!((empty($currentLine[1])))) {
    //then convert time stamp into seconds
                $time = explode(':', $currentLine[1]);
                $hours = $time[0];
                $minites = $time[1];
                $seconds = $time[2];
                $endTime = $hours * 3600 + $minites * 60 + $seconds;

            }
        //get newline variable to read easily
            if ($newLine == 0) {
                $no_of_slides = $db->query("UPDATE lesson SET no_of_slides=$currentLine[0] WHERE (lesson_id=$id)");

                //if succesfuly added the number of slides
                if ($no_of_slides) {
#                   echo " no of slides added successfully";
                    $newLine++;
                }
                else {
                    die (" no of slides added not successed ");
                }
            }
            //go to the second line
            else if ($newLine == 1) {
            //insert previous rows starttime+1 value and others into configdata table
                $config_data = $db->query("INSERT INTO configdata(lesson_id, slide_id, start_time,end_time) VALUES
(:lid,:sid,:st,:et)", array("lid" => $id, "sid" => $currentLine[0], "st" => 0, "et" => $endTime));

                //if config data added successfully then goto sub topics column
                if ($config_data) {
                    if (!((empty($currentLine[2])))) {

                    //insert subtopics into subtitles tables with the corresponding lesson id
                        $subt = $db->query("INSERT INTO subtitles(lesson_id, slide_id, sub_title,start_time) VALUES
(:leid,:slid,:sut,:sat)", array("leid" => $id, "slid" => $currentLine[0], "sut" => $currentLine[2], "sat" =>0));
                    }
                    $oldEndTime = $endTime;
                    $newstartTime = $oldEndTime + 1;
                    $newLine++;
                }
                else {
                    echo " config data added not successed ";
                }
            }
            //read lines except 1 and 2
            else {
                $config_data = $db->query("INSERT INTO configdata(lesson_id, slide_id, start_time,end_time) VALUES
(:lid,:sid,:st,:et)", array("lid" => $id, "sid" => $currentLine[0], "st" => $newstartTime, "et" => $endTime));

                if ($config_data) {
                    if (!((empty($currentLine[2])))) {
            //read sub topics
                        $subt = $db->query("INSERT INTO subtitles(lesson_id, slide_id, sub_title,start_time) VALUES
(:leid,:slid,:sut,:sat)", array("leid" => $id, "slid" => $currentLine[0], "sut" => $currentLine[2], "sat" => $newstartTime));

                    }
                    //set previous time
                    $oldEndTime = $endTime;
                    $newstartTime = $oldEndTime + 1;
                    $newLine++;
                }
                else {
                    die(" config data added not successed ");
                }
            }
        }
        else{
            #echo "There was a blank line at line number <br />";
        }
    }
//close the config file
    fclose($myfile);


}


?>