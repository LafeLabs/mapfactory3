<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/factory2/master/json/dna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    //sources
    mkdir("symbols");
    mkdir("uploader");
        mkdir("uploader/images");
        mkdir("uploader/json");
    mkdir("combiner");
        mkdir("combiner/json");
    mkdir("aligner");
        mkdir("aligner/json");
    mkdir("linkfeed");
        mkdir("linkfeed/json");
    mkdir("linker");
        mkdir("linker/json");
    mkdir("maps");
    mkdir("symbol");
    mkdir("scroll");

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
?>

<a href = "index.php" style = "font-size:5em;">index.php</a>
