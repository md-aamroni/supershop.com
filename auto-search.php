<?php

include("app/Http/Controllers/View.php");

$view = new View;

$view->loadContent("include", "session");
$view->loadContent("content", "auto-search");
