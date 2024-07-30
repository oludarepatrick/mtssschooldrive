<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="example1" data-text="example">
            <table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
                <thead>
                <tr>
				<th>SN</th>
      
      <th>USERNAME</th>
	  <th>NAME</th>
	  <th>SUBJECT</th>
      <th>SCORE</th>
	  <th>CLASS</th>
	  <th>TERM</th>
	  <th>SESSION</th>

    </tr>
    </thead>
	

       <tbody>
	   <?php
$i=0; 
  
   foreach ($all_result as $row)
   {
      /*echo $row->staff_id;
      echo $row->name;
      echo $row->password;*/
    
		  $i+=1;
    ?>
	   <tr>
	
      <td><?php echo "$i "; ?></td>
	  <td><?php echo $row->username;?></td>
	  <td><?php echo $row->name;?></td>
	  <td><?php echo $row->subject;?></td>
	  <td><?php echo $row->score;?></td>
	  <td><?php echo $row->class;?></td>
	  <td><?php echo $row->term;?></td>
	  <td><?php echo $row->session;?></td>
	  

    </tr>
    <?php } ?>
	</tbody>
            </table>
			</div>
			</div>
			<script type="text/javascript">
				$(document).ready(function(){
				    $('#example_table').DataTable();
				});
			</script>
</body>
</html>
