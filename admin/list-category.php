<?php
### INCLUDE VIEW CLASS
include("app/Http/Controllers/View.php");

## [O]bject Defined 
$view = new View;

## [M]ethod Execute | VIEW CLASS
$view->loadContent("include", "session");
$view->loadContent("include", "top");
$view->loadContent("content", "list-category");
$view->loadContent("include", "tail");
?>