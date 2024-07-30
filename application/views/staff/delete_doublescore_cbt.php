<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="example1" data-text="example">
            <table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
                <thead>
                <tr>
	  <th>SN</th>
	  <th>NAME</th>
	  <th>SUBJECT</th>
      <th>SCORE</th>
	  <th>CLASS</th>
	  <th>TERM</th>
	  <th>SESSION</th>
	  <th>DELETE</th>

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
	  <td><?php echo $row->studentname;?></td>
	  <td><?php echo $row->subject;?></td>
	  <td><?php echo $row->score;?></td>
	  <td><?php echo $row->class;?></td>
	  <td><?php echo $row->term;?></td>
	  <td><?php echo $row->session;?></td>
	  <td><button class="button small-button danger" onclick="deleteDoubleScore('<?php echo $result[$i]->id; ?>')">Delete</button></td>
	  

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

function deleteDoubleScore(id)
	{
		swal({   
                title: "Delete?",   
                text: "Are You Sure You Want to Delete this Score?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, function()
            {
                $("#spinner").css({"display":"block", "background-attachment":"fixed"})

				$.post("deleteCbtScore_Ajax",
		        {
		            id: id
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		
		        		swal("SUCCESS!", "Score Deleted Successfully, Reload Page to See Changes Made!", "success");
		        	}
                    $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        })
		        });
	}
