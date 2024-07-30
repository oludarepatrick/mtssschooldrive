<div class="m-content">
<div class="example1" data-text="example">
            <table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
                <thead>
                <tr>
	  <th>SN</th>
	  <th>NAME</th>
	  <th>PHONE NO</th>
	  <th>USERNAME</th>
	  <th>PASSWORD</th>
	  <th>EDIT</th>
          <th>DELETE</th>
    </tr>
    </thead>
	<tfoot>
     <tr>
	 <th>SN</th>
	  <th>NAME</th>
	  <th>PHONE NO</th>
	  <th>USERNAME</th>
	  <th>PASSWORD</th>
	  <th>EDIT</th>
          <th>DELETE</th>
	  </tr>
        </tfoot>

       <tbody>
	   <?php
$i=0; 
  
   foreach ($query_teacher->result() as $row)
   {
      /*echo $row->staff_id;
      echo $row->name;
      echo $row->password;*/
    
		  $i+=1;
    ?>
	   <tr>
	
      <td><?php echo "$i "; ?></td>
	  <td><?php echo $row->name;?></td>
	  <td><?php echo $row->phone;?></td>
	  <td><?php echo $row->username;?></td>
	  <td><?php echo $row->password;?></td>  
	  <td><button class="button small-button warning" onclick="editStaff('<?php echo $row->staff_id; ?>')">Edit</button></td>
<td><button class="button small-button danger" onclick="deleteStaff('<?php echo $row->staff_id; ?>')">Delete</button></td>
    </tr>
    <?php } ?>
	</tbody>
            </table>
			</div>
			</div>
<div class="limiter">
<div class="remodal" data-remodal-id="modal">
  	<button data-remodal-action="close" class="remodal-close"></button>
  	<div class="tabcontrol" data-role="tabcontrol">
    <ul class="tabs">
        <li><a href="#1">Staff Details</a></li>
        <li><a href="#2">Edit Subjects</a></li>
    </ul>
    <div class="frames">
        <div class="frame" id="1">
        	<div class="flex-grid">
        	<div class="row">
        	<div class="cell colspan3">
        	<p><b>Name: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="name">
        	</div>
        	</div>
        	</div>

        	<div class="row">
        	<div class="cell colspan3">
        	<p><b>Phone Number: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="phonenumber">
        	</div>
        	</div>
        	</div>

        	<div class="row">
        	<div class="cell colspan3">
        	<p><b>Email: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="email">
        	</div>
        	</div>
        	</div>

        	<div class="row">
        	<div class="cell colspan3">
        	<p><b>Staff Category: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<select class="" id="staff_cat" onchange="updateClass()" style="width: 100%">
        	<option value="">SELECT CATEGORY</option>
        	<option value="CLASS TEACHER">CLASS TEACHER</option>
        	<option value="SUBJECT TEACHER">SUBJECT TEACHER</option>
        	<option value="CLASS | SUBJECT TEACHER">CLASS | SUBJECT TEACHER</option>
        	<option value="PRINCIPAL | HEADMASTER">PRINCIPAL | HEADMASTER</option>
        	</select>
        	</div>
        	</div>

        	<div class="row" id="class-area">
        	<div class="cell colspan3">
        	<p><b>Class Supervised: </b></p>
        	</div>
        	<div class="cell colspan5" id="class-supervised-area">
        	<select id="class" class="" style="width: 100%">
        	<option value="">SELECT CLASS</option>
        	</select>
        	</div>
        	</div>

        	<div class="row" id="class-arm-area">
        	<div class="cell colspan3">
        	<p><b>Class Division: </b></p>
        	</div>
        	<div class="cell colspan5" id="class-div-area">
        	<select id="class_division" class="" style="width: 100%">
        	<option value="">SELECT DIVISION</option>
        	</select>
        	</div>
        	</div>

        	<div class="row">
        	<div class="cell colspan1">
        	<button class="button success" id="submit-btn-1" onclick="">Submit</button>
        	</div>
        	</div>

        	</div>
        </div>
        <div class="frame" id="2">
        <div class="flex-grid">
        <div class="row">
        <div class="cell colspan3">
        <select class="" style="width: 100%" id="addsubject-subject">
        <?php foreach($subjects as $subject) { ?>
        <option value="<?php echo $subject->course; ?>"><?php echo $subject->course; ?></option>
        <?php } ?>
        </select>
        </div>
        <div class="cell colspan3">
        <select class="" id="addsubject-class">
        <?php foreach($class as $cla) { ?>
        <option value="<?php echo $cla->class; ?>"><?php echo $cla->class; ?></option>
        <?php } ?>
        </select>
        </div>
        <div class="cell colspan3">
        <button class="button success mini-button" onclick='addSubject()'>Add Subject</button>
        </div>
        </div>
        <div class="row">
        <div class="cell colspan12">
        <table id="subjectdetails" class="table hovered border striped">
        	
        </table>
        </div>
        </div>
        </div>
        </div>
    </div>
	</div>
</div>
</div>

<script type="text/javascript">
	
	$('.basic').fancySelect();
	$('.remodal').css("min-height", $(window).height())
	$('.selectize').selectize();

	function editStaff(id)
	{
		s_id = id;
		var staff_id = id;
		var inst = $('[data-remodal-id=modal]').remodal();
        $("#spinner").css({"display":"block", "background-attachment":"fixed"})
		//$('.limiter').css("max-height", $(window).height())
		$.post("getStaffDetails_Ajax",
        {
            staff_id: staff_id
        },
        function(data){
        resu = data;
        console.log(data);
        var result = JSON.parse(data);
        console.log(result[0][0])
        $('#editsubject').empty();
        $('#subjectdetails').empty();
        $('#name').val(result[0][0].name)
        $('#phonenumber').val(result[0][0].phone)
        $('#email').val(result[0][0].email)
$('#class').empty();
        $('#class_division').empty();
$('#class').append("<option value=''>SELECT CLASS</option>")
$('#class_division').append("<option value=''>SELECT DIVISION</option>")
        var i;
        for(i=0;i<result[2].length;i++)
        {
        	$('#class').append("<option value='"+result[2][i].class+"'>"+result[2][i].class+"</option>");

        }
        for(i=0;i<result[3].length;i++)
        {
        	$('#class_division').append("<option value='"+result[3][i].division+"'>"+result[3][i].division+"</option>");

        }
        $('#submit-btn-1').attr('onclick', 'submitStaffDetails('+result[0][0].staff_id+')')
        $('#class').val(result[0][0].class);
        $('#class_division').val(result[0][0].class_arm);
        $('#staff_cat').val(result[0][0].category);
        var mySelect = $('.basic');
        mySelect.trigger('update.fs');
        if(result[1] == "nil")
        {
        	var msg = "<h4 class='warning_bg_1'>Staff is not a Subject Teacher</h4>"
        	$('#editsubject').append(msg);
        } else {
        	var t = $('#subjectdetails');
        	var i;
        	var j = 1;
        	t.append("<thead><tr><th>S/N</th><th>Subject</th><th>Class</th><th>Delete</th></tr></thead><tbody>")
        	for(i=0;i<result[1].length;i++)
        	{
        		t.append("<tr><td>"+j+"</td><td>"+result[1][i].subject+"</td><td>"+result[1][i].class+"</td><td><a onclick=\"deleteSubject('"+result[1][i].id+"')\"><span class='mif-bin'></span>Delete</a></td></tr>");
        		j++;
        	}
        	t.append("</tbody>")
        }
		inst.open();
        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		});

	}

	function submitStaffDetails(staff_id)
	{
		var name = $('#name').val();
		var phonenumber = $('#phonenumber').val();
		var email = $('#email').val();
		var clas = $('#class').val();
		var class_division = $('#class_division').val();
		var staff_cat = $('#staff_cat').val();
		swal({   
                title: "Procced?",   
                text: "Confirm that details are correct",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: false
            }, function()
            {$("#spinner").css({"display":"block", "background-attachment":"fixed"})
				$.post("updateStaffDetails_Ajax",
		        {
		            staff_id: staff_id,
		            name: name,
		            email: email,
		            class: clas,
		            phonenumber: phonenumber,
		            class_division: class_division,
		            staff_cat: staff_cat
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		editStaff(staff_id);
		        		swal("SUCCESS!", "Staff details updated successfully", "success");
		        	}
		        	else
		        	{
		        		editStaff(staff_id);
		        		swal("Error", data, "error");
		        	}
                    $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        });
			}
		        )
	}

function deleteStaff(staff_id)
	{
		swal({   
                title: "Delete?",   
                text: "Are You Sure You Want to Delete this Staff?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, function()
            {
                $("#spinner").css({"display":"block", "background-attachment":"fixed"})

				$.post("deleteStaff_Ajax",
		        {
		            staff_id: staff_id
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		//editStaff(s_id);
		        		swal("SUCCESS!", "Staff Deleted Successfully, Reload Page to See Changes Made!", "success");
		        	}
                    $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        })
		        });
	}

	function deleteSubject(subject_id)
	{
		swal({   
                title: "Delete?",   
                text: "Delete this subject?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, function()
            {
                $("#spinner").css({"display":"block", "background-attachment":"fixed"})

				$.post("deleteStaffSubject_Ajax",
		        {
		            id: subject_id
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		editStaff(s_id);
		        		swal("SUCCESS!", "Subject deleted for staff", "success");
		        	}
                    $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        })
		        });
	}

	function addSubject()
	{
		var subject = $('#addsubject-subject').val();
		var clas = $('#addsubject-class').val();
        $("#spinner").css({"display":"block", "background-attachment":"fixed"})
		$.post("addStaffSubject_Ajax",
		        {
		            id: s_id,
		            subject: subject,
		            class: clas
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		editStaff(s_id);
		        		swal("SUCCESS!", "Subject added for staff", "success");
		        	}
		        	else
		        	{
		        		swal("OOps!", "Subject already assigned to staff for the selected class", "error");
		        	}
                    $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        })

	}

	function updateClass()
	{
		var check = $('#staff_cat').val();
		if(check == "SUBJECT TEACHER")
		{
			$('#class-area').css('display', 'none');
			$('#class-arm-area').css('display', 'none');
			$('#class').val('');
			$('#class_division').val('');
		}
		else if(check=="PRINCIPAL | HEADMASTER")
		{
			$('#class-area').css('display', 'none');
			$('#class-arm-area').css('display', 'none');
			$('#class').val('');
			$('#class_division').val('');
		}
		else if(check=="")
		{
			$('#class-area').css('display', 'none');
			$('#class-arm-area').css('display', 'none');
			$('#class').val('');
			$('#class_division').val('');
		}

		else
		{
			$('#class-area').css('display', 'flex');
			$('#class-arm-area').css('display', 'flex');
		}
	}
</script>
</body>
</html>
