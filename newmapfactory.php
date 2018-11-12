<?php
if(isset($_GET['name'])){
    
    $name = $_GET['name'];
    mkdir($name);
    $data = file_get_contents("replicator.php");
    echo "<a href = \"".$name."/\">".$name."</a>";
    
    $file = fopen($name."/replicator.php","w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
       
}
else{
    echo "no name given, use format newmapfactory.php?name=[new directory name]";
}

?>