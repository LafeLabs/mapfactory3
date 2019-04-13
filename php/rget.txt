<?php
//  rget.php?url=http://www.lafelabs.org/artbox/php/artbox.txt

    if(isset($_GET['url'])){
        $url = $_GET['url'];
        $data = file_get_contents($url);
        $filename = "tempphp.php";
        $file = fopen($filename,"w");// create new file with this name
        fwrite($file,$data); //write data to file
        fclose($file);  //close file
        echo "<a href = \"";
        echo $filename;
        echo "\" style = \"font-size:5em;\">";
        echo $filename;
        echo "</a>";
    }
    else{
        echo "<a href = \"index.php\" style = \"font-size:5em;\">index.php</a>";
    }
    
?>
