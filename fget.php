<?php
//  fget: flow get, f stands for "flow"
// fget.php?baseurl=http://www.lafelabs.org/artbox/json/outflow.txt&thingname=artbox

$outflow = json_decode(file_get_contents("json/outflow.txt"));

$sourceurl = $_GET['baseurl'];
$baseurl = explode("json",$sourceurl)[0];

$thingname = $_GET['thingname'];

$sourcejson = json_decode(file_get_contents($sourceurl));

$outthing = json_decode("{}");

foreach($sourcejson as $thing){
    if($thingname == $thing->name){
        $outthing->name = $thingname;
        $outthing->scrolls = [];
        $outthing->maps = [];
        $outthing->symbols = [];

        //get the scrolls and save them, keep names 
        foreach($thing->scrolls as $scrollname){
            $scrolldata = file_get_contents($baseurl.$scrollname);
            $file = fopen($scrollname,"w");// create new file with this name
            fwrite($file,$scrolldata); //write data to file
            fclose($file);  //close file
            array_push($outthing->scrolls,$scrollname);
        }
        //get the maps and save them, keep names
        foreach($thing->maps as $mapname){
            $mapdata = file_get_contents($baseurl.$mapname);
            $file = fopen($mapname,"w");// create new file with this name
            fwrite($file,$mapdata); //write data to file
            fclose($file);  //close file
            array_push($outthing->maps,$mapname);
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
            array_push($outthing->symbols,"svg/".$thingname.$symbolindexstring);
        }    
    }
}

array_push($outflow,$outthing);
$data = json_encode($outflow);
$file = fopen("json/outflow.txt","w");// create new file with this name
fwrite($file,$data); //write data to file
fclose($file);  //close file

//echo the links to the various sub-things

?>

<a href = "inflow.php">inflow.php</a>