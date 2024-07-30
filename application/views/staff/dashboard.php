<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="example1" data-text="example">
            <table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
                <thead>
                <tr>
				<th>SN</th>
      
      <th>ADMIN. NO</th>
	  <th>SURNAME</th>
	  <th>FIRSTNAME</th>
	  
	  <th>CLASS</th>
	  <th>ARM</th>
	  
    </tr>
    </thead>
	

       <tbody>
	   <?php
$i=0; 
  
   foreach ($all_student as $row)
   {
      /*echo $row->staff_id;
      echo $row->name;
      echo $row->password;*/
    
		  $i+=1;
    ?>
	   <tr>
	
      <td><?php echo "$i"; ?></td>
      <td><?php echo $row->student_id;?></td>
	  <td><?php echo $row->surname;?></td>
	  <td><?php echo $row->firstname;?></td>

	  <td><?php echo $row->class; ?></td>
	  <td><?php echo $row->class_division; ?></td>
	 
    </tr>
    <?php } ?>
	</tbody>
            </table>
			</div>
			</div>
			
</body>
</html>
