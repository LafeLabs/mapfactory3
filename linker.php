<!doctype html>
<html  lang="en">
<head>
<meta charset="utf-8"> 
<title>Link Creator</title>

<link href="data:image/x-icon;base64,AAABAAEAEBAQAAEABAAoAQAAFgAAACgAAAAQAAAAIAAAAAEABAAAAAAAgAAAAAAAAAAAAAAAEAAAAAAAAAAAAAAAAP//AP8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAiIiIiIiIiIgERAAERAAERABEQABEQABEAAREAAREAASIiIiIiIiIiAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACIiIiIiIiIiAREAAREAAREAERAAERAAEQABEQABEQABIiIiIiIiIiL//wAAAAAAAAAAAAAAAAAAAAAAAAAAAAC++wAAnnkAAI44AACeeQAAvvsAAAAAAAAAAAAAAAAAAAAAAAAAAAAA" rel="icon" type="image/x-icon" />

<!-- 
PUBLIC DOMAIN, NO COPYRIGHTS, NO PATENTS.

note that "map" has a broader meaning than just geographic maps like google maps or yahoo or whatever, the wikipedia definition starts like this:

"A map is a symbolic depiction emphasizing relationships between elements of some space, such as objects, regions, or themes."

This is the goal of this project, to make a factory which creates maps in this generalized definition.  

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
</head>
<body>
<div id = "datadiv" style = "display:none"><?php

echo file_get_contents("json/map.txt");

?></div>
<div id = "linkdatadiv" style = "display:none"><?php

    echo file_get_contents("json/links.txt");

?></div>
<div id = "listoflists" style = "display:none;"><?php

    echo file_get_contents("json/listoflists.txt");
    
?></div>
<a href = "editor.php"><img src = "icons/editor.svg"></a>

<script>
    links = JSON.parse(document.getElementById("linkdatadiv").innerHTML);
    imgurls = [];
    listoflists = JSON.parse(document.getElementById("listoflists").innerHTML);
    for(var index = 0;index < listoflists.length;index++){
        currentFile = listoflists[index];
        var httpc = new XMLHttpRequest();     
        httpc.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                baseurl = currentFile.split("list.txt")[0];
                svgs = this.responseText.split(",");
                for(var sindex = 0;sindex < svgs.length - 1;sindex++){
                    imgurls.push(baseurl + svgs[sindex]);   
                }
            }
        };
        httpc.open("GET", "fileloader.php?filename=" + currentFile, true);
        httpc.send();
   
    }
    
    

</script>
</body>
</html>