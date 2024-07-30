
<style type="text/css">
<!--
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style33 {color: #000000}
.style34 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style33 {color: #000000}
.style34 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style36 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
.style37 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style33 {color: #000000}
.style34 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style37 {color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif;}
-->
</style>
<body>
<div class="m-content">
  <div class="tabcontrol" data-role="tabcontrol">
  <ul class="tabs">
        <li><a href="#frame1">School Details</a></li>
        <li><a href="#frame2">Term | Session</a></li>
		<li><a href="#frame3">School Logo</a></li>
		<li><a href="#frame4">School Calender</a></li>
    </ul>
    <div class="frames">
<div class="frame" id="frame1">
<div class="flex-grid">
<form id="form1" name="form1" method="post" action="school_settings/school_details">
	<?php
    foreach ($schinfo->result() as $row){
    ?>
<h4 class="head_bg_2"> SCHOOL DETAILS </h4>
<h6 class="message_bg_1"> <?php echo $sucess; ?></h6>
<div class="row">
<h6><?php echo form_error('schname');?></h6>
<div class="cell colspan5"><p>School Name:</p></div>
<div class="cell colspan7">
		<div class="input-control text full-size">
        <input name="schname" type="text" size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->name;} ?>" />
		</div>
</div>
</div>
<div class="row">
<h6><?php echo form_error('schmotto');?></h6>
<div class="cell colspan5"><p>School Motto: </p></div>
<div class="cell colspan7">
	<div class="input-control text full-size">
    <input name="schmotto" type="text" size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->slogan;} ?>" />
	</div>
</div>
</div>
<div class="row">
<h6 class="tx-red"><?php echo form_error('address');?></h6>
<div class="cell colspan5"><p>Address:</p></div>
<div class="cell colspan7">
	<div class="input-control textarea full-size">
	  <textarea name="address"><?php if(empty($row)){ echo " "; }else{ echo $row->address;} ?></textarea>
  </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Postal Address: </p></div>
<div class="cell colspan7">
	<div class="input-control textarea full-size">
    <textarea name="postal"><?php if(empty($row)){ echo " "; }else{ echo $row->postal_add;} ?></textarea>
  </div>
</div>
</div>
<div class="row">
<h6 class="tx-red"><?php echo form_error('email');?></h6>
<div class="cell colspan5"><p>Email</p></div>
<div class="cell colspan7">
		<div class="input-control text full-size">
        <input name="email" type="text" size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->email;} ?>" />
    </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>Website</p></div>
<div class="cell colspan7">
	  <div class="input-control text full-size">
	  <input name="website" type="text"  size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->web_add;} ?>" />
  </div>
</div>
</div>
<div class="row">
<h6 class="tx-red"><?php echo form_error('phone');?></h6>
<div class="cell colspan5"><p>Phone Number: </p></div>
<div class="cell colspan7">
	  <div class="input-control text full-size">
	  <input name="phone" type="text"  size="40" value="<?php if(empty($row)){ echo " "; }else{ echo $row->phone;} ?>" />
    </div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>School Level: </p></div>
<div class="cell colspan7">
<div class="input-control full-size">
        <select name="schlevel" class="select">
          <option value="">--SELECT---</option>
          <option value="1">NURSERY | PRIMARY</option>
          <option value="2">SECONDARY</option>
        </select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>SEPERATE SETTING FOR JUNIOR &amp; SENIOR </p></div>
<div class="cell colspan7">
<div class="input-control full-size">      
      <select name="junsenior" class="select">
        <option value="">---SELECT-----</option>
        <option value="Y">YES</option>
        <option value="N">NO</option>
      </select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">
       <input type="submit" name="submit" value="Update" class="button success loading-pulse lighten primary">
</div>
</div>
</form>
</div>
</div>
<div class="frame" id="frame2">
<div class="flex-grid">
<form id="form2" name="form2" method="post" action="">
<h4 class="head_bg_2">TERM AND SESSION SETTING </h4>
<div class="row">
<div class="cell colspan5">
<div class="input-control full-size">
<input type="text">
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>CURRENT SESSION: </p></div>
<div class="cell colspan7">
<div class="input-control full-size">
        <select name="session" class="select">
        <option value="<?php echo set_select('session', '', TRUE); ?>">SELECT SESSION</option>
      	<option value="2010/2011">2010/2011</option>
		<option value="2011/2012">2011/2012</option>
		<option value="2012/2013">2012/2013</option>
		<option value="2013/2014">2013/2014</option>
		<option value="2014/2015">2014/2015</option>
		<option value="2015/2016">2015/2016</option>
		<option value="2016/2017">2016/2017</option>
		<option value="2017/2018">2017/2018</option>
		<option value="2018/2019">2018/2019</option>
		<option value="2019/2020">2019/2020</option>
		<option value="2020/2021">2020/2021</option>
		<option value="2021/2022">2021/2022</option>
		<option value="2022/2023">2022/2023</option>
		<option value="2023/2024">2023/2024</option>
		<option value="2024/2025">2024/2025</option>		
      </select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">
<p>CURRENT TERM: </p>
</div>
<div class="cell colspan5">
<div class="input-control">
    <select name="term" class="select">
        <option value="<?php echo set_select('term', '', TRUE); ?>">SELECT TERM</option>
      	<option value="FIRST TERM">FIRST TERM</option>
		<option value="SECOND TERM">SECOND TERM</option>
		<option value="THIRD TERM">THIRD TERM</option>
		</select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">
<p>RESULT INPUT TYPE: </p>
</div>
<div class="cell colspan5">
<div class="input-control">
      <select name="result_type" class="select">
        <option>SELECT TYPE</option>
        <option value="CA">CA</option>
        <option value="EXAM">EXAM</option>
        <option value="BOTH">BOTH</option>
      </select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5"><p>TERM FOR RESULT INPUT: </p></div>
<div class="cell colspan5" style="background-color: #ddd">
<div class="input-control full-size">
<select name="input_term" class="select full-size">
        <option value="<?php echo set_select('term', '', TRUE); ?>">SELECT TERM</option>
      	<option value="FIRST TERM">FIRST TERM</option>
		<option value="SECOND TERM">SECOND TERM</option>
		<option value="THIRD TERM">THIRD TERM</option>
		<option value="ALL TERMS">ALL TERMS</option>
		</select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">    
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">
</div>
</div>
</form>
</div>
</div>

<div class="frame" id="frame3">
<div class="flex-grid">
<form action="" method="post" enctype="multipart/form-data" name="form3" id="form3">
<h4 class="head_bg_2">TERM AND SESSION SETTING</h4> 
<div class="row">
<div class="cell colspan5"><p>UPLOAD SCHOOL LOGO: </p></div>
<div class="cell colspan5">


    <div class="input-control file" data-role="input">
        <input type="file" name="file" size="20">
        <button class="button"><span class="mif-folder"></span></button>
    </div>


</div>
</div>
<div class="row">
<div class="cell colspan5">
       <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">
</div>
</div>
</form>
</div>
</div>
<div class="frame" id="frame4">
<div class="flex-grid">
<form id="form4" name="form4" method="post" action="">
<div class="row flex-just-sb">
<div class="cell colspan5">
<label>School Resumption Date</label>
<div class="input-control text full-size" data-role="datepicker" data-format="dd/mm/yyyy">
    <input name="resume_date" type="text">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan5">
<label> School Closing Date</label>
<div class="input-control text full-size" data-role="datepicker" data-format="dd/mm/yyyy">
    <input name="closing_date" type="text">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan5">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">
</div>
</div>
</form>
</div>
</body>

<?php }?>
<!--<link rel="stylesheet" href="<?php //echo base_url();?>asset/css/metro.css" />
<script src='<?php //echo base_url();?>asset/js/metro.js'></script>-->