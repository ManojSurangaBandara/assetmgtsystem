<?php include 'header2.php';?>
<style type="text/css">
       a:link {color: black;}      /* unvisited link */
       a:visited {color: black;}   /* visited link */
       a:hover {color: black;}     /* mouse over link */
       a:active {color: black;}    /* selected link */
</style>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
						        <div class="title_wrapper">
									<h2>Unit Contact Details</h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
													<div class="table_wrapper">
													<div class="table_wrapper_inner">
															<table id="abc" cellpadding="0" cellspacing="0" width="100%" >
														<tbody><tr>
															<th>&nbsp;</th>
															<th>Unit</th>
															<th>Address</th>
															<th>Telephone</th>
															<th>E-Mail</th>
															<th>Fax</th>
														</tr>
														<?php $i = 1; ?>
														<?php foreach($exps as $exp) { ?>																
														<tr class=<?php if ($i % 2) {
																		echo "first";
																		} else {
																		echo "second";
																		}?>>
															<td><?php echo $i; ?></td>
															<td><?php echo $exp['unit']; ?></td>
															<td><?php echo $exp['address']; ?></td>
															<td><?php echo $exp['telephone']; ?></td>
															<td><?php echo $exp['email']; ?></td>
															<td><?php echo $exp['fax']; ?></td>															
														</tr>
														<?php $i++; ?>
														<?php }  ?>
													  </tbody>
													  </table>					
													</div>
													  </div>
	  						        <div class="title_wrapper">
									<h2>Units Locations</h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
								<script src="http://maps.google.com/maps/api/js?sensor=false" 
									  type="text/javascript"></script>
							<div id="map" style="width:100%;height:1600px;"></div>
							  <script type="text/javascript">
								var locations = <?php echo json_encode($locations); ?>;	
								//var locations = [
								//  ['Bondi Beach', -33.890542, 151.274856, 4],
								//  ['Coogee Beach', -33.923036, 151.259052, 5],
								//  ['Cronulla Beach', -34.028249, 151.157507, 3],
								//  ['Manly Beach', -33.80010128657071, 151.28747820854187, 2],
								//  ['Maroubra Beach', -33.950198, 151.259302, 1]
								//];
								var map = new google.maps.Map(document.getElementById('map'), {
								  zoom: 9,
								  center: new google.maps.LatLng(7.898522, 80.677079),
								  mapTypeId: google.maps.MapTypeId.ROADMAP
								});

								var infowindow = new google.maps.InfoWindow();

								var marker, i;

								for (i = 0; i < locations.length; i++) {  
								  marker = new google.maps.Marker({
									position: new google.maps.LatLng(locations[i][1], locations[i][2]),
									map: map
								  });

								  google.maps.event.addListener(marker, 'click', (function(marker, i) {
									return function() {
									  infowindow.setContent(locations[i][0]);
									  infowindow.open(map, marker);
									}
								  })(marker, i));
								}
							  </script>		  

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>