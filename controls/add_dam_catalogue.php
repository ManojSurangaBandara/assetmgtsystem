<?php include 'header5.php';?>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="../jquery/bootstrap-datepicker.js"></script>
		<script src="../jquery/jquery.notifyBar.js"></script>
		<link rel="stylesheet" href="../css/datepicker.css">
        <link media="screen" rel="stylesheet" type="text/css" href="../css/admin.css"  />
		<link href="../css/jquery.notifyBar.css"  rel="stylesheet" type="text/css" >
		<link href="../css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />		
		<script src="../jquery/bootstrap-dialog.js"></script>
		<script src="../jquery/bootstrap.js"></script>
<style>
#data {
		background-color: #ebfafa;
		}
</style>
<script>	
$(document).ready(function () {

$( "#saveBtn" ).click(function() {
	var itemtype = $('#itemtype').val();
	var itemcode = $('#itemcode').val();
	var description = $('#description').val();
	var AsstNo = $('#AsstNo').val();
	var qstore = $('#qstore').val();	
	var votehead = $('#votehead').val();	
	var votename = $('#votename').val();	
	
	var querystring = {
			itemtype : itemtype, 	
			itemcode : itemcode,		
			description : description,	
			AsstNo : AsstNo,	
			qstore	: qstore,
			votehead : votehead,
			votename: votename,
			action: 'dos_catalogue_save'
		}
		$.post('index.php', querystring, processResponse);
	 function processResponse(result) {
		$.notifyBar({ cssClass: "success", html: "Data has been Saved...!" });
		//alert(result);
		setMessage(Number(result));
		//$("#"+id).hide();	
		}
	return false
});
/***************************************************************************************************/

/***************************************************************************************************/
    function setMessage(err)
    {
        switch (err) {
            case 0:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Enter Data and press - Save - Button</strong></li>');
                break;
            case 1:
                $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Saved.</strong></li>');
                break;
            case 2:
                $('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Updated.</strong></li>');
                break;
            case 3:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Item Code Already Entered</strong></li>');
                break;
            case 4:
                $('#message').html('<li class="blue"><span class="ico"></span><strong class="system_title">Modify Data and Press Update Button.</strong></li>');
                break;
            case 5:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Data Error. Please Check Data !</strong></li>');
                break;
            case 6:
                $('#message').html('<li class="red"><span class="ico"></span><strong class="system_title">Error when Database Writing !</strong></li>');
                break;
			case 7:			
			$('#message').html('<li class="green"><span class="ico"></span><strong class="system_title">Data Successfully Deleted.</strong></li>');
				break;
        }
    }
});
</script>	

<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Add DOS Assets Catalogue Details</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
 
	<div class="panel panel-primary">
	<ul class="system_messages" id="message"></ul>	
	<form role="form" id="data" name="data" method="post" action="index.php" data-toggle="validator">
	<input type="hidden" name="action" value="dos_catalogue_save" />
	<div class="panel-body">
	   <div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label>Item Type</label>
					<select id="itemtype" name="itemtype" class="form-control">
						<option value="">---</option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>DOS Catalogue No</label>
					<input name="itemcode" type="text" id="itemcode" class="form-control" value=""/>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Description</label>
					<input name="description" type="text" id="description" class="form-control" value=""/>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label>Asset No.</label>
					<input name="AsstNo" type="text" id="AsstNo" class="form-control" value=""/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group"><label>Q Store</label>
					<select id="qstore" name="qstore" class="form-control">
						<option value="">---</option>
					</select>
				</div>
			</div>
			<div class="col-md-4">
				<div class="form-group"><label>Vote Head</label>
					<select id="votehead" name="votehead" class="form-control">
						<option value="">---</option>
					</select>
				</div>
            </div>
            <div class="col-md-4">
				<div class="form-group"><label>Vote Name</label>
					<select id="votename" name="votename" class="form-control">
						<option value="">---</option>
					</select>
				</div>
            </div>
            </div> 
    </div>
   <div class="panel-footer"> 
	<button type="submit" class="btn btn-primary" id="saveBtn"><span class="glyphicon glyphicon-floppy-save" aria-hidden="true"></span> Save</button>
	<button type="reset" class="btn btn-info" id="resetBtn"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span> Reset</button>
	<button class="btn btn-danger" id="deleteBtn"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete</button>
   </div>
  </form>
</div>

                               <fieldset>
                                    <div class="table_wrapper_inner">
                                        <table id="abc" class="tablesorter" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">
											<thead>
											<tr>
                                            <th><nobr>S/N</nobr></th>
											<th><nobr>Item Type</nobr></th>
                                            <th><nobr>DAM Catalogue</nobr></th>
                                            <th><nobr>DOS Catalogue</nobr></th>
                                            <th><nobr>Description</nobr></th>
                                            <th><nobr>Asset No.</nobr></th>
                                            <th><nobr>Q Store</nobr></th>
                                            <th><nobr>Vote Head</nobr></th>
											<th><nobr>Vote Name</nobr></th>
											</tr>
											</thead>
											<tbody>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($itemss as $exp) { ?>																
                                                            <tr>
                                                                <td><nobr><?php echo $i; ?></nobr></td>
																<td><nobr><?php echo $exp['itemtype']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['dam_catalogueno']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['itemcode']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['description']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['AsstNo']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['qstore']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['votehead']; ?></nobr></td>
                                                                <td><nobr><?php echo $exp['votename']; ?></nobr></td>
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