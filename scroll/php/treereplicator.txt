<?php



//replace this with url of scroll tree dna in source page:

    $url = "https://raw.githubusercontent.com/LafeLabs/mapfactory3/master/scroll/json/treedna.txt";
    
    $dnaraw = file_get_contents($url);
    $dna =json_decode($dnaraw);
    $baseurl = explode("json",$url)[0];

    $markdown = $dna->markdown;
    $latex = $dna->latex;
    $image = $dna->image;
    
    foreach($markdown as $scrolls){
        copy($baseurl."markdown/".$scrolls,"markdown/".$scrolls);
    }    
    foreach($latex as $texs){
        copy($baseurl."latex/".$texs,"latex/".$texs);
    }
    foreach($image as $images){
        $imagedirname = "latex/".explode("/",$images)[0];
        if(!file_exists($imagedirname)){
            mkdir($imagedirname);
        }
        copy($baseurl."latex/".$images,"latex/".$images);
    }
    
?>

<a href = "index.php?tree.php" style = "font-size:5em;">TREE</a>
