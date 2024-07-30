<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="example1" data-text="example">
<form action="confirm_payment_status" method="post">
<table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
 <thead>
  <tr>
	  <th>SN</th>
	  <th>CHECK</th>
      <th>ADMIN. NO</th>
	  <th>SURNAME</th>
	  <th>FIRSTNAME</th>
	  <th>CLASS</th>
	  <th>ARM</th>
	  <th>SESSION</th>
	  <th>PAYMENT STATUS</th>
	 

    </tr>
    </thead>
	

       <tbody>
	   <?php
$i=0; 
  
   foreach ($all_student->result() as $row)
   {
      /*echo $row->staff_id;
      echo $row->name;
      echo $row->password;*/
    
		  $i+=1;
    ?>
	   <tr>
	
      <td><?php echo "$i "; ?></td>
	  <td><input type="checkbox" id="id" name="id[]" value="<?php echo $row->student_id; ?>" /></td>
      <td><?php echo $row->student_id;?></td>
	  <td><?php echo $row->surname;?></td>
	  <td><?php echo $row->firstname;?></td>
	  <td><?php echo $row->class; ?></td>
	  <td><?php echo $row->class_division; ?></td>
	  <td><?php echo $row->session; ?></td>
	   <td><?php echo $row->payment_status; ?></td>

    </tr>
    <?php } ?>
	</tbody>
            </table>
			</div>
			
			
<div class="row flex-just-sb">
<div class="cell colspan3">
<div class="input-control full-size">
<select name="status" class="select">
<option value="">PAYMENT STATUS</option>
<option value="PAID">PAID</option>
<option value="OWING">OWING</option>
</select>
</div>
</div>
<div class="cell colspan3">
 <input type="submit" name="submit" id="submit" value="Update"   class="button success loading-pulse lighten primary" />
	</div>	
	</div>
	</form>	
	</div>
</body>
</html>
