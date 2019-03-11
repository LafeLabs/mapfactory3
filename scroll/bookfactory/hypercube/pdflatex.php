<?php

exec("pdflatex scroll.tex");
exec("pdfbook scroll.pdf");

?>
