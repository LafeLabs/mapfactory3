<?php

    $url = "https://raw.githubusercontent.com/LafeLabs/factory2/master/curve/json/treedna.txt";
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach($dna as $dirs){
        mkdir("curves/".$dirs);
        mkdir("curves/".$dirs."/svg");
        mkdir("curves/".$dirs."/javascript");
        mkdir("curves/".$dirs."/markdown");
        mkdir("curves/".$dirs."/json");

        $data = file_get_contents($baseurl."/curves/".$dirs."/javascript/topfunctions.txt");
        $file = fopen("curves/".$dirs."/javascript/topfunctions.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        $data = file_get_contents($baseurl."/curves/".$dirs."/json/currentjson.txt");
        $file = fopen("curves/".$dirs."/json/currentjson.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        $data = file_get_contents($baseurl."/curves".$dirs."/markdown/equation.txt");
        $file = fopen("curves/".$dirs."/markdown/equation.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

    }
?>

<a href = "tree.php" style = "font-size:5em;">TREE</a>
