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
                                                                            
                                                                            // Convert the API data to an array
                                                                            $data = json_decode($data, true);


                                                                            // Set the number of items per page
                                                                            $items_per_page = 50;

                                                                            // Get the current page number from the query string
                                                                            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

                                                                            // Get the filter values from the query string
                                                                            $itemcode_filter = isset($_GET['itemcode']) ? $_GET['itemcode'] : '';
                                                                            $description_filter = isset($_GET['description']) ? $_GET['description'] : '';
                                                                            $stores_filter = isset($_GET['stores']) ? $_GET['stores'] : '';
                                                                            $place_filter = isset($_GET['place']) ? $_GET['place'] : '';

                                                                            // Filter the data based on the filter values
                                                                            $filtered_data = array_filter($data, function($item) use ($place_filter, $itemcode_filter, $description_filter,$stores_filter) {
                                                                                if ($place_filter && is_string($item['Place']) && stripos($item['Place'], $place_filter) === false) {
                                                                                    return false;
                                                                                }
                                                                                if ($itemcode_filter && is_string($item['itemcode']) && stripos($item['itemcode'], $itemcode_filter) === false) {
                                                                                    return false;
                                                                                }
                                                                                if ($description_filter && is_string($item['description']) && stripos($item['description'], $description_filter) === false) {
                                                                                    return false;
                                                                                }
                                                                                if ($stores_filter && is_string($item['itemtype']) && stripos($item['itemtype'], $stores_filter) === false) {
                                                                                    return false;
                                                                                }
                                                                                return true;
                                                                            });
                                                                            

                                                                            // Get the total number of items
                                                                            $total_items = count($filtered_data);

                                                                            // Calculate the total number of pages
                                                                            $total_pages = ceil($total_items / $items_per_page);

                                                                            // Limit the data to the current page
                                                                            $offset = ($page - 1) * $items_per_page;
                                                                            $limited_data = array_slice($filtered_data, $offset, $items_per_page);
                                                                            echo '<br>';

                                                                            // Display the data
                                                                            echo '&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="itemcode" placeholder="Filter by Catalogue Code" value="'.$itemcode_filter.'">&nbsp;&nbsp;<input type="text" name="description" placeholder="Filter by Item Name" value="'.$description_filter.'">&nbsp;&nbsp;<input type="text" name="stores" placeholder="Filter by Stores" value="'.$stores_filter.'">&nbsp;&nbsp;<input type="text" name="place" placeholder="Filter by Location" value="'.$place_filter.'">&nbsp;&nbsp;<button onclick="updateFilters()">Apply Filters</button>';
                                                                            echo '<br><br>';
                                                                            echo '<table>';
                                                                            echo '<tr><th>S/N</th><th>Catalogue Code</th><th>Item Name</th><th>Stores</th><th>Stock</th><th>Location</th></tr>';
                                                                            foreach ($limited_data as $index => $item) {
                                                                                echo '<tr>';
                                                                                echo '<td>' . ($index + 1) . '</td>';
                                                                                echo '<td>' . $item['itemcode'] . '</td>';
                                                                                echo '<td>' . $item['description'] . '</td>';
                                                                                echo '<td>' . $item['itemtype'] . '</td>';
                                                                                echo '<td>' . $item['actualStock'] . '</td>';
                                                                                echo '<td>' . $item['Place'] . '</td>';
                                                                                echo '</tr>';
                                                                            }
                                                                            echo '</table>';
                                                                            

                                                                             // Display the pagination links
                                                                            // echo '<div>';
                                                                            // if ($total_pages > 1) {
                                                                            //     for ($i = 1; $i <= $total_pages; $i++) {
                                                                            //         echo '<a href="?action=report_stock&page='.$i.'&place='.$place_filter.'&itemcode='.$itemcode_filter.'&description='.$description_filter.'">'.$i.'</a>';
                                                                            //     }
                                                                            // }
                                                                            // echo '</div>';                                                                           

                                                                            ?>

                                                                            <?php if ($total_pages > 1): ?>
                                                                                <div class="pagination">
                                                                                    <?php if ($page > 1): ?>
                                                                                        <a href="?action=report_stock&page=<?php echo $page-1; ?>"><i class="fa fa-angle-left"></i></a>
                                                                                    <?php endif ?>

                                                                                    <?php if ($total_pages <= 30): ?>
                                                                                        <?php for ($i=1; $i<=$total_pages; $i++): ?>
                                                                                            <?php if ($i == $page): ?>
                                                                                                <button class="active"><?php echo $i ?></button>
                                                                                            <?php else: ?>
                                                                                                <a href="?action=report_stock&page=<?php echo $i; ?>"><button><?php echo $i ?></button></a>
                                                                                            <?php endif ?>
                                                                                        <?php endfor ?>
                                                                                    <?php else: ?>
                                                                                        <?php if ($page <= 15): ?>
                                                                                            <?php for ($i=1; $i<=30; $i++): ?>
                                                                                                <?php if ($i == $page): ?>
                                                                                                    <button class="active"><?php echo $i ?></button>
                                                                                                <?php else: ?>
                                                                                                    <a href="?action=report_stock&page=<?php echo $i; ?>"><button><?php echo $i ?></button></a>
                                                                                                <?php endif ?>
                                                                                            <?php endfor ?>
                                                                                            <span>...</span>
                                                                                            <a href="?action=report_stock&page=<?php echo $total_pages; ?>"><button><?php echo $total_pages ?></button></a>
                                                                                        <?php elseif ($page >= $total_pages - 14): ?>
                                                                                            <a href="?action=report_stock&page=1"><button>1</button></a>
                                                                                            <span>...</span>
                                                                                            <?php for ($i=$total_pages - 29; $i<=$total_pages; $i++): ?>
                                                                                                <?php if ($i == $page): ?>
                                                                                                    <button class="active"><?php echo $i ?></button>
                                                                                                <?php else: ?>
                                                                                                    <a href="?action=report_stock&page=<?php echo $i; ?>"><button><?php echo $i ?></button></a>
                                                                                                <?php endif ?>
                                                                                            <?php endfor ?>
                                                                                        <?php else: ?>
                                                                                            <a href="?action=report_stock&page=1"><button>1</button></a>
                                                                                            <span>...</span>
                                                                                            <?php for ($i=$page-14; $i<=$page+15; $i++): ?>
                                                                                                <?php if ($i == $page): ?>
                                                                                                    <button class="active"><?php echo $i ?></button>
                                                                                                <?php else: ?>
                                                                                                    <a href="?action=report_stock&page=<?php echo $i; ?>"><button><?php echo $i ?></button></a>
                                                                                                <?php endif ?>
                                                                                            <?php endfor ?>
                                                                                            <span>...</span>
                                                                                            <a href="?action=report_stock&page=<?php echo $total_pages; ?>"><button><?php echo $total_pages ?></button></a>
                                                                                        <?php endif ?>
                                                                                    <?php endif ?>

                                                                                    <?php if ($page < $total_pages): ?>
                                                                                        <a href="?action=report_stock&page=<?php echo $page+1; ?>"><i class="fa fa-angle-right"></i></a>
                                                                                    <?php endif ?>
                                                                                </div>
                                                                            <?php endif ?>
                                                                            

                                                                            <script>
                                                                                function updateFilters() {
                                                                                // Get the filter input values
                                                                                var place_filter = document.getElementsByName("place")[0].value;
                                                                                var itemcode_filter = document.getElementsByName("itemcode")[0].value;
                                                                                var description_filter = document.getElementsByName("description")[0].value;
                                                                                var stores_filter = document.getElementsByName("stores")[0].value;

                                                                                // Redirect to the filtered page with the updated filter values
                                                                                var url = window.location.pathname + '?action=report_stock&page=1' + '&place=' + encodeURIComponent(place_filter) + '&itemcode=' + encodeURIComponent(itemcode_filter) + '&description=' + encodeURIComponent(description_filter) + '&stores=' + encodeURIComponent(stores_filter);
                                                                                window.location.href = url;
                                                                                }
                                                                            </script>                                                            
                                                    </div>
                                                </div>
                                            </fieldset>
                                        <!-- </form> -->

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