<?php

$files = scandir(getcwd()."/tables");

$latesttime = 0;

foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,0,5) == "table"){
      //  echo $value."<br/>".substr(substr($value,3),0,-4)."<br/>";
        $timestamp = substr(substr($value,5),0,-4);
    //    echo gmdate("Y-m-d H:i:s", $timestamp)."<br/>";     
  //      echo intval($timestamp) - 4287;
//        echo "<br/>";
        if($timestamp > $latesttime){
            $latesttime = $timestamp;
        }
    }
}
echo "<br/>Most recent save time: ".gmdate("Y-m-d H:i:s", $timestamp);
$latestfilename = "tables/table".$latesttime.".txt";
$outstring =  file_get_contents($latestfilename);

$file = fopen("bytecode/shapetable.txt","w");// create new file with this name
fwrite($file,$outstring); //write data to file
fclose($file);  //close file
echo "<br/>";


echo "<br/>";

?>
<a href = "editor.php">editor.php</a>