<div class="m-content">
<form  method="post"  data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true">
		
<div class="panel" style="top: 1.00003px; left: -10px; width: 129%;">
<div class="heading">
        <span class="mif-keyboard icon"></span>
        <span class="title">SKILLS GRADE</span>
    </div>
	<div class="content">
		
<table class="table striped hovered cell-hovered border">
<thead>
<tr>
<td>
class details
</td>
</tr>
</thead>
<thead>
<tr>

            <th>Sn</th>
            <th>Student Names</th>
			<th>Admission No</th>
            <th>Skills Settings</th>
</tr>
</thead>

<tbody>
<?php if(isset($students)){$i=1; foreach($students->result() as $student) { ?>
<tr>
<td><div class="input-control">
	<input type="text" size="2" readonly="readonly" value="<?php echo $i++; ?>" />
	</div></td>
<td><div class="input-control ">
	<input type="text" size="30" readonly="readonly" value="<?php echo $student->surname." ".$student->firstname." ".$student->othername; ?>" />
	</div></td>
<td><div class="input-control ">
	<input type="text" size="4" readonly="readonly" value="<?php echo $student->student_id; ?>" />
	</div></td>
<td>

<input type="button" id="submit" value="Grade Skills" onclick="getSkillsGrade('<?php echo $student->student_id; ?>')" class="button success loading-pulse lighten primary">
</td>
</tr>
<?php }} ?> 
<tr>
<td align="right" colspan="4">
<div class="row">
<div class="cell colspan4">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">

</div>
    </div>
</td></tr>
</tbody>
</table>
</div>
</div>





    


</form>
</div>
<div class="remodal-bg">
<div class="limiter">
<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="flex-grid">
  <div class="row">
  <div id="studentdetails" class="cell colspan7" align="left">
  <p><strong>Name: </strong><span id="studentname"></span></p>
  <p><strong>Admission Number: </strong><span id="studentid"></span></p>
  <p><strong>Class: </strong><span id="studentclass"></span></p>
  <p><strong>Class Arm: </strong><span id="studentclassdiv"></span></p>
  </div>
  <div class="cell colspan3">
  <img src="" id="studentimage" width="200" height="100">
  </div>
  </div>
  </div>

<div class="criteria">
  <p>Choose Term to Grade</p>
  <select id="term" onchange="getSkillsGradeData()">
  <option value="">SELECT TERM</option>
  <option value="FIRST TERM">FIRST TERM</option>
  <option value="SECOND TERM">SECOND TERM</option>
  <option value="THIRD TERM">THIRD TERM</option>
  </select>
  </div>
  <br>

  <div id="grades">
  

<div class="flex-grid grades" style="display: none">
<h4>PSYCHOMOTOR SKILLS</h4>
<div class="row">
  <div class="cell colspan2">
  <p><strong>Handwriting: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="handwriting">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Games and Sports: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="games">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Handling Tools: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="handling">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>
  </div>

<div class="row">
  <div class="cell colspan2">
  <p><strong>Verbal Fluency: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="fluency">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Drawing and Painting: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="drawing">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Musical Skills: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="musical">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>
  </div>

  <h4>AFFECTIVE DISPOSITION</h4>

<div class="row">
<div class="cell colspan2">
  <p><strong>Punctuality: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="punctuality">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Neatness: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="neatness">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Cooperative with Others: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="cooperation">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>
  </div>

<div class="row">
<div class="cell colspan2">
  <p><strong>Leadership: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="leadership">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Attitude to School Work: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="attitude">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

<div class="cell colspan2">
  <p><strong>Attentiveness: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="attentiveness">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>
  </div>

<div class="row">
<div class="cell colspan2">
  <p><strong>Emotional Stability: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="emotional">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

 <div class="cell colspan2"> 
  <p><strong>Politeness: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="politeness">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

  <div class="cell colspan2">
  <p><strong>Honesty: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="honesty">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>
  </div>

  <div class="row">
  <div class="cell colspan2">
  <p><strong>Helping Others: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="helping">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

  <div class="cell colspan2">
  <p><strong>Perseverance: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="perseverance">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>

  <div class="cell colspan2">
  <p><strong>Health: </strong></p>
  </div>
  <div class="cell colspan2">
  <select class="basic" id="phy_health">
  <option value="5">5</option>
  <option value="4">4</option>
  <option value="3">3</option>
  <option value="2">2</option>
  <option value="1">1</option>
  </select>
  </div>
  </div>

  <h4>WEIGHT/HEIGHT/ATTENDANCE</h4>
  <div class="row">
  <div class="cell colspan2">
  <p><strong>Weight: </strong></p><b>(kg)</b>
  </div>
  <div class="cell colspan2">
  <div class="input-control text" data-role="keypad">
    <input type="text" id="weight">
  </div>
  </div>
  <div class="cell colspan2">
  <p><strong>Height: </strong></p><b>(cm)</b>
  </div>
  <div class="cell colspan2">
  <div class="input-control text" data-role="keypad">
    <input type="text" id="height">
  </div>
  </div>
  </div>

  <div class="row">
  <div class="cell colspan2">
  <p><strong>Number of Time(s) Present: </strong></p>
  </div>
  <div class="cell colspan2">
  <div class="input-control text" data-role="keypad">
    <input type="text" id="attendance">
  </div>
  </div>
  <div class="cell colspan2">
  <p><strong>Extra Curriculum: </strong></p>
  </div>
  <div class="cell colspan2">
  <div class="input-control text">
    <input type="text" id="extra_curriculum">
  </div>
  </div>
  </div>
  </div>


  <br>
  <div id="buttons" style="display: none">
  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <button onclick="submitSkillsGrade()" class="remodal-confirm">Save</button>
  </div>
</div>
</div>
</div>
<script type="text/javascript">
    //var inst = $('[data-remodal-id=modal]').remodal();
    //inst.close();
    
    $('.limiter').css("max-height", $(window).height())
</script>

<script>
    function showDialog(id){
        var dialog = $(id).data('dialog');
        dialog.open();
    }

    function getSkillsGrade(student_id)
    {
        console.log("Spinner Loading")
        $("#spinner").css({"display":"block", "background-attachment":"fixed"})
        $.post("getStudent_Ajax",
        {
            student_id: student_id
        },
        function(data){
        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
        console.log(data);
        var inst = $('[data-remodal-id=modal]').remodal();
        inst.open();
        var studentdetails = JSON.parse(data);
        console.log(studentdetails[0].sn)
        $('#studentname').text(studentdetails[0].surname+" "+studentdetails[0].firstname+" "+studentdetails[0].othername);
        $('#studentid').text(studentdetails[0].student_id);
        $('#studentclass').text(studentdetails[0].class);
        $('#studentclassdiv').text(studentdetails[0].class_division)
        $('#studentimage').attr('src', '../../uploads/perm_upload/student/'+studentdetails[0].student_id+'.jpg')
		$('.criteria').css('display', 'block');
		$('#buttons').css('display', 'none');
		$('.grades').css('display', 'none');

        
        
        if(data == "SUCCESS")
        {
            
        }
        
        })
        }

        function getSkillsGradeData()
        {
            console.log("Spinner Loading");
            var student_id = $('#studentid').text();
            student_id = student_id.replace(/Admission Number: /i, "");
            term = $('#term').val();
            $("#spinner").css({"display":"block", "background-attachment":"fixed"})
            $('.criteria').css('display', 'none');
            $.post("getSkillsGradeData_Ajax",
            {
                term : term,
                student_id: student_id
            },
            function(data){
            $('#term').val("SELECT TERM")
            $("#spinner").css({"display":"none", "background-attachment":"fixed"})
            console.log(data);    
            var skillsgrade = JSON.parse(data);
			if(data!="[]")
			{
            console.log(skillsgrade[0].handwriting) 

            var e = $('#handwriting').val(skillsgrade[0].handwriting); 
            var e = $('#fluency').val(skillsgrade[0].fluency); 
            var e = $('#games').val(skillsgrade[0].games); 
            var e = $('#drawing').val(skillsgrade[0].drawing); 
            var e = $('#handling').val(skillsgrade[0].handling); 
            var e = $('#musical').val(skillsgrade[0].musical); 
            var e = $('#punctuality').val(skillsgrade[0].punctuality); 
            var e = $('#neatness').val(skillsgrade[0].neatness); 
            var e = $('#politeness').val(skillsgrade[0].politeness); 
            var e = $('#emotional').val(skillsgrade[0].emotional); 
            var e = $('#cooperation').val(skillsgrade[0].cooperation); 
            var e = $('#leadership').val(skillsgrade[0].leadership); 
            var e = $('#attitude').val(skillsgrade[0].attitude); 
            var e = $('#attentiveness').val(skillsgrade[0].attentiveness); 
            var e = $('#honesty').val(skillsgrade[0].honesty); 
            var e = $('#helping').val(skillsgrade[0].helping); 
            var e = $('#perseverance').val(skillsgrade[0].perseverance); 
            var e = $('#phy_health').val(skillsgrade[0].phy_health); 
            var e = $('#weight').val(skillsgrade[0].weight); 
            var e = $('#height').val(skillsgrade[0].height); 
            var e = $('#attendance').val(skillsgrade[0].no_presents); 
            var e = $('#extra_curriculum').val(skillsgrade[0].extra_curriculum); 
            //var e = $('#handwriting > option[value=4]').attr('selected', 'selected');   
            $('.basic').fancySelect();
            var mySelect = $('.basic')
            mySelect.trigger('update.fs');
            $('.grades').css('display', 'block')
			$('#grades').css('display', 'block')
            $('#buttons').css('display', 'block')
            swal("Notice!", "Ungraded skills default to 5")
            }
			else
			{
				var e = $('#handwriting').val("5"); 
				var e = $('#fluency').val("5"); 
				var e = $('#games').val("5"); 
				var e = $('#drawing').val("5"); 
				var e = $('#handling').val("5"); 
				var e = $('#musical').val("5"); 
				var e = $('#punctuality').val("5"); 
				var e = $('#neatness').val("5"); 
				var e = $('#politeness').val("5"); 
				var e = $('#emotional').val("5"); 
				var e = $('#cooperation').val("5"); 
				var e = $('#leadership').val("5"); 
				var e = $('#attitude').val("5"); 
				var e = $('#attentiveness').val("5"); 
				var e = $('#honesty').val("5"); 
				var e = $('#helping').val("5"); 
				var e = $('#perseverance').val("5"); 
				var e = $('#phy_health').val("5"); 
				var e = $('#weight').val(""); 
				var e = $('#height').val(""); 
				var e = $('#attendance').val(""); 
				var e = $('#extra_curriculum').val(""); 
				//var sel = $('select.basic').data("selectBox-selectbasic");
				//$('.selectbasic-container').remove()
				//console.log(sel)
				/*for (i=0;i<sel.length;i++)
				{
			
					sel[i].destroy();
				}*/
				
				
				//console.log(sel)
				//sel.destroy();

				$('.basic').fancySelect();
        var mySelect = $('.basic')
        mySelect.trigger('update.fs');
				$('.grades').css('display', 'block')
				$('#grades').css('display', 'block')
				$('#buttons').css('display', 'block')
				swal("Notice!", "Student has not yet been graded\n\n Ungraded skills default to 5")
			}
            
            })
        }

        function submitSkillsGrade()
        {
            swal({   
                title: "Are you sure?",   
                text: "Verify that the Grades are Correct",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: false 
            }, 
                function()
                {   
                    var handwriting = $('#handwriting').val(); 
                    var fluency = $('#fluency').val(); 
                    var games = $('#games').val(); 
                    var drawing = $('#drawing').val(); 
                    var handling = $('#handling').val(); 
                    var musical = $('#musical').val(); 
                    var punctuality = $('#punctuality').val(); 
                    var neatness = $('#neatness').val(); 
                    var politeness = $('#politeness').val(); 
                    var emotional = $('#emotional').val(); 
                    var cooperation = $('#cooperation').val(); 
                    var leadership = $('#leadership').val(); 
                    var attitude = $('#attitude').val(); 
                    var attentiveness = $('#attentiveness').val(); 
                    var honesty = $('#honesty').val(); 
                    var helping = $('#helping').val(); 
                    var perseverance = $('#perseverance').val(); 
                    var phy_health = $('#phy_health').val(); 
                    var weight = $('#weight').val(); 
                    var height = $('#height').val(); 
                    var attendance = $('#attendance').val(); 
                    var extra_curriculum = $('#extra_curriculum').val(); 
                    var student_id = $('#studentid').text()
                   
                    var studentclass = $('#studentclass').text()
                    var class_division = $('#studentclassdiv').text()


                    $.post("submitSkillsGrade_Ajax",
                    {
                        handwriting: handwriting,
                        fluency: fluency,
                        games: games,
                        drawing: drawing,
                        handling: handling,
                        musical: musical,
                        punctuality: punctuality,
                        neatness: neatness,
                        politeness: politeness,
                        emotional: emotional,
                        cooperation: cooperation,
                        leadership: leadership,
                        attitude: attitude,
                        attentiveness: attentiveness,
                        honesty: honesty,
                        helping: helping,
                        perseverance: perseverance,
                        phy_health: phy_health,
                        weight: weight,
                        height: height,
                        attendance: attendance,
                        extra_curriculum: extra_curriculum,
                        student_id: student_id,
                        term: term,
                        class: studentclass,
                        class_division: class_division
                    },
                    function(data){
                    if(data == "SUCCESS")
                    {
                    swal("Graded!", "Skills Grading has been updated successfuuly", "success");
                    var inst = $('[data-remodal-id=modal]').remodal();
                    inst.close();
					$('.grades').css('display', 'none');
					$('.criteria').css('display', 'block');

                }
                });
                });
        }
</script>
</body>
</html>
