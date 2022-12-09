<?php include '../view/header1.php'; ?>							
<div id="page">
<div id="confirm" title="Land Details"></div>
    <div class="section table_section">
		<form name="add_form" method="post" id="add_form" action="index.php" class="add_form"> 
            <input type="hidden" name="action" value="List_Inquiry_Data_Ajax"/>           
                        <label for="assetscenter" class="label"><?php echo $tList[0][$lang]?></label>                    
                         <div>
						<select name="assetscenter" id="assetscenter">
                            <option value=""></option>
                            <?php foreach ($assetsCenters as $center) { ?>
                                <option value="<?php echo $center->getName(); ?>" <?php if ($assetscenter == $center->getName()) echo "selected = 'selected'"; ?>>
                                    <?php echo $center->getName(); ?>
                                </option>
                            <?php } ?>
                        </select>
						</div>
                    <label for="assetunit" class="label"><?php echo $tList[1][$lang]?></label>  
                        <div id="Unitdiv">
                            <select name="assetunit" id="assetunit">
                                <option value=""></option>
                                <?php foreach ($assetunits as $unit) { ?>
                                    <option value="<?php echo $unit->getName(); ?>" <?php if ($assetunit == $unit->getName()) echo "selected = 'selected'"; ?>>
                                        <?php echo $unit->getName(); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <label class="label"><?php echo $inqtype[$lang]?></label>
                        <div>
						<select name="searchby" id="searchby">
                            <option value="Identification Number">Identification Number</option>
                            <option value="Province">District</option>
                            <option value="DS Division">DS Division</option>
                            <option value="GS Division">GS Division</option>
                            <option value="Land Category">Land Category</option>
                            <option value="Assets No">Assets No</option>
                            <option value="Classification No">Classification No</option>
                            <option value="Register Number">Register Number</option>
                            <option value="Land Name">Land Name</option>
                            <option value="Plan Number">Plan Number</option>
                            <option value="Title Deed Number">Title Deed Number</option>
                            <option value="Title Deed Date">Title Deed Date</option>
                            <option value="Nature of Land">Nature of Land</option>
                            <option value="Area">Area</option>
                            <option value="Date of Acquisition">Date of Acquisition</option>
                            <option value="Remarks">Remarks</option>
                        </select>
                            <datalist id="searchs" value="<?php echo $search; ?>">
                                <option value=""></option>
                                <?php foreach ($searchText as $itemCate) { ?>
                                    <option value="<?php echo $itemCate; ?>">
                                        <?php echo $itemCate; ?>
                                    </option>
                                <?php } ?>
                            </datalist>
                            <input type="text" class="text" name="search"  id="search" list="searchs"/>
							</div>
						<label class="label"><?php echo $tList[20][$lang]?></label> 
                        <div><input type='text' class="date" name="date1" id="date1" style="width:90px;"/>
                        <b>To :</b>                        
						<input type='text' class="date" name="date2" id="date2" style="width:90px;"/></div>						
                        <div><input type="submit" name="submit" id="submit" value="Search"></div> 
						<label class="label"><?php echo ""?></label>
                        <div><input type="Button" name="ExpToExcel" id="ExpToExcel" value="<?php echo $expexcel[$lang]?>" style="background-color:#0B610B; color:#FBF8EF;"/> 
                        <input type="Button" name="ExpToPdf" id="ExpToPdf" value="<?php echo $exppdf[$lang]?>" style="background-color:#FE2E2E; color:#FBF8EF;"/> </div>
        </form>
        <div class="title_wrapper">
            <h2>Lands Details List</h2>
            <span class="title_wrapper_left"></span>
            <span class="title_wrapper_right"></span>
        </div>
        <div class="section_content">
            <div class="sct">
                <div class="sct_left">
                    <div class="sct_right">
                        <div class="sct_left">
                            <div class="sct_right">
                                    <div id="dvData" class="table_wrapper_inner">
                                        <table id="newtable" cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:12px;">
                                            <tbody>
											<tr>
                                            <th>SNo</th>
                                            <th><a>Identification No.</a></th>
                                            <th><a>Category Name</a></th>
                                            <th><a>District</a></th>
                                            <th><a>DS Division</a></th>
                                            <th><a>GS Division</a></th>
                                            <th><a>Deed Number</a></th>
                                            <th><a>Land Name</a></th>
                                            <th><a>Area</a></th>
                                            <th><a>DOR</a></th>
                                            <th><a>Value</a></th>
                                            </tr>
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
<script type="text/javascript">
        function demoFromHTML() {
             var table1 = 
        tableToJson($('#newtable').get(0)),
        cellWidth = 35,
        rowCount = 0,
        cellContents,
        leftMargin = 2,
        topMargin = 12,
        topMarginTable = 55,
        headerRowHeight = 13,
        rowHeight = 9,

         l = {
         orientation: 'l',
         unit: 'mm',
         format: 'a3',
         compress: true,
         fontSize: 10,
         lineHeight: 1,
         autoSize: false,
         printHeaders: true
     };

    var doc = new jsPDF(l, '', '', '');

    doc.setProperties({
        title: 'Test PDF Document',
        subject: 'This is the subject',
        author: 'author',
        keywords: 'generated, javascript, web 2.0, ajax',
        creator: 'author'
    });

    doc.cellInitialize();

   $.each(table1, function (i, row)
    {

        rowCount++;

        $.each(row, function (j, cellContent) {

            if (rowCount == 1) {
                doc.margins = 1;
                doc.setFont("helvetica");
                doc.setFontType("bold");
                doc.setFontSize(12);

                doc.cell(leftMargin, topMargin, cellWidth, headerRowHeight, cellContent, i)
            }
            else if (rowCount == 2) {
                doc.margins = 1;
                doc.setFont("times ");
                doc.setFontType("italic");  // or for normal font type use ------ doc.setFontType("normal");
                doc.setFontSize(12);                    

                doc.cell(leftMargin, topMargin, cellWidth, rowHeight, cellContent, i); 
            }
            else {

                doc.margins = 1;
                doc.setFont("courier ");
                doc.setFontType("bolditalic ");
                doc.setFontSize(12);                    

                doc.cell(leftMargin, topMargin, cellWidth, rowHeight, cellContent, i);  // 1st=left margin    2nd parameter=top margin,     3rd=row cell width      4th=Row height
            }
        })
    })

doc.save('sample Report.pdf');
        }
	function tableToJson(table) {
var data = [];

// first row needs to be headers
var headers = [];
for (var i=0; i<table.rows[0].cells.length; i++) {
    headers[i] = table.rows[0].cells[i].innerHTML.toLowerCase().replace(/ /gi,'');
}

// go through cells
for (var i=1; i<table.rows.length; i++) {

    var tableRow = table.rows[i];
    var rowData = {};

    for (var j=0; j<tableRow.cells.length; j++) {

        rowData[ headers[j] ] = tableRow.cells[j].innerHTML;

    }

    data.push(rowData);
}       

return data; }	
    </script>
<script type="text/javascript">
	$("#ExpToPdf").click(function () {
	demoFromHTML();
});

</script>
<script src="inquiry_list.js"></script>
<?php
//include('sidebar.php');
include '../view/footer.php';
?>