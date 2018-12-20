 <?php
/* javascript this pairs with:
*/
    $filename = $_POST["filename"];

    exec("pdflatex -interaction=nonstopmode -output-directory=\"latex\" latex/".$filename);
    
    
?>