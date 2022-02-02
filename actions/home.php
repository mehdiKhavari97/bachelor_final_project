

	<!-- top_box -->
	<div id="top_box">

		<!-- logo -->
		<!-- logo -->
			<div class="top_box_right">
				<?php
				if( isset( $_SESSION['panel_pass']) or isset($_SESSION['paneldealer_user']) )
				{
				?>
					<br class="ifsmallnone">
					<br class="ifsmallnone">
				<?php
				}
				?>
						<img src="./images/favicon.png" class="logo" alt="logo" />
						<h1>خودرویاب</h1>
						<br class="clear">
						<p>
						<?php echo str_ireplace("\n", "<br>", strip_tags($row_settings['help_pardakht'])); ?>
						</p>
				<?php
				if( !isset( $_SESSION['panel_pass']) and !isset($_SESSION['paneldealer_user']) )
				{
				?>
					<br class="clear">
					<a href="<?php echo $url ?>/panel_user" class="a_green_button" target="_blank">می خواهم خودرو اجاره کنم</a>
					<br style="clear: both;">
					<br style="clear: both;">
					<a href="<?php echo $url ?>/panel_dealer" class="a_blue_button" target="_blank">نمایشگاه هستم</a>
				<?php
				}
				?>

			</div>
		<!-- logo -->
		<!-- logo -->

		<!-- map -->
		<!-- map -->
		<div class="map_buttons">
			<a href="javaScript:void(0)" id="locate-position">جستجو در محدوده من</a>
		</div>
			<link rel="stylesheet" href="<?php echo $url; ?>/js/leaflet/leaflet.css" />
			<script src="<?php echo $url; ?>/js/leaflet/leaflet.js"></script>
			<div id="map" class="map map-home"></div>
			<script>
				var osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
					osmAttrib = '',
					osm = L.tileLayer(osmUrl, {maxZoom: 18, attribution: osmAttrib});


					var map = L.map('map').setView([32.17751245743296, 53.2934810113244], 5).addLayer(osm);



					$('#locate-position').on('click', function(){

						function onLocationFound(e) {
							var radius = e.accuracy / 2;
				      
							//Create pop-up to display location accuracy.  Location is coming from IP location or GPS receiver in mobile device
							//L.marker(e.latlng).addTo(map)
								//.bindPopup("You are within " + radius + " meters from this point").openPopup();

							//Create circle to graphically represent location accuracy
							L.circle(e.latlng, radius).addTo(map);
						}

									
						function onLocationError(e) {
							alert(e.message);
						}

						map.on('locationfound', onLocationFound);
						map.on('locationerror', onLocationError);

						map.locate({setView: true, maxZoom: 13});

					});

				<?php
				$res_dealers = mysqli_query($dbc, 'select * from users_dealers where lat!="" and lng!="";');
				$num_dealers = mysqli_num_rows($res_dealers);
				for ($i=0; $i < $num_dealers; $i++) {
					$row_dealers = mysqli_fetch_array($res_dealers);

					if(strlen($row_dealers['lat'])>5 and strlen($row_dealers['lng'])>5 )
					{
						echo '
							var marker = L.marker(['.$row_dealers['lat'].', '.$row_dealers['lng'].']).addTo(map);
							marker.bindPopup("<b>'.$row_dealers['dealer_name'].'</b><br><a href=\''.$url.'/?action=dealer_cars&id='.$row_dealers['id'].'\'>لیست خودروها</a>");
						';
					}
				}
				?>


			</script>
		<!-- map -->
		<!-- map -->

	</div>
	<!-- top_box -->


	<br class="clear">
