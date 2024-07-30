<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <?php //echo form_open('student/forgotPassword'); ?>
<body>
 <div class="m-content">
<form method="post" action="" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<input type="hidden" value="<?php //echo $term; ?>" name="term" />
		<div class="panel" style="top: 1.00003px; left: 30%; width: 70%;">
<div class="heading">
        <span class="mif-keyboard icon"></span>
        <span class="title">PASSWORD RECOVERY </label></span>
    </div>
    
	<div class="content" style="align:center">
<table class="table striped hovered cell-hovered border">  

	<thead>
        <tr>
            
            <th>Names</th>
            <th>Admission No</th>
			<th>Username</th>
            <th>Password</th>
			
			
        </tr>
    </thead>
	<tbody>
	<?php  foreach($recoverPass->result() as $val){ 
	
	?>
	<tr>
	
	<td>
	<div class="input-control ">
	<input type="text" size="40" readonly="readonly" value="<?php echo $val->surname; echo " "; echo $val->firstname; echo " "; echo $val->othername; ?>" />
	</div>
	</td>
	<td>
	<div class="input-control ">
	<input type="text" size="4" readonly="readonly" value="<?php echo $val->student_id; ?>" name="<?php //echo 'a'.$val->student_id."[]"; ?>" />
	</div>
	</td>
	<td>
	<div class="input-control" data-role="">
   <input type="text" readonly="readonly" value="<?php if(isset($val->username)) {echo $val->username;} ?>" name="<?php //echo 'a'.$val->student_id."[]"; ?>">
</div>
	</td>
	<td>
	<div class="input-control" data-role="">
    <input type="text" readonly="readonly" value="<?php if(isset($val->password)){echo $val->password;} ?>" name="<?php //echo 'a'.$val->student_id."[]"; ?>">
    	
</div>
	</td>
		<?php }?>
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
