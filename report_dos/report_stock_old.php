<?php
include '../view/header1.php';
?>
<div id="sec_menu">
    <?php include("sub_menu.tpl"); ?>
</div>

<div id="page">
        <div class="inner">
            <p>&nbsp;</p>
            <div class="section table_section">
                <div class="title_wrapper">
                    <h2>Stocks - DOS</h2>
                    <span class="title_wrapper_left"></span>
                    <span class="title_wrapper_right"></span>
                </div>
                <div class="section_content">
                    <div class="sct">
                        <div class="sct_left">
                            <div class="sct_right">
                                <div class="sct_left">
                                    <div class="sct_right">
                                        <!-- <form action="#"> -->
                                            <fieldset>
                                                <div class="table_wrapper">
                                                    <div class="table_wrapper_inner">
                                                        <table cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody>
                                                                <tr>
                                                                    <th>S/N                                                                        
                                                                    </th>                                                                    
                                                                    <th>Catologue Code <br>
                                                                        <input type="text" name="code" id="code"/>
                                                                    </th>
                                                                    <th>Item Name<br>
                                                                        <input type="text" name="name" id="name"/>
                                                                    </th>
                                                                    <th>Ordanance Stores<br>
                                                                        <input type="text" name="stores" id="stores"/>
                                                                    </th>
                                                                    <th>Current Stock</th>
                                                                    <th>Location<br>
                                                                        <input type="text" name="location" id="location"/>
                                                                    </th>
                                                                </tr>

                                                                <?php
                                                                            $url = "https://172.16.60.11/dos/api/stocks?key=62c9f89ab4ada907d069d037d0b2fee2";
                                                                            $options = [
                                                                                'ssl' => [
                                                                                    'verify_peer' => false,
                                                                                    'verify_peer_name' => false,
                                                                                ],
                                                                            ];

                                                                            // Fetch the data from the API
                                                                            $data = file_get_contents($url, false, stream_context_create($options));
                                                                            $json = json_decode($data, true);

                                                                            // Initialize the variables for pagination
                                                                            $items_per_page = 100;
                                                                            $total_items = count($json);
                                                                            $number_of_pages = ceil($total_items / $items_per_page);
                                                                            $current_page = isset($_GET['page']) ? $_GET['page'] : 1;

                                                                            // Calculate the starting and ending points for this page
                                                                            $starting_index = ($current_page - 1) * $items_per_page;
                                                                            $ending_index = $starting_index + $items_per_page;

                                                                            // Slice the array based on the starting and ending points for this page
                                                                            $json_page = array_slice($json, $starting_index, $items_per_page);

                                                                            // If there are more pages, fetch them too
                                                                            if ($current_page < $number_of_pages) {
                                                                                // Initialize the variables for the next page
                                                                                $next_page = $current_page + 1;
                                                                                $next_starting_index = $ending_index;
                                                                                $next_ending_index = $next_starting_index + $items_per_page;

                                                                                // Fetch the data for the next page
                                                                                $next_url = $url . "&start=$next_starting_index&end=$next_ending_index";
                                                                                $next_data = file_get_contents($next_url, false, stream_context_create($options));
                                                                                $next_json = json_decode($next_data, true);

                                                                                // Merge the data for the next page with the current page
                                                                                $json_page = array_merge($json_page, $next_json);
                                                                            }

                                                                            // Use the $json_page array for your display logic
                                                                            ?>



                                                                <?php foreach ($json as $index => $item): ?>
                                                                    <?php if ($index < $starting_index || $index >= $starting_index + $items_per_page) continue; ?>
                                                                    <tr>
                                                                        <td><?php echo ($index + 1) ?></td>
                                                                        <td><?php echo $item['itemcode'] ?></td>
                                                                        <td><?php echo $item['description'] ?></td>
                                                                        <td><?php echo $item['itemtype'] ?></td>
                                                                        <td><?php echo $item['actualStock'] ?></td>
                                                                        <td><?php echo $item['Place'] ?></td>
                                                                    </tr>
                                                                <?php endforeach ?>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        <!-- </form> -->

                                        <?php if ($number_of_pages > 1): ?>
                                        <div class="pagination">
                                            <?php if ($current_page > 1): ?>
                                            <a href="<?php echo "?action=report_stock&page=".($current_page-1); ?>"><i class="fa fa-angle-left"></i></a>
                                            <?php endif ?>

                                            <?php if ($number_of_pages <= 30): ?>
                                            <?php for ($i=1; $i<=$number_of_pages; $i++): ?>
                                                <?php if ($i == $current_page): ?>
                                                <button class="active"><?php echo $i ?></button>
                                                <?php else: ?>
                                                <a href="<?php echo "?action=report_stock&page=".$i; ?>"><button><?php echo $i ?></button></a>
                                                <?php endif ?>
                                            <?php endfor ?>
                                            <?php else: ?>
                                            <?php if ($current_page <= 15): ?>
                                                <?php for ($i=1; $i<=30; $i++): ?>
                                                <?php if ($i == $current_page): ?>
                                                    <button class="active"><?php echo $i ?></button>
                                                <?php else: ?>
                                                    <a href="<?php echo "?action=report_stock&page=".$i; ?>"><button><?php echo $i ?></button></a>
                                                <?php endif ?>
                                                <?php endfor ?>
                                                <span>...</span>
                                                <a href="<?php echo "?action=report_stock&page=".$number_of_pages; ?>"><button><?php echo $number_of_pages ?></button></a>
                                            <?php elseif ($current_page >= $number_of_pages - 14): ?>
                                                <a href="<?php echo "?action=report_stock&page=1"; ?>"><button>1</button></a>
                                                <span>...</span>
                                                <?php for ($i=$number_of_pages - 29; $i<=$number_of_pages; $i++): ?>
                                                <?php if ($i == $current_page): ?>
                                                    <button class="active"><?php echo $i ?></button>
                                                <?php else: ?>
                                                    <a href="<?php echo "?action=report_stock&page=".$i; ?>"><button><?php echo $i ?></button></a>
                                                <?php endif ?>
                                                <?php endfor ?>
                                            <?php else: ?>
                                                <a href="<?php echo "?action=report_stock&page=1"; ?>"><button>1</button></a>
                                                <span>...</span>
                                                <?php for ($i=$current_page-14; $i<=$current_page+15; $i++): ?>
                                                <?php if ($i == $current_page): ?>
                                                    <button class="active"><?php echo $i ?></button>
                                                <?php else: ?>
                                                    <a href="<?php echo "?action=report_stock&page=".$i; ?>"><button><?php echo $i ?></button></a>
                                                <?php endif ?>
                                                <?php endfor ?>
                                                <span>...</span>
                                                <a href="<?php echo "?action=report_stock&page=".$number_of_pages; ?>"><button><?php echo $number_of_pages ?></button></a>
                                            <?php endif ?>
                                            <?php endif ?>

                                            <?php if ($current_page < $number_of_pages): ?>
                                            <a href="<?php echo "?action=report_stock&page=".($current_page+1); ?>"><i class="fa fa-angle-right"></i></a>
                                            <?php endif ?>
                                        </div>
                                        <?php endif ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <span class="scb"><span class="scb_left"></span><span class="scb_right"></span></span>						
                </div>
            </div>
            <div class="section table_section">
            </div>
        </div>

    </div>
<?php
include('sidebar.php');
include '../view/footer.php';
?>