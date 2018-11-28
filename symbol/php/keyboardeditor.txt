<!doctype html>
<html>
<head>
<title>Geometron Symbol</title>
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


if(isset($_GET['path'])){
    if(file_exists("symbols/".$_GET['path']."/bytecode/shapetable.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/shapetable.txt");
    }
    if(file_exists("symbols/".$_GET['path']."/bytecode/font.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/font.txt");
    }
    if(file_exists("symbols/".$_GET['path']."/bytecode/keyboard.txt")){
        echo file_get_contents("symbols/".$_GET['path']."/bytecode/keyboard.txt");
    }
}


?>
*/
</script>
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
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "stylejsondiv" style = "display:none"><?php

    if(isset($_GET['path'])){
        echo file_get_contents("symbols/".$_GET['path']."json/stylejson.txt");
    }
    else{
        echo file_get_contents("json/stylejson.txt");
    }
    
    
?></div>
<div id = "page">
    <table id = "linktable">
        <tr>
            <td>
                <a href = "editor.php">
                    <img src = "icons/editor.svg"/>
                </a>
            </td>
            <td>
                <a id = "indexlink" href = "index.php">
                    <img src = "icons/symbol.svg"/>
                </a>
            </td>
        </tr>
    </table>
    <textarea id = "textIO"></textarea>


    <table id = "keytable">
        <tr>
            <td>UPPERCASE KEY: <span id = "upperkey"></span></td><td><input id = "upperascii"/></td><td>Action:</td><td><canvas id = "uppercan"></canvas></td><td><input  id = "upperaction"/></td>
        </tr>
        <tr>
            <td>LOWERCASE KEY: <span id = "lowerkey"></span></td><td><input id = "lowerascii"/></td><td>Action:</td><td><canvas id = "lowercan"></canvas></td><td><input id = "loweraction"/></td>
        </tr>
    </table>

    <table id = "keyboardtable">
    </table>

</div>

<script id = "init">
init();
function init(){
    
    path = document.getElementById("pathdiv").innerHTML;
    
    if(path.length > 0){
        document.getElementById("indexlink").href = "index.php?path=" + path;
    }

    doTheThing(06);//import embedded hypercube in this .html doc
    doTheThing(07);//initialize Geometron global variables

    document.getElementById("uppercan").width = 30;
    document.getElementById("uppercan").height = 30;
    document.getElementById("lowercan").width = 30;
    document.getElementById("lowercan").height = 30;

    styleJSON = JSON.parse(document.getElementById("stylejsondiv").innerHTML);

    currentKey = "0101";
    
    numbersUpper = "0176,041,0100,043,044,045,0136,046,052,050,051,0137,053,";
    numbersLower = "0140,061,062,063,064,065,066,067,070,071,060,055,075,";
    qwertyUpper = "0121,0127,0105,0122,0124,0131,0125,0111,0117,0120,0173,0175,0174,";
    qwertyLower = "0161,0167,0145,0162,0164,0171,0165,0151,0157,0160,0133,0135,0134,";
    asdfUpper = "0101,0123,0104,0106,0107,0110,0112,0113,0114,072,042,";
    asdfLower = "0141,0163,0144,0146,0147,0150,0152,0153,0154,073,047,";
    zxcvUpper = "0132,0130,0103,0126,0102,0116,0115,074,076,077,";
    zxcvLower = "0172,0170,0143,0166,0142,0156,0155,054,056,057,";
    upperArray = [numbersUpper,qwertyUpper,asdfUpper,zxcvUpper];
    lowerArray = [numbersLower,qwertyLower,asdfLower,zxcvLower];
    indentArray = [1,5.8,6.7,7.7];

    
    tdindex = 0;
    currenttd = 0;
    
    for(var rowIndex = 0;rowIndex < upperArray.length;rowIndex++){
        var newtr = document.createElement("TR");
        var tempArray = lowerArray[rowIndex].split(",");
        var tempArrayUp = upperArray[rowIndex].split(",");

        for(var index = 0;index < tempArray.length;index++){
            if(tempArray[index].length > 1){
                var newtd = document.createElement("TD");
                var newcanvas = document.createElement("canvas");
                newcanvas.width = 60;
                newcanvas.height = 60;
                ctx = newcanvas.getContext("2d");
                unit = 55;
                x0 = 5;
                y0 = 55;
                doTheThing(0300);
                doTheThing(parseInt(tempArrayUp[index],8));
                drawGlyph("0333,0200,0336,0330,0332,0332,0365,");
                doTheThing(parseInt(tempArray[index],8));
                drawGlyph("0331,0365,0330,0333,");
                doTheThing(01000 + parseInt(currentTable[parseInt(tempArrayUp[index],8)],8));
                drawGlyph("0331,0332,");
                doTheThing(01000 + parseInt(currentTable[parseInt(tempArray[index],8)],8));

    //            doTheThing(01000 + parseInt(currentTable[parseInt(tempArray[index],8)],8));
                newtd.appendChild(newcanvas);
                newtr.appendChild(newtd);
                
                var tdjson = {};
                tdjson.upperkey = parseInt(tempArrayUp[index],8);
                tdjson.upperaction = parseInt(currentTable[parseInt(tempArrayUp[index],8)],8);
                tdjson.lowerkey = parseInt(tempArray[index],8);
                tdjson.loweraction = parseInt(currentTable[parseInt(tempArray[index],8)],8);
                tdjson.index = tdindex;
                newtd.id = "t" + tdindex.toString();
                tdindex++;
                var newp = document.createElement("P");
                newp.className = "datap";
                newp.innerHTML = JSON.stringify(tdjson,null,"    ");
                newtd.appendChild(newp);
                newtd.onclick = function(){
                    var tdjson = JSON.parse(this.getElementsByClassName("datap")[0].innerHTML);
                    document.getElementById("upperkey").innerHTML = String.fromCharCode(tdjson.upperkey);
                    document.getElementById("lowerkey").innerHTML = String.fromCharCode(tdjson.lowerkey);
                    document.getElementById("upperascii").value = "0" + tdjson.upperkey.toString(8);
                    document.getElementById("lowerascii").value = "0" + tdjson.lowerkey.toString(8);
                    document.getElementById("upperaction").value = "0" + tdjson.upperaction.toString(8);
                    document.getElementById("loweraction").value = "0" + tdjson.loweraction.toString(8);
                    currenttd = parseInt(this.id.substring(1));
                    ctx = document.getElementById("uppercan").getContext("2d");
                    unit = 28;
                    x0 = 1;
                    y0 = 29;
                    ctx.clearRect(0,0,30,30);
                    doTheThing(0300);
                    ctx.lineWidth = 1;    	
                    doTheThing(01000 + tdjson.upperaction);
                    ctx = document.getElementById("lowercan").getContext("2d");
                    unit = 28;
                    x0 = 1;
                    y0 = 29;
                    ctx.clearRect(0,0,30,30);
                    doTheThing(0300);
                    ctx.lineWidth = 1;
                    doTheThing(01000 + tdjson.loweraction);
                }
            }
        }
        document.getElementById("keyboardtable").appendChild(newtr);
        newtr.style.position = "relative";
        newtr.style.left = indentArray[rowIndex].toString() + "em";
    }   
}

document.getElementById("upperaction").onchange = function(){
    currentTable[parseInt(document.getElementById("upperascii").value,8)] = this.value;
    ctx = document.getElementById("uppercan").getContext("2d");
    unit = 28;
    x0 = 1;
    y0 = 29;
    ctx.clearRect(0,0,30,30);
    doTheThing(0300);
    ctx.lineWidth = 1;
    doTheThing(01000 + parseInt(this.value,8));
    savekeyboard();
    drawkey();
}

document.getElementById("loweraction").onchange = function(){
    currentTable[parseInt(document.getElementById("lowerascii").value,8)] = this.value;
    ctx = document.getElementById("lowercan").getContext("2d");
    unit = 28;
    x0 = 1;
    y0 = 29;
    ctx.clearRect(0,0,30,30);
    doTheThing(0300);
    ctx.lineWidth = 1;
    doTheThing(01000 + parseInt(this.value,8));
    savekeyboard();

    drawkey();
}



function drawkey(){
    ctx = document.getElementById("t" + currenttd.toString()).getElementsByTagName("canvas")[0].getContext("2d");
    ctx.clearRect(0,0,60,60);
    unit = 55;
    x0 = 5;
    y0 = 55;
    doTheThing(0300);
    doTheThing(parseInt(document.getElementById("upperascii").value,8));
    drawGlyph("0333,0200,0336,0330,0332,0332,0365,");
    doTheThing(parseInt(document.getElementById("lowerascii").value,8));
    drawGlyph("0331,0365,0330,0333,");
    doTheThing(01000 + parseInt(document.getElementById("upperaction").value,8),8);
    drawGlyph("0331,0332,");
    doTheThing(01000 + parseInt(document.getElementById("loweraction").value,8),8);

}

function savekeyboard(){
    
    if(path.length > 1){
        currentFile = "symbols/" + path + "bytecode/keyboard.txt";
        
        data = "";
        for(var index = 040;index < 0177;index++){
            if(currentTable[index].length > 1){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }
        
    }
    else{
        currentFile = "bytecode/keyboard.txt";
        data = "";
        for(var index = 040;index < 0177;index++){
            if(currentTable[index].length > 2){
                data += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
            }
        }
    }
    
    
    var httpc = new XMLHttpRequest();
    var url = "filesaver.php";        
    httpc.open("POST", url, true);
    httpc.setRequestHeader("Content-Type", "application/x-www-form-urlencoded;charset=utf-8");
    httpc.send("data="+data+"&filename="+currentFile);//send text to filesaver.php
    
    document.getElementById("textIO").value  = data;  

    
}



</script>
<script id = "redraw">

</script>
<script id = "pageevents">

</script>
<style>
#linktable{
    position:absolute;
    top:0px;
    left:50%;
}
#linktable img{
    width:80px;
}
#keyboardtable{
  position:absolute;
  left:10px;
  top:200px;
  font-family:Helvetica;
  font-size:1em
}
#keyboardtable td{
  width:1.5em;
  text-align:center;
  padding:0.25em 0.5em 0.25em 0.5em;
  border:solid;
  border-radius:0.25em;
  cursor:pointer;
}
#keyboardtable td:hover{
  background-color:green;
}
#keyboardtable td:active{
  background-color:yellow;
}

#keytable input{
    width:4em;
    font-size:1em;
    font-family:courier;
}
#keytable{
    font-size:1em;
    font-family:Helvetica;
}

#mainCanvas{
    position:absolute;
    right:1em;
    top:1em;
    border:solid;
}
#textIO{
    position:absolute;
    top:1em;
    right:160px;
}
input{
    width:3em;
}
.datap{
    display:none;
}
#keytable{
    position:absolute;
    left:0px;
    top:0px;
}
#uppercan{
    border:solid;
}
#lowercan{
    border:solid;
}
</style>

</body>
</html>