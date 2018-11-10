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
    var newimg = document.createElement("IMG");
    newimg.src = "uploadimages/" + uploadimages[index];
    document.getElementById("imagescroll").appendChild(newimg);
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
#imagescroll img{
    width:50%;
    display:block;
    margin:auto;
}
</style>
</body>
</html>