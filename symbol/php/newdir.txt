<?php

$path = $_POST['path'];

$jsontemplate = file_get_contents("json/currentjson.txt");
$stylejson = file_get_contents("json/stylejson.txt");

mkdir("symbols/".$path);
    mkdir("symbols/".$path."/"."bytecode");
    mkdir("symbols/".$path."/"."json");
    mkdir("symbols/".$path."/"."svg");
    mkdir("symbols/".$path."/"."png");
    
$file = fopen("symbols/".$path."/"."json/currentjson.txt","w");// create new file with this name
fwrite($file,$jsontemplate); //write data to file
fclose($file);  //close file

$file = fopen("symbols/".$path."/"."json/stylejson.txt","w");// create new file with this name
fwrite($file,$stylejson); //write data to file
fclose($file);  //close file


?>