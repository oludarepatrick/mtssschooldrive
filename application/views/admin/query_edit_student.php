<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body>

<div class="m-content">
<div class="panel_bg_2">

<div class="flex-grid">
<form action="" method="post"  data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<div class="row flex-just-sb">

<div class="cell colspan4">
<label>Please Enter Student Id</label>
	  <div class="input-control ">
	  <input type="text" name="stud_id" placeholder="Type Student Id Here" data-validate-hint-position="bottom"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
			<?php echo $message; ?>
	  </div>
	  </div>
	  <div class="cell colspan8">
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