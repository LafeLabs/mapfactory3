 <?php
/* javascript this pairs with:

 document.getElementById("publish").onclick = function(){
    data = encodeURIComponent(document.getElementById("textIO").value);
    var httpc = new XMLHttpRequest();
    var url = "feedsaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data);//send text to feedsaver.php

 }
*/


    if(isset($_POST['path'])){
        $path = $_POST['path'];
        $indexpath = $path."svg/index.html";
        $feedpath = $path."svg/";   
    }
    else{
        $indexpath = "svg/index.html";
        $feedpath = "svg/";
    }


    $data = $_POST["data"]; //get data 
    $filename = "svg".time().".svg";
    $file = fopen($feedpath.$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file
    $oldfeed = file_get_contents($indexpath); 
    $file = fopen($indexpath,"w");// create new file with this name
    fwrite($file,"<p><a href = \"".$filename."\"><img src = \"".$filename."\"></a></p>\n".$oldfeed); //write data to file
    fclose($file);  //close file
    
    
    if(isset($_POST['path'])){
        $files = scandir(getcwd()."/".$path."svg");
    }
    else{
        $files = scandir(getcwd()."/svg");
    }

    $outtext  = "";
    $listtext = "";

    foreach(array_reverse($files) as $value){
        if($value != "." && $value != ".." && substr($value,0,3) == "svg"){
            $listtext .= $value.",";
            $outtext .= "\n<p><img src = \"".$value."\"/></p>\n";
        }
    }

    $file = fopen($path."svg/list.txt","w");// create new file with this name
    fwrite($file,$listtext); //write data to file
    fclose($file);  //close file

    
?>
