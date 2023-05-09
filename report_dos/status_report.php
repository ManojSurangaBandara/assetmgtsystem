<?php	
	include '../view/header1.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
<script>
    $(function () {
        $('table').tablesorter({
            widgets: ['zebra', 'stickyHeaders', 'cssStickyHeaders'],
            usNumberFormat: false,
            sortReset: true,
            sortRestart: true
        });
    });
</script>
<div id="page">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
								<br>
								<div class="title_wrapper">
									<h2><?php echo $filestatus[$i]; ?></h2>
									<span class="title_wrapper_left"></span>
									<span class="title_wrapper_right"></span>
								</div>
								<br>
							
								<?php
								$j = 1;
								foreach ($content as $con):
									$i = 1;
									if ($j == 1) {
										$filestatus = "මු.රෙ. 104(3)  ගොණු";
									} elseif ($j == 2) {
										$filestatus = "මු.රෙ. 104(4)  ගොණු";
									} elseif ($j == 3) {
										$filestatus = "මු.රෙ. 109  ගොණු";
									}
								?>
								<table class="tablesorter">
									<caption style="text-align:left"><font size="4"><?php echo $filestatus; ?></font></caption>
									<thead>
										<tr>
											<th>S No.</th>
											<th><nobr><h4>ලිපිගොනු අංකය</h4></nobr></th>
											<th><nobr>ඒකකය</nobr></th>
											<th><nobr>ස්ථානය</nobr></th>
											<th>දිනය</th>
											<th>නැතිවූ ආකාරය</th>	
											<th>යවන ලද දිනය</th>											
										</tr>
									</thead>
									<tbody>									
								<?php
									foreach ($con as $c):
											?>
										<tr class=<?php if ($i % 2) {
														echo "first";
														} else {
														echo "second";
														}?>>
											<td><?php echo $i; ?></td>
											<td><nobr><a href="index.php?action=file_view&id=<?php echo $c['id']; ?>"style="color:blue"><?php echo $c['fileno']; ?></a></nobr></td>
											<td><nobr><?php echo $c['assetunit']; ?></nobr></td>
											<td><nobr><?php echo $c['place']; ?></nobr></td>
											<td><nobr><?php echo $c['date']; ?></nobr></td>
											<td><nobr><?php echo $c['description']; ?></nobr></td>
											<td><nobr><?php echo $c['sdate']; ?></nobr></td>
										</tr>
										<?php
										$i++;
										endforeach;
										?>
										</tbody>
										</table>
										<?php
										$j++;
									endforeach; ?>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>