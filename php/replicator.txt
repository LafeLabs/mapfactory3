<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/mapfactory3/master/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    mkdir("maps");
    mkdir("three");
    mkdir("symbol");
    mkdir("scroll");
    mkdir("curve");
    mkdir("textfeed");
    mkdir("uploadimages");


    if(file_exists("json/map.txt")){
        copy("json/map.txt","maps/oldmap.txt");
    }
    //sources

    foreach($dna as $dirs){
        mkdir($dirs->path);
        $files = $dirs->files;
        foreach($files as $filename){
            $data = file_get_contents($baseurl.$dirs->path."/".$filename);
            $file = fopen($dirs->path."/".$filename,"w");// create new file with this name
            fwrite($file,$data); //write data to file
            fclose($file);  //close file
            if(substr($dirs->path,-3) == "php" && $filename != "php/replicator.txt"){
                $file = fopen(substr($dirs->path,0,-3).explode(".",$filename)[0].".php","w");// create new file with this name
                fwrite($file,$data); //write data to file
                fclose($file);  //close file                
            }
        }    
    }
    
    if(file_exists("maps/oldmap.txt")){
        copy("maps/oldmap.txt","json/map.txt");
    }

?>

<a href = "index.php" style = "font-size:5em;">index.php</a>
