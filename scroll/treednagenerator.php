<?php

$finalstring = "{\n  \"markdown\":[\n";

$files = scandir(getcwd()."/markdown");

foreach($files as $value){
    if($value != "." && $value != ".."){
        $finalstring .= "    \"".$value."\",\n";
    }
}

$finalstring = rtrim($finalstring, ",\n");
$finalstring .= "\n  ],\n  \"latex\":[\n";

$files = scandir(getcwd()."/latex");

foreach($files as $value){
    if(substr($value,-4) == ".tex"){
        $finalstring .= "    \"".$value."\",\n";
    }
}
$finalstring = rtrim($finalstring, ",\n");
$finalstring .= "\n  ],\n  \"image\":[\n";

foreach($files as $value){
    if(substr($value,-7) == "_images"){
        $subfiles = scandir(getcwd()."/latex/".$value);
        foreach($subfiles as $subvalue){
            if($subvalue != "." && $subvalue != ".."){
                $finalstring .= "    \"".$value."/".$subvalue."\",\n";
            }
        }
    }
}
$finalstring = rtrim($finalstring, ",\n");



$finalstring .= "\n  ]\n}";

echo "<pre>".$finalstring."</pre>";


$file = fopen("json/treedna.txt","w");// create new file with this name
fwrite($file,$finalstring); //write data to file
fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>