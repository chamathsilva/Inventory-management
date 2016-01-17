<?php
require_once("configReader.php");
require_once("subjectReader.php");
require_once("tagReader.php");
require_once("../../models/DB/Db.class.php");
$db = new Db();
//check if this is an ajax request
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
    die();
}

if (isset($_FILES["FileInput1"]) && $_FILES["FileInput1"]["error"] == UPLOAD_ERR_OK) {

    //check if this is an ajax request
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        die();
    }
    //allowed file type Server side check
    switch (strtolower($_FILES['FileInput1']['type'])) {
        //allowed file type is mp4
        case 'video/mp4':
            break;
        default:
            die('Unsupported File Please upload mp4 file!'); //Output error,Stops at this point
    }
}
else {
    die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}


if (isset($_FILES["files"])) {

//check if this is an ajax reques
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        die();
    }

//allowed file type Server side check check all uploaded slides one by one
    foreach($_FILES['files']['name'] as $i=>$name) {

//convert file name into lowercase
        switch (strtolower($_FILES['files']['type'][$i])) {

//allowed file type is png
            case 'image/jpeg':
                break;
            default:
                die('Unsupported File Please upload jpeg/png file!'); //output error
        }
    }
}
else {
    die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}


if (isset($_FILES["FileInput3"]) && $_FILES["FileInput3"]["error"] == UPLOAD_ERR_OK) {

    //check if this is an ajax request
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        die();
    }
    //allowed file type Server side check

    switch (strtolower($_FILES['FileInput3']['type'])) {

        //allowed file type is txt
        case 'text/plain':
        break;
        default:
            die('Unsupported File Please upload txt file!'); //output error
    }
} else {
    die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
}
//if all files are uploaded correctly, following things happen, it is a part of validation
//get first three text fields and assign to variables
$lesson_name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$description = filter_var($_POST["description"], FILTER_SANITIZE_STRING);
$lecturer = filter_var($_POST["lecturer"], FILTER_SANITIZE_STRING);

//insert text field values into lesson table
$lessons = $db->query("INSERT INTO lesson(name, description, lecture) VALUES (:nam,:des,:lec)",array("nam"=>$lesson_name,"des"=>$description,"lec"=>$lecturer));

//get the id of last inserted row
$lessonID=$db->lastInsertId();

//upload files separately into the unique folder of the uploads folder
$UploadDirectory1 = '../../../data/uploaded_lessons/' . $lessonID . '/' . 'videos/';
$UploadDirectory2 = '../../../data/uploaded_lessons/'.$lessonID.'/'.'slides/';
$UploadDirectory3 = '../../../data/uploaded_lessons/'.$lessonID.'/';

//get file name
$File_Name = strtolower($_FILES['FileInput1']['name']);
//rename video file always as 1.mp4
$NewFileName = "1.mp4";

//if not directly by above name create it.
if(!file_exists($UploadDirectory1)){
    mkdir($UploadDirectory1,0755, true);
}
//move temporary uploaded file into the folder created above
if (move_uploaded_file($_FILES['FileInput1']['tmp_name'], $UploadDirectory1 . $NewFileName)) {
    //  die('Success! File Uploaded.');

} else {
    die('error uploading File!');
}
//make folder to slides
if(!file_exists($UploadDirectory2)){
    mkdir($UploadDirectory2);
}
//read slides one by one
foreach($_FILES['files']['name'] as $i=>$name) {
    $File_Name = strtolower($_FILES['files']['name'][$i]);

    $NewFileName = $File_Name;
//move all files to folder
    if (move_uploaded_file($_FILES['files']['tmp_name'][$i], $UploadDirectory2 . $NewFileName)) {
//  die('Success! File Uploaded.');

    } else {
        die('error uploading File!');
    }

}

//get the config file
$File_Name = strtolower($_FILES['FileInput3']['name']);
$NewFileName = $File_Name;

if(!file_exists($UploadDirectory3)){
    mkdir($UploadDirectory3);
}
//move file to the unique folder
if (move_uploaded_file($_FILES['FileInput3']['tmp_name'], $UploadDirectory3 . $NewFileName)) {
    //  die('Success! File Uploaded.');

} else {
    die('error uploading File!');
}

//give parameters to the readCofigFile function
readConfigFile($lessonID,$NewFileName);

//check for other subjects field and get them if exits
if(isset($_POST["othersubjects"])) {
    $others = $_POST["othersubjects"];
    subjectRows($lessonID,$others);
}
//check for other search tags and get them if exits
if(isset($_POST["searchtags"])) {
    $searcht = $_POST["searchtags"];
    tagRows($lessonID,$searcht);
}
//get subjects check boxes
$sub=$_POST["subject"];
//get user check boxes
$use=$_POST["users"];

$k=0;
$r=0;
//read checked check boxes of subjects and insert them into subjects table with corresponding lesson id
for($k=0;$k<4;$k++){
    if(isset($sub[$k])){
        $lsnsub = $db->query("INSERT INTO subjects(lesson_id, subject) VALUES (:ld,:su)",array("ld"=>$lessonID,"su"=>$sub[$k]));
    }
}
//read checked check boxes of users and insert them into lessonusers table with corresponding lesson id
for($r=0;$r<4;$r++){
    if(isset($use[$r])){
        $lsus = $db->query("INSERT INTO lessonusers(lesson_id, lsnuser) VALUES (:lud,:lusr)",array("lud"=>$lessonID,"lusr"=>$use[$r]));
    }
}
echo "Uploaded Successfuly";


?>