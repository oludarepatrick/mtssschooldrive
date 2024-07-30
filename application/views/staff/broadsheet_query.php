<div class="m-content">
<div class="panel_bg_2">
<div class="flex-grid">
<form id="form1" name="form1" method="post" action="">
	<div class="row flex-just-sb">
	<div class="cell colspan2">
	<div class="input-control full-size">
	<select name="classes" class="select">
 	<option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php  foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
      <select name="class_arm" class="select">
        <option value="<?php echo set_select('class_arm', '', TRUE); ?>">SELECT ARMS</option>
        <?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
        <?php } ?>
      </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
  <select name="term" class="select">
    <option value="<?php echo set_select('term', '', TRUE); ?>">SELECT TERM</option>
    <option value="FIRST TERM" >FIRST TERM</option>
    <option value="SECOND TERM" >SECOND TERM</option>
	 <option value="THIRD TERM" >THIRD TERM</option>
  </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
<select name="session" class="select">
        <option value="<?php echo set_select('session', '', TRUE); ?>">SELECT SESSION</option>
      	<?php foreach($sessions as $s) { ?>
      	<option value="<?php echo $s->session; ?>"><?php echo $s->session; ?></option>
      	<?php } ?>	
      </select>
	  </div>
	  </div>
	  <div class="cell colspan2">
	  <input type="submit" value="Send"/>
	  <input  type="hidden" name="class_arm_selected" class="class_arm_selected" value="" />
	  </div>
	</div>
</form>
</div>
</div>

