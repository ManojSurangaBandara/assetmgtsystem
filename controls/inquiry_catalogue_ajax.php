<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>

<div id="page">

    <div class="section table_section">
	<form method="get">
		<input type="hidden" name="action" value="List_Inquiry_ajax1"/>
    <label for="name">Name</label>
    <input id="name" name="name" placeholder="Type the name" />
    <button class="btnSearch">Search</button>   
</form>
        <form action="." method="post" id="search_Expendable__form">
            <input type="hidden" name="action" value="List_Inquiry"/>
            <table width="100%" border="0">
                <tr>
                    <td>
                        <b>Inquiry Type:</b>
                    </td>
                    <td>

                        <select name="searchby">
                            <option value="Main Category"  <?php if ($searchby == "Main Category") echo "selected = 'selected'"; ?>>Main Category</option>
                            <option value="Item Category" <?php if ($searchby == "Item Category") echo "selected = 'selected'"; ?>>Item Category</option>
                            <option value="Item Description" <?php if ($searchby == "Item Description") echo "selected = 'selected'"; ?>>Item Description</option>
                            <option value="Catalogue Number" <?php if ($searchby == "Catalogue Number") echo "selected = 'selected'"; ?>>Catalogue Number</option>
                            <option value="Make" <?php if ($searchby == "Make") echo "selected = 'selected'"; ?>>Make</option>
                            <option value="Modle" <?php if ($searchby == "Modle") echo "selected = 'selected'"; ?>>Modle</option>
                            <option value="New Classification of asset" <?php if ($searchby == "New Classification of asset") echo "selected = 'selected'"; ?>>New Classification of asset</option>
                            <option value="Present Asst No" <?php if ($searchby == "Present Asst No") echo "selected = 'selected'"; ?>>Present Asst No</option>
                        </select>

                    </td>
                    <td>
                        <input type="text" class="text" name="search"  id="search" list="searchs" value="<?php echo $search; ?>"/>
                    </td>
                    <td>  
                        <input type="submit" value="Search" />

                    </td>

                    <td>  

                        <input type="checkbox" name="ExpToExcel" value="1" /> Export to Excel
                    </td> 
                    <td>  

                        <input type="checkbox" name="ExpToPdf" value="1" /> Export to PDF
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
                                        <table cellpadding="1" cellspacing="0" width="100%" border="1" BORDERCOLOR=skyblue style="font-size:11px;">

                                            <tbody>
                                            <col width="10">
                                            <col width="185">
                                            <th>SNo</th>
                                            <th><a>Main Category.</a></th>
                                            <th><a>Item Category</a></th>
                                            <th><a>Description</a></th>
                                            <th><a>Make</a></th>
                                            <th><a>Modle</a></th>
                                            <th><a>vote Head</a></th>
                                            <th><a>new Assestno</a></th>
                                            <th><a>assets no</a></th>
                                            <th><a>Catalogue No<a></th>
                                                        <?php $i = 1; ?>
                                                        <?php foreach ($items as $exp) { ?>																
                                                            <tr>
                                                                <td><?php echo $i; ?></td>
                                                                <td><?php echo $exp['mainCategory']; ?></td>
                                                                <td><?php echo $exp['itemCategory']; ?></td>
                                                                <td><?php echo $exp['itemDescription']; ?></td>
                                                                <td><?php echo $exp['make']; ?></td>
                                                                <td><?php echo $exp['modle']; ?></td>
                                                                <td><?php echo $exp['voteHead']; ?></td>
                                                                <td><?php echo $exp['newAssestno']; ?></td>
                                                                <td><?php echo $exp['assetsno']; ?></td>
                                                                <td><?php echo $exp['catalogueno']; ?></td>
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