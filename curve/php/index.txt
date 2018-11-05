 <!doctype html>
<html>
<head>
<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAIiIiIiIiIiIAERAAERAAEQABEQABEQABIiIiIiIiIiIiIiIiIiIiIgAAAAAAAAAAAAAAAAAAIgAwAAAAAAIAIwMAAAAAIAAyADAAAAIAAwAAAAAAAAAAACAAMAIAAwAAAgADIAAwAAAAIAIwAwAAAAACIAMwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//AAD/8wAAf+wAAL/cAADfuwAAAAAAAHbvAAC53wAA2b8AAOZ/AAD//wAA" rel="icon" type="image/x-icon" />

<title>Curve Factory</title>

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.


_____9 LAWS OF GEOMETRON_____:

EVERYTHING IS PHYSICAL
EVERYTHING IS FRACTAL
EVERYTHING IS RECURSIVE

NO MONEY
NO MINING
NO PROPERY

EGO DEATH:
    LOOK AT THE FUNGI
    LOOK AT THE INSECTS
    LANGUAGE IS HOW THE MIND PARSES REALITY


no patents, trademarks, real estate, equity, debt, corporate structure, copyrights, or fixed machines
no press
no investors, no workers, no customers, all are participants
no logins, no passwords
no native code
no app store presence
no installs from command line
no advertising
no cookies other than the ones you eat
trust all non coders, mistrust all coders


the five Elements are:

EARTH: GEOMETRON
FIRE: JAVASCRIPT
AIR: CSS
WATER: HTML
AETHER: PHP



-->

<!--Stop Google:-->
<META NAME="robots" CONTENT="noindex,nofollow">

<script id = "topfunctions">

<?php

    if(isset($_GET['url']) && !isset($_GET['path'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</topfunctions>",$svgcode)[0];
        $outcode = explode("<topfunctions>",$topcode)[1];
        echo $outcode;
        $file = fopen("javascript/topfunctions.txt","w");// create new file with this name
        fwrite($file,$outcode); //write data to file
        fclose($file);  //close file
    }
    if(isset($_GET['url']) && isset($_GET['path'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</topfunctions>",$svgcode)[0];
        $outcode = explode("<topfunctions>",$topcode)[1];
        echo $outcode;
        $file = fopen("curves/".$_GET['path']."javascript/topfunctions.txt","w");// create new file with this name
        fwrite($file,$outcode); //write data to file
        fclose($file);  //close file
    }
    if(isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("curves/".$_GET['path']."javascript/topfunctions.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("javascript/topfunctions.txt");
    }

?>

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/hammer.js/2.0.8/hammer.js"></script>
<!--
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjax/2.7.0/MathJax.js?config=TeX-AMS-MML_HTMLorMML"></script>
    <script>
	MathJax.Hub.Config({
		tex2jax: {
		inlineMath: [['$','$'], ['\\(','\\)']],
		processEscapes: true,
		processClass: "mathjax",
        ignoreClass: "no-mathjax"
		}
	});//			MathJax.Hub.Typeset();//tell Mathjax to update the math
</script>
-->
</head>
<body>
<div id = "pathdiv" style= "display:none"><?php

    if(isset($_GET['path'])){
        echo $_GET['path'];
    }

?></div>
<div id = "plotdatadiv" style = "display:none;"><?php
    echo file_get_contents("json/plotdata.txt");
?></div>
    
<div id = "jsondatadiv" style = "display:none;"><?php

    if(isset($_GET['url'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</currentjson>",$svgcode)[0];
        $outcode = explode("<currentjson>",$topcode)[1];
        echo $outcode;
    }
    if(isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("curves/".$_GET['path']."json/currentjson.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("json/currentjson.txt");
    }


?></div>
<div id = "equationdata" style = "display:none"><?php

    if(isset($_GET['url'])){
        $urlfilename = $_GET['url'];
        $svgcode = file_get_contents($_GET['url']);
        $topcode = explode("</equation>",$svgcode)[0];
        $outcode = explode("<equation>",$topcode)[1];
        echo $outcode;
    }
    if(isset($_GET['path'])){
        echo file_get_contents("curves/".$_GET['path']."markdown/equation.txt");
    }
    if(!isset($_GET['path']) && !isset($_GET['url'])){
        echo file_get_contents("markdown/equation.txt");
    }

?></div>
<?php

echo file_get_contents("html/page.txt");

?>
<script id = "init">
init();
function init(){
<?php
    $data = file_get_contents("javascript/init.txt");
    echo $data;    
?>
}
</script>
<script id = "redraw">
<?php
        echo "\nredraw();\n";
        echo "\nfunction redraw(){\n";
        $data = file_get_contents("javascript/redraw.txt");
        echo $data;
        echo "\n}\n";
?>
</script>
<script id = "pageevents">
<?php
    $data = file_get_contents("javascript/pageevents.txt");
    echo $data;    
?>
</script>
</body>
</html>