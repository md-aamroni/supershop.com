<?php
	$connection = new PDO ('mysql:host=localhost;dbname=supershop_rdb;charset=utf8', 'root', '');
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	
	$query = $connection->prepare("SELECT page_title FROM pages WHERE page_status = 'Active'");
	$query->execute();
	$pages = $query->fetchAll(PDO::FETCH_ASSOC);
	$base_url = 'http://localhost/www.supershop.com/';
	
	header("Content-Type: application/xml; charset=utf-8");
	
	echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
	echo '<urlset xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd" xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;
	
	foreach ($pages AS $each) 
	{
		echo '<url>' . PHP_EOL;
		echo '<loc>'. $base_url . $each['page_title'] .'</loc>' . PHP_EOL;
		echo '<changefreq>daily</changefreq>' . PHP_EOL;
		echo '</url>' . PHP_EOL;
	}
	
	echo '</urlset>' . PHP_EOL;
?>