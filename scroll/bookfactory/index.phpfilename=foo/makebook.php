<?php
exec("pdflatex scroll.tex");
exec("pdfbook scroll.pdf");
exec("cp scroll-book.pdf ../index.php?filename=foo-book.pdf");
?>
