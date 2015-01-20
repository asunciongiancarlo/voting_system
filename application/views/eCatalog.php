<div class="content">
		
	<div class="title-content fl">
		<h2> <span style='text-transform: lowercase;'>e</span>CATALOGUE </h2>
	</div>
	
	<div style="float:right;margin: 16px;">
		<a href='<?php echo HTTP_PATH ."files/user_manual/$USER_MANUAL"?>' target='_new'><img src='<?php echo HTTP_PATH ?>img/help1.png'></a>
	</div>
	
	<div class="clear"></div>

	<div class="working_area" >
		<div class="container2 form" style='background:white;'>
			<?php
				$CI =& get_instance();
				//MESSAGE ALERT
				if(isset($msg)){
					$CI->load->library('alert');
					echo $CI->alert->check($msg);
				}
			?>
		
			<div class="clear"></div>
			<?php 
			if($ADD){ ?>
			<a href="<?php echo HTTP_PATH ."eCatalog/catalog/add" ?>"> 
			<div class="sub-link">
				<ul>
					<li> <img src="<?php echo HTTP_PATH ?>img/plus.png" width="31" height="31"> </li>
					<li> <h5>Add<br/><span style='text-transform:lowercase;'>e</span>CATALOGUE</h5> </li>
				</ul>
			</div>
			</a>
			<?php } ?>
			
			<table cellpadding="0" cellspacing="0" style="100%">
			
				<tr style="border-radius: 6px;">
					<th style="width:200px;text-align:center;"> BRAND 			    				</th> 
					<th style="width:200px;text-align:center;"> TITLE 			    				</th> 
					<th style="width:200px;text-align:center;"> BRAND GUIDELINES 			   		</th> 
					<th style="width:200px;text-align:center;"> DATE UPDATED 			 			</th> 
					<th style="width:150px;text-align:center;"> ACTION 								</th>   
				</tr>
				
				<?php
			
					$x=0;
					//print_r($eCatalog);
					foreach($eCatalog as $eC)
					{
						$c = (($x++)%2) == 0 ? "class='alter'" :  ""; 
						extract($eC);
						echo "<tr>";
							echo "<td $c > <img src='". HTTP_PATH."img/cover/".$cover  ."' </td>";
							echo "<td $c >". $title  					."</td>";
							echo "<td $c > <a href='".HTTP_PATH."files/brand_guidelines/$brand_guidelines' target='_blank'>Brand Guidelines </a></td>";
							echo "<td $c >". $tdate 						."</td>";
							echo "<td $c style='text-align:center;'>";
							if($REVIEW){
								echo "<a href='".HTTP_PATH."gallery/eCatalog/view/".$id."'>View</a> |";  
							}
							if($EDIT){
								echo "<a href='".HTTP_PATH."eCatalog/catalog/edit/".$id."'>Edit</a> |"; 
							}
							if($DELETE){
								echo "<a style='cursor:pointer' onclick='deleteOneItem($id)'>Delete</a> </td>";
							}
						echo "</tr>";
					}
				?>
			</table>
            </div>
	</div>
</div>
	<script>	
	function deleteOneItem(id)
	{
		jConfirm("Are you sure you want to delete this eCatalogue?","Alert",function(r){
			if(r) window.location = "<?php echo HTTP_PATH ?>eCatalog/catalog/deleteOneItem/"+ id;
		});
		
	}
	</script>
	
	</div>
        <div class="clear" style="height:20px;"></div>
    </div>

	