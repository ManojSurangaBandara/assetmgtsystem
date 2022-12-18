<?php include 'header1.php'; ?>
    <script>
        $(function () {
            var $chk = $("#grpChkBox input:checkbox"); 
            var $tbl = $("#someTable");
            var $tblhead = $("#someTable th");

            //$chk.prop('checked', true); 
			for (i = 1; i < 24; i++) { 
				hideColumn(i);
			}
            $chk.click(function () {
                var colToHide = $tblhead.filter("." + $(this).attr("name"));
                var index = $(colToHide).index();
                $tbl.find('tr :nth-child(' + (index + 1) + ')').toggle();
            });
			
			function hideColumn(columnIndex) {
				$tbl.find('tr :nth-child(' + (columnIndex + 1) + ')').hide();
			}
			//not use
			$("#update1").click(
				function(e) {
				//var brand=$('#brand').val();
				var assetscenter=$('#assetscenter').val();
				var assetunit=$('#assetunit').val();
				var searchby=$('#searchby').val();
				var search=$('#search').val();
				var inputField1=$('#inputField1').val();
				var inputField2=$('#inputField2').val();
				var querystring = {
					assetscenter: assetscenter,
					assetunit: assetunit,
					searchby: searchby,
					search: search,
					inputField1: inputField1,
					inputField2: inputField2,
					action: 'List_Inquiry_Data_Ajax'
				}
				$.get('index.php', querystring, processResponse);
				function processResponse(result) {
					var item = $.parseJSON(result);
					//$('$someTable tbody > tr').remove();
					$('#someTable tbody').remove();
					$.each(item, function(key, value) {
						i = parseInt(key) + 1;
						$tbl.append("<tr><td>"+i+"</td><td>"+
						value.assetscenter+"</td><td>"+
						value.assetunit+"</td><td>"+
						value.district+"</td><td>"+
						value.dsDivision+"</td><td>"+
						value.gsDivision+"</td><td>"+
						value.category+"</td><td>"+
						value.category+"-"+value.classificationno+"</td><td>"+
						value.natureOwnership+"</td><td>"+
						value.ownership+"</td><td>"+
						value.register+"</td><td>"+
						value.landname+"</td><td>"+
						value.planno+"</td><td>"+
						value.deedno+"</td><td>"+
						value.deeddate+"</td><td>"+
						value.landNature+"</td><td>"+
						value.areaMeasure+"</td><td>"+
						value.area+"</td><td>"+
						value.estimatedValue+"</td><td>"+
						value.previousownership+"</td><td>"+
						value.acquisitiondate+"</td><td>"+
						value.remarks+"</td><td>"+
						value.identificationno+"</td></tr>");
					});
					
					} // end processData
					for (i = 1; i < 24; i++) { 
						hideColumn(i);
					}
				e.preventDefault();
				});
				//not use end

    $("#selecctall").change(function(){
      $(".checkbox1").prop('checked', $(this).prop("checked"));
      });      


	   });
    </script>
<div id="page">

    <div class="section table_section">
        <div class="title_wrapper">
            <h2><?php echo $subMenu[0][$lang]?></h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>

	<hr/>
	 <form action="." method="post" id="add_form">
            <input type="hidden" name="action" value="List_columnlist"/>
            <table border="0">
                <tr>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td>
                        <b><?php echo $tList[0][$lang]?></b>
                    </td>
                    <td>
                        <select name="assetscenter" id="assetscenter" onChange="getAssetsUnitByCenter('index.php?action=findAssetsUnitsByCenter&center=' + this.value)">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
                    </td>
                
                    <td>
                    </td>
                    <td  align="right">
                        <b><?php echo $tList[1][$lang]?></b>
                    </td>
                    <td>   
                        <div id="Unitdiv">
                            <select name="assetunit" id="assetunit" onChange="getPresentUnitByUnit('index.php?action=findPresentUnitByUnit&unit=' + this.value)">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                    </td>
                    <td>
                        <b><?php echo $inqtype[$lang]?></b> </td>
                    <td>
                        <select name="searchby" id="searchby" onChange="getrequestitem('index.php?action=findSearchType&searchby=' + this.value)">
                            <option value="Area" <?php if ($searchby == "Area") echo "selected = 'selected'"; ?>>Area</option>
							<option value="Assets No" <?php if ($searchby == "Assets No") echo "selected = 'selected'"; ?>>Assets No</option>
							<option value="Classification No" <?php if ($searchby == "Classification No") echo "selected = 'selected'"; ?>>Classification No</option>
							<option value="Date of Acquisition" <?php if ($searchby == "Date of Acquisition") echo "selected = 'selected'"; ?>>Date of Acquisition</option>
							<option value="District" <?php if ($searchby == "District") echo "selected = 'selected'"; ?>>District</option>
							<option value="DS Division" <?php if ($searchby == "DS Division") echo "selected = 'selected'"; ?>>DS Division</option>
							<option value="GS Division" <?php if ($searchby == "GS Division") echo "selected = 'selected'"; ?>>GS Division</option>
							<option value="Identification Number"  <?php if ($searchby == "Identification Number") echo "selected = 'selected'"; ?>>Identification Number</option>
                            <option value="Land Category" <?php if ($searchby == "Land Category") echo "selected = 'selected'"; ?>>Land Category</option>
							<option value="Land Name" <?php if ($searchby == "Land Name") echo "selected = 'selected'"; ?>>Land Name</option>
							<option value="Nature of Land" <?php if ($searchby == "Nature of Land") echo "selected = 'selected'"; ?>>Nature of Land</option>
							<option value="Plan Number" <?php if ($searchby == "Plan Number") echo "selected = 'selected'"; ?>>Plan Number</option>
							<option value="Province"  <?php if ($searchby == "Province") echo "selected = 'selected'"; ?>>Province</option>
							<option value="Register Number" <?php if ($searchby == "Register Number") echo "selected = 'selected'"; ?>>Register Number</option>
                            <option value="Remarks" <?php if ($searchby == "Remarks") echo "selected = 'selected'"; ?>>Remarks</option>
                            <option value="Title Deed Date" <?php if ($searchby == "Title Deed Date") echo "selected = 'selected'"; ?>>Title Deed Date</option>
                            <option value="Title Deed Number" <?php if ($searchby == "Title Deed Number") echo "selected = 'selected'"; ?>>Title Deed Number</option>
                         </select>
                    </td>
                    <td>
                        <div id="Itmdiv">
                            <datalist id="searchs" value="<?php echo $search; ?>">
                                <option value=""></option>
                                <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
                            </datalist>
                            <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                        </div>
                    </td>
                    <td align="right"><b><?php echo $tList[20][$lang]?></b></td> <td> <b>From :</b>
                        <input type='text' class="text" name="inputField1" id="inputField1" value="<?php echo $inputField1; ?>" id="inputField1" style="width:90px;"/>

                        <b>To :</b>
                        <input type='text' class="text" name="inputField2" id="inputField2" value="<?php echo $inputField2; ?>" id="inputField2" style="width:90px;"/></td>
                    </td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td>  
                        <input type="submit" id="update" value="Search" /> 
                    </td>
                    <td>
                        
                    </td> 
                </tr>
            </table>
        </form>
		<hr/>
			<div id="grpChkBox">
		    <table>
        <tbody>
            <tr>
                <td><input class="checkbox1" type="checkbox" name="0" /><?php echo $tList[0][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="1" /><?php echo $tList[1][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="2" /><?php echo $tList[2][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="3" /><?php echo $tList[3][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="4" /><?php echo $tList[4][$lang]?></td>
				<td><input class="checkbox1" type="checkbox" name="5" /><?php echo $tList[5][$lang]?></td>
            </tr>
            <tr>
                <td><input class="checkbox1" type="checkbox" name="6" /><?php echo $tList[6][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="7" /><?php echo $tList[7][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="8" /><?php echo $tList[8][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="9" /><?php echo $tList[9][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="10" /><?php echo $tList[10][$lang]?></td>
				<td><input class="checkbox1" type="checkbox" name="11" /><?php echo $tList[11][$lang]?></td>
            </tr>
            <tr>
                <td><input class="checkbox1" type="checkbox" name="12" /><?php echo $tList[12][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="13" /><?php echo $tList[13][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="14" /><?php echo $tList[14][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="15" /><?php echo $tList[15][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="16" /><?php echo $tList[16][$lang]?></td>
				<td><input class="checkbox1" type="checkbox" name="17" /><?php echo $tList[17][$lang]?></td>
            </tr>
			<tr>
                <td><input class="checkbox1" type="checkbox" name="18" /><?php echo $tList[18][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="19" /><?php echo $tList[19][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="20" /><?php echo $tList[20][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="21" /><?php echo $tList[21][$lang]?></td>
                <td><input class="checkbox1" type="checkbox" name="22" /><?php echo $tList[22][$lang]?></td>
            </tr>
			
        </tbody>
    </table>
	<div>&nbsp;</div>
    </div>
		
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                        <div class="table_wrapper_inner">
                                            <table id="someTable" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
                                                        <thead>
															<tr>
																<th>S/N</th>
																<th class="0"><?php echo $tList[0][$lang]?></th>
																<th class="1"><?php echo $tList[1][$lang]?></th>
																<th class="2"><?php echo $tList[2][$lang]?></th>
																<th class="3"><?php echo $tList[3][$lang]?></th>
																<th class="4"><?php echo $tList[4][$lang]?></th>
																<th class="5"><?php echo $tList[5][$lang]?></th>
																<th class="6"><?php echo $tList[6][$lang]?></th>
																<th class="7"><?php echo $tList[7][$lang]?></th>
																<th class="8"><?php echo $tList[8][$lang]?></th>
																<th class="9"><?php echo $tList[9][$lang]?></th>
																<th class="10"><?php echo $tList[10][$lang]?></th>
																<th class="11"><?php echo $tList[11][$lang]?></th>
																<th class="12"><?php echo $tList[12][$lang]?></th>
																<th class="13"><?php echo $tList[13][$lang]?></th>
																<th class="14"><?php echo $tList[14][$lang]?></th>
																<th class="15"><?php echo $tList[15][$lang]?></th>
																<th class="16"><?php echo $tList[16][$lang]?></th>
																<th class="17"><?php echo $tList[17][$lang]."-Hec"?></th>
																<th class="18"><?php echo $tList[18][$lang]?></th>
																<th class="19"><?php echo $tList[19][$lang]?></th>
																<th class="20"><?php echo $tList[20][$lang]?></th>
																<th class="21"><?php echo $tList[21][$lang]?></th>
																<th class="22"><?php echo $tList[22][$lang]?></th>
															</tr>
														</thead>
														 <tbody>
												
												
												
												
												<tbody> 
                                                <?php $i = 1; ?>
                                                <?php foreach ($items as $exp) { ?>																
                                                    <tr class=<?php
                                                    if ($i % 2) {
                                                        echo "first";
                                                    } else {
                                                        echo "second";
                                                    }
                                                    ?>>
                                                        <td><?php echo $i; ?></td>                                                        
                                                        <td><?php echo $exp['assetscenter']; ?></td>
                                                        <td><?php echo $exp['assetunit']; ?></td>
                                                        <td><?php echo $exp['province']; ?></td>
                                                        <td><?php echo $exp['district']; ?></td>
                                                        <td><?php echo $exp['dsDivision']; ?></td>
                                                        <td><?php echo $exp['gsDivision']; ?></td>
                                                        <td><?php echo $exp['category']; ?></td>
                                                        <td><?php echo $exp['assetsno']."-".$exp['classificationno']; ?></td>                                                      
                                                        <td><?php echo $exp['natureOwnership']; ?></td>
                                                        <td><?php echo $exp['ownership']; ?></td>
                                                        <td><?php echo $exp['register']; ?></td>
                                                        <td><?php echo $exp['landname']; ?></td>
                                                        <td><?php echo $exp['planno']; ?></td>
                                                        <td><?php echo $exp['deedno']; ?></td>
                                                        <td><?php echo $exp['deeddate']; ?></td>
														<td><?php echo $exp['landNature']; ?></td>
                                                        <td><?php echo $exp['areaMeasure']; ?></td>
                                                        <td align="right"><?php echo number_format((float)$exp['area'], 2, '.', ','); ?></td>
                                                        <td align="right"><?php echo number_format((float)$exp['estimatedValue'], 2, '.', ','); ?></td>
                                                        <td><?php echo $exp['previousownership']; ?></td>
                                                        <td><?php echo $exp['acquisitiondate']; ?></td>
                                                        <td><?php echo $exp['remarks']; ?></td>
														<td><?php echo $exp['identificationno']; ?></td>
                                                    </tr>
                                                    <?php $i++; ?>
                                                <?php } ?> 
                                                </tbody></table>
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
<?php
include '../view/footer.php';
?>