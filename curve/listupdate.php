 <?php
/* javascript this pairs with:


    var httpc = new XMLHttpRequest();
    var url = "listupdate.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("path=" + path);//send text to listupdate.php

 
*/


    
    if(isset($_POST['path'])){
        $files = scandir(getcwd()."/curves/".$path."svg");
    }
    else{
        $files = scandir(getcwd()."/svg");
    }

    $listtext = "";

    foreach(array_reverse($files) as $value){
        if($value != "." && $value != ".." && substr($value,0,3) == "svg"){
            $listtext .= $value.",";
        }
    }

    if(isset($_POST['path'])){
        $files = scandir(getcwd()."/curves/".$path."svg");
        $file = fopen("curves/".$path."svg/list.txt","w");// create new file with this name
    }
    else{
        $file = fopen("svg/list.txt","w");// create new file with this name
    }


    fwrite($file,$listtext); //write data to file
    fclose($file);  //close file

    
?>
