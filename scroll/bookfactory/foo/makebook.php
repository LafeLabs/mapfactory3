<?php
exec("pdflatex scroll.tex");
exec("pdfbook scroll.pdf");
exec("cp scroll-book.pdf ../foo-book.pdf");
?>
