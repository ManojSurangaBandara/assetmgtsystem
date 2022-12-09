<?php
include '../view/header5.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
<script>	
$(document).ready(function () {
			$('table').tablesorter({
			widgets        : ['stickyHeaders'],
			usNumberFormat : false,
			sortReset      : true,
			sortRestart    : true
		});	
}); 
</script>
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>අවසන් වූ ලිපි ගොණු</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:14px;">
                                            <thead>
												<tr>
													<th><div class="verticalText">S No.</div></th>
													<th><nobr><h4>ලිපිගොනු අංකය</h4></nobr></th>
													<th><nobr>ඒකකය</nobr></th>
													<th><nobr>ස්ථානය</nobr></th>
													<th>දිනය</th>
													<th>නැතිවූ ආකාරය</th>
													<th>මු.රෙ. 104(4) සඳහා අනුමැතිය ලද දිනය</th>
													<th>මු.රෙ. 109 සඳහා අනුමැතිය ලද දිනය</th>
													<th>කපාහැරීමේ අනුමැතිය ලද දිනය</th>
													<th>කපාහරින ලද දිනය</th>
													<th>කපාහරින ලද වටිනාකම</th>													
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
					<td><nobr><a href="index.php?action=closed_file_view&id=<?php echo $exp['id']; ?>"style="color:blue"><?php echo $exp['fileno']; ?></a></nobr></td>
					<td><nobr><?php echo $exp['assetunit']; ?></nobr></td>
					<td><nobr><?php echo $exp['place']; ?></nobr></td>
					<td><nobr><?php echo $exp['date']; ?></nobr></td>
					<td><nobr><?php echo $exp['description']; ?></nobr></td>
					<td><nobr><?php echo $exp['_1043_defminrecdate']; ?></nobr></td>
					<td><nobr><?php echo $exp['_1044_defminrecdate']; ?></nobr></td>
					<td><nobr><?php echo $exp['_109_defminrecdate']; ?></nobr></td>
					<td><nobr><?php echo $exp['removeddate']; ?></nobr></td>
					<td><nobr><?php echo $exp['removedvalue']; ?></nobr></td>
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
                                                            </div>

                                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                            </div>
                                                            </div>

    </div>
                                                            </div>

                                                            <?php
//include('sidebar.php');
                                                            include '../view/footer.php';
                                                            ?>