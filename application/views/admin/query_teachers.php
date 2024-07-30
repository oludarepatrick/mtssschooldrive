<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body>

<div class="m-content">
<div class="panel_bg_2">
<?php echo $message; ?>
<div class="flex-grid">
<form action="" method="post"  data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<div class="row flex-just-sb">
<div class="cell colspan4">
	  <div class="input-control full-size ">
	  <select name="teachers" class="select">
	  <option value="<?php echo set_select('teachers', '', TRUE); ?>">SELECT TEACHERS</option>
	   <?php  foreach($get_teachers->result() as $val){?>
	  <option value="<?php echo $val->staff_id;?>"><?php echo $val->name;?></option>
	  
	   <?php } ?>
	  </select>
	  
	   </div>
	  </div>
	  <div class="cell colspan6">
	   <input type="submit" name="submit" value="Send" class="button success" />
	   </div>
	  
</div>


</form>
</div>
</div>
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