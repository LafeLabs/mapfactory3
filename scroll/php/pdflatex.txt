 <?php
/* javascript this pairs with:
*/
    $filename = $_POST["filename"];

    exec("pdflatex -output-directory=\"latex\" ".$filename);

?>