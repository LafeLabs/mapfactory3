<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Combiner</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
</head>
<body>
<div id = "pathdiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo $_GET['path'];
    }
?></div>
<div id = "datadiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo file_get_contents($_GET['path']);
    }
    else{
        echo file_get_contents("json/meme.txt");        
    }
?></div>
<div id = "imgurls" style = "display:none;"><?php

    echo file_get_contents("json/imgurls.txt");
    
?></div>
<div id = "uploadimages" style = "display:none;"><?php

$files = scandir(getcwd()."/uploadimages");
$listtext = "";
foreach($files as $value){
    if($value != "." && $value != ".." && substr($value,-4) != ".txt"){
        $listtext .= $value.",";
    }
}
echo $listtext;
    
?></div>
<div id = "listoflists" style = "display:none"><?php

    $listoflists = json_decode(file_get_contents("json/listoflists.txt"));
    
    foreach($listoflists as $listurl){
        $baseurl = explode("list.txt",$listurl)[0];
        $filelist = explode(",",file_get_contents($listurl));
        foreach($filelist as $filename){
            echo $baseurl.$filename.",";
        }
    }
    
    $listofimgurls = json_decode(file_get_contents("json/listofimgurls.txt"));

    foreach($listofimgurls as $imgurlsurl){
        $imgurls = json_decode(file_get_contents($imgurlsurl));
        foreach($imgurls as $value){
            echo $value.",";
        }
    }
?></div>


<a id = "factorylink" href = "index.php" style = "position:absolute;left:10px;top:10px"><img src = "mapicons/memefactory.svg" style = "width:50px"></a>

<div id = "imagescroll"></div>
<div id = "memescroll"></div>


<script>
    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        pathset = true;
        document.getElementById("factorylink").href += "?path=" + path;
    }
    else{
        pathset = false;
    }
    

    imgurls = JSON.parse(document.getElementById("imgurls").innerHTML);

    uploadimages = document.getElementById("uploadimages").innerHTML.split(",");
    for(var index = 0;index < uploadimages.length - 1;index++){
        imgurls.push("uploadimages/" + uploadimages[index]);
    }
    
    extimages = document.getElementById("listoflists").innerHTML.split(",");
    for(var index = 0;index < extimages.length;index++){
        if(extimages[index].length > 1){
            imgurls.push(extimages[index]);
        }
    }
    
    meme = JSON.parse(document.getElementById("datadiv").innerHTML);

    for(var index = 0;index < meme.length;index++){
         var newimg2 = document.createElement("IMG");
        newimg2.src = meme[index].src;
        newimg2.className = "button";
        document.getElementById("memescroll").appendChild(newimg2);
        newimg2.onclick = function(){
            document.getElementById("memescroll").removeChild(this);
            redraw();
        }
    }
    
    for(var index = 0;index < imgurls.length; index++){
        var newimg = document.createElement("IMG");
        newimg.src = imgurls[index];
        newimg.className = "button";
        document.getElementById("imagescroll").appendChild(newimg);
        newimg.onclick = function(){
            var newimg2 = document.createElement("IMG");
            newimg2.src = this.src;
            newimg2.className = "button";
            document.getElementById("memescroll").appendChild(newimg2);
            newimg2.onclick = function(){
                document.getElementById("memescroll").removeChild(this);
                redraw();
            }
            redraw();
        }
    }
    

function redraw(){
    memeimages = document.getElementById("memescroll").getElementsByTagName("IMG");
    
    meme = [];
    for(var index = 0;index < memeimages.length;index++){
        var newjson = {};
        newjson.src = memeimages[index].src;
        newjson.w = 0.5;
        newjson.y = 0.2;
        newjson.x = 0.2;
        newjson.angle = 0;
        meme.push(newjson);
    }
    if(pathset){
        currentFile = path;
    }
    else{
        currentFile = "json/meme.txt";
    }
    data = encodeURIComponent(JSON.stringify(meme,null,"    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data=" + data + "&filename=" + currentFile);//send text to filesaver.php
}
    
</script>

<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
input{
    font-family:courier;
    font-size:20px;
}
    #memescroll{
        position:absolute;
        overflow:scroll;
        right:10px;
        width:40%;
        bottom:10px;
        top:110px;
        border:solid;
        border-color:green;
        border-width:5px;
    }
    #imagescroll{
        position:absolute;
        left:10px;
        width:40%;
        top:110px;
        bottom:10px;
        border:solid;
        border-color:blue;
        border-width:5px;
        overflow:scroll;
    }
    #imagescroll img{
        width:50%;
        display:block;
        margin:auto;
    }
    #memescroll img{
        width:50%;
        display:block;
        margin:auto;
    }

    .button{
        cursor:pointer;
        border:solid;
        margin-top:1em;
        margin-bottom:1em;
    }
    .button:hover{
        background-color:#a0ffa0;
    }
    .button:active{
        background-color:yellow;
    }


</style>
</body>
</html>