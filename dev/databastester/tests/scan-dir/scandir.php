<?php
$dir = "includes";

// Sort in ascending order - this is default
$a = preg_grep('~\.(jpeg|jpg|php)$~', scandir($dir));

// Sort in descending order
$b = scandir($dir,1);

print_r($a);
// Sort in kind of cool
print_r($b);
?>