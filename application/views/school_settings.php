<style>
#tabs{ 
	width:100%;
	margin-top:30px;
	font-size:80%;
	padding:0px;
	padding: 0px; 
    background: none; 
    border-width: 0px; 
		
	}
#tabs li{
	padding-left:0;
	padding-right:0;
	}
#tabs .ui-tabs-nav { 
    padding-left: 0px; 
    background: transparent; 
    border-width: 0px 0px 1px 0px; 
    -moz-border-radius: 0px; 
    -webkit-border-radius: 0px; 
    border-radius: 0px; 
} 
#tabs .ui-tabs-panel { 
    /*background: #f5f3e5 url(http://code.jquery.com/ui/1.8.23/themes/south-street/images/ui-bg_highlight-hard_100_f5f3e5_1x100.png) repeat-x scroll 50% top; */
    border-width: 0px 1px 1px 1px; 
}
</style>

<?php echo form_open('school_settings');?>
<div id="tab_menu1">
<form  id="schdetails" method="post" action=""  enctype="multipart/form-data">
<ol id="setting_style">
	<li>
    	<div> <input  id="save1" class="save" type="submit" name="submit" value="Save Changes" /></div>
    </li>
    <li>
    	<div><label for="schoolname">School Name</label></div>
        <input type="text" name="schoolname"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->name;} ?>" />
        <input type="hidden" class="input" value="schinfo" name="schinfoForm" /><!-- this is ti set the AjaxPost data on controller-->
    </li>
    <li>
    	<div><label for="slogan">School Slogan</label></div>
        <input type="text" name="slogan"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{  echo $schinfo->slogan; }?>" />
    </li>
    <li>
    	<div><label for="address">School Address</label></div>
        <input type="text" name="address"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->address;}?>" />
    </li>
    <li>
    	<div><label for="postal">Postal Address</label></div>
        <input type="text" name="postal"  class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->postal_add;}?>" />
    </li>
    <li>
    	<div><label for="email">Email</label></div>
        <input type="text" name="email" class="input" value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->email;}?>" />
    </li>
    <li>
    	<div><label for="web_add">Web Address</label></div>
        <input type="text" name="web_add"  class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo  $schinfo->web_add;}?>"/>
    </li>
    <li>
    	<div><label for="phone">Phone Number</label></div>
        <input type="text" name="phone" class="input"  value="<?php if(empty($schinfo)){ echo " "; }else{ echo $schinfo->phone;}?>"/>
    </li>
    
    <li>
    	<div><label for="level">School Level</label></div>
        <select class="span2"   name="level" id="level" >
        <option value="">-- SELECT LEVEL --</option>
        <option value="1" >Nursery/Primary</option>
        <option value="2">Secondary/College</option>
		</select>
    </li>
     <li id="ca-exam">
    	<div><label for="ca_exam">Separate CAs/Exam for Junior and Senior Classes</label></div>
        <select class="span2" size="1"  name="separate_ca_exam" >
        <option value="">--- SELECT ---</option>
        <option value="Y" >Yes</option>
        <option value="N">No</option>
		</select>
    </li>
    <li>
    	<div> <input  id="save1" class="save" type="submit" name="submit" value="Save Changes" /> </div>
    </li>
   
 </ol> 
 
</form>
</div>

<div id="tab_menu2">
<form  action="" method="post" id="termForm">
<ol id="setting_style">
	<li>
    	<div> <input  id="save2" class="save" type="submit"  name="submit" value="Save Changes" /> </div>
    </li>
    <li>
    <input type="hidden" class="input" value="term" name="termForm" />
    	<div><label for="session">Current Session</label></div>
        				<select name="session" id="select"  class="span3" >
    									<option value="" selected="selected">   --SELECT--</option>
										<option>2010/2011</option>
										<option>2011/2012</option>
										<option>2012/2013</option>
                                        <option>2013/2014</option>
										<option>2014/2015</option>
										<option>2015/2016</option>
                                        <option>2016/2017</option>
										<option>2017/2018</option>
										<option>2018/2019</option>
                                        <option>2019/2020</option>
										<option>2020/2021</option>
										<option>2021/2022</option>
										<option>2022/2023</option>
										<option>2023/2024</option>
										<option>2024/2025</option>
                                        <option>2025/2026</option>
										<option>2026/2027</option>
										<option>2027/2028</option>
                                        <option>2028/2029</option>
										<option>2029/2030</option>
										<option>2030/2031</option>
                                        <option>2031/2032</option>
										<option>2032/2033</option>
										<option>2033/2034</option>
										</select>
    </li>
    <li>
    	<div><label for="current_term">Current Term</label></div>
        <select class="span3" size="1"  name="current_term" >
        <option value="">   --SELECT--</option>
        <option value="First Term" >First Term</option>
        <option value="Second Term">Second Term</option>
         <option value="Third Term">Third Term</option>
		</select>
    </li>
    <li>
    	<div><label for="result_type">Result Input Type</label></div>
        <select class="span3" size="1"  name="result_type" >
      <option value="">--SELECT-- </option>
        <option value="CA" >CA Only</option>
        <option value="EXAM">Exam Only</option>
         <option value="ALL">All Results</option>
         
		</select>
    </li>
    <li >
    	<div><label for="input_status">Result Input Term</label></div>
        <select class="select" size="1"  name="input_status" >
      <option value=""> --SELECT--  </option>
        <option value="1" >First Term</option>
        <option value="2">Second Term</option>
         <option value="3">Third Term</option>
         <option value="4">All Terms</option>
         
		</select>
    </li>
   
    <li>
    	<div> <input  id="save2" class="save" type="submit"  name="submit" value="Save Changes" /> </div>
    </li>
 </ol>

 </form>
</div>
<div id="tab_menu3">
<form action="" method="post" id="calendar">
<ol id="setting_style">
	<li>
    	<div> <input  id="save3" class="save" type="submit"  name="submit" value="Save Changes" /> </div>
    </li>
    <li>
    	<div><label for="resumption">Resumption Date</label></div>
        <input type="text" id="datepicker" name="resumption"  class="input" />&nbsp;&nbsp;<span id="img"><?php //echo img($calendar);?></span>
        <input type="hidden" class="input" value="calendar" name="calendarForm" />
    </li>
    <li>
    	<div><label for="closingdate">Closing Date</label></div>
        <input type="text" id="datepicker2" name="closing" class="input" />&nbsp;&nbsp;<span id="img2"><?php //echo img($calendar);?></span>
        
    </li>
   
   
    <li>
    	<div> <input  id="save3" class="save" type="submit"  name="submit" value="Save Changes" /> </div>
    </li>
 </ol>
 
</form>
</div> 

<div id="tab_menu4">
<form id="imageform" method="post" enctype="multipart/form-data" >
<ol id="setting_style" class="cancel">
	<li>
       <div class="imgdiv">
             <div id="upload"></div> 
            	 <div class="progress">
                	<div class="bar"></div >
                	<div class="percent">0%</div >
                 	<!--/*<div id="status"></div>*/-->
             	</div>
			<input type="file" class="filestyle" name="userfile" id="photoimg"  data-input="true" data-classIcon="icon-plus" > 
         </div>
   </li>
</ol>
</form>
</div> 

<script type="text/javascript">

$(document).ready(function($){

		//Activate click event on tab navigation		
		$( "#tabs" ).tabs({ event: "click" });
		$( "#tabs_menu1" ).tabs({ event: "click" });
		</script>