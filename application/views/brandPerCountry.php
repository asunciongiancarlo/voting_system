    <div class="content">
		
    	<div class="fl title-content">
        	<h2>Brand Per Country</h2>
        </div>
		<div style="float:right;margin: 16px;">
			<a href='<?php echo HTTP_PATH ."files/user_manual/$USER_MANUAL"?>' target='_new'><img src='<?php echo HTTP_PATH ?>img/help1.png'></a>
		</div>
        
        <div class="clear"></div>
	
        <div class="working_area">
			<div class="container2">
			<?php
				$CI =& get_instance();
				
				//MESSAGE ALERT
				if(isset($msg)){
					$CI->load->library('alert');
					echo $CI->alert->check($msg);
				}
		
				 
				
				//ISSET ID
				$countryVal="";
				$action = HTTP_PATH ."itemDatabase/brandPerCountry/insert.html";
					 
				 
			?>
			
			<!-- STATUS FORM  -->
			<div id="errorContainer">
			</div>
			<?php
			if($ADD OR $EDIT){
				$CI =& get_instance();
				$CI->load->library('forms');
				echo $CI->forms->form_header('SMBi','statusFORM',$action);
				 echo "<select name='selCountry' style='float:left' >";
				  foreach($status  as $key => $s)
					{
					 extract($s);
					 echo "<option value='$id'>$countryName </option>"; 
					}
				 echo  "</select>";
				 echo "<select name='selBrand' style='float:left;margin-right:10px;'>";
				  foreach($brand  as $key => $s)
					{
					 extract($s);
					 echo "<option value='$id'>$brandName </option>"; 
					}
				 echo  "</select>";
				echo $CI->forms->form_submit('SMBi');
				echo "</form>";
			}
			?>
			<!-- STATUS TABLE  -->
			<form name="SMBi2" id="statusTable" action="<?php echo HTTP_PATH ?>itemDatabase/Country/deleteSelectedItem" method="POST"> 
				<?php echo $csrf ?>
				<div class="clear"></div>
				<table cellpadding="0" cellspacing="0" style="width:100%;margin: 0px auto;">
				
					<tr style="border-radius: 6px;">
						<th style="width:200px;text-align:center;"> Country Name </th> 
						<th style="width:200px;text-align:center;"> Brand Name </th> 
						<th style="width:150px;text-align:center;"> ACTION </th>   
					</tr>
					
					<?php 
						$x=0;
						foreach($brandxref as $s)
						{
							$c = (($x++)%2) == 0 ? "class='alter'" :  ""; 
							extract($s);
							echo "<tr>";
								 
								echo "<td $c >". $countryName ."</td>";
								echo "<td $c style='text-align:left;padding-left:100px;'>". $brandName ."</td>";
								echo "<td $c style='text-align:center;'>"; 
								//if($EDIT)
									//echo "<a href='".HTTP_PATH."itemDatabase/BrandCountry/edit/".$id."'>Edit</a> |"; 
								if($DELETE)	
									echo "<a style='cursor:pointer' onclick='deleteOneItem($id)'>Delete</a> </td>";
							echo "</tr>";
						}
					?>
				</table>
			</form>
			
            </div>
			
        </div>
           
        <div class="clear"></div>
    </div>
	
	
	<br/>
	<div style="text-align:center">
	
	
	<?php if($last>0){ ?>
		<ul class="pagination">
				<a href="<?php echo HTTP_PATH."itemDatabase/brandPerCountry/page/1" ?>"><li class="page-btn" style="margin-left:3px;"> &laquo; FIRST </li></a> 
				<?php 
					//PAGNINATION
					$i	   = 1; 
					$page  = 1;
					$page2 = 1;
					$l 	   = $last;
					
					while($l!=0)
					{
						
						//ACTIVE PAGE
						$style="";
						$page_link = HTTP_PATH."itemDatabase/brandPerCountry/page/".$i++;
						if($active_page==$page++)
						{
							$style="style='text-decoration:underline'";
						}
						echo  " <a href='$page_link' $style><li>". $page2++ ."</li></a> ";
						$l--;
					}
				?>
				<a href="<?php echo HTTP_PATH."itemDatabase/brandPerCountry/page/".$last ?>"><li class="page-btn">LAST &raquo;</li></a>
		</ul>
	<?php } ?>
    </div>
	
	<script type="text/javascript">
		function deleteOneItem(id)
		{
			jConfirm("Are you sure you want to delete this Item?","Alert",function(r){
				if(r) window.location = "<?php echo HTTP_PATH ?>itemDatabase/brandPerCountry/deleteOneItem/"+ id;
			});
		}
 

	</script>