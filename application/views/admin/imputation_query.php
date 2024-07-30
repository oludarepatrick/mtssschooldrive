<div class="m-content">

<div class="panel_bg_2">
<div class="flex-grid">

<form id="form1" name="form1" method="post" action="">
	<div class="row flex-just-sb">
	<div class="cell colspan2">
	<div class="input-control full-size">
	<select name="classes" required="required">
 	<option value="">SELECT CLASSES</option>
 <?php  foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
      <select name="class_arm" required="required">
        <option value="">SELECT ARMS</option>
        <?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
        <?php } ?>
      </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
 <select name="subject" required="required">
        <option value="">SELECT SUBJECT</option>
		<?php  foreach($query_teacher_subject->result() as $val){?>
      	<option value="<?php echo $val->subject;?>" ><?php echo $val->subject;?></option>
			<?php }?>
      </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
 <select name="term" required="required">
 <option value="">SELECT TERM</option>
       <option value="FIRST TERM">FIRST TERM</option>
    <option value="SECOND TERM">SECOND TERM</option>
    <option value="THIRD TERM">THIRD TERM</option>
  </select>


	  </div>
	  </div>
	  <div class="cell colspan2">
	  <button type="submit" class="button success loading-pulse lighten primary">Send</button>
	  <!--<input type="submit" value="Send" class="button success loading-pulse lighten primary"/>-->
	  <input  type="hidden" name="class_arm_selected" class="class_arm_selected" value="" />
	  
	  </div>
	</div>
</form>
</div>
</div>

