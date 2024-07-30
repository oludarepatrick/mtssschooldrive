<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<form method="post" data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
<div class="m-content">
<div class="flex-grid" >
<h4 class="head_bg_1">Overall Grades For Junior Classes </h4>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Min.%</label>
<div class="input-control ">
            <input type="text" name="min" size="7" data-validate-hint-position="top"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>        

</div>
</div>
<div class="cell colspan3">
<label>Max.%</label>
<div class="input-control">
<input type="text" name="max" size="7" data-validate-hint-position="top"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
</div>
</div>
<div class="cell colspan3">
<label>Grades</label>
<div class="input-control">
<input type="text" name="grades" size="7" data-validate-hint-position="top"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
</div>
</div>
<div class="cell colspan3">
<label>Remarks</label>
<div class="input-control">
<input type="text" name="remarks" size="9" data-validate-hint-position="top"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
</div>
</div>
<input type="submit" name="submit" value="Submit">
</div>
</div>
</div>
</form>


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