<?php
//  fget: flow get, f stands for "flow"
// fget.php?baseurl=http://www.lafelabs.org/artbox/json/outflow.txt&thingname=artbox

$sourceurl = $_GET['baseurl'];
$baseurl = explode("json",$sourceurl)[0];

$thingname = $_GET['thingname'];

$sourcejson = json_decode(file_get_contents($sourceurl));
foreach($sourcejson as $thing){
    if($thingname == $thing->name){
        //get the scrolls and save them, keep names 
        foreach($thing->scrolls as $scrollname){
            $scrolldata = file_get_contents($baseurl.$scrollname);
            $file = fopen($scrollname,"w");// create new file with this name
            fwrite($file,$scrolldata); //write data to file
            fclose($file);  //close file

        }
        //get the maps and save them, keep names
        foreach($thing->maps as $mapname){
            $mapdata = file_get_contents($baseurl.$mapname);
            $file = fopen($mapname,"w");// create new file with this name
            fwrite($file,$mapdata); //write data to file
            fclose($file);  //close file
        }
        //get the symbols and save them, with names based on $tjhing->name
        //put a relocalized "thing" in the outscroll
        $symbolindex = 1;
        foreach($thing->symbols as $symbolname){
            $symbolindexstring = strval($symbolindex);
            $symboldata = file_get_contents($baseurl.$symbolname);
            $file = fopen("svg/".$thingname.$symbolindexstring,"w");// create new file with this name
            fwrite($file,$mapdata); //write data to file
            fclose($file);  //close file
            $symbolindex = $symbolindex + 1;
        }    
    }
}

?>
