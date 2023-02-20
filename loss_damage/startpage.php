<?php	
	include '../view/header1.php';
?>
<div id="sec_menu">
	<?php include("sub_menu.tpl");?>
</div>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<div id="page">
<div class="inner">
	<div class="section">
		<div class="section_content">
			<div class="sct">
				<div class="sct_left">
					<div class="sct_right">
						<div class="sct_left">
								<br>
								<table class="table table-hover">
									<thead>
										<tr class="alert alert-warning alert-dismissible">			
											<th><font size="4">File Status<font></th>         
											<th align="center"><font size="4">මු.රෙ. 104(3)  ගොණු<font></th>
											<th align="center"><font size="4">මු.රෙ. 104(4)  ගොණු<font></th>
											<th align="center"><font size="4">මු.රෙ. 109  ගොණු<font></th>
											<th align="center"><font size="4">එකතුව<font></th>
											<th align="center"><font size="4"><font></th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 0;
										$_1043_total = 0;
										$_1044_total = 0;
										$_109_total = 0;
										foreach ($content as $c):
											?>
										<tr>
											<td><font size="4"><?php echo $c['text']; ?><font></td>
											<td align="center"><font size="4"><nobr><?php echo $c['_1043']; ?></nobr><font></td>
											<td align="center"><font size="4"><nobr><?php echo $c['_1044']; ?></nobr><font></td>
											<td align="center"><font size="4"><nobr><?php echo $c['_109']; ?></nobr><font></td>
											<td align="center"><font size="4"><nobr><?php echo $c['_1043'] + $c['_1044'] + $c['_109']; ?></nobr><font></td>
											<td>
											<form action="index.php" method="post" name="edata<?php echo $i; ?>" id="edata<?php echo $i; ?>">
											<div class="input-group">  											
												<input name="i" type="hidden" id="i" value="<?php echo $i; ?>" />
												<input name="action" type="hidden" id="action" value="status_report" />
												<button type="submit" class="btn btn-success btn-xs" >Details</button>
											</div>
											</form>
											</td>
										</tr><font>
										<?php
										$_1043_total = $_1043_total + $c['_1043'];
										$_1044_total = $_1044_total + $c['_1044'];
										$_109_total = $_109_total + $c['_109'];
										$i++;
									endforeach;
									?>
									<tr>
									<td><font size="4">එකතුව :</td>
									<td align="center"><font size="4"><nobr><?php echo $_1043_total; ?></nobr><font></td>
									<td align="center"><font size="4"><nobr><?php echo $_1044_total; ?></nobr><font></td>
									<td align="center"><font size="4"><nobr><?php echo $_109_total; ?></nobr><font></td>
									<td align="center"><font size="4"><nobr><?php echo $_1043_total + $_1044_total + $_109_total; ?></nobr><font></td>
									<td>
											
											</td>				
									</tr>     
									</tbody>
								</table>							
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