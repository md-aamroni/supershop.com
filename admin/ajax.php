<?php
### INCLUDE VIEW CLASS
include("app/Http/Controllers/View.php");

## [O]bject Defined
$view = new View;

## [M]ethod Execute | VIEW CLASS 
$view->loadContent("content", "ajax");
?>