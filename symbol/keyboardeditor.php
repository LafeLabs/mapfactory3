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
<div id = "stylejsondiv" style = "display:none"><?php

echo file_get_contents("json/stylejson.txt");
    
?></div>
<div id = "page">
    <p>
        <a href = "editor.php">editor.php</a>
    </p>
    <table id = "keytable">
        <tr>
            <td>keycode:</td><td id = "keycodeinput"></td>
        </tr>
        <tr>
            <td>Key:</td><td id = "keyinput"></td>
        </tr>
        <tr>
            <td>Action:</td><td><input id  = "actioninput"/></td>
        </tr>
    </table>
    <textarea id = "textIO"></textarea>
    <canvas id = "mainCanvas"></canvas>
    
    
    <table id = "keyboardtable">
    </table>
</div>

<script id = "init">
init();
function init(){
    doTheThing(06);//import embedded hypercube in this .html doc
    doTheThing(07);//initialize Geometron global variables

    styleJSON = JSON.parse(document.getElementById("stylejsondiv").innerHTML);

    document.getElementById("mainCanvas").width = 140;
    document.getElementById("mainCanvas").height = 140;

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



    for(var rowIndex = 0;rowIndex < upperArray.length;rowIndex++){
        var newtr = document.createElement("TR");
        var tempArray = lowerArray[rowIndex].split(",");
        for(var index = 0;index < tempArray.length;index++){
            if(tempArray[index].length > 1){
                var newtd = document.createElement("TD");
                var newcanvas = document.createElement("canvas");
                newcanvas.width = 60;
                newcanvas.height = 60;
                ctx = newcanvas.getContext("2d");
                unit = 50;
                x0 = 5;
                y0 = 55;
                doTheThing(0300);
                doTheThing(01000 + parseInt(currentTable[parseInt(tempArray[index],8)],8));
                newtd.appendChild(newcanvas);
                newtr.appendChild(newtd);
                

            }
        }
        document.getElementById("keyboardtable").appendChild(newtr);
        newtr.style.position = "relative";
        newtr.style.left = indentArray[rowIndex].toString() + "em";
    }   

    for(var rowIndex = 0;rowIndex < upperArray.length;rowIndex++){
        var newtr = document.createElement("TR");
        var tempArray = lowerArray[rowIndex].split(",");
        for(var index = 0;index < tempArray.length;index++){
            if(tempArray[index].length > 1){
                var newtd = document.createElement("TD");
                newtd.innerHTML = byteCode2string(tempArray[index]) + "<br/>" + tempArray[index] + ":";   
                newtd.innerHTML += "<input value = \"" + currentTable[parseInt(tempArray[index],8)] + "\" id = \"i" + tempArray[index] + "\"/>";

                newtr.appendChild(newtd);
                newtd.id = "k" + tempArray[index];
                newtd.onclick  = function(){
                    currentKey = this.id.substring(1);
                    redraw();
                }

            }
        }
        document.getElementById("keyboardtable").appendChild(newtr);
        newtr.style.position = "relative";
        newtr.style.left = indentArray[rowIndex].toString() + "em";
    }   


    for(var rowIndex = 0;rowIndex < upperArray.length;rowIndex++){
        var newtr = document.createElement("TR");
        var tempArray = upperArray[rowIndex].split(",");
        for(var index = 0;index < tempArray.length;index++){
            if(tempArray[index].length > 1){
                var newtd = document.createElement("TD");
                var newcanvas = document.createElement("canvas");
                newcanvas.width = 60;
                newcanvas.height = 60;
                ctx = newcanvas.getContext("2d");
                unit = 50;
                x0 = 5;
                y0 = 55;
                doTheThing(0300);
                doTheThing(01000 + parseInt(currentTable[parseInt(tempArray[index],8)],8));
                newtd.appendChild(newcanvas);
                newtr.appendChild(newtd);
                

            }
        }
        document.getElementById("keyboardtable").appendChild(newtr);
        newtr.style.position = "relative";
        newtr.style.left = indentArray[rowIndex].toString() + "em";
    }   
    
        for(var rowIndex = 0;rowIndex < upperArray.length;rowIndex++){
        var newtr = document.createElement("TR");
        var tempArray = upperArray[rowIndex].split(",");
        for(var index = 0;index < tempArray.length;index++){
            if(tempArray[index].length > 1){
                var newtd = document.createElement("TD");
                
                newtd.innerHTML = byteCode2string(tempArray[index]) + "<br/>" + tempArray[index] + ":";   
                newtd.innerHTML += "<input value = \"" + currentTable[parseInt(tempArray[index],8)] + "\" id = \"i" + tempArray[index] + "\"/>";
                //newtd.innerHTML = tempArray[index] + ":<br/>" +byteCode2string(tempArray[index]);   
                //newtd.innerHTML += "<br/>" + currentTable[parseInt(tempArray[index],8)];
                newtr.appendChild(newtd);
                newtd.id = "k" + tempArray[index];
                newtd.onclick  = function(){
                    currentKey = this.id.substring(1);
                    redraw();
                }
            }
       }
        document.getElementById("keyboardtable").appendChild(newtr);
        newtr.style.position = "relative";
        newtr.style.left = indentArray[rowIndex].toString() + "em";
    }

      
}
</script>
<script id = "redraw">
redraw();
function redraw(){

    ctx = document.getElementById("mainCanvas").getContext("2d");
    ctx.clearRect(0,0,200,200);
    x0 = 20;
    y0 = 120;
    unit = 100;
    doTheThing(0300);
    drawGlyph(currentTable[01000 + parseInt(currentTable[parseInt(currentKey,8)],8)]);
    document.getElementById("keycodeinput").innerHTML = currentKey;
    document.getElementById("keyinput").innerHTML = byteCode2string(currentKey);
    document.getElementById("actioninput").value = currentTable[parseInt(currentKey,8)];
    
}

document.getElementById("actioninput").onchange = function(){
    currentTable[parseInt(currentKey,8)] = this.value;    
    
    keyboardout = "";
    for(var index = 040;index < 0177;index++){
        keyboardout += "0" + index.toString(8) + ":" + currentTable[index] + "\n";
    }
    document.getElementById("textIO").value = keyboardout;
    redraw();
}

</script>
<script id = "pageevents">

</script>
<style>

#keyboardtable{
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
</style>

</body>
</html>