<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="accordion" data-role="accordion">
<div class="frame">
        <div class="heading">Select Lesson Note By Teachers</div>
		
        <div class="content"><div class="input-control"> <select name="by_teacher" class="select">
	  <option value="<?php echo set_select('by_teacher', '', TRUE); ?>">SELECT TEACHERS</option>
	  <?php  foreach($query_teacher->result() as $val){?>
  <option value="<?php echo $val->name;?>" ><?php echo $val->name;?></option>
  <?php } ?>
      </select> </div>   <div>
        <button class="button success">Send</button>
    </div></div>
	  
    </div>

<div class="frame">
        <div class="heading">View Lesson Note Subject</div>
		
		<div class="content"><div class="input-control"><select name="by_subject">
	  <option value="<?php echo set_select('by_subject', '', TRUE); ?>">SELECT SUBJECT</option>
	  <?php  foreach($query_subject->result() as $val){?>
  <option value="<?php echo $val->course;?>" ><?php echo $val->course;?></option>
  <?php } ?>
      </select></div><div>
        <button class="button success">Send</button>
    </div></div>
    </div>
</div>
   
       
   
  


</body>
</html>