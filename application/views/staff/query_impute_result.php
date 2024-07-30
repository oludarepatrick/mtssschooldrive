<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body>
<?php //echo $message; ?>
<div class="m-content">
<div class="panel_bg_2">
<div class="flex-grid">
<form action="" method="get">
<div class="row flex-just-sb">
<div class="cell colspan3">
<div class="input-control full-size">
<select name="classes" class="select">
 <option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php $i=0;  foreach($query_class->result() as $val){ $i+=1;?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
<select name="class_arm" class="select">
        <option value="<?php echo set_select('class_arm', '', TRUE); ?>">--ARMS--</option>
      	<?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
     <?php } ?>
      </select>
      </div>
      </div>
      <div class="cell colspan2">
      <div class="input-control full-size">
        <select name="select" class="select">
          <option value="">--SELECT--</option>
          <?php foreach($query_subject->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('subject',}else{?>
          <option value="<?php echo $val->course;?>" ><?php echo $val->course;?> </option>
          <?php } ?>
        </select>
      </div>
		</div>
<div class="cell colspan2">
<div class="input-control full-size">
  <select name="term" class="select">
        <option value="<?php echo set_select('term', '', TRUE); ?>">--TERM--</option>
        <option value="FIRST TERM">FIRST TERM</option>
        <option value="SECOND TERM">SECOND TERM</option>
        <option value="THIRD TERM">THIRD TERM</option>
      </select>
</div>
</div>
	  
	  
</div>
	  <div class="cell colspan2">
	   <input type="submit" name="submit" value="Send" class="button success" />
	   </div>
	 


</form>
</div>
</div>
</div>
</body>
</html>
