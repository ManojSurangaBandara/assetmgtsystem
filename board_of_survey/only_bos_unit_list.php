<?php include 'header1.php';?> 
<div id="page">

        <div class="section">
            <div class="title_wrapper">
                <h2>
                    Change Unit Details
                </h2>
                <span class="title_wrapper_left"></span>
                <span class="title_wrapper_right"></span>
            </div>
			<div id="Itmdiv">
		<div class="table_wrapper">
			<div class="table_wrapper_inner">
							<table id="buyerTable" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">                            
							<thead><tr>
					<th>S No.</th>
					<th>Center</th>
					<th>Unit</th>
					<th>Unit ID</th>
					<th>protocoltext1</th>
					<th>protocoltext2</th>
					<th>P/L 1</th>
					<th>P/L 2</th>
					<th>P/L 3</th>
					<th>P/L 4</th>
					<th>P/L 5</th>
                                    </tr>
								</thead>
				<tbody>
				<?php $i = 1; ?>
				<?php foreach($exps as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><?php echo $exp['centreName']; ?></td>
					<td style="font-family: courier;font-size:14px;"><?php echo $exp['unitName']; ?></td>
					<td style="font-family: courier;font-size:14px;"><?php echo $exp['centreID']; ?></td>
					<td><?php echo $exp['protocoltext1']; ?></td>
					<td><?php echo $exp['protocoltext2']; ?></td>
					<td><?php echo $exp['protocollevel1']; ?></td>
					<td><?php echo $exp['protocollevel2']; ?></td>
					<td><?php echo $exp['protocollevel3']; ?></td>
					<td><?php echo $exp['protocollevel4']; ?></td>	
					<td><?php echo $exp['protocollevel5']; ?></td>						
				</tr>
				<?php $i++; ?>
				<?php }  ?>
			  </tbody>
			  </table>
			  </div>
			  </div>
		</div>
        </div>


</div>

<?php
//include('sidebar.php');
include '../view/footer.php';
?>










