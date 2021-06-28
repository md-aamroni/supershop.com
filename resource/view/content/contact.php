<?php
## ===*=== [C]ALLING CONTROLLER ===*=== ##
include("app/Http/Controllers/Controller.php");


## ===*=== [O]BJECT DEFINED ===*=== ##
$control = new Controller;
$eloquent = new Eloquent;


## ===*=== [I]NSERT DATA TO CONTACTS ===*=== ##
if(isset($_POST['user_contact']))
{
	$tableName = "contacts";
	$columnValue["contacts_name"] = $_POST['contact_name'];
	$columnValue["contacts_email"] = $_POST['contact_email'];
	$columnValue["contacts_phone"] = $_POST['contact_phone'];
	$columnValue["contacts_overview"] = $_POST['contact_message'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$contactsData = $eloquent->insertData($tableName, $columnValue);
}
## ===*=== [I]NSERT DATA TO CONTACTS ===*=== ##
?>

<!--=*= CONTACT SECTION START =*=-->
<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="index.php">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Contact Us</li>
			</ol>
		</div>
	</nav>
	<div class="page-header">
		<div class="container">
			
			<?php 
				#== SUBMIT CONFIRMATION MESSAGE
				if(isset($_POST['user_contact']))
				{
					if($contactsData > 0)
						echo '<div class="alert alert-success">
									Dear Customer, we appeciate your valueable comments. Our team will be contact you soon, thanks for stay with us.
								</div>';
				}
			?>
			
			<h1>Contact Us</h1>
		</div>
	</div>
	<div class="container">
		<div class="map">
			<div class="map-part">
				<div id="map" class="map-inner-part"></div>
			</div>
			
			<!--=*= GOOGLE MAP CONTENT START =*=-->
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyC_G1wZMKrwyHHOteMdVwCy82Qm4Pp7vyI&amp;callback=initMap"></script> 
			<script type="text/javascript">
				// #== When the window has finished loading create our google map below
				google.maps.event.addDomListener(window, 'load', init);
				
				function init() {
					// #== Basic options for a simple Google Map
					// #== For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
					
					var mapOptions = {
						// #== How zoomed in you want the map to start at (always required)
						zoom: 14,
						scrollwheel:false,
						
						// #== The latitude and longitude to center the map (always required)
						center: new google.maps.LatLng(23.617928, 90.4864331), // New York
						
						// #== How you would like to style the map. 
						// #== This is where you would paste any style found on Snazzy Maps.
						styles: [{"featureType":"all","elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#666666"},{"lightness":40}]},{"featureType":"all","elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#000000"},{"lightness":16}]},{"featureType":"all","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#000000"},{"lightness":17},{"weight":1.2}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":20}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":21}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#000000"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#666666"},{"lightness":100},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":16}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":19}]},{"featureType":"water","elementType":"geometry","stylers":[{"color":"#000000"},{"lightness":17}]}]
					};
					
					// #== Get the HTML DOM element that will contain your map 
					// #== We are using a div with id="map" seen below in the <body>
					var mapElement = document.getElementById('map');
					
					// #== Create the Google Map using our element and options defined above
					var map = new google.maps.Map(mapElement, mapOptions);
					
					// #== Let's also add a marker while we're at it
					
				var marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(23.617928, 90.4864331)});infowindow = new google.maps.InfoWindow({content:"<b>https://aamroni.net</b><br/>BSCIC-1420<br/> Narayanganj" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);
			</script> 
			<!--=*= GOOGLE MAP CONTENT END =*=-->
			
		</div>
		<div class="row">
			<div class="col-md-8">
				<h2 class="light-title">Write <strong>Us</strong></h2>
				<form action="" method="post">
					<div class="form-group required-field">
						<label for="contact-name">Name</label>
						<input type="text" class="form-control" name="contact_name" required>
					</div>
					<div class="form-group required-field">
						<label for="contact-email">Email</label>
						<input type="email" class="form-control" name="contact_email" required>
					</div>
					<div class="form-group">
						<label for="contact-phone">Phone Number</label>
						<input type="tel" class="form-control" name="contact_phone">
					</div>
					<div class="form-group required-field">
						<label for="contact-message">What’s on your mind?</label>
						<textarea cols="30" rows="1" class="form-control" name="contact_message" required></textarea>
					</div>
					<div class="form-footer">
						<button type="submit" name="user_contact" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<h2 class="light-title">Contact <strong>Details</strong></h2>
				<div class="contact-info">
					<div>
						<i class="icon-phone"></i>
						<p><a href="tel:">880 1316 440504</a></p>
						<p>Cell Number</p>
					</div>
					<div>
						<i class="icon-mobile"></i>
						<p><a href="tel:">880 1316 440497</a></p>
						<p>Home Number</p>
					</div>
					<div>
						<i class="icon-mail-alt"></i>
						<p><a href="mailto:#">md.aamroni@gmail.com</a></p>
						<p><a href="mailto:#">md.aamroni@hotmail.com</a></p>
					</div>
					<div>
						<i class="icon-skype"></i>
						<p><a href="skype:live:.cid.5ed7daebee5e7820">md.aamroni</a></p>
						<p>FULL STACK WEB DEVELOPER</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="mb-8">
		<!-- CREATE A EMPTY SPACE BETWEEN CONTENT -->
	</div>
</main>
<!--=*= CONTACT SECTION START =*=-->