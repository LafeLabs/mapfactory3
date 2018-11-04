<?php
    $data = file_get_contents("bytecode/shapetable.txt"); 

    $filename = "table".time().".txt";
    $file = fopen("tables/".$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
    
    $oldfeed = file_get_contents("index.html"); 
    $file = fopen("tables/index.html","w");// create new file with this name
    fwrite($file,"<p><a href = \"".$filename."\">".$filename."</a></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file

?>
<a href = "editor.php">editor.php</a>