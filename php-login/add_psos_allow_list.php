<?php
include '../view/header2.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>
<div id="page">
<style>
	th
	{
		text-align: center;
		vertical-align: bottom;
		height: 150px;
		padding-bottom: 3px;
		padding-left: 5px;
		padding-right: 5px;
	}

	.verticalText
	{
		text-align: center;
		vertical-align: middle;
		width: 5px;
		margin: 0px;
		padding: 0px;
		padding-left: 3px;
		padding-right: 3px;
		padding-top: 10px;
		white-space: nowrap;
		-webkit-transform: rotate(-90deg); 
		-moz-transform: rotate(-90deg);                 
	};
</style>
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
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var DGGS 		 = ($('#DGGS_'+id).prop('checked')) ? 1 : 0;
	var DOPS 		 = ($('#DOPS_'+id).prop('checked')) ? 1 : 0;
	var DTRG         = ($('#DTRG_'+id).prop('checked')) ? 1 : 0;
	var DPLAN        = ($('#DPLAN_'+id).prop('checked')) ? 1 : 0;
	var DIT          = ($('#DIT_'+id).prop('checked')) ? 1 : 0;
	var CFE          = ($('#CFE_'+id).prop('checked')) ? 1 : 0;
	var CSO          = ($('#CSO_'+id).prop('checked')) ? 1 : 0;
	var DGSPORTS     = ($('#DGSPORTS_'+id).prop('checked')) ? 1 : 0;
	var DSPORTS      = ($('#DSPORTS_'+id).prop('checked')) ? 1 : 0;
	var AG           = ($('#AG_'+id).prop('checked')) ? 1 : 0; 
	var DGAHS        = ($('#DGAHS_'+id).prop('checked')) ? 1 : 0;
	var DAMS         = ($('#DAMS_'+id).prop('checked')) ? 1 : 0;
	var DADS         = ($('#DADS_'+id).prop('checked')) ? 1 : 0;
	var DAMPS        = ($('#DAMPS_'+id).prop('checked')) ? 1 : 0;
	var DAMM         = ($('#DAMM_'+id).prop('checked')) ? 1 : 0;
	var QMG          = ($('#QMG_'+id).prop('checked')) ? 1 : 0;
	var DAQ          = ($('#DAQ_'+id).prop('checked')) ? 1 : 0;
	var DST          = ($('#DST_'+id).prop('checked')) ? 1 : 0;
	var DES          = ($('#DES_'+id).prop('checked')) ? 1 : 0;
	var MGO          = ($('#MGO_'+id).prop('checked')) ? 1 : 0;
	var DOS          = ($('#DOS_'+id).prop('checked')) ? 1 : 0;
	var DEME         = ($('#DEME_'+id).prop('checked')) ? 1 : 0;
	var DGINF        = ($('#DGINF_'+id).prop('checked')) ? 1 : 0;

	var querystring = {
			id: id,
			DGGS: DGGS, 				
			DOPS: DOPS, 		
			DTRG: DTRG,      
			DPLAN: DPLAN,     
			DIT: DIT,       
			CFE: CFE,       
			CSO: CSO,       
			DGSPORTS: DGSPORTS,  
			DSPORTS: DSPORTS,   
			AG: AG,        
			DGAHS: DGAHS,     
			DAMS: DAMS,      
			DADS: DADS,
			DAMPS: DAMPS,
			DAMM: DAMM,      
			QMG: QMG,       
			DAQ: DAQ,       
			DST: DST,       
			DES: DES,       
			MGO: MGO,       
			DOS: DOS,       
			DEME: DEME,      
			DGINF: DGINF,     
			action: 'Add_psos_save'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 
	return false
});
$(".savebttnland").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var DGGS 		 = ($('#lDGGS_'+id).prop('checked')) ? 1 : 0;
	var DOPS 		 = ($('#lDOPS_'+id).prop('checked')) ? 1 : 0;
	var DTRG         = ($('#lDTRG_'+id).prop('checked')) ? 1 : 0;
	var DPLAN        = ($('#lDPLAN_'+id).prop('checked')) ? 1 : 0;
	var DIT          = ($('#lDIT_'+id).prop('checked')) ? 1 : 0;
	var CFE          = ($('#lCFE_'+id).prop('checked')) ? 1 : 0;
	var CSO          = ($('#lCSO_'+id).prop('checked')) ? 1 : 0;
	var DGSPORTS     = ($('#lDGSPORTS_'+id).prop('checked')) ? 1 : 0;
	var DSPORTS      = ($('#lDSPORTS_'+id).prop('checked')) ? 1 : 0;
	var AG           = ($('#lAG_'+id).prop('checked')) ? 1 : 0; 
	var DGAHS        = ($('#lDGAHS_'+id).prop('checked')) ? 1 : 0;
	var DAMS         = ($('#lDAMS_'+id).prop('checked')) ? 1 : 0;
	var DADS         = ($('#lDADS_'+id).prop('checked')) ? 1 : 0;
	var DAMPS        = ($('#lDAMPS_'+id).prop('checked')) ? 1 : 0;
	var DAMM         = ($('#lDAMM_'+id).prop('checked')) ? 1 : 0;
	var QMG          = ($('#lQMG_'+id).prop('checked')) ? 1 : 0;
	var DAQ          = ($('#lDAQ_'+id).prop('checked')) ? 1 : 0;
	var DST          = ($('#lDST_'+id).prop('checked')) ? 1 : 0;
	var DES          = ($('#lDES_'+id).prop('checked')) ? 1 : 0;
	var MGO          = ($('#lMGO_'+id).prop('checked')) ? 1 : 0;
	var DOS          = ($('#lDOS_'+id).prop('checked')) ? 1 : 0;
	var DEME         = ($('#lDEME_'+id).prop('checked')) ? 1 : 0;
	var DGINF        = ($('#lDGINF_'+id).prop('checked')) ? 1 : 0;

	var querystring = {
			id: id,
			DGGS: DGGS, 				
			DOPS: DOPS, 		
			DTRG: DTRG,      
			DPLAN: DPLAN,     
			DIT: DIT,       
			CFE: CFE,       
			CSO: CSO,       
			DGSPORTS: DGSPORTS,  
			DSPORTS: DSPORTS,   
			AG: AG,        
			DGAHS: DGAHS,     
			DAMS: DAMS,      
			DADS: DADS,   
			DAMPS: DAMPS,  			
			DAMM: DAMM,      
			QMG: QMG,       
			DAQ: DAQ,       
			DST: DST,       
			DES: DES,       
			MGO: MGO,       
			DOS: DOS,       
			DEME: DEME,      
			DGINF: DGINF,     
			action: 'Add_psos_save_land'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 
	return false
});

$(".savebttnbuilding").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var DGGS 		 = ($('#bDGGS_'+id).prop('checked')) ? 1 : 0;
	var DOPS 		 = ($('#bDOPS_'+id).prop('checked')) ? 1 : 0;
	var DTRG         = ($('#bDTRG_'+id).prop('checked')) ? 1 : 0;
	var DPLAN        = ($('#bDPLAN_'+id).prop('checked')) ? 1 : 0;
	var DIT          = ($('#bDIT_'+id).prop('checked')) ? 1 : 0;
	var CFE          = ($('#bCFE_'+id).prop('checked')) ? 1 : 0;
	var CSO          = ($('#bCSO_'+id).prop('checked')) ? 1 : 0;
	var DGSPORTS     = ($('#bDGSPORTS_'+id).prop('checked')) ? 1 : 0;
	var DSPORTS      = ($('#bDSPORTS_'+id).prop('checked')) ? 1 : 0;
	var AG           = ($('#bAG_'+id).prop('checked')) ? 1 : 0; 
	var DGAHS        = ($('#bDGAHS_'+id).prop('checked')) ? 1 : 0;
	var DAMS         = ($('#bDAMS_'+id).prop('checked')) ? 1 : 0;
	var DADS         = ($('#bDADS_'+id).prop('checked')) ? 1 : 0;
	var DAMPS        = ($('#bDAMPS_'+id).prop('checked')) ? 1 : 0;
	var DAMM         = ($('#bDAMM_'+id).prop('checked')) ? 1 : 0;
	var QMG          = ($('#bQMG_'+id).prop('checked')) ? 1 : 0;
	var DAQ          = ($('#bDAQ_'+id).prop('checked')) ? 1 : 0;
	var DST          = ($('#bDST_'+id).prop('checked')) ? 1 : 0;
	var DES          = ($('#bDES_'+id).prop('checked')) ? 1 : 0;
	var MGO          = ($('#bMGO_'+id).prop('checked')) ? 1 : 0;
	var DOS          = ($('#bDOS_'+id).prop('checked')) ? 1 : 0;
	var DEME         = ($('#bDEME_'+id).prop('checked')) ? 1 : 0;
	var DGINF        = ($('#bDGINF_'+id).prop('checked')) ? 1 : 0;

	var querystring = {
			id: id,
			DGGS: DGGS, 				
			DOPS: DOPS, 		
			DTRG: DTRG,      
			DPLAN: DPLAN,     
			DIT: DIT,       
			CFE: CFE,       
			CSO: CSO,       
			DGSPORTS: DGSPORTS,  
			DSPORTS: DSPORTS,   
			AG: AG,        
			DGAHS: DGAHS,     
			DAMS: DAMS,      
			DADS: DADS,  
			DAMPS: DAMPS,			
			DAMM: DAMM,      
			QMG: QMG,       
			DAQ: DAQ,       
			DST: DST,       
			DES: DES,       
			MGO: MGO,       
			DOS: DOS,       
			DEME: DEME,      
			DGINF: DGINF,     
			action: 'Add_psos_save_building'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		//alert(result);
		} 
	return false
});

$("#copy_btn").click( function() {
	  var querystring = {     
			action: 'copy_pso_details'
		     }      
		$.get('index.php', querystring, processResponse);
		function processResponse(result) {
		//alert(result);
		} 
	return false		
     });
}); 
</script>
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>PSO Allow List (Plant & Macheniry / Office Equipments, Vehicle Details)</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>
                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
												<tr>
													<th><div class="verticalText">S No.</div></th>
													<th><nobr><div class="verticalText">Main Category</div></nobr></th>
													<th><nobr><div class="verticalText">Item Category</div></nobr></th>
													<th><div class="verticalText">DGGS</div></th>
													<th><div class="verticalText">DOPS</div></th>
													<th><div class="verticalText">DTRG</div></th>
													<th><div class="verticalText">DPLAN</div></th>
													<th><div class="verticalText">DIT</div></th>
													<th><div class="verticalText">CFE</div></th>
													<th><div class="verticalText">CSO</div></th>
													<th><div class="verticalText">DGSPORTS</div></th>
													<th><div class="verticalText">DSPORTS</div></th>
													<th><div class="verticalText">AG</div></th>
													<th><div class="verticalText">DGAHS</div></th>
													<th><div class="verticalText">DAMS</div></th>
													<th><div class="verticalText">DADS</div></th>
													<th><div class="verticalText">DAMPS</div></th>
													<th><div class="verticalText">DAMM</div></th>
													<th><div class="verticalText">QMG</div></th>
													<th><div class="verticalText">DAQ</div></th>
													<th><div class="verticalText">DST</div></th>
													<th><div class="verticalText">DES</div></th>
													<th><div class="verticalText">MGO</div></th>
													<th><div class="verticalText">DOS</div></th>
													<th><div class="verticalText">DEME</div></th>
													<th><div class="verticalText">DGINF</div></th>
													<th><div class="verticalText">Save</div></th>
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
					<td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
					<td><nobr><?php echo substr($exp['itemCategory'],0, 35); ?></nobr></td>
					<td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">
						<input type="checkbox" name="DGGS_<?php echo $exp['id']; ?>" id="DGGS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGGS']; ?>" <?php if($exp['DGGS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DOPS_<?php echo $exp['id']; ?>" id="DOPS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DOPS']; ?>" <?php if($exp['DOPS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DTRG_<?php echo $exp['id']; ?>" id="DTRG_<?php echo $exp['id']; ?>" value="<?php echo $exp['DTRG']; ?>" <?php if($exp['DTRG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DPLAN_<?php echo $exp['id']; ?>" id="DPLAN_<?php echo $exp['id']; ?>" value="<?php echo $exp['DPLAN']; ?>" <?php if($exp['DPLAN']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DIT_<?php echo $exp['id']; ?>" id="DIT_<?php echo $exp['id']; ?>" value="<?php echo $exp['DIT']; ?>" <?php if($exp['DIT']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="CFE_<?php echo $exp['id']; ?>" id="CFE_<?php echo $exp['id']; ?>" value="<?php echo $exp['CFE']; ?>" <?php if($exp['CFE']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="CSO_<?php echo $exp['id']; ?>" id="CSO_<?php echo $exp['id']; ?>" value="<?php echo $exp['CSO']; ?>" <?php if($exp['CSO']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGSPORTS_<?php echo $exp['id']; ?>" id="DGSPORTS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGSPORTS']; ?>" <?php if($exp['DGSPORTS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DSPORTS_<?php echo $exp['id']; ?>" id="DSPORTS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DSPORTS']; ?>" <?php if($exp['DSPORTS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="AG_<?php echo $exp['id']; ?>" id="AG_<?php echo $exp['id']; ?>" value="<?php echo $exp['AG']; ?>" <?php if($exp['AG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGAHS_<?php echo $exp['id']; ?>" id="DGAHS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGAHS']; ?>" <?php if($exp['DGAHS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMS_<?php echo $exp['id']; ?>" id="DAMS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMS']; ?>" <?php if($exp['DAMS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DADS_<?php echo $exp['id']; ?>" id="DADS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DADS']; ?>" <?php if($exp['DADS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMPS_<?php echo $exp['id']; ?>" id="DAMPS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMPS']; ?>" <?php if($exp['DAMPS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMM_<?php echo $exp['id']; ?>" id="DAMM_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMM']; ?>" <?php if($exp['DAMM']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="QMG_<?php echo $exp['id']; ?>" id="QMG_<?php echo $exp['id']; ?>" value="<?php echo $exp['QMG']; ?>" <?php if($exp['QMG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAQ_<?php echo $exp['id']; ?>" id="DAQ_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAQ']; ?>" <?php if($exp['DAQ']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DST_<?php echo $exp['id']; ?>" id="DST_<?php echo $exp['id']; ?>" value="<?php echo $exp['DST']; ?>" <?php if($exp['DST']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DES_<?php echo $exp['id']; ?>" id="DES_<?php echo $exp['id']; ?>" value="<?php echo $exp['DES']; ?>" <?php if($exp['DES']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="MGO_<?php echo $exp['id']; ?>" id="MGO_<?php echo $exp['id']; ?>" value="<?php echo $exp['MGO']; ?>" <?php if($exp['MGO']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DOS_<?php echo $exp['id']; ?>" id="DOS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DOS']; ?>" <?php if($exp['DOS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DEME_<?php echo $exp['id']; ?>" id="DEME_<?php echo $exp['id']; ?>" value="<?php echo $exp['DEME']; ?>" <?php if($exp['DEME']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGINF_<?php echo $exp['id']; ?>" id="DGINF_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGINF']; ?>" <?php if($exp['DGINF']==1) echo "checked=checked"; ?>></td>
						<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
					</form>
					</td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
				
				
			  </tbody>
											  </table>
                                                            </div>
                                                            </fieldset>


                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>

                                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                            </div>
                                                            </div>
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>PSO Allow List (Land Details)</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>
                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
												<tr>
													<th><div class="verticalText">S No.</div></th>
													<th><nobr><div class="verticalText">Main Category</div></nobr></th>
													<th><nobr><div class="verticalText">Item Category</div></nobr></th>
													<th><div class="verticalText">DGGS</div></th>
													<th><div class="verticalText">DOPS</div></th>
													<th><div class="verticalText">DTRG</div></th>
													<th><div class="verticalText">DPLAN</div></th>
													<th><div class="verticalText">DIT</div></th>
													<th><div class="verticalText">CFE</div></th>
													<th><div class="verticalText">CSO</div></th>
													<th><div class="verticalText">DGSPORTS</div></th>
													<th><div class="verticalText">DSPORTS</div></th>
													<th><div class="verticalText">AG</div></th>
													<th><div class="verticalText">DGAHS</div></th>
													<th><div class="verticalText">DAMS</div></th>
													<th><div class="verticalText">DADS</div></th>
													<th><div class="verticalText">DAMPS</div></th>
													<th><div class="verticalText">DAMM</div></th>
													<th><div class="verticalText">QMG</div></th>
													<th><div class="verticalText">DAQ</div></th>
													<th><div class="verticalText">DST</div></th>
													<th><div class="verticalText">DES</div></th>
													<th><div class="verticalText">MGO</div></th>
													<th><div class="verticalText">DOS</div></th>
													<th><div class="verticalText">DEME</div></th>
													<th><div class="verticalText">DGINF</div></th>
													<th><div class="verticalText">Save</div></th>
												</tr>
											</thead>                                                     
                                            <tbody>
				<?php $i = 1; ?>
				<?php foreach($landcategorys as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><nobr>Land Details</nobr></td>
					<td><nobr><?php echo substr($exp['categoryName'],0, 35); ?></nobr></td>
					<td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">
						<input type="checkbox" name="DGGS_<?php echo $exp['id']; ?>" id="lDGGS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGGS']; ?>" <?php if($exp['DGGS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DOPS_<?php echo $exp['id']; ?>" id="lDOPS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DOPS']; ?>" <?php if($exp['DOPS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DTRG_<?php echo $exp['id']; ?>" id="lDTRG_<?php echo $exp['id']; ?>" value="<?php echo $exp['DTRG']; ?>" <?php if($exp['DTRG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DPLAN_<?php echo $exp['id']; ?>" id="lDPLAN_<?php echo $exp['id']; ?>" value="<?php echo $exp['DPLAN']; ?>" <?php if($exp['DPLAN']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DIT_<?php echo $exp['id']; ?>" id="lDIT_<?php echo $exp['id']; ?>" value="<?php echo $exp['DIT']; ?>" <?php if($exp['DIT']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="CFE_<?php echo $exp['id']; ?>" id="lCFE_<?php echo $exp['id']; ?>" value="<?php echo $exp['CFE']; ?>" <?php if($exp['CFE']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="CSO_<?php echo $exp['id']; ?>" id="lCSO_<?php echo $exp['id']; ?>" value="<?php echo $exp['CSO']; ?>" <?php if($exp['CSO']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGSPORTS_<?php echo $exp['id']; ?>" id="lDGSPORTS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGSPORTS']; ?>" <?php if($exp['DGSPORTS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DSPORTS_<?php echo $exp['id']; ?>" id="lDSPORTS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DSPORTS']; ?>" <?php if($exp['DSPORTS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="AG_<?php echo $exp['id']; ?>" id="lAG_<?php echo $exp['id']; ?>" value="<?php echo $exp['AG']; ?>" <?php if($exp['AG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGAHS_<?php echo $exp['id']; ?>" id="lDGAHS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGAHS']; ?>" <?php if($exp['DGAHS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMS_<?php echo $exp['id']; ?>" id="lDAMS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMS']; ?>" <?php if($exp['DAMS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DADS_<?php echo $exp['id']; ?>" id="lDADS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DADS']; ?>" <?php if($exp['DADS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMPS_<?php echo $exp['id']; ?>" id="lDAMPS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMPS']; ?>" <?php if($exp['DAMPS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMM_<?php echo $exp['id']; ?>" id="lDAMM_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMM']; ?>" <?php if($exp['DAMM']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="QMG_<?php echo $exp['id']; ?>" id="lQMG_<?php echo $exp['id']; ?>" value="<?php echo $exp['QMG']; ?>" <?php if($exp['QMG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAQ_<?php echo $exp['id']; ?>" id="lDAQ_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAQ']; ?>" <?php if($exp['DAQ']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DST_<?php echo $exp['id']; ?>" id="lDST_<?php echo $exp['id']; ?>" value="<?php echo $exp['DST']; ?>" <?php if($exp['DST']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DES_<?php echo $exp['id']; ?>" id="lDES_<?php echo $exp['id']; ?>" value="<?php echo $exp['DES']; ?>" <?php if($exp['DES']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="MGO_<?php echo $exp['id']; ?>" id="lMGO_<?php echo $exp['id']; ?>" value="<?php echo $exp['MGO']; ?>" <?php if($exp['MGO']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DOS_<?php echo $exp['id']; ?>" id="lDOS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DOS']; ?>" <?php if($exp['DOS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DEME_<?php echo $exp['id']; ?>" id="lDEME_<?php echo $exp['id']; ?>" value="<?php echo $exp['DEME']; ?>" <?php if($exp['DEME']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGINF_<?php echo $exp['id']; ?>" id="lDGINF_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGINF']; ?>" <?php if($exp['DGINF']==1) echo "checked=checked"; ?>></td>
						<td><input class = "savebttnland" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
					</form>
					</td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
				
				
			  </tbody>
											  </table>
                                                            </div>
                                                            </fieldset>


                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>

                                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                            </div>
                                                            </div>


    <div class="section table_section">
        <div class="title_wrapper">
            <h2>PSO Allow List (Building Details)</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                <fieldset>
                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                            <thead>
												<tr>
													<th><div class="verticalText">S No.</div></th>
													<th><nobr><div class="verticalText">Main Category</div></nobr></th>
													<th><nobr><div class="verticalText">Item Category</div></nobr></th>
													<th><div class="verticalText">DGGS</div></th>
													<th><div class="verticalText">DOPS</div></th>
													<th><div class="verticalText">DTRG</div></th>
													<th><div class="verticalText">DPLAN</div></th>
													<th><div class="verticalText">DIT</div></th>
													<th><div class="verticalText">CFE</div></th>
													<th><div class="verticalText">CSO</div></th>
													<th><div class="verticalText">DGSPORTS</div></th>
													<th><div class="verticalText">DSPORTS</div></th>
													<th><div class="verticalText">AG</div></th>
													<th><div class="verticalText">DGAHS</div></th>
													<th><div class="verticalText">DAMS</div></th>
													<th><div class="verticalText">DADS</div></th>
													<th><div class="verticalText">DAMPS</div></th>
													<th><div class="verticalText">DAMM</div></th>
													<th><div class="verticalText">QMG</div></th>
													<th><div class="verticalText">DAQ</div></th>
													<th><div class="verticalText">DST</div></th>
													<th><div class="verticalText">DES</div></th>
													<th><div class="verticalText">MGO</div></th>
													<th><div class="verticalText">DOS</div></th>
													<th><div class="verticalText">DEME</div></th>
													<th><div class="verticalText">DGINF</div></th>
													<th><div class="verticalText">Save</div></th>
												</tr>
											</thead>                                                     
                                            <tbody>
				<?php $i = 1; ?>
				<?php foreach($buildingCategorys as $exp) { ?>																
				<tr class=<?php if ($i % 2) {
								echo "first";
								} else {
								echo "second";
								}?>>
					<td><?php echo $i; ?></td>
					<td><nobr>Building Details</nobr></td>
					<td><nobr><?php echo substr($exp['categoryName'],0, 35); ?></nobr></td>
					<td>
					<form name="add_form" id="add_form" class="add_form" action="." method="post">
						<input type="checkbox" name="DGGS_<?php echo $exp['id']; ?>" id="bDGGS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGGS']; ?>" <?php if($exp['DGGS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DOPS_<?php echo $exp['id']; ?>" id="bDOPS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DOPS']; ?>" <?php if($exp['DOPS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DTRG_<?php echo $exp['id']; ?>" id="bDTRG_<?php echo $exp['id']; ?>" value="<?php echo $exp['DTRG']; ?>" <?php if($exp['DTRG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DPLAN_<?php echo $exp['id']; ?>" id="bDPLAN_<?php echo $exp['id']; ?>" value="<?php echo $exp['DPLAN']; ?>" <?php if($exp['DPLAN']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DIT_<?php echo $exp['id']; ?>" id="bDIT_<?php echo $exp['id']; ?>" value="<?php echo $exp['DIT']; ?>" <?php if($exp['DIT']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="CFE_<?php echo $exp['id']; ?>" id="bCFE_<?php echo $exp['id']; ?>" value="<?php echo $exp['CFE']; ?>" <?php if($exp['CFE']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="CSO_<?php echo $exp['id']; ?>" id="bCSO_<?php echo $exp['id']; ?>" value="<?php echo $exp['CSO']; ?>" <?php if($exp['CSO']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGSPORTS_<?php echo $exp['id']; ?>" id="bDGSPORTS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGSPORTS']; ?>" <?php if($exp['DGSPORTS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DSPORTS_<?php echo $exp['id']; ?>" id="bDSPORTS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DSPORTS']; ?>" <?php if($exp['DSPORTS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="AG_<?php echo $exp['id']; ?>" id="bAG_<?php echo $exp['id']; ?>" value="<?php echo $exp['AG']; ?>" <?php if($exp['AG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGAHS_<?php echo $exp['id']; ?>" id="bDGAHS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGAHS']; ?>" <?php if($exp['DGAHS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMS_<?php echo $exp['id']; ?>" id="bDAMS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMS']; ?>" <?php if($exp['DAMS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DADS_<?php echo $exp['id']; ?>" id="bDADS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DADS']; ?>" <?php if($exp['DADS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMPS_<?php echo $exp['id']; ?>" id="bDAMPS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMPS']; ?>" <?php if($exp['DAMPS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAMM_<?php echo $exp['id']; ?>" id="bDAMM_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAMM']; ?>" <?php if($exp['DAMM']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="QMG_<?php echo $exp['id']; ?>" id="bQMG_<?php echo $exp['id']; ?>" value="<?php echo $exp['QMG']; ?>" <?php if($exp['QMG']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DAQ_<?php echo $exp['id']; ?>" id="bDAQ_<?php echo $exp['id']; ?>" value="<?php echo $exp['DAQ']; ?>" <?php if($exp['DAQ']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DST_<?php echo $exp['id']; ?>" id="bDST_<?php echo $exp['id']; ?>" value="<?php echo $exp['DST']; ?>" <?php if($exp['DST']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DES_<?php echo $exp['id']; ?>" id="bDES_<?php echo $exp['id']; ?>" value="<?php echo $exp['DES']; ?>" <?php if($exp['DES']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="MGO_<?php echo $exp['id']; ?>" id="bMGO_<?php echo $exp['id']; ?>" value="<?php echo $exp['MGO']; ?>" <?php if($exp['MGO']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DOS_<?php echo $exp['id']; ?>" id="bDOS_<?php echo $exp['id']; ?>" value="<?php echo $exp['DOS']; ?>" <?php if($exp['DOS']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DEME_<?php echo $exp['id']; ?>" id="bDEME_<?php echo $exp['id']; ?>" value="<?php echo $exp['DEME']; ?>" <?php if($exp['DEME']==1) echo "checked=checked"; ?>></td>
						<td><input type="checkbox" name="DGINF_<?php echo $exp['id']; ?>" id="bDGINF_<?php echo $exp['id']; ?>" value="<?php echo $exp['DGINF']; ?>" <?php if($exp['DGINF']==1) echo "checked=checked"; ?>></td>
						<td><input class = "savebttnbuilding" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
					</form>
					</td>
				</tr>
				<?php $i++; ?>
				<?php }  ?>
				
				
			  </tbody>
											  </table>
                                                            </div>
                                                            </fieldset>


                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>

                                                            <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                                                            </div>
                                                            </div>
															<div>
        <input id="copy_btn" type="button" value="Copy PSO Details to Asset Tables" style="color: white; background-color: red;"/>
    </div>
                                                            </div>

                                                            <?php
//include('sidebar.php');
                                                            include '../view/footer.php';
                                                            ?>