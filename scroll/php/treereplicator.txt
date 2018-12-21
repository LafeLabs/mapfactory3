<?php



//replace this with url of tree dna in source page:

    $url = "https://raw.githubusercontent.com/LafeLabs/factory2/master/symbol/json/treedna.txt";
    
    
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    foreach($dna as $dirs){
        mkdir($dirs);
        mkdir($dirs."/svg");
        mkdir($dirs."/bytecode");
        mkdir($dirs."/json");
        $data = file_get_contents($baseurl."/".$dirs."/bytecode/shapetable.txt");
        $file = fopen($dirs."/bytecode/shapetable.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file
        $data = file_get_contents($baseurl."/".$dirs."/json/currentjson.txt");
        $file = fopen($dirs."/json/currentjson.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file
        $data = file_get_contents($baseurl."/".$dirs."/json/stylejson.txt");
        $file = fopen($dirs."/json/stylejson.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

        $data = file_get_contents($baseurl."/".$dirs."/bytecode/font.txt");
        $file = fopen($dirs."/bytecode/font.txt","w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file

    }
?>

<a href = "index.php?tree.php" style = "font-size:5em;">TREE</a>
