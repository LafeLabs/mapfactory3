<?php

$finalstring = "[\n";

$files = scandir(getcwd()."/symbols");

foreach($files as $value){
    if($value != "." && $value != ".."){
        $finalstring .= "\"".$value."\",";
    }
}

$finalstring = rtrim($finalstring, ",");
$finalstring .= "\n]";

echo $finalstring;

$file = fopen("json/treedna.txt","w");// create new file with this name
fwrite($file,$finalstring); //write data to file
fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>