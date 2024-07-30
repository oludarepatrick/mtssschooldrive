<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">


<body>
 <div class="m-content">
<form method="get" action="result_term" >


    

<table class="table striped hovered cell-hovered border">
<tbody>
	<tr>
	<?php echo $message; ?>
	 <?php 
	 if ($query_result->num_rows() > 0)
{
   $val = $query_result->row();
	 //$i=0; foreach($query_result->result() as $val){ $i+=1;?>
	<td>Name</td>
	
	<td><div class="input-control"><input type="text" size="40" name="studname" readonly="readonly" value="<?php echo $val->studentname; ?>" /></div></td>
	<td>Class</td>

	<td><div class="input-control"><input type="text" size="25" name="studclass" readonly="readonly" value="<?php echo $val->class; echo " ";  echo $val->class_division;?>" /></div></td>
	</tr>
	<tr>
	<td>Admission No</td>
	
	<td><div class="input-control"><input type="text" size="5" name="studid" readonly="readonly" value="<?php echo $val->student_id; ?>" /></div></td>
	<td>Term</td>
	
	<td><div class="input-control"><input type="text" size="25"  name="term" readonly="readonly" value="<?php echo $val->term; echo " "; echo $val->session; ?>" /></div></td>
	</tr>
	<?php }?>
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
	<?php $i=0; foreach($query_result->result() as $val){ $i+=1;?>
	<tr>
	<td><?php echo "$i "; ?><input type="hidden" name="id" value="<?php echo $val->id;?>" /></td>
	<td><div class="input-control ">
    <input name="subject" size="40" readonly="readonly" type="text" value="<?php echo $val->subject;?>">
</div></td>
	<td><div class="input-control">
    <input name="totalscore" size="4" type="text" readonly="readonly" value="<?php echo $val->totalscore;?>">
</div></td>
	
</tr>
<?php }?>
</tbody>
</table>

</form>
</div>
</body>
</html>
