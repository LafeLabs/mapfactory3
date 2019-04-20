<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Uploader</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
</head>
<body>
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

<a href = "index.php" style = "position:absolute;left:10px;top:10px"><img src = "mapicons/mapfactory.svg" style = "width:50px"></a>

<div id = "imagescroll"></div>

 <form id = "uploadform" style = "margin-top:10px" action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
 </form>

<script>

uploadimages = document.getElementById("uploadimages").innerHTML.split(",");

for(var index = 0;index < uploadimages.length-1;index++){
    var newp = document.createElement("P");
    var newimg = document.createElement("IMG");
    newp.appendChild(newimg);
    newimg.src = "uploadimages/" + uploadimages[index];
    newimg.className = "uploadimage";
    document.getElementById("imagescroll").appendChild(newp);
    var newimg = document.createElement("img");
    newimg.src = "mapicons/deletex.svg";
    newp.appendChild(newimg);
    newimg.className= "button";
    newimg.onclick = function(){
        imagename = this.parentElement.getElementsByTagName("img")[0].src.split("uploadimages/")[1];
        var httpc = new XMLHttpRequest();
        var url = "deletefile.php";         
        httpc.open("POST", url, true);
        httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
        httpc.send("filename=uploadimages/" + imagename);//send text to filesaver.php
        document.getElementById("imagescroll").removeChild(this.parentElement);
    }

}
</script>
<style>
body{
    font-family:Helvetica;
    font-size:24px;
}
#uploadform{
    position:absolute;
    bottom:0px;
    left:0px;
        z-index:99999999;

}
#imagescroll{
    position:absolute;
    left:25%;
    right:25%;
    top:110px;
    bottom:2em;
    overflow:scroll;
    border:solid;
    border-radius:10px;
}
#imagescroll p{
    border:solid;
}
.uploadimage{
    max-width:90%;
}
.button{
    cursor:pointer;
    width:50px;
    border:solid;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}
</style>
</body>
</html>