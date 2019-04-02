<?php

function getfiles($localpath){
    $outstring = "";
    $files = scandir(getcwd()."/".$localpath);
    $outstring .= "\t{\n\t\t\"path\":\"".$localpath."\",\n\t\t\"files\":[\n";
    
    foreach($files as $value){
        if($value != "." && $value != ".."){
            if(substr($value,-4) == ".txt"){
                $outstring .= "\t\t\t\"".$value."\",\n";
            }
        }
    }
    $outstring = substr($outstring,0,-2);
    $outstring .= "\n\t\t]\n\t}";
    return $outstring;
}

function getALLfiles($localpath){
    $outstring = "";
    $files = scandir(getcwd()."/".$localpath);
    $outstring .= "\t{\n\t\t\"path\":\"".$localpath."\",\n\t\t\"files\":[\n";
    
    foreach($files as $value){
        if($value != "." && $value != ".."){
            $outstring .= "\t\t\t\"".$value."\",\n";
        }
    }
    $outstring = substr($outstring,0,-2);
    $outstring .= "\n\t\t]\n\t}";
    return $outstring;
}

$finalstring = "[\n";

$finalstring .= getfiles("php");
$finalstring .= ",\n";
$finalstring .= getfiles("html");
$finalstring .= ",\n";
$finalstring .= getfiles("json");
$finalstring .= ",\n";
$finalstring .= getALLfiles("mapicons");
$finalstring .= ",\n";
$finalstring .= "    {\n        \"path\":\"memefactory\",\n        \"files\":[\n            \"replicator.php\"\n        ]\n    },\n";
$finalstring .= "    {\n        \"path\":\"symbol\",\n        \"files\":[\n            \"replicator.php\"\n        ]\n    },\n";
$finalstring .= "    {\n        \"path\":\"curve\",\n        \"files\":[\n            \"replicator.php\"\n        ]\n    },\n";
$finalstring .= "    {\n        \"path\":\"three\",\n        \"files\":[\n            \"replicator.php\"\n        ]\n    },\n";
$finalstring .= "    {\n        \"path\":\"scroll\",\n        \"files\":[\n            \"replicator.php\"\n        ]\n    }";

$finalstring .= "\n]";

echo $finalstring;

$file = fopen("json/dna.txt","w");// create new file with this name
fwrite($file,$finalstring); //write data to file
fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>