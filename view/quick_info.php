<div class="quick_info">
	<div class="quick_info_top">
		<h2>Quick info</h2>
	</div>
	<div class="quick_info_content">
    <ul class="sidebar_menu">
	<?php
	 
      foreach ($Qinfo as $Item) :
      ?>
		<li><a href="../controls/index.php?action=View_QuickInfos&id=<?php echo $Item['id']; ?>" title="<?php echo $Item['id']; ?>"><?php echo $Item['title']; ?> </a></li>         
      <?php endforeach; ?>
	   </ul>
	</div>
	<span class="quick_info_bottom"></span>
</div>

 

         