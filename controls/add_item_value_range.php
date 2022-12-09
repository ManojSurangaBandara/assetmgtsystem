<?php include 'header5.php';?>
<script>	
$(document).ready(function () {
$(".savebttn").click(function(){
  // Holds the product ID of the clicked element
	var id = $(this).attr('id');
	var minval = $('#minval_'+id).val();
	var maxval = $('#maxval_'+id).val();
	var minlifetime = $('#minlifetime_'+id).val();
	var maxlifetime = $('#maxlifetime_'+id).val();
	var querystring = {
			id: id,
			minval: minval,
			maxval: maxval,
			minlifetime: minlifetime,
			maxlifetime: maxlifetime,
			action: 'add_min_max'
		}
		$.get('index.php', querystring, processResponse);
	 function processResponse(result) {
		 //alert(result);
		}
	return false
});
}); 
</script>
<div id="page">

    <div class="section table_section">
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="add_item_value_range"/>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <b>Inquiry Type:</b>
                    </td>
                    <td>

                        <select name="searchby">
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
							<option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
							<option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
							<option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Make" <?php if ($searchby == "Make") echo "selected = 'selected'"; ?>>Make</option>
                            <option value="Model" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Model</option>
                            <option value="New Classification of Asset" <?php if ($searchby == "New Classification of asset") echo "selected = 'selected'"; ?>>New Classification of Asset</option>
                            <option value="Present Asset No" <?php if ($searchby == "Present Asst No") echo "selected = 'selected'"; ?>>Present Asset No</option>
                        </select>

                    </td>
                    <td>
                        <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                    </td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>

                    <td>  

                        
                    </td> 
                    <td>  

                        
                    </td> 

                </tr>
            </table>
        </form>
        <div class="title_wrapper">
            <h2>Fixed Assets Details List</h2>
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
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
											<tr>
                                            <th><nobr>S/N</nobr></th>
                                            <th><nobr>Main Category</nobr></th>
                                            <th><nobr>Item Category</nobr></th>
                                            <th><nobr>Description</nobr></th>                                           
                                            <th><nobr>Catalogue No</nobr></th>
											<th><nobr>Min Value</nobr></th>
											<th><nobr>Max Value</nobr></th>
											<th><nobr>Min Life Time</nobr></th>
											<th><nobr>Max Life Time</nobr></th>
											<th><nobr>Save</nobr></th>
											</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['mainCategory']; ?></nobr></td>
                                                                <td><nobr><?php echo substr($exp['itemCategory'],0,25); ?></nobr></td>
                                                                <td><nobr><?php echo substr($exp['itemDescription'],0,45); ?></nobr></td>
																<td><nobr><?php echo $exp['catalogueno']; ?></nobr></td>
																<form name="add_form" id="add_form" class="add_form" action="." method="post">
																	<td style="text-align: right;"><nobr><input type="text" name="minval_<?php echo $exp['id']; ?>" id="minval_<?php echo $exp['id']; ?>" style="text-align: right;" value="<?php echo $exp['minval']; ?>" size="6" onClick="this.select();"></nobr></td>
																	<td style="text-align: right;"><nobr><input type="text" name="maxval_<?php echo $exp['id']; ?>" id="maxval_<?php echo $exp['id']; ?>" style="text-align: right;"value="<?php echo $exp['maxval']; ?>" size="6" onClick="this.select();"></nobr></td>
																	<td style="text-align: right;"><nobr><input type="text" name="minlifetime_<?php echo $exp['id']; ?>" id="minlifetime_<?php echo $exp['id']; ?>" style="text-align: right;" value="<?php echo $exp['minlifetime']; ?>" size="6" onClick="this.select();"></nobr></td>
																	<td style="text-align: right;"><nobr><input type="text" name="maxlifetime_<?php echo $exp['id']; ?>" id="maxlifetime_<?php echo $exp['id']; ?>" style="text-align: right;"value="<?php echo $exp['maxlifetime']; ?>" size="6" onClick="this.select();"></nobr></td>
																	<td><input class = "savebttn" id = "<?php echo $exp['id']; ?>" name="submit" type="submit" value="Save"/>
																</form>
                                                            </tr>
                                                            <?php $i++; ?>
                                                        <?php } ?> 
                                                        </tbody></table>
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

                                                        </div>
                                                        <?php
//include('sidebar.php');
                                                        include '../view/footer.php';
                                                        ?>