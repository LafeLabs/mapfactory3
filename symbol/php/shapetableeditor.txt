<!doctype html>
<html>
<head>
<title>Metamap</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.
-->
<script id = "bytecodeScript">
/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
echo file_get_contents("bytecode/keyboard.txt")."\n";
echo file_get_contents("bytecode/symbols013xx.txt")."\n";
echo file_get_contents("bytecode/symbols010xx.txt")."\n";


?>
*/
</script>
<script id = "localbytecodeScript">
/*
<?php

if(isset($_GET['path'])){
    if(file_exists("symbols/".$_GET['path']."/bytecode/shapetable.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/shapetable.txt")."\n";
    }
    if(file_exists("symbols/".$_GET['path']."/bytecode/font.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/font.txt")."\n";
    }
}

?>
*/
</script>

<script id = "topfunctions">

 function string2byteCode(localString){
    var localByteCode = "";
    for(var stringIndex = 0;stringIndex < localString.length;stringIndex++){
        var tempCharCode = localString.charCodeAt(stringIndex);
        if(tempCharCode != 0){
            localByteCode += "0";
            localByteCode += tempCharCode.toString(8);
            localByteCode += ",";
        }
    }
    return localByteCode;
}
        
function byteCode2string(localByteCode){
    var localString = "";
    var stringArray = localByteCode.split(",");
    for(var index = 0;index < stringArray.length;index++){
        var myCharCode = String.fromCharCode(parseInt(stringArray[index],8));
        if(parseInt(stringArray[index],8) >= 040 && parseInt(stringArray[index],8) < 0177 ){
            localString += myCharCode;
        }
        if(parseInt(stringArray[index],8) == 012){//newline
            localString += myCharCode;
        }
        if(parseInt(stringArray[index],8) == 011){//vertical tab
            localString += myCharCode;
        }		
        if(parseInt(stringArray[index],8) >= 0400 && parseInt(stringArray[index],8) <= 0777){
            if(currentTable[parseInt(stringArray[index],8)].length > 0){
                localString += byteCode2string(currentTable[parseInt(stringArray[index],8)]);
            }
        }		
        
    }
    return localString;
}
        
function drawGlyph(localString){
    var tempArray = localString.split(',');
    for(var index = 0;index < tempArray.length;index++){
        doTheThing(parseInt(tempArray[index],8));
    }
}
    
function spellGlyph(localString){
    var tempArray = localString.split(',');
    for(var index = 0;index < tempArray.length;index++){
        ctx.lineWidth = 2;
        // ctx.strokeStyle="black";

        if(x > 0.94*innerWidth){
            y+= 1.1*side;
            x = side;
        }

        doTheThing(parseInt(tempArray[index],8) + 01000);
        if(parseInt(tempArray[index],8) > 01000){
            doTheThing(01060);
            doTheThing(01061);
            var sixtyfours = (parseInt(tempArray[index],8) & 0700) >> 6;
            var eights = (parseInt(tempArray[index],8) & 070) >> 3;
            var ones = parseInt(tempArray[index],8) & 07;
            doTheThing(01060 + sixtyfours);            
            doTheThing(01060 + eights);            
            doTheThing(01060 + ones);            
        }
    }
}

</script>
<script id = "actions">
function doTheThing(localCommand){    
    if(localCommand >= 040 && localCommand <= 0176){
        currentHTML += String.fromCharCode(localCommand);
        currentWord += String.fromCharCode(localCommand);
    }
    if(localCommand >= 0200 && localCommand <= 0277){//shapes 
        if(!(localCommand == 0207 && editMode == false) ){
            drawGlyph(currentTable[localCommand]);    	    
        }
    }
    if(localCommand >= 01000 && localCommand <= 01777){//symbol glyphs
            drawGlyph(currentTable[localCommand]);    	    
    } 
    <?php
    echo file_get_contents("javascript/actions03xx.txt");
    echo "\n";
    echo file_get_contents("javascript/actions0xx.txt");
    echo "\n";
    ?>    
}
</script>
</head>
<body>

<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "stylejsondiv"  style = "display:none"><?php

    if(isset($_GET['path'])){
        echo file_get_contents("symbols/".$_GET['path']."json/stylejson.txt");
    }
    else{
        echo file_get_contents("json/stylejson.txt");
    }

    
?></div>
<div id = "datadiv" style = "display:none">
<?php

    if(isset($_GET['path'])){
        echo file_get_contents("symbols/".$_GET['path']."json/currentjson.txt");
    }
    else{
        echo file_get_contents("json/currentjson.txt");
    }


?>
</div>    
<div id = "page">
    <a  id = "editorlink" href = "editor.php"><img style = "width:80px" src = "icons/editor.svg"></a>
    <a  id = "factorylink" href = "index.php"><img style = "width:80px" src = "icons/symbol.svg"></a>

    <canvas id="invisibleCanvas" style="display:none"></canvas>
    <canvas id="mainCanvas"></canvas>
    <textarea id="textIO"></textarea>
    <table id = "controlTable">
        <tr id = "addressline">
            <td>ADDRESS:</td><td><input/></td>
        </tr>
        <tr>
            <td>ACTION:</td><td><input/></td>
        </tr>
        <tr>
            <td>PRINT:</td><td><input/></td>
        </tr>
        <tr>
            <td>STACK:</td><td><input/></td>
        </tr>
    </table>

    <table id = "buttonTable">
        <tr><td class = "button" id = "actionsymbol">ACTION/SYMBOL</td></tr>
        <tr><td class = "button" id = "importbytecode">IMPORT BYTECODE</td></tr>
        <tr><td class = "button" id = "exportshapes">EXPORT SHAPES</td></tr>
        <tr><td class = "button" id = "exportfont">EXPORT FONT</td></tr>
        <tr><td class=  "button" id = "savesvgbutton">SAVE SVG</td></tr>
    </table>
    <input id = "glyphspellinput"/>
    <img id = "mainImage"/>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
    doTheThing(06);//import embedded hypercube in this .html doc
    doTheThing(07);//initialize Geometron global variables

    path = document.getElementById("pathdiv").innerHTML;
    if(path.length > 1){
        document.getElementById("factorylink").href = "index.php?path=" + path;
        
        var inputbytecode = document.getElementById("localbytecodeScript").text;
        var bytecodearray = inputbytecode.split("\n");
        for(var index = 0;index < bytecodearray.length;index++){
            if(bytecodearray[index].includes(":")){
                var localBytecode = bytecodearray[index].split(":");
                var localAddress = parseInt(localBytecode[0],8);
                currentTable[localAddress] = localBytecode[1];
            }
        }


    }



    currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
    styleJSON = JSON.parse(document.getElementById("stylejsondiv").innerHTML);


    document.getElementById("mainCanvas").width = innerWidth;
    document.getElementById("mainCanvas").height = innerHeight;

    x0 = innerWidth/2;
    y0 = innerHeight/2;    

    controls = document.getElementById("controlTable").getElementsByTagName("input");   
    unit = 100;
    currentAddress = 0220;

    currentGlyph = currentTable[currentAddress] + ",0207,";
    glyphEditMode = true;
    shapeTableEditMode = true;
    controls[1].select();
}

</script>
<script id = "redraw">
redraw();
function redraw(){
    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,innerWidth,innerHeight);
    svgheight = 500;
    svgwidth = 500;
    ctx.strokeRect(0.5*innerWidth - 0.5*svgwidth,0.5*innerHeight - 0.5*svgheight,svgwidth,svgheight);
    
    doTheThing(0300);
    drawGlyph(currentGlyph);

    
    doTheThing(0300);
    side = 25;
    x = 150;
    y = innerHeight - 100;
    spellGlyph(currentGlyph);
    controls[0].value = "0" + currentAddress.toString(8);
    var glyphArray = currentGlyph.split(",");
    currentTable[currentAddress] = "";
    for(var index = 0;index < glyphArray.length;index++){
        if(glyphArray[index] != "0207" && glyphArray[index].length > 0){
            currentTable[currentAddress] += glyphArray[index] + ",";
        }
    }
    
    var glyphArray = currentGlyph.split(",");
    cleanGlyph = "";
    for(var index = 0;index < glyphArray.length;index++){
        if(glyphArray[index] != "0207" && glyphArray[index].length > 0){
            cleanGlyph += glyphArray[index] + ",";
        }
    }

    document.getElementById("glyphspellinput").value = cleanGlyph;
    


if((currentAddress >= 0220 && currentAddress < 0277) || (currentAddress >= 01220 && currentAddress < 01277)){
    if(path.length > 1){
        currentFile = "symbols/" + path + "bytecode/shapetable.txt";
        data = "";
        for(var index = 0220;index < 0277;index++){
            if(currentTable[index].length > 2  && currentTable[index] != currentTableStart[index]){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }
        for(var index = 01220;index < 01277;index++){
            if(currentTable[index].length > 2 && currentTable[index] != currentTableStart[index]){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }

    }
    else{
        currentFile = "bytecode/shapetable.txt";
        data = "";
        for(var index = 0220;index < 0277;index++){
            if(currentTable[index].length > 2){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }
        for(var index = 01220;index < 01277;index++){
            if(currentTable[index].length > 2){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }    
    }
}

if(currentAddress >= 01040 && currentAddress < 01177){
    if(path.length > 1){
        currentFile = "symbols/" + path + "bytecode/font.txt";
        data = "";
        for(var index = 01040;index < 01177;index++){
            if(currentTable[index].length > 2 && currentTable[index] != currentTableStart[index]){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }
    }
    else{
        currentFile = "bytecode/font.txt";
        data = "";
        for(var index = 01040;index < 01177;index++){
            if(currentTable[index].length > 2){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }
    }
}
    
    
    
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php


}
</script>
<script id = "pageevents">

document.getElementById("glyphspellinput").onchange = function(){
    cleanGlyph = this.value;
    currentGlyph = cleanGlyph + "0207,";
    redraw();
}

document.getElementById("actionsymbol").onclick = function(){
    if(currentAddress < 01000){
        currentAddress += 01000;
        currentGlyph = currentTable[currentAddress] + ",0207,";
        redraw();
    }
    else{
        currentAddress -= 01000;
        currentGlyph = currentTable[currentAddress] + ",0207,";
        redraw();
    }
}

document.getElementById("importbytecode").onclick = function(){
    var inputbytecode = document.getElementById("textIO").value;
    var bytecodearray = inputbytecode.split("\n");
    for(var index = 0;index < bytecodearray.length;index++){
        if(bytecodearray[index].includes(":")){
            var localBytecode = bytecodearray[index].split(":");
            var localAddress = parseInt(localBytecode[0],8);
            currentTable[localAddress] = localBytecode[1];
        }
    }
}
document.getElementById("exportshapes").onclick = function(){
    bytecodedata = "";
    for(var index = 0220;index < 0277;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" +  currentTable[index] + "\n";   
        }
    }
    for(var index = 01220;index < 01277;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }
    document.getElementById("textIO").value = bytecodedata;    
}
document.getElementById("exportfont").onclick = function(){
    bytecodedata = "";
    for(var index = 01040;index < 01177;index++){
        if(currentTable[index].length > 1){
            bytecodedata +=  "0" + index.toString(8) + ":" + currentTable[index] + "\n";   
        }
    }
    document.getElementById("textIO").value = bytecodedata;    
    
}

document.getElementById("savesvgbutton").onclick = function(){
//    svgwidth = currentJSON.svgwidth;
  //  svgheight = currentJSON.svgheight;
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

controls[0].onchange = function(){
    currentAddress = parseInt(this.value,8);
    currentGlyph = currentTable[currentAddress] + ",0207,";
    redraw();
}

controls[1].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        arrowkey = false;
        if(charCode == 010){
            doTheThing(010);
            redraw();
            arrowkey = true;
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
            arrowkey = true;
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
            arrowkey = true;
        }
        if(charCode == 046){
//        doTheThing(023);
            currentAddress++;
            currentGlyph = currentTable[currentAddress] + ",0207,";
            redraw();
            arrowkey = true;
        }
        if(charCode == 050){
//        doTheThing(022);
            currentAddress--;
            currentGlyph = currentTable[currentAddress] + ",0207,";
            redraw();
            arrowkey = true;
        }    
    }
    
    controls[2].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        arrowkey = false;
        if(charCode == 010){
            doTheThing(010);
            redraw();
            arrowkey = true;
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
            arrowkey = true;
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
            arrowkey = true;
        }
    }
    
    controls[3].onkeydown = function(e) {
        charCode = e.keyCode || e.which;
        arrowkey = false;
        if(charCode == 010){
            doTheThing(010);
            redraw();
            arrowkey = true;
        }
        if(charCode == 045){
            doTheThing(020);
            redraw();
            arrowkey = true;
        }
        if(charCode == 047){
            doTheThing(021);
            redraw();
            arrowkey = true;
        }

    }
    
controls[1].onkeypress = function(a){//action
    charCode = a.keyCode || a.which;
    console.log(a.which);
    if(charCode != 010 && charCode != 047  && charCode != 050  && !arrowkey){
            
        if(parseInt(currentTable[charCode],8) >= 0200){
            var glyphSplit = currentGlyph.split(",");
            currentGlyph = "";
            for(var index = 0;index < glyphSplit.length;index++){
                if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                    currentGlyph += glyphSplit[index] + ",";
                }
                if(glyphSplit[index] == "0207"){
                    currentGlyph += currentTable[charCode] + ",0207,";
                }
            }
            var glyphSplit = currentGlyph.split(",");
            currentGlyph = "";
            for(var index = 0;index < glyphSplit.length;index++){
                if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                    currentGlyph += glyphSplit[index] + ",";
                }
            }
            redraw();
        } 
        if(parseInt(currentTable[charCode],8) < 040){
            doTheThing(parseInt(currentTable[charCode],8));
            redraw();
        }
        this.value = "";
    }
}
    
controls[2].onkeypress = function(a){//print
    charCode = a.keyCode || a.which;
    if(charCode != 010  && charCode != 047  && !arrowkey){
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                currentGlyph += glyphSplit[index] + ",";
            }
            if(glyphSplit[index] == "0207"){
                currentGlyph += "0" + (charCode + 01000).toString(8) + ",0207,";
            }
        }
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                currentGlyph += glyphSplit[index] + ",";
            }
        }
        redraw();
        this.value = "";
    }
}
    
controls[3].onkeypress = function(a){//stack
    charCode = a.keyCode || a.which;    
    if(charCode != 010 && charCode != 047  && !arrowkey){
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0 && glyphSplit[index] != "0207"){
                currentGlyph += glyphSplit[index] + ",";
            }
            if(glyphSplit[index] == "0207"){
                currentGlyph += "0" + (charCode).toString(8) + ",0207,";
            }
        }
        var glyphSplit = currentGlyph.split(",");
        currentGlyph = "";
        for(var index = 0;index < glyphSplit.length;index++){
            if(glyphSplit[index].length > 0  && parseInt(glyphSplit[index]) >= 040){
                currentGlyph += glyphSplit[index] + ",";
            }
        }
        redraw();
        this.value = "";
    }
}

</script>
<style>
    
    
    body{
    overflow:hidden;
}
#pngimage{
    position:absolute;
    z-index:3;
    background-color:white;
}
#zoompan{
    position:absolute;
    left:20%;
    top:0.5em;
    font-size:18px;
}
.links{
    position:absolute;
    color:black;
    background-color:white;
    z-index:1;
}
.imgs{
    position:absolute;
    z-index:-1;
}
#backlink{
    position:absolute;
    left:60%;
    top:0px;
    z-index:2;
}
 #svglink{
     position:absolute;
     left:80%;
     top:10px;
     z-index:2;
 }
 #phpfeedlink{
     position:absolute;
     left:80%;
     top:3em;
     z-index:2;
 }
 #editorlink{
     position:absolute;
     left:70%;
     top:10px;
     z-index:2;
 }
 #uplink{
     position:absolute;
     left:60%;
     top:2em;
     z-index:2;
 }
 #factorylink{
     position:absolute;
     left:60%;
     top:1.2em;
     z-index:2;
 }
 #shapetablelink{
     position:absolute;
     left:70%;
     top:50px;
     z-index:2;
 }
 #stylelink{
     position:absolute;
     left:70%;
     top:80px;
     z-index:2;
 }
 #textIO{
    position:absolute;
    width:100px;
    height:100px;
    right:0px;
    bottom:0px;
    border:solid;
}
#mainCanvas{
    position:absolute;
    z-index:0;
    left:0px;
    top:0px;
}
#controlTable{
    left:15px;
    top:15px;
}
#imageTable{
    right:10px;
    top:20%;
    position:absolute;

}
#imageTable input{
    width:5em;
    font-family:courier;
}
table{
    font-family:courier;
    font-size:18;
    position:absolute;
}
#controlTable input{
    width:3em;
    font-family:courier;
}

.button{
    padding:0.5em 0.5em 0.5em 0.5em;
    font-family:courier;
    cursor:pointer;
    border:solid;
    border-radius:0.5em;
}
.button:hover{
    background-color:green;
}
.button:active{
    background-color:yellow;
}
#keyboardlink{
    position:absolute;
    right:5%;
    bottom:5%;
}
#glyphspellinput{
    position:absolute;
    bottom:5px;
    left:10px;
    width:90%;
    font-family:courier;
    font-size:16px;
}
#buttonTable{
    position:absolute;
    left:15px;
    top:40%;
}
img{
    position:absolute;
    z-index:-2;
}
#mainImage{
    position:absolute;
    z-index:-2;
}
#editmodebutton{
    position:absolute;
    right:0px;
    top:0px;
    z-index:2;
}
#softkeybutton{
    position:absolute;
    right:0px;
    top:3em;
    z-index:2;
}
#keytable{
    bottom:0px;
    right:0px;
    margin:auto;
    display:block;
    border:solid;
    display:none;
}
.softkey{
    width:55px;
    height:55px;
    border-radius:5px;
    border:solid;
    padding:5px 5px 5px 5px;
}
</style>

</body>
</html>