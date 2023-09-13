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
                                                                            $filtered_data = array_filter($data, function($item) use ($place_filter, $itemcode_filter, $description_filter, $stores_filter) {
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

                                                                            if ($total_pages > 1) {
                                                                                echo '<div class="pagination">';
                                                                                
                                                                                if ($page > 1) {
                                                                                    // Generate the previous page link with filter parameters
                                                                                    $prev_page = $page - 1;
                                                                                    $prev_url = buildPaginationURL($prev_page, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                    echo '<a href="'.$prev_url.'"><i class="fa fa-angle-left"></i></a>';
                                                                                }

                                                                                if ($total_pages <= 30) {
                                                                                    // Generate links for all pages if the total pages are less than or equal to 30
                                                                                    for ($i = 1; $i <= $total_pages; $i++) {
                                                                                        $url = buildPaginationURL($i, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                        if ($i == $page) {
                                                                                            echo '<button class="active">'.$i.'</button>';
                                                                                        } else {
                                                                                            echo '<a href="'.$url.'"><button>'.$i.'</button></a>';
                                                                                        }
                                                                                    }
                                                                                } else {
                                                                                    if ($page <= 15) {
                                                                                        // Generate links for the first 30 pages if the current page is within the first 15 pages
                                                                                        for ($i = 1; $i <= 30; $i++) {
                                                                                            $url = buildPaginationURL($i, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                            if ($i == $page) {
                                                                                                echo '<button class="active">'.$i.'</button>';
                                                                                            } else {
                                                                                                echo '<a href="'.$url.'"><button>'.$i.'</button></a>';
                                                                                            }
                                                                                        }
                                                                                        echo '<span>...</span>';
                                                                                        // Generate the last page link with filter parameters
                                                                                        $last_url = buildPaginationURL($total_pages, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                        echo '<a href="'.$last_url.'"><button>'.$total_pages.'</button></a>';
                                                                                    } elseif ($page >= $total_pages - 14) {
                                                                                        // Generate the first page link with filter parameters
                                                                                        $first_url = buildPaginationURL(1, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                        echo '<a href="'.$first_url.'"><button>1</button></a>';
                                                                                        echo '<span>...</span>';
                                                                                        // Generate links for the last 30 pages if the current page is within the last 15 pages
                                                                                        for ($i = $total_pages - 29; $i <= $total_pages; $i++) {
                                                                                            $url = buildPaginationURL($i, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                            if ($i == $page) {
                                                                                                echo '<button class="active">'.$i.'</button>';
                                                                                            } else {
                                                                                                echo '<a href="'.$url.'"><button>'.$i.'</button></a>';
                                                                                            }
                                                                                        }
                                                                                    } else {
                                                                                        // Generate the first page link with filter parameters
                                                                                        $first_url = buildPaginationURL(1, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                        echo '<a href="'.$first_url.'"><button>1</button></a>';
                                                                                        echo '<span>...</span>';
                                                                                        // Generate links for the current page with surrounding 15 pages
                                                                                        for ($i = $page - 14; $i <= $page + 15; $i++) {
                                                                                            $url = buildPaginationURL($i, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                            if ($i == $page) {
                                                                                                echo '<button class="active">'.$i.'</button>';
                                                                                            } else {
                                                                                                echo '<a href="'.$url.'"><button>'.$i.'</button></a>';
                                                                                            }
                                                                                        }
                                                                                        echo '<span>...</span>';
                                                                                        // Generate the last page link with filter parameters
                                                                                        $last_url = buildPaginationURL($total_pages, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                        echo '<a href="'.$last_url.'"><button>'.$total_pages.'</button></a>';
                                                                                    }
                                                                                }

                                                                                if ($page < $total_pages) {
                                                                                    // Generate the next page link with filter parameters
                                                                                    $next_page = $page + 1;
                                                                                    $next_url = buildPaginationURL($next_page, $itemcode_filter, $description_filter, $stores_filter, $place_filter);
                                                                                    echo '<a href="'.$next_url.'"><i class="fa fa-angle-right"></i></a>';
                                                                                }

                                                                                echo '</div>';
                                                                            }

                                                                            function buildPaginationURL($page, $itemcode_filter, $description_filter, $stores_filter, $place_filter) {
                                                                                $url = '?action=report_stock&page=' . $page;
                                                                                if (!empty($itemcode_filter)) {
                                                                                    $url .= '&itemcode=' . urlencode($itemcode_filter);
                                                                                }
                                                                                if (!empty($description_filter)) {
                                                                                    $url .= '&description=' . urlencode($description_filter);
                                                                                }
                                                                                if (!empty($stores_filter)) {
                                                                                    $url .= '&stores=' . urlencode($stores_filter);
                                                                                }
                                                                                if (!empty($place_filter)) {
                                                                                    $url .= '&place=' . urlencode($place_filter);
                                                                                }
                                                                                return $url;
                                                                            }

                                                                            ?>

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