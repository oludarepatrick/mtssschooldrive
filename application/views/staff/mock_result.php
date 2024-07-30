<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo($this->session->flashdata('warning')); ?></h4>
<?php } ?>

<form action="" method="post">
<div class="row flex-just-sb">
<div class="cell colspan3">
<div class="input-control full-size">
<select name="class" class="select">
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
        <select name="subject" class="select">
          <option value="">--SELECT--</option>
          <?php foreach($query_subject->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('subject',}else{?>
          <option value="<?php echo $val->subject;?>" ><?php echo $val->subject;?> </option>
          <?php } ?>
        </select>
      </div>
		</div>
	  
	  
</div>
	  <div class="cell colspan2">
	   <input type="submit" name="submit" value="Send" class="button success" />
	   </div>
	 


</form>
<?php
    if(count($query_student->result())>0)
    { ?>
<form method="post" action="enter_mock" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
		<div class="panel" style="top: 1.00003px; left: -10px; width: 129%;">
<div class="heading">
        <span class="mif-keyboard icon"></span>
        <span class="title">RESULT IMPUTATION FOR <?php echo $post_data['class']." ".$post_data['subject'] ?> <label style="float:right; margin-right: 25px;"><?php if ($query_student->num_rows() > 0)
{
   $row = $query_student->row();

   echo $row->class; echo " "; echo $row->class_division; 
   //echo $row->name;
   //echo $row->body;
} 
	
	?></label></span>
    </div>
    <?php 
    if(isset($message)) {echo "<h4 class='message_bg_1'>".$message."</h4>";} ?>


	<div class="content">
<table class="table striped hovered cell-hovered border">  

	<thead>
        <tr>
            <th>Sn</th>
            <th>Names</th>
            <th>Admission No</th>
			<th>Ca(40)</th>
            <th>Exam(60)</th>
			
			
        </tr>
    </thead>
	<tbody>
	<?php $i=0; foreach($query_student->result() as $val){ $i+=1;
	
	?>
	<tr>
	<td>
	<div class="cell colspan5">
	<div class="input-control">
	<input type="text" size="3" readonly="readonly" value="<?php echo "$i "; ?>" />
	</div>
	</div>
	</td>
	<td>
	<div class="input-control ">
	<input type="text" size="40" readonly="readonly" value="<?php echo $val->surname; echo " "; echo $val->firstname; echo " "; echo $val->othername; ?>" />
	</div>
	</td>
	<td>
	<div class="input-control ">
	<input type="text" size="4" readonly="readonly" value="<?php echo $val->student_id; ?>" name="<?php echo 'a'.$val->student_id."[]"; ?>" />
	</div>
	</td>
	<td>
	<div class="input-control" data-role="">
   <input type="text" value="<?php if(isset($val->ca)) {echo $val->ca;} ?>" name="<?php echo 'a'.$val->student_id."[]"; ?>" size="7" data-validate-hint-position="top" data-validate-arg="40" data-validate-func="max"  data-validate-func="number"           
            data-validate-hint="Field cannot be Empty! <br>Maximum Number is: <h1>40!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>  
</div>
	</td>
	<td>
	<div class="input-control" data-role="">
    <input type="text" value="<?php if(isset($val->exam)){echo $val->exam;} ?>" name="<?php echo 'a'.$val->student_id."[]"; ?>" size="7" data-validate-hint-position="right" data-validate-arg="60" data-validate-func="max"  data-validate-func="number"           
            data-validate-hint=" Field cannot be Empty! <br>maximum number is: <h1>60!" >
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>  
    	
</div>
<input type="hidden" value="<?php if(isset($val->subject)){echo $val->subject;}else{echo $subject;} ?>" name="<?php echo 'a'.$val->student_id."[]"; ?>">
	</td>
		<?php }?>
	</tr>
	<tr>
	<td  colspan="5" align="right">
	<button type="submit" class="button">Submit</button>
	</td>
	</tr>

	</tbody>
	</table>
	</div>
	
	</div>

	</form>
	<?php } ?>
</div>

