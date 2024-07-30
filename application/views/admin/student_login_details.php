<div class="m-content">
<div class="example1" data-text="example">
            <table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
                <thead>
                <tr>
	  <th>SN</th>
	  <th>NAME</th>
	  <th>CLASS</th>
	  <th>CLASS ARM</th>
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
	  <th>CLASS</th>
	  <th>CLASS ARM</th>
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
	  <td><?php echo $row->surname; echo " "; echo $row->firstname;?></td>
	  <td><?php echo $row->class;?></td>
	  <td><?php echo $row->class_division;?></td>
	  <td><?php echo $row->phone;?></td>
	  <td><?php echo $row->username;?></td>
	  <td><?php echo $row->password;?></td>  
	  <td><button class="button small-button warning" onclick="editStaff('<?php echo $row->student_id; ?>')">Edit</button></td>
	  <td><button class="button small-button danger" onclick="deleteStaff('<?php echo $row->student_id; ?>')">Delete</button></td>
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
        <li><a href="#1">Student Details</a></li>
        
    </ul>
    <div class="frames">
        <div class="frame" id="1">
        	<div class="flex-grid">
        	<div class="row">
        	<div class="cell colspan3">
        	<p><b>Surname: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="name" required>
			<input type="hidden" id="student_id" required>
        	</div>
        	</div>
        	</div>
			<div class="row">
        	<div class="cell colspan3">
        	<p><b>Firstname: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="firstname" required>
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
        	<p><b>Date of Birth: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="dob">
        	</div>
        	</div>
        	</div>
			<div class="row">
        	<div class="cell colspan3">
        	<p><b>Username: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="username">
        	</div>
        	</div>
        	</div>
			<div class="row">
        	<div class="cell colspan3">
        	<p><b>Password: </b></p>
        	</div>
        	<div class="cell colspan5">
        	<div class="input-control text full-size">
        	<input type="text" id="password">
        	</div>
        	</div>
        	</div>



        	

        	<div class="row">
        	<div class="cell colspan1">
        	<button class="button success" id="submit-btn-1" onclick="">Update</button>
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
	

	function editStaff(id)
	{
		s_id = id;
		var student_id = id;
		var inst = $('[data-remodal-id=modal]').remodal();
        $("#spinner").css({"display":"block", "background-attachment":"fixed"})
		//$('.limiter').css("max-height", $(window).height())
		$.post("getStudentDetails_Ajax",
        {
            student_id: student_id
        },
        function(data){
        resu = data;
        console.log(data);
        var result = JSON.parse(data);
        console.log(result[0][0])
        $('#editsubject').empty();
        $('#subjectdetails').empty();
        $('#name').val(result[0][0].surname)
		 $('#student_id').val(result[0][0].student_id)
		$('#firstname').val(result[0][0].firstname)
        $('#phonenumber').val(result[0][0].phone)
        $('#dob').val(result[0][0].dob)
		$('#username').val(result[0][0].username)
		$('#password').val(result[0][0].password)
$('#class').empty();
        $('#class_division').empty();
$('#class').append("<option value=''>SELECT CLASS</option>")
$('#class_division').append("<option value=''>SELECT DIVISION</option>")
        var i;
        for(i=0;i<result[0].length;i++)
        {
        	$('#class').append("<option value='"+result[0][i].class+"'>"+result[0][i].class+"</option>");

        }
        for(i=0;i<result[0].length;i++)
        {
        	$('#class_division').append("<option value='"+result[0][i].class_division+"'>"+result[0][i].class_division+"</option>");

        }
        $('#submit-btn-1').attr('onclick', 'submitStudentDetails('+result[0][0].student_id+')')
       // $('#class').val(result[0][0].class);
        //$('#class_division').val(result[0][0].class_arm);
        //$('#staff_cat').val(result[0][0].category);
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

	function submitStudentDetails(student_id)
	{
		var name = $('#name').val();
		var student_id = $('#student_id').val();
		var firstname = $('#firstname').val();
		var phonenumber = $('#phonenumber').val();
		var dob = $('#dob').val();
		var username = $('#username').val();
		var password = $('#password').val();
		//var clas = $('#class').val();
		//var class_division = $('#class_division').val();
		//var staff_cat = $('#staff_cat').val();
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
				$.post("updateStudentDetails_Ajax",
		        {
		            student_id: student_id,
		            name: name,
					firstname: firstname,
		            dob: dob,
		            phonenumber: phonenumber,
					username: username,
		            password: password
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		editStaff(student_id);
		        		swal("SUCCESS!", "Student details updated successfully", "success");
		        	}
		        	else
		        	{
		        		editStaff(student_id);
		        		swal("Error", data, "error");
		        	}
                    $("#spinner").css({"display":"none", "background-attachment":"fixed"})
		        });
			}
		        )
	}
function deleteStaff(student_id)
	{
		swal({   
                title: "Delete?",   
                text: "Are You Sure You Want to Delete this Student?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, function()
            {
                $("#spinner").css({"display":"block", "background-attachment":"fixed"})

				$.post("deleteStudent_Ajax",
		        {
		            student_id: student_id
		        },
		        function(data){
		        	if(data == "SUCCESSFUL")
		        	{
		        		//editStaff(s_id);
		        		swal("SUCCESS!", "Student Deleted Successfully, Reload Page to See Changes Made!", "success");
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
