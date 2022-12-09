<!DOCTYPE html>
<?php
require_once('../model/database.php');
require('../model/errorcode_db.php');
$exps = errorcodeDB::getFullDetails();
?>
<html>
<head>
<title>HTML Tables</title>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
</head>
<body>
<div class="title_wrapper">
	<h2>
		Error Codes
	</h2>
	<span class="title_wrapper_left"></span>
	<span class="title_wrapper_right"></span>
</div>
<fieldset>
	<div class="table_wrapper">
		<div class="table_wrapper_inner">
		<table cellpadding="0" id="thetable" cellspacing="0" width="100%">
			<tr>
				<th>S/No</th>
				<th>Code</th>
				<th>Title</th>
				<th>Details</th>
			</tr>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['code']; ?></td>
					<td><?php echo $exp['title']; ?></td>
					<td><?php echo $exp['details']; ?></td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			</table>
		</div>
	</div>
	</fieldset>
</body>
</html>





