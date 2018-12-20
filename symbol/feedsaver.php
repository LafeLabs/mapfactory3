 <?php
/* javascript this pairs with:

document.getElementById("savesvg").onclick = function(){
    svgwidth = currentJSON.svgwidth;
    svgheight = currentJSON.svgheight;
    tempx0 = x0;
    tempy0 = y0;
    x0 -= 0.5*(innerWidth - svgwidth);
    y0 -= 0.5*(innerHeight - svgheight);
    ctx = document.getElementById("invisibleCanvas").getContext("2d");
    currentSVG = "<svg width=\"" + svgwidth.toString() + "\" height=\"" + svgheight.toString() + "\" viewbox = \"0 0 " + svgwidth.toString() + " " + svgheight.toString() + "\"  xmlns=\"http://www.w3.org/2000/svg\">\n";
    currentSVG += "\n<!--\n<json>\n" + JSON.stringify(currentJSON,null,"    ") + "\n</json>\n-->\n";
    doTheThing(0300);
    drawGlyph(cleanGlyph);
    currentSVG += "</svg>";
    document.getElementById("textIO").value = currentSVG;

    var httpc = new XMLHttpRequest();
    var url = "feedsaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    if(path.length > 1){
         httpc.send("data=" + encodeURIComponent(document.getElementById("textIO").value) + "&path=" + path);//send text to feedsaver.php
    }
    else{
        httpc.send("data=" + encodeURIComponent(document.getElementById("textIO").value));//send text to feedsaver.php
    }
    x0 = tempx0;
    y0 = tempy0;
    redraw();
 
}

*/

    if(isset($_POST['path'])){
        $path = $_POST['path'];
        $feedpath = "symbols/".$path."svg/";   
    }
    else{
        $feedpath = "svg/";
        $path = "";
    }

    $timestamp = $_POST["timestamp"];//get timestamp from javascript
    $data = $_POST["data"]; //get data 
    $filename = "svg".$timestamp.".svg";
    $file = fopen($feedpath.$filename,"w");// create new file with this name
    fwrite($file,$data); //write data to file
    fclose($file);  //close file


    if(isset($_POST['path'])){
        $files = scandir(getcwd()."/symbols/".$path."svg");
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

    if(isset($_POST['path'])){
        $file = fopen("symbols/".$path."svg/index.html","w");// create new file with this name
        fwrite($file,$outtext); //write data to file
        fclose($file);  //close file

        $file = fopen("symbols/".$path."svg/list.txt","w");// create new file with this name
        fwrite($file,$listtext); //write data to file
        fclose($file);  //close file
    }
    else{
        $file = fopen($path."svg/index.html","w");// create new file with this name
        fwrite($file,$outtext); //write data to file
        fclose($file);  //close file

        $file = fopen($path."svg/list.txt","w");// create new file with this name
        fwrite($file,$listtext); //write data to file
        fclose($file);  //close file
        
    }


    
    
    
    
    
?>