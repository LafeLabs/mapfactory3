<!doctype html>
<html>
<head>
<title>Geometron Symbol</title>
<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAA/wAAAAD//wAA/wAAAAD/AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAzMzMAERERAAMzMEQBERAAAzMwRAEREAAAMwREQBEAAAAAREREAAAAAAAAAAAAAAAAACIiIgAAAAAAIiIiAAAAAAACIiAAAAAAAAAiAAAAAAAAACIAAAAAAAAAAAAAAAAAAAAAAAAAD//wAA//8AAAAAAAAAAAAAAAAAAIABAACAAQAAwAMAAOAHAADgBwAA8A8AAPAPAAD4HwAA/D8AAPw/AAD+fwAA" rel="icon" type="image/x-icon" />
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

<script id = "bytecodeScript">/*
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
<div id = "softkeydata" style = "display:none"><?php
    echo file_get_contents("json/softkeys.txt");
?></div>
<div id = "backurldata" style = "display:none"><?php

    if(isset($_GET['backlink'])){
        echo $_GET['backlink'];
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
<?php
    echo file_get_contents("html/page.txt");
?>
</div>
<script>
</script>
<script id = "init">
init();
function init(){
<?php
    echo file_get_contents("javascript/init.txt");
?>
}
</script>
<script id = "redraw">
redraw();
function redraw(){
<?php
    echo file_get_contents("javascript/redraw.txt");
?>
}
</script>

<script id = "pageevents">
<?php
    echo file_get_contents("javascript/pageevents.txt");
?>
</script>
<?php
    echo "<style>\n";
    echo file_get_contents("css/style.txt");
    echo "</style>\n";
?>
</body>
</html>