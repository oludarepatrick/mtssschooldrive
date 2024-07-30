<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<form  method="post"  data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
		
<div class="panel" data-role="draggable" style="top: 1.00003px; left: -10px; width: 143%;">
<div class="heading">
        <span class="mif-keyboard icon"></span>
        <span class="title">RESULT COMMENTS</span>
    </div>
	<div class="content">
		
<table class="table striped hovered cell-hovered border">
<thead>
<tr>
<td>
class details
</td>
</tr>
</thead>
<thead>
<tr>

            <th>Sn</th>
            <th>Student Names</th>
			<th>Admission No</th>
            <th>Comments</th>
</tr>
</thead>

<tbody>
<tr>
<td><div class="input-control">
	<input type="text" size="2" readonly="readonly" value="" />
	</div></td>
<td><div class="input-control ">
	<input type="text" size="30" readonly="readonly" value="" />
	</div></td>
<td><div class="input-control ">
	<input type="text" size="4" readonly="readonly" value="" />
	</div></td>
<td><div class="cell colspan7">
<div class="input-control text full-size " >
<input type="text" name="comment" size="50"  data-validate-hint-position="bottom"  data-validate-func="required"           
            data-validate-hint="This field cannot be empty!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span>   
</div>
</div></td>
</tr>
<tr>
<td align="right" colspan="4">
<div class="row">
<div class="cell colspan4">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">

</div>
    </div>
</td></tr>
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