<?php
set_error_handler('exceptions_error_handler');

function exceptions_error_handler($severity, $message, $filename, $lineno) {
    if (error_reporting() == 0) {
        return;
    }
    if (error_reporting() & $severity) {
        throw new ErrorException($message, 0, $severity, $filename, $lineno);
    }
}

$current_line = 0;
try{
    $readFile = fopen("my-4.txt", "r") or die("Unable to open file!");
    while(!feof($readFile)){
        $current_line += 1;
        $line = fgets($readFile);
        if(trim($line) != ''){
            $line = explode(',', $line);
            for($i=0;$i<4;$i++){
                echo $line[$i];
                echo "<br>";

            }
        }

    }
}catch(Exception $e){
    echo "Some thing wrong with txt file,Pleace check near line $current_line";

}

?>