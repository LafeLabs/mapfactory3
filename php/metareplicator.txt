<?php

    $replicator = file_get_contents("https://raw.githubusercontent.com/LafeLabs/mapfactory3/master/php/replicator.txt");
    $file = fopen("replicator.php","w");
    fwrite($file,$replicator); 
    fclose($file);
    
    echo $replicator;
    
?>