
<?php
require("../../models/DB/Db.class.php");
$db = new Db();

if($_POST)

{
    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' => 'Sorry Request must be Ajax POST'
        ));
        die($output); //exit script outputting json data
    }

    //Sanitize input data using PHP filter_var().
    $id	= filter_var($_POST["id"], FILTER_SANITIZE_STRING);


    $result=  $db->query("DELETE FROM lesson WHERE lesson_id = :lid ",array("lid"=>$id));


    $path = '../../../data/uploaded_lessons/'.$id;

    function FolderDelete($path)
    {
        if (is_dir($path) === true)
        {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($files as $file)
            {
                if (in_array($file->getBasename(), array('.', '..')) !== true)
                {
                    if ($file->isDir() === true)
                    {
                        rmdir($file->getPathName());
                    }

                    else if (($file->isFile() === true) || ($file->isLink() === true))
                    {
                        unlink($file->getPathname());
                    }
                }
            }

            return rmdir($path);
        }

        else if ((is_file($path) === true) || (is_link($path) === true))
        {
            return unlink($path);
        }

        return false;
    }


    FolderDelete($path);




    if ($result == 1){
        $output = json_encode(array( //create JSON data
            'type'=>'text',
            'text' => '<div class="alert alert-success">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Success!</strong> Deleted Succesfully
                        </div>'
        ));
    }else{
        $output = json_encode(array( //create JSON data
            'type'=>'error',
            'text' =>  '<div class="alert alert-danger">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Warning!</strong> Not Any Change Happened
                        </div>'
        ));
    }


    die($output);


}
?>
