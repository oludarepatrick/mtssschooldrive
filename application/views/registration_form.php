

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style>
		#bd{ border:1px solid #C9C9C9; background-color: #FAFAFA}
		legend{ font-size:16px; color:#09F;}
		.chk-label{ color:#03C; position:relative; top:3px}
		#req{ color:#FF0000; font-size:18px; font-weight:bold;}
		#req2{ color:#FF0000; font-size:10px;}

.error{
		margin:1% auto auto 30%;
		padding:10px 4px 10px 10px;
		color:red;
		border:1px solid #800000;
		width:588px;
		vertical-align:middle;
		padding-top:10px;
		background-color: #FCBEC5; 
		font-size:14px;
		letter-spacing:1px;
		
		}
	.text-error{ vertical-align:top}
	INPUT#t1{
	border:1px solid #BEBEBE;
	height:25px;
	color: #4A4A4A;
	background: #FFF4FF;
	-webkit-border-radius: 0 10px 10px 0;
	-moz-border-radius: 0 10px 10px 0;
	margin-left: 3px;
	width:90%; 
	}
	INPUT#tb1 { height:30px;
				width: 300px;
				background-color:#FFFFFF;
				font-size: 14px;
				color:#000033
				}
				INPUT#tb2{ height:30px;
				width: 300px;
				background-color:#FFFFFF;
				font-size: 14px;
				color:#000033;
				overflow:visible;
				}
	INPUT:focus{
				border-style:solid;
				border-color:#FF9900;
				
				}
	BUTTON#btn { width:90px; height:20px; background-color:#000033; color:#FFFF00; font-size:14px;}
	BUTTON:focus{
					border-style:solid;
					border-color:#0000FF;}

</style>
<?php echo link_tag('css/mystyles.css');?>
<?php echo form_open('receipt');?>
<?php echo $sucess; ?>

<body>
<!---->
 <div id="bd">
<div></div>
<?php // base_url("asset/headstonelogo.jpg");?>
 <span class="girl"><?php echo img(array('src'=>'asset/images/headstonelogo.png', 'width'=>300, 'heigth'=>50))?></span>
 <div class="hd_title"align="center" ><span > GENERAL SETTINGS</span>
<!---------------------------------------------------------------------------------------------------------------------------------
													DIV TABS
 ---------------------------------------------------------------------------------------------------------------------------------->

  <div class="girl"></div>
      <!-- /* <li><a href="#tab_menu1"><span>Company Info</span></a></li>*/-->
        
       
<!----------------------------------------------- ------------------------------------------------------------------------------
													SCHOINFO FORM   
 --------------------------------------------------------------------------------------------------------------------------------><!--<div id="tab_menu1">-->
<form  id="infoForm" method="get" action=""  >

     <?php
    foreach ($result->result() as $row){
    ?>
    
    	<table width="200"   border="0">
		
    	  <tr>
		  <td colspan="4" ><legend align="left">COMPANY INFO</legend><div class="req"  align="right" >REQUIRED<label id="req">*</label>&nbsp;&nbsp;<?php //echo img($star);?>&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>
		  <tr>
		  <td><label for="companyname">Company Name<label id="req">*</label><label id="req2"><?php echo form_error('compname');?></label></label><input type="text" size="30" name="compname"  class="input" value="<?php if(empty($row)){ echo " "; }else{ echo $row->companyname;} ?>" /></td><td></td>
       <!-- <input type="hidden" class="input" value="schinfo" name="schinfoForm" />--><!-- this is ti set the AjaxPost data on controller-->
    <td><label for="address">Company Address<label id="req">*</label><label id="req2"><?php echo form_error('address');?></label></label>
    	
      <textarea name="address" class="input" id="tb2"><?php if(empty($row)){ echo " "; }else{ echo $row->address;}?>
      </textarea></td>
	
    <td> </td>
     <td>&nbsp;</td>
 	 <td> </td>
 </tr>   
    	<tr><td><label for="postal">Postal</label>
            <textarea name="postal" cols="20" class="input"><?php  if(empty($row)){ echo " "; }else{ echo $row->postal;}?>
            </textarea></td>
    
	 
    	<td><label for="web_add">Web Address</label>
          <input name="site" type="text" class="input" size="20" value="<?php if(empty($row)){ echo " "; }else{ echo  $row->site;}?>
          "></td>
    <td><label for="slogan">Company Slogan</label>
        <input type="text" name="slogan"  class="input" value="<?php if(empty($row)){ echo " "; }else{  echo $row->slogan; }?>" /> </td>
    	<td></td></tr>
    
    <tr><td><label for="phone">Phone 1<label id="req">*</label><label id="req2"><?php echo form_error('phone1');?></label></label>
        <input type="text" name="phone1" class="input"  value="<?php /*echo set_value('phone1');*/ if(empty($row)){ echo " "; }else{ echo $row->phone1;}?>"/></td>
    <td><label for="slogan">Vat No
      <label id="req">*</label><label id="req2"><?php echo form_error('vatno');?></label></label>
        <input type="text" name="vatno" class="input"  value="<?php //if(empty($row)){ echo " "; }else{ echo $row->vatno;}?>"/></td>
		<td><label for="email">Email 1<label id="req">*</label><label id="req2"><?php echo form_error('email1');?></label></label>
      <input type="text" name="email1" class="input" size="30" value="<?php if(empty($row)){ echo " "; }else{ echo $row->email1;}?>" /></td>
   
   <td></td>
    
    
       <td> </td>
        </tr>
    
    <tr>
	<td> <label for="phone">Phone 2</label>
        <input type="text" name="phone2" class="input"  value="<?php  if(empty($row)){ echo " "; }else{ echo $row->phone2;}?>"/></td>
   
    	 <td> 
        <input type="hidden" class="input" value="schinfo" name="schinfoForm" /></td><td class="star"><label for="email">Email 2</label>
        <input type="text" name="email2" size="30" class="input" value="<?php  if(empty($row)){ echo " "; }else{ echo $row->email2;}?>" /></td>
 </tr>
 <tr> 
    	<td><label for="phone">Phone 3</label>
          <input type="text" name="phone3" class="input"  value="<?php if(empty($row)){ echo " "; }else{ echo $row->phone3;}?>"/></td><td class="star"><label for="slogan">Reference No<label id="req">*</label><label id="req2"><?php echo form_error('refrence');?></label></label>
        <input type="text" name="refrence" class="input"  value="<?php if(empty($row)){ echo " "; }else{ echo $row->referenceno;}?>"/></td>
        	<td></td><td class="star"></td></tr>
    	<tr>
		<td></td><td class="star"><label for="schoolname">Bank Account Name<label id="req">*</label><label id="req2"> <?php echo form_error('accountname');?></label></label> <input type="text" size="30" name="accountname"  class="input" value="<?php if(empty($row)){ echo " "; }else{ echo $row->accountname;} ?>" /></td><td></td>
		</tr>
    <tr>
    	<td><label for="slogan">Bank 1<label id="req">*</label><label id="req2"><?php echo form_error('bank1');?></label></label>
        <input type="text" name="bank1"  class="input" value="<?php  if(empty($row)){ echo " "; }else{  echo $row->bank1; }?>" /></td><td></td><td><label for="slogan">Account Number 1<label id="req">*</label><label id="req2"><?php echo form_error('account1');?></label></label>
        <input type="text" name="account1" class="input"  value="<?php  if(empty($row)){ echo " "; }else{ echo $row->account1;}?>"/></td><td></td></tr>
    	<tr>
		<td><label for="slogan">Bank 2</label>
        <input type="text" name="bank2"  class="input" value="<?php if(empty($row)){ echo " "; }else{  echo $row->bank2; }?>" /></td><td><label for="slogan">Account Number 2</label>
        <input type="text" name="account2" class="input"  value="<?php  if(empty($row)){ echo " "; }else{ echo $row->account2;}?>"/></td><td><label for="slogan">Bank 3</label>
        <input type="text" name="bank3"  class="input" value="<?php  if(empty($row)){ echo " "; }else{  echo $row->bank3; }?>" /></td>
		<td><label for="slogan">Account Number 3</label>
        <input type="text" name="account3" class="input"  value="<?php if(empty($row)){ echo " "; }else{ echo $row->account3;}?>"/></td>
		</tr>
    <tr>
    	<td><label for="slogan">Bank 4</label>
        <input type="text" name="bank4"  class="input" value="<?php if(empty($row)){ echo " "; }else{  echo $row->bank4; }?>" /> </td>   
   <td><label for="slogan">Account Number 4</label>
        <input type="text" name="account4" class="input"  value="<?php if(empty($row)){ echo " "; }else{ echo $row->account4;}?>"/></td>
		<td><label for="slogan">Bank 5</label>
        <input type="text" name="bank5"  class="input" value="<?php if(empty($row)){ echo " "; }else{  echo $row->bank5; }?>" /></td>
		<td><label for="slogan">Account Number 5</label>
        <input type="text" name="bank5" class="input"  value="<?php if(empty($row)){ echo " "; }else{ echo $row->account5;}?>"/></td>
   </tr>
   
   <tr>
     <td> 
	 <input type="submit" id="btn" name="save" value="Save"/>
	 </td>     
        </tr>
		<?php } ?>
		</table>
  </form>
</div>
	
	
<script type="text/javascript" >
$(function() {
    $( "#datepicker" ).datepicker();//this create a datepicker for u. u have to set something in the html part my-code6.html
  

    $( "#tabs" ).tabs();//this create a tab for you and den u have to set something in the html part my-code6.html
	  $( "input[type=submit], a, button" )//this create a button for u. u have to set something in the html part my-code6.html
      .button()
      .click(function( event ) {
        //event.preventDefault();
      
  });
  });
  </script>
