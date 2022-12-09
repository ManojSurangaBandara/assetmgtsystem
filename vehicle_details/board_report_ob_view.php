<?php	
	include 'header1.php';
?>
<style>
 table.thetable > td {font-size: 16px;}
</style>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="title_wrapper">
			<h2>Board Report Observation View - <?php echo $currentYear ?></h2>
			<span class="title_wrapper_left"></span>
			<span class="title_wrapper_right"></span>
		</div>
	</div>
	<div class="table_wrapper">
		<div class="table_wrapper_inner">
		<table cellpadding="0" id="thetable" cellspacing="0" width="100%">
			<tr>
				<th>S/No</th>
				<th>Title</th>
				<th>Details</th>
			</tr>
			<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>	
			<tr >
				<td><?php echo $i; ?></td>
				<td><?php echo $exp['subject']; ?></td>
				<td><?php echo $exp['details']; ?></td>
			</tr>
			<?php $i++; ?>
			<?php }  ?>
			</table>
		</div>
	</div>
  </div>
</div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>