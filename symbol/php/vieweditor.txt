<!doctype html>
<html>
<head>
<title>View Editor</title>
<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

_9_LAWS_OF_GEOMETRON_:

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO PROPERTY
NO MINING

EGO DEATH:
    LOOK AT THE INSECTS
    LOOK AT THE FUNGI
    LANGUAGE IS HOW THE MIND PARSES REALITY
    
-->
<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

<script src = "https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>

<script id = "bytecodeScript">/*
<?php
echo file_get_contents("bytecode/baseshapes.txt")."\n";
echo file_get_contents("bytecode/shapetable.txt")."\n";
echo file_get_contents("bytecode/font.txt")."\n";
echo file_get_contents("bytecode/symbolkeyboard.txt")."\n";
echo file_get_contents("bytecode/symbols013xx.txt")."\n";
echo file_get_contents("bytecode/symbols010xx.txt")."\n";

if(isset($_GET['path'])){
    if(file_exists("symbols/".$_GET['path']."/bytecode/shapetable.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/shapetable.txt");
    }
    if(file_exists("symbols/".$_GET['path']."/bytecode/font.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/font.txt");
    }
}

if(isset($_GET['font'])){
    echo file_get_contents($_GET['font'])."\n";
}
if(isset($_GET['shapetable'])){
    echo file_get_contents($_GET['shapetable'])."\n";
}

?>
*/</script>
<script id = "topfunctions">
<?php
echo file_get_contents("javascript/topfunctions.txt");
?>   
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
<div id = "stylejsondiv" style = "display:none"><?php
    if(isset($_GET['path'])){
        echo file_get_contents("symbols/".$_GET['path']."json/stylejson.txt");

    }
    else{
        echo file_get_contents("json/stylejson.txt");
    }
?></div>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
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
<div id = "extdatadiv" style = "display:none"><?php
if(isset($_GET['url'])){
    $urlfilename = $_GET['url'];
    if(substr($urlfilename,-4) == ".svg"){
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</json>",$svgcode)[0];
        $jsoncode = explode("<json>",$topcode)[1];
        echo $jsoncode;
    }
    else{
        echo file_get_contents($_GET['url']);
    }
}?>
</div>
<div id = "page">
<table id = "linkTable">
    <tr>
        <td>
            <a id = "indexlink" href = "index.php"><img src = "icons/symbol.svg"></a>
        </td>
    </tr>
</table>

<table id = "inputtable">
    <tr>
        <td>WIDTH:</td><td><input/></td>
    </tr>
    <tr>
        <td>HEIGHT:</td><td><input/></td>
    </tr>
    <tr>
        <td>UNIT:</td><td><input/></td>
    </tr>
    <tr>
        <td>X OFFSET:</td><td><input/></td>
    </tr>
    <tr>
        <td>Y OFFSET:</td><td><input/></td>
    </tr>
    
</table>

<div id = "resetbutton" class = "button">RESET</div>

<table id = "hammertable">
    <tr><td id = "svgwidthslider">WIDTH</td></tr>
    <tr><td id = "svgheightslider">HEIGHT</td></tr>
    <tr><td id = "scaleslider">SCALE</td></tr>
</table>

<canvas id="invisibleCanvas" style="display:none"></canvas>
<canvas id="mainCanvas"></canvas>

</div>
<script>
</script>
<script id = "init">
init();
function init(){
    doTheThing(06);//import embedded hypercube in this .html doc
    doTheThing(07);//initialize Geometron global variables

    currentJSON = JSON.parse(document.getElementById("datadiv").innerHTML);
    styleJSON = JSON.parse(document.getElementById("stylejsondiv").innerHTML);

    path = document.getElementById("pathdiv").innerHTML;


    if(path.length > 0){
        document.getElementById("indexlink").href = "index.php?path=" + path;
    }

    document.getElementById("mainCanvas").width = innerWidth;
    document.getElementById("mainCanvas").height = innerHeight;

    exturl = false;

    currentGlyph = currentJSON.glyph + "0207,";
    
    for(var index = 0;index < currentJSON.table.length;index++){
        var localaddr = parseInt(currentJSON.table[index].split(":")[0],8);    
        currentTable[localaddr] = currentJSON.table[index].split(":")[1];
    }


    cleanGlyph = "";
    glyphEditMode = true;
    shapeTableEditMode = false;
    spellMode = false;

    currentGlyph = currentJSON.glyph;

    tableinputs = document.getElementById("inputtable").getElementsByTagName("INPUT");

}
</script>
<script id = "redraw">
redraw();
function redraw(){

    unit = currentJSON.unit;
    x0 =  0.5*innerWidth + currentJSON.x0rel;
    y0 = 0.5*innerHeight + currentJSON.y0rel;

    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,innerWidth,innerHeight);
ctx.strokeStyle= "black";
ctx.lineWidth = 1;    	

    ctx.strokeRect(0.5*innerWidth - 0.5*currentJSON.svgwidth,0.5*innerHeight - 0.5*currentJSON.svgheight,currentJSON.svgwidth,currentJSON.svgheight);

    doTheThing(0300);
    drawGlyph(currentGlyph);


    if(path.length>1){
        currentFile = "symbols/" + path + "json/currentjson.txt";
    }
    else{
        currentFile = "json/currentjson.txt";
    }

    
    data = encodeURIComponent(JSON.stringify(currentJSON,null, "    "));
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    

    tableinputs[0].value = currentJSON.svgwidth.toString();
    tableinputs[1].value = currentJSON.svgheight.toString();
    tableinputs[2].value = currentJSON.unit.toString();
    tableinputs[3].value = currentJSON.x0rel.toString();
    tableinputs[4].value = currentJSON.y0rel.toString();

    
}
</script>
<script id = "pageevents">

document.getElementById("resetbutton").onclick = function(){
    currentJSON.x0rel = 0;
    currentJSON.y0rel = 0;
    currentJSON.unit = 100;
    currentJSON.svgwidth = 250;
    currentJSON.svgheight = 250;
    redraw();
 }

mc = new Hammer(document.getElementById("mainCanvas"));
mc.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc.on("panleft panright panup pandown tap press", function(ev) {
    currentJSON.x0rel = ev.deltaX;
    currentJSON.y0rel = ev.deltaY;
    redraw();
});    

mc1 = new Hammer(document.getElementById("scaleslider"));
mc1.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc1.on("panleft panright panup pandown tap press", function(ev) {
    currentJSON.unit = Math.round(100*Math.exp(ev.deltaX/100));
    redraw();
});


mc2 = new Hammer(document.getElementById("svgwidthslider"));
mc2.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc2.on("panleft panright panup pandown tap press", function(ev) {
    currentJSON.svgwidth = Math.round(250*Math.exp(ev.deltaX/100));
    redraw();
});

mc3 = new Hammer(document.getElementById("svgheightslider"));
mc3.get('pan').set({ direction: Hammer.DIRECTION_ALL });
mc3.on("panleft panright panup pandown tap press", function(ev) {
    currentJSON.svgheight = Math.round(250*Math.exp(ev.deltaX/100));
    redraw();
});


tableinputs[0].onchange = function(){
    currentJSON.svgwidth = parseInt(this.value);
    redraw();
} 
tableinputs[1].onchange = function(){
    currentJSON.svgheight = parseInt(this.value);
    redraw();
} 
tableinputs[2].onchange = function(){
    currentJSON.unit = parseInt(this.value);
    redraw();
} 
tableinputs[3].onchange = function(){
    currentJSON.x0rel = parseInt(this.value);
    redraw();
} 
tableinputs[4].onchange = function(){
    currentJSON.y0rel = parseInt(this.value);
    redraw();
} 


</script>
<style>
body{
    overflow:hidden;
    font-family:Helvetica;
    font-size:24px;
}
#mainCanvas{
    position:absolute;
    z-index:0;
    left:0px;
    top:0px;
}
.button{
    padding:0.5em 0.5em 0.5em 0.5em;
    font-family:courier;
    cursor:pointer;
    border:solid;
    border-radius:0.5em;
}
.button:active{
    background-color:yellow;
}

#linkTable{
    position:absolute;
    z-index:2;
    left:0px;
    top:0px;
}
#linkTable img{
    width:80px;
}
#inputtable{
    position:absolute;
    top:110px;
    left:0px;
    z-index:4;
}
#mainCanvas{
    top:0px;
    left:0px;
    position:absolute;
    z-index:0;
}
#hammertable{
    position:absolute;
    bottom:0px;
    left:0px;
    z-index:3;
    width:100%;
}
#hammertable tr{
    position:relative;
    bottom:0px;
    left:0px;
    z-index:3;
    width:100%;
}
#hammertable td{
    left:0px;
    width:100%;
    z-index:3;
    height:80px;
    border:solid;
}

#resetbutton{
    position:absolute;
    right:0px;
    top:0px;
    z-index:3;
}

</style>
</body>
</html>