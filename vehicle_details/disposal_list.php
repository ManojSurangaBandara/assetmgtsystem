<?php include 'header1.php'; ?>
<style>
a.paging:link, a:visited {
    background-color: #5CB3FF;
    color: white;
    padding: 4px 5px;
    text-align: center;	
    text-decoration: none;
    display: inline-block;
}


a.paging:hover, a:active {
    background-color: #157DEC;
}
</style>
<div id="page">
    <div class="section table_section">
        <div class="title_wrapper">
            <h2>Plant & Machinery Disposal Details List</h2>
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
                                    <?php
echo "<a href='index.php?action=Paging_List&page1=1' class='paging'>First Page</a>";
for ($j=1; $j<=$total_pages; $j++) {
	echo "<a href='index.php?action=Paging_List&page1=$j' class='paging'>$j</a>";
};
$last_page_no = $total_pages ? $total_pages : 1;
echo "<a href='index.php?action=Paging_List&page1=$last_page_no'  class='paging'>Last Page</a>";
?>

                                    <div class="table_wrapper_inner">
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">

                                            <tbody>
                                            <col width="10">
                                            <col width="200">
                                            <th>S/N</th>
                                            <th><a>Identification No</a></th>
                                            <th><a>Disposed Date</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Asset No</a></th>
                                            <th><a>Catalogue No</a></th>
                                            <th><a>Ledger No</a></th>
                                            <th><a>Chassis No</a></th>
                                            <th><a>DOP</a></th>
                                            <th><a>DOR<a></th>
                                                        <th><a>Army No</a></th>
                                                        <th><a>Unit Value</a></th>
                                                        <th><a>Total Value</a></th>
                                                        </tr>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><a href="index.php?action=DisposalList&identificationno=<?php echo $exp['identificationno']; ?>"><font color="DarkBlue"><?php echo $exp['identificationno']; ?></a></td>
                                                                <td><?php echo $exp['disposedDate']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['assetsno']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>
                                                                <td><?php echo $exp['totalCost']; ?></td>
                                                                <td><?php echo $exp['chessisno']; ?></td>
                                                                <td><?php echo $exp['purchasedDate']; ?></td>
                                                                <td><?php echo $exp['receivedDate']; ?></td>
                                                                <td><?php echo $exp['armyno']; ?></td>
                                                                <td><?php echo $exp['unitValue']; ?></td>
                                                                <td><?php echo $exp['totalCost']; ?></td>
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