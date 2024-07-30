<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
 <div class="m-content">
<form>
<table class="table striped hovered cell-hovered border bordered">
<thead>
        <tr>
            <th class="">Sn</th>
            <th class="">Min%</th>
            <th class="">Max%</th>
			<th class="">Grades</th>
			<th class="">Remarks</th>
			<th class="">Edit | Delete</th>
        </tr>
    </thead>
	<tbody>
	<tr>
	<?php
$i=0; 
    foreach ($query_grades->result() as $row){
		  $i+=1;
    ?>
	<td><?php echo "$i "; ?><input type="hidden" name="id" value="<?php echo $row->id;?>" /></td>
	<td><div class="input-control">
    <input name="min" size="4" readonly="readonly" type="text" value="<?php echo $row->lower;?>">
</div></td>
	<td><div class="input-control">
    <input name="max" size="4" type="text" readonly="readonly" value="<?php echo $row->higher;?>">
</div></td>
	<td><div class="input-control">
    <input name="grade" size="4" type="text" readonly="readonly" value="<?php echo $row->grade;?>">
</div></td>
	<td><div class="input-control">
    <input name="remarks"  type="text" readonly="readonly" value="<?php echo $row->remark;?>">
</div></td>
	<td></td>
	</tr>
	<?php } ?>
	</tbody>
</table>
</form>
</div>
</body>
</html>