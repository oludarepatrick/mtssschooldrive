<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body>
<form method="get" action="result_term">
<table class="table striped hovered cell-hovered border">
<tbody>
	<tr>
	 <?php $i=0; foreach($query_result->result() as $val){ $i+=1;?>
	<td>Name</td>
	<td><input type="text" name="studname" value="<?php echo $val->studentname; ?>" /></td>
	<td>Class</td>
	<td><input type="text" name="studclass" value="<?php echo $val->class; ?>" /></td>
	</tr>
	<tr>
	<td>Admission No</td>
	<td><input type="text" name="studid" value="<?php echo $val->student_id; ?>" /></td>
	<td>Term</td>
	<td><input type="text" name="term" value="<?php echo $val->term; echo " "; echo $val->session; ?>" /></td>
	</tr>
	
	<tr>
	<td></td>
	<td></td>
	<td></td>
	<td></td>
	</tr>
	</tbody>
</table>


<table class="table striped hovered cell-hovered border bordered">
<thead>
        <tr>
            <th class="">Sn</th>
            <th class="">Subjects</th>
            <th class="">Total Score(%)</th>
			
			
        </tr>
    </thead>
	<tbody>
	<tr>
	<td><?php echo "$i "; ?><input type="hidden" name="id" value="<?php echo $val->id;?>" /></td>
	<td><div class="input-control">
    <input name="min" size="4" readonly="readonly" type="text" value="<?php echo $val->subject;?>">
</div></td>
	<td><div class="input-control">
    <input name="max" size="4" type="text" readonly="readonly" value="<?php echo $val->totalscore;?>">
</div></td>
	
</tr>
<?php }?>
</tbody>
</table>
</form>
</body>
</html>
