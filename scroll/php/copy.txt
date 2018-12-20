<?php

    $source = $_POST["source"]; //get data 
    $destination = $_POST["destination"];
    copy($source,$destination);
    
?>