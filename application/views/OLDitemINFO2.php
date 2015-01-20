    <div style='background-color:white;'>
        <div class="container form" style='width:100%;'>
			
			<div class="clear" style='height:10px;'></div>
			<div class="red"> </div>
			
			<?php
				$CI =& get_instance();
				$CI2 =& get_instance();
				$CI2->load->library('fv');
				$CI->load->database('default');
				
				//MESSAGE ALERT
				if(isset($msg)){
					$CI->load->library('alert');
					echo $CI->alert->check($msg);
				}
		
				//ACTION STATEMENT
				$action = HTTP_PATH ."itemDatabase/items/insert";
				//ISSET ID
				$imgTot=0;
				$Long_Description='';
				$brandID='';
				$POSMTypeID='';
				$POSMStatusID='';
				$OUTLETStatusID=0;
				$PremiumTypeID='';
				$MaterialTypeID='';
				$countryID='';
				$itemName='';
				$Short_Description='';
				$UnitPrice='';
				$MOQ='';
				$UOM='';
				$dateAdded='';
				$Fields0001='';
				$Fields0002='';
				$Fields0003='';
				$Fields0004='';
				$Fields0005='';
				$DateLastEdited=''; 
				$selectedVendor='';
				$publish='';
				$publish_other_country='';
				$plant_inventory 		= '';
				$supplier_stock_on_hand = '';
				$date_first_issue 		= '';
				$date_last_used 		= '';
				$activity_event_use 	= '';
				
			
				if(isset($id))
				{
					$action = HTTP_PATH ."itemDatabase/items/update/".$id;
					$sql = $CI->db->query("SELECT * FROM ec_items WHERE id= $id");
					$sql = $sql->result_array();
					
					//ITEM DESCRIPTION
					extract($sql);
			
					$Long_Description 	= 	$sql[0]['Long_Description']; 
					$brandID	 		= 	$sql[0]['brandID']; 
					$POSMTypeID 		= 	$sql[0]['POSMTypeID']; 
					$POSMStatusID		=  	$sql[0]['POSMStatusID'];
					$OUTLETStatusID		=  	$sql[0]['OUTLETStatusID'];;
					$PremiumTypeID		=  	$sql[0]['PremiumTypeID'];;
					$MaterialTypeID		=  	$sql[0]['MaterialTypeID'];;
					$countryID			=  	$sql[0]['countryID'];;
					$itemName			=  	$sql[0]['itemName'];;
					$Short_Description	=  	$sql[0]['Short_Description'];;
					$UnitPrice			=  	$sql[0]['UnitPrice'];;
					$MOQ				=  	$sql[0]['MOQ'];;
					$UOM				= 	$sql[0]['UOM'];;
					$dateAdded			= 	$sql[0]['dateAdded'];;
					$Fields0001			= 	$sql[0]['Fields0001'];;
					$Fields0002			=  	$sql[0]['Fields0002'];;
					$Fields0003			= 	$sql[0]['Fields0003'];;
					$Fields0004			= 	$sql[0]['Fields0004'];;
					$Fields0005			= 	$sql[0]['Fields0005'];
					$DateLastEdited		= 	$sql[0]['DateLastEdited'];
					$publish			=   $sql[0]['publish'];
					$publish_other_country	=   $sql[0]['publish_other_country'];
					
					$plant_inventory 		= $sql[0]['plant_inventory'];
					$supplier_stock_on_hand = $sql[0]['supplier_stock_on_hand'];
					$date_first_issue 		= $sql[0]['date_first_issue'];
					$date_last_used 		= $sql[0]['date_last_used'];
					$activity_event_use 	= $sql[0]['activity_event_use'];
					
					//ITEM VENDORS
					$sql = $CI->db->query("SELECT vendorID as selectedVendorID FROM itemVendorsRef WHERE itemID= $id");
					$selectedVendor = $sql->result_array();
					
				}
			?>
			
			
			<div class="container" style='margin-left: -25px;'>
			
			<!-- ITEM FORM -->
			<div id="item_description" style="display:block;">
			<div class="container form">
			 <div style="margin:0 20px">
              <br/><br/>	  
              <table width="100%" cellpadding="0" cellspacing="0" border="0" >
                <tr>
                 <td rowspan="7" width="50%" valign='top'>
                  <center>
					<?php 
					if(isset($id))
					{
						$itemID = $id;
						$itemID1 = $id;
						
						
						$item_img = isset($items_images[0]['image']) ? $items_images[0]['image'] : 'blank.png';
						echo" <div style='margin:5px'> <a href='JavaScript:zoom($itemID)'><img src='".HTTP_PATH."img/zoom.png' '></a> </div>";
						echo "<div class='targetarea'>
								 <a href='JavaScript:imgs(-1)'><img src='".HTTP_PATH."img/left.png' '></a>
								<a href='#'><img style=''  id='zoom' data-zoom-image='".HTTP_PATH."img/big/$item_img' src='".HTTP_PATH."img/small/$item_img'></a>
							   
								<a href='JavaScript:imgs(1)'><img src='".HTTP_PATH."img/right.png' '></a>
								
							   </div>";
							  
						echo "<hr style='width:450px;clear:both'>";
						
						
						echo "<div class='multizoom1 thumbs' id='imageBar' style='width:450px;'>";

								$i=0; $j=0;
								echo "<label style='margin-top:15px' class='fl' onclick='adjustLeft()'> <img src='".HTTP_PATH."img/left.png' '> &nbsp;</label>";
								echo "<div class='fl' style='width:380px;margin-top:-10px;max-height:80px;height:80px;overflow:hidden;border:1px solid rgb(196, 196, 196);position:relative;'>";
								
								
								echo "<div id='imageBox'>";
									echo "<ul id='imageSlider'  style='position:absolute;list-style:none;left:0'>";
										$imgTot = count($items_images);
										
											$border_color = ''; $imgIDs=array();
											foreach($items_images as $i=>$im)
											{
												extract($im);
												$imgIDS[] =$id;
												//SET GREEN BORDER IF DEFAULT
												if($defaultStatus == 1) $primaryIcon = 'check_icon.png';
												else $primaryIcon = 'check_icon_black.png';
												
												//IMAGE HIDDEN FIELD
												$imgT =  HTTP_PATH."img/thumb/$image";
												$imgS =  HTTP_PATH."img/small/$image";
												$imgB =  HTTP_PATH."img/big/$image";
												if(isset($duplicate))
												echo "<input type='hidden' name='images[]' value='$image'>";
											   
												  echo "<li class='fl' >
															<div id='tf$id' style='margin:5px;margin-top: -2px;'>
																<br/>
																<a href='#' onclick='chImg($i)'   id='imgs$id'  data-image='$imgS'  data-zoom-image='$imgB'><img   src='$imgT' alt='' style='border:3px solid gray;height:35px'/></a> <br>
																
															</div>
														</li>";
												$border_color='';
											}
										echo "</ul>";
									echo "</div>";
							echo "</div>";
							echo "<label class='fl' style='margin-top:15px' onclick='adjustRight()'> &nbsp; <img src='".HTTP_PATH."img/right.png' '> </label>";
						echo "</div>";
						
					}else {
						echo "<img src='".HTTP_PATH."img/small/blank.png' width='460' height='460' style='border: 1px solid #cccccc;'>";
					}
					?>
                </center>
                </td>

                        </tr>
                        <tr>
                            <td width="50%">
                                <?php 
								$CI =& get_instance();
								$CI->load->library('forms');						
								echo $CI->forms->form_header('SMBi','vendorFORM',$action);
								
								//HIDDEN ELEMENT
								echo "<input type='hidden' name='POSMStatusID' value='$POSMStatusID'>";
								
								//COUNTRY		
								if($_SESSION['super_admin']=='y'){
									echo $CI->forms->select('countryID','country','countryName',$CI2->fv->label(10),$countryID,$CI2->fv->v(10));
								}
								else{
									$countryID = $_SESSION['countryID'];
									echo "<input type='hidden' name='countryID' value='$countryID'>";
									echo $CI->forms->select('countryID','country','countryName',$CI2->fv->label(10),$countryID,$CI2->fv->v(10),'disabled');
								}
								
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
									if($CI2->fv->fieldChecker($POSMStatusID,12)=='y')
										echo $CI->forms->form_fields2('text','itemName',$itemName,$CI2->fv->label(11),$CI2->fv->v(11));
								?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <?php 
									if($CI2->fv->fieldChecker($POSMStatusID,13)=='y')
										echo $CI->forms->form_fields2('textarea','Short_Description',$Short_Description,$CI2->fv->label(12),$CI2->fv->v(12));
								?>
                            </td>
                        </tr>                    
            
						<tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,5)=='y')
										echo $CI->forms->select('POSMTypeID','POSM_Type','typeName',$CI2->fv->label(4),$POSMTypeID,$CI2->fv->v(4));
								
								?>
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,6)=='y')	
										echo $CI->forms->select('OUTLETStatusID','OUTLET_Status','statusName',$CI2->fv->label(6),$OUTLETStatusID,$CI2->fv->v(6));
								
									
								?>
                            </td>
						</tr>
						<tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,10)=='y')	
										echo $CI->forms->select('MaterialTypeID','MATERIAL_Type','materialName',$CI2->fv->label(9),$MaterialTypeID,$CI2->fv->v(9));	
								
								?>
                            </td>
                        </tr> 
						<tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,3)=='y')
									$v = '';
									$v = isset($id) ? 'o' : $CI2->fv->v(2);
									echo $CI->forms->form_fields2('multiple_files','files[]','',$CI2->fv->label(2),$v);	
								?>
                            </td>
							<td>
                            	<?php 
										if($CI2->fv->fieldChecker($POSMStatusID,4)=='y')
											echo $CI->forms->select('brandID','brands','brandName',$CI2->fv->label(3),$brandID,$CI2->fv->v(3),''," where id in (select brandID from brandXref where countryID='".$_SESSION['countryID']."')");
								?>
                            </td>
						</tr>
                        <tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,7)=='y')
										echo $CI->forms->form_fields2('select_premium','PremiumTypeID',$PremiumTypeID,$CI2->fv->label(7),$CI2->fv->v(7));
								
								?>
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                            	<?php
									if($CI2->fv->fieldChecker($POSMStatusID,15)=='y')	
										echo $CI->forms->form_fields2('text','MOQ',$MOQ,$CI2->fv->label(14),$CI2->fv->v(14));
								?>
                            </td>
                            <td>
                            	<?php 
									//PUBLISH	
									echo "<input type='hidden' name='publish' value='y' id='publishInput'>";
									
									if($CI2->fv->fieldChecker($POSMStatusID,14)=='y')
										echo $CI->forms->form_fields2('text','UnitPrice',$UnitPrice,$CI2->fv->label(13),$CI2->fv->v(13));
								
								?>
                            </td>
                        </tr>                    
                        
                        <tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,16)=='y')
										echo $CI->forms->form_fields2('text','UOM',$UOM,$CI2->fv->label(15),$CI2->fv->v(15));
								?>
                            </td>
                            <td>
                            	<?php 
									//ADDITIONAL INFO
									if($CI2->fv->fieldChecker($POSMStatusID,22)=='y')
										echo $CI->forms->form_fields2('text','plant_inventory',$plant_inventory,$CI2->fv->label(54),$CI2->fv->v(54));
								?>
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,23)=='y')
										echo $CI->forms->form_fields2('text','supplier_stock_on_hand',$supplier_stock_on_hand,$CI2->fv->label(55),$CI2->fv->v(55));
								
								?>
                            </td>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,24)=='y')
										echo $CI->forms->form_fields2('text','date_first_issue',$date_first_issue,$CI2->fv->label(56),$CI2->fv->v(56));
								?>
                            </td>
                        </tr>                    
                        <tr>
                            <td>
                            	<?php 	
									if($CI2->fv->fieldChecker($POSMStatusID,25)=='y')
										echo $CI->forms->form_fields2('text','date_last_used',$date_last_used,$CI2->fv->label(57),$CI2->fv->v(57));	
								?>
                            </td>
                            <td>
                            	<?php 
									if($CI2->fv->fieldChecker($POSMStatusID,26)=='y')
										echo $CI->forms->form_fields2('text','activity_event_use',$activity_event_use,$CI2->fv->label(58),$CI2->fv->v(58));
								?>
                            </td>
                        </tr>                    
                        <tr>
                            <td rowspan="2">
                            	<?php if($CI2->fv->fieldChecker($POSMStatusID,2)=='y')
										echo $CI->forms->form_fields2('textarea','Long_Description',$Long_Description,$CI2->fv->label(1),$CI2->fv->v(1));
								?>
                            </td>
                            <td>&nbsp;</td>
                        </tr>                    
                        <tr>
                            <td>&nbsp;</td>
                        </tr>                    
                    </table>
					
                    <br/><br/>
				</div>
				
				<?php
				
					echo "<div class='clear'></div>";
					
					$f1 = $CI2->fv->fieldChecker($POSMStatusID,17);
					$f2 = $CI2->fv->fieldChecker($POSMStatusID,18);
					$f3 = $CI2->fv->fieldChecker($POSMStatusID,19);
					$f4 = $CI2->fv->fieldChecker($POSMStatusID,20);
					$f5 = $CI2->fv->fieldChecker($POSMStatusID,21);
					
					if($f1=='y' OR  $f2=='y' OR $f3=='y' OR $f4=='y' OR $f5=='y')
					{
					echo "<h2 class='form'>EXTRA FIELDS</h2>";
					echo "<div class='extraFieldDiv'>";
					
					if($CI2->fv->fieldChecker($POSMStatusID,17)=='y')
						echo $CI->forms->form_fields2('text','Fields0001',$Fields0001,$CI2->fv->label(16),$CI2->fv->v(16));
					
					if($CI2->fv->fieldChecker($POSMStatusID,18)=='y')
						echo $CI->forms->form_fields2('text','Fields0002',$Fields0002,$CI2->fv->label(17),$CI2->fv->v(17));
					
					if($CI2->fv->fieldChecker($POSMStatusID,19)=='y')
						echo $CI->forms->form_fields2('text','Fields0003',$Fields0003,$CI2->fv->label(18),$CI2->fv->v(18));
					
					if($CI2->fv->fieldChecker($POSMStatusID,20)=='y')
						echo $CI->forms->form_fields2('text','Fields0004',$Fields0004,$CI2->fv->label(19),$CI2->fv->v(19));
					
					if($CI2->fv->fieldChecker($POSMStatusID,21)=='y')
						echo $CI->forms->form_fields2('text','Fields0005',$Fields0005,$CI2->fv->label(20),$CI2->fv->v(20));
						
					echo "</div>";
					}
				?>
			</div>
			<?php
			if(isset($id)){
			$date = $DateLastEdited;
			$DateLastEdited = ($DateLastEdited!='0000-00-00') ?  date('M j, Y', strtotime($date)) : $DateLastEdited='-';
			
			echo "<div style='clear:both;margin:5px'> </div>";
			echo "	  <p style='font-size:12px;text-align:left;margin-bottom:10px;margin-left:30px;'> 
						<b>Date Added:</b> ".  date('M j, Y', strtotime($dateAdded)) ."<br/>
						<b>Last Update:</b> $DateLastEdited <br/>
					 </p><br/>";
			}
			?>
			
			</div>
			<!-- ITEM FORM -->
		
		
			<div class="clear"></div>
			
				<div id="item_vendors" style="display:none;width:95%;margin-left: 25px;">
				
					<?php
						//VENDORS
						$i=1;
						$j=1;						
						foreach($vendors as $d){
						$checked="";
						extract($d);
						
							//CHECK IF SELECTED
							if($selectedVendor!=NULL)
							{
								foreach($selectedVendor as $sV)
								{
									extract($sV);
									if($selectedVendorID==$vID)
										$checked = "checked";
								}
							}
					?>
				
					<div class="drop-down" style="cursor:pointer;">
						<span class="ven"> <h2><input type="checkbox" <?php echo $checked ?> name="multipleVendors[]" value="<?php echo $vID ?>" style="vertical-align:text-top;margin-right:10px;">  <?php echo $company_name ?></h2></span>
						<span class="arrow" onclick="showCompany('<?php echo "info_company".$i++ ?>')"><img src="<?php echo HTTP_PATH ?>/img/arrow-down.jpg"  width="21" height="15" /></span>
						<div class="clear"></div>
					</div>
					
					<div class="info-company" style="display:none" id='info_company<?php echo $j++ ?>'>
						<table border="0">
							<tr>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">COMPANY NAME </h2><br/><br/>
										<p align="left"> <?php echo $company_name ?> </p>
									</span>
								</td>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">CONTACT PERSON</h2><br/><br/>
										<p align="left"> <?php echo $fname ." ". $mname ." ".  $lname  ?> </p>
									</span>
								</td>
							</tr>
							<tr>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">BILLING ADDRESS </h2><br/><br/>
										<p align="left"> <?php echo $billing_address ?> </p>
									</span>
								</td>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">TELEPHONE </h2><br/><br/>
										<p align="left"> <?php echo $telephone ?> </p>
									</span>
								</td>							</tr>
							<tr>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">EMAIL ADDRESS </h2><br/><br/>
										<p align="left"> <?php echo $telephone ?>  </p>
									</span>
								</td>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">COUNTRY </h2><br/><br/>
										<p align="left"> <?php echo $countryName ?> </p>
									</span>
								</td>
							</tr>
							<tr>
								<td style="width: 470px;" align="left">
									<span class="info-right">
										<h2 align="left">POSTAL CODE </h2><br/><br/>
										<p align="left"> <?php echo $postal_code ?>  </p>
									</span>
								</td>
								<td style="width: 400px;" align="left">
									<span class="info-right">
										<h2 align="left">CITY CODE </h2><br/><br/>
										<p align="left"> <?php echo $city_state ?> </p>
									</span>
								</td>
							</tr>
						</table>
					</div>
				
				<?php } ?>
				
				</div>
				
			</div>
			
        </div>
		
        <div class="clear"></div>
    </div>

			
			
	
<style>
#mask2 {
	position: absolute;
	left: 0;
	top: 0;
	z-index: 90000;
	background-color:black;
	display: none;
}

.popupBox {
	
	min-height: 900px;
	position: absolute;
	width:90%;
	left: 0;
	top: 0;
	display: none;
	z-index: 99999;
	padding: 20px; 
}
 
</style>	
	
   		     <div class="popupBox" style='opacity:1;' id="dialog" >
			 <div class='close2' style='color:white;font-size:20px;margin-right:50px;float:left;padding:0;cursor:pointer'> close </div>
			 <div style='clear:both'></div>
			 <iframe  src='google.com' style='height:800px;border:0;width:90%;margin:0 auto' id='popUpFrame'> </iframe>
			 </div>	
			 <div id="mask2"> </div>
			
	
	<script>
	
	 function zoom(id)
	  { 
		 var img  =  $('#zoom').attr('src');
		 img  =img.substring(img.lastIndexOf('/')+1,img.length);
		
		 document.getElementById('popUpFrame').src = "<?php echo HTTP_PATH ?>gallery/itemzoom/" +id +'/'+img;
		 var maskHeight = $(document).height();
		 var maskWidth = $(window).width();
		 $('#mask2').css({'width':maskWidth,'height':maskHeight});	
		 $('#mask2').fadeIn(1500);	
		 $('#mask2').fadeTo("slow",0.8);
		 var winH = $(window).height();
		 var winW = $(window).width();
		 $('#dialog').css('top',50);
		 $('#dialog').css('left', winW/2-$('#dialog').width()/2);
		 $('#dialog').fadeIn(3000);
         $('#dialog').css('opacity',1);  		 
	   }
   
 	
  
	$('.close2').click(function (e) {
		e.preventDefault();
		$('#mask2').hide();
		$('#dialog').hide();
	});	
	//if mask is clicked
	$('#mask2').click(function () {
		$(this).hide();
		$('#dialog').hide();
	});	
	
	
	var adjusVal = 0;
	var curImgIndex = 0;
	var TotIMG = <?php echo count($imgIDS) ?>;
	
	var imgIDS = new Array(<?php   foreach($imgIDS as $k=> $id) { if($k<count($imgIDS)-1) echo "$id,"; else echo "$id" ; }?>);
	 
	var SliderWidth = $('#imageSlider li').length ;
	SliderWidth = SliderWidth * 60;
	var cl = 0  ;
	var imgSmallWidht = $('#zoom').css('width');
	var imgSmallheight = $('#zoom').css('height');
	 if(imgSmallheight > imgSmallWidht) $('#zoom').css('height',500);
	 if(imgSmallheight < imgSmallWidht) $('#zoom').css('width',450);
	function imgs(index)
	  {
	    if((index+curImgIndex) < TotIMG && (index+curImgIndex) >=0)
		  {  
		    if((curImgIndex +1) % 5 == 0 && index==1 )
			 { cl = cl-300;$('#imageSlider').animate({left:cl},500);}
			if((curImgIndex +1) % 5 == 0 && index==-1  )
			 {cl = cl+300;$('#imageSlider').animate({left:cl},500);}
			 
			$('#imgs'+imgIDS[curImgIndex] + ' img').css('border','3px solid gray');
			curImgIndex = index+curImgIndex;
		    $('#imgs'+imgIDS[curImgIndex] + ' img').css('border','3px solid red');
		    $('#imgs'+imgIDS[curImgIndex]).trigger('click');
			var lpos = $('#imageSlider').offset();
		    var lpos = lpos.left;
		  
			
			
		   //alert(imgIDS[curImgIndex]);
		  }
		 
		 
	  }
	  
	 function chImg(i)
	  {
	   $('#imgs'+imgIDS[curImgIndex] + ' img').css('border','3px solid gray');
	   curImgIndex = i;
	   $('#imgs'+imgIDS[curImgIndex] + ' img').css('border','3px solid red');
	  }
	function adjustLeft()
	{	
		var ctr=0;
		var lpos = $('#imageSlider').offset();
		var lpos = lpos.left;
		//alert(SliderWidth); 
		if(cl-300>(SliderWidth*-1)) {cl = cl-300; $('#imageSlider').animate({left:cl},500); }
		
	}
	
	function adjustRight()
	{	
		var lpos = $('#imageSlider').offset();
		var lpos = lpos.left;
		if(cl+300<=0) {cl = cl+300; $('#imageSlider').animate({left:cl},500); }
	
	}
	
	
	function StopPar()
	{
		document.getElementById('publishInput').value = 'n';
		$('#vendorFORM').parsley().destroy();
		//$('#vendorFORM').parsley('destroy');
	}
	
	
	
	function enlargeThumbnail(img)
	{
	
		document.getElementById('smallThum').src = "<?php echo HTTP_PATH?>img/small/" + img ;
	
	}
	
	function deleteOneImg(id,itemID)
	{
		if(confirm("Are you sure you want to delete this thumbnail?"))
		{
			
			var xmlhttp2;
			var file = '<?php echo HTTP_PATH ?>itemDatabase/deleteOneImg/'+id+'/'+itemID;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp2=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp2.onreadystatechange=function()
			  {
			  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
				{
			 
					if(xmlhttp2.responseText==true)
						location.reload();
				}
			  }
			xmlhttp2.open("GET",file,true);
			xmlhttp2.send();
		}
	}
	
	function setDefaultImg(id,itemID)
	{
		if(confirm("Are you sure you want to set this as default Image for this product?"))
		{
			var xmlhttp2;
			var file = '<?php echo HTTP_PATH ?>itemDatabase/setDefaultImg/'+id+'/'+itemID;
			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp2=new XMLHttpRequest();
			  }
			else
			  {// code for IE6, IE5
			  xmlhttp2=new ActiveXObject("Microsoft.XMLHTTP");
			  }
			xmlhttp2.onreadystatechange=function()
			  {
			  if (xmlhttp2.readyState==4 && xmlhttp2.status==200)
				{
			 
					if(xmlhttp2.responseText==true)
						location.reload();
				}
			  }
			xmlhttp2.open("GET",file,true);
			xmlhttp2.send();
		
		}
	}
	
	
	function showItemDescription(id)
	{
		var x = document.getElementById(id);
		var y = document.getElementById('item_vendors');
		
		document.getElementById('tab1').className = 'button-content2';
		document.getElementById('tab2').className = 'button-content1';
		
		if(x.style.display == "none")
		{
			x.style.display="block";
			y.style.display="none";
		}
	}
	
	function showItemVendors(id)
	{
		var x = document.getElementById(id);
		var y = document.getElementById('item_description');
        
		document.getElementById('tab2').className = 'button-content2';
		document.getElementById('tab1').className = 'button-content1';
		
		
		if(x.style.display == "none")
		{
			x.style.display="block";
			y.style.display="none";
		}
		
	}
	
	function showCompany(info_company)
	{
		var x = document.getElementById(info_company);
		
		if(x.style.display == "none")
		{
			x.style.display = "block";
		}else
		{
			x.style.display = "none";
		}
	}
	
	 
</script>
<script src="<?php echo HTTP_PATH?>js/jquery.elevateZoom-3.0.8.min.js"></script>
<script>
    $("#zoom").elevateZoom({ensSize:45,gallery:'imageSlider', cursor: 'pointer', galleryActiveClass: 'active', loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'}); 
</script>	
	
	
	
	