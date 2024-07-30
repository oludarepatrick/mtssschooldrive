<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
 <div class="m-content">
<form method="post" action="enter_result" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<input type="hidden" value="<?php echo $term; ?>" name="term" />
		<div class="panel" style="top: 1.00003px; left: -10px; width: 129%;">
<div class="heading">
        <span class="mif-keyboard icon"></span>
        <span class="title">RESULT IMPUTATION FOR <?php if(isset($val->subject)){echo $val->subject;}else{echo $subject;} ?> <label style="float:right; margin-right: 25px;"><?php if ($query_student->num_rows() > 0)
{
   $row = $query_student->row();

   echo $row->class; echo " "; echo $row->class_division; 
   //echo $row->name;
   //echo $row->body;
} 
	
	?></label></span>
    </div>
    <?php 
    if($message!="") {echo "<h4 class='message_bg_1'>".$message."</h4>";} ?>
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
    <input type="text" value="<?php if(isset($val->exam)){echo $val->exam;} ?>" name="<?php echo 'a'.$val->student_id."[]"; ?>" size="7" data-validate-hint-position="top" data-validate-arg="60" data-validate-func="max"  data-validate-func="number"           
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
	</div>

</body>
</html>

<script>
        function notifyOnErrorInput(input){
            var message = input.data('validateHint');
            /*$.Notify({
                caption: 'Error',
                content: message,
                type: 'alert'
            });*/
        }
    </script>
