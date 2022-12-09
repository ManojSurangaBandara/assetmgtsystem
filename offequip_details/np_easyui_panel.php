    <div  class="easyui-panel" style="padding:5px">
        <ul id="tt" class="easyui-tree">
            <li id="1">
                <span><a href="index.php?action=np_tree_list_2&id=1">Sri Lanka Army</a></span>
                <ul>
                    <?php 
					$tem = "";
					$tem2 = "";
					foreach ($items as $exp) { 
					 if ($exp['protocollevel1'] == 25) {
					 if ($tem <> $exp['protocoltext2']) { ?>	
					<li id="2" data-options="state:'closed'">                        
						<span><a href="index.php?action=np_tree_list_2&id=2&unit=<?php echo $exp['protocoltext2']; ?>"><?php echo $exp['protocoltext2']; ?></a></span>
						<ul>
                            <li id="3"><a href="index.php?action=np_tree_list_2&id=3&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext2'];
					   } else {
						?>
						<ul>
                            <li id="4"><a href="index.php?action=np_tree_list_2&id=4&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					 } else {
					 if ($tem <> $exp['protocoltext1']) { ?>	
					<li id="5" data-options="state:'closed'">                        
						<span><a href="index.php?action=np_tree_list_2&id=5&unit=<?php echo $exp['protocoltext1']; ?>"><?php echo $exp['protocoltext1']; ?></a></span>
						<ul>
                            <li id="6"><a href="index.php?action=np_tree_list_2&id=6&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>
                       <?php 
					   $tem = $exp['protocoltext1'];
					   } else {
						?>
						<ul>
                            <li id="7"><a href="index.php?action=np_tree_list_2&id=7&unit=<?php echo $exp['unitName']; ?>"><?php echo $exp['unitName']; ?></a></li>
                        </ul>   
						<?php   
					   } 
					} }?>
                    </li>
                </ul>
            </li>
        </ul>
    </div>