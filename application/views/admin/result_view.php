<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="example1" data-text="example">
   <table>
           <tr>
		
	 		<?php 
	 if ($query_result->num_rows() > 0)
{
   $val = $query_result->row();
   ?>
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
   </table>         

<table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
         
				<thead>
                <tr>
				<th>Sn</th>
            <th>Subjects</th>
            <th>Total Score(%)</th>
    </tr>
    </thead>
	

       <tbody>
	<?php $i=0; foreach($query_result->result() as $val){ $i+=1;?>
	<tr>
	
	<td><?php echo "$i "; ?><input type="hidden" name="id" value="<?php echo $val->id;?>" /></td>
	<td><?php echo $val->subject;?></td>
	<td><?php echo $val->totalscore;?></td>
</tr>
<?php }?>
</tbody>
            </table>
			</div>
			</div>

</body>
</html>
