 <div class="remodal-bg">
<div class="limiter">
<div class="remodal" data-remodal-id="createmodal">
  <button data-remodal-action="close" class="remodal-close"></button>
    <p align="left"><b>Name:</b> <span id="name"></span></p>
    <p align="left"><b>Class:</b> <span id="class"></span></p>
  <div class="row">
  <div class="cell colspan1">
  <strong>Comment: </strong>
  </div>
  <div class="cell colspan5" align="left">
  <textarea id="commentcreate" style="width: 100%; height: 200px"></textarea>
  </div>
  </div>
  <div class="row">
  <div class="cell colspan2">
  <button class="button small-button success" type="button" onclick="addComment()">Click to comment on result</button>
  </div>
  </div>
  </div>
  </div>
  </div>

<div class="m-content">
<div class="panel_bg_2">
<div class="flex-grid">
<form id="form1" name="form1" method="post" action="">
  <div class="row flex-just-sb">
  <div class="cell colspan2">
  <div class="input-control full-size">
  <select name="class" class="select">
  <option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php  foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
      <select name="class_division" class="select">
        <option value="<?php echo set_select('class_arm', '', TRUE); ?>">SELECT ARMS</option>
        <?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
        <?php } ?>
      </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
  <select name="term" class="select">
    <option value="<?php echo set_select('term', '', TRUE); ?>">SELECT TERM</option>
    <option value="FIRST TERM" >FIRST TERM</option>
    <option value="SECOND TERM" >SECOND TERM</option>
   <option value="THIRD TERM" >THIRD TERM</option>
  </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
<select name="session" class="select">
        <option value="<?php echo set_select('session', '', TRUE); ?>">SELECT SESSION</option>
        <?php foreach($sessions as $s) { ?>
        <option value="<?php echo $s->session; ?>"><?php echo $s->session; ?></option>
        <?php } ?>  
      </select>
    </div>
    </div>
    <div class="cell colspan2">
    <input type="submit" value="Send"/>
    <input  type="hidden" name="class_arm_selected" class="class_arm_selected" value="" />
    </div>
  </div>
</form>
</div>
</div>


<?php if(isset($students)) { ?>
<h4 class="head_bg_1"><?php echo $class.' '.$class_division.' '.$term.' '.$session; ?></h4>
<table class="table striped border bordered">
    <thead>
    <tr>
    <th>Student Name</th>
    <th>Admin No</th>
    <th>Options</th>
    </tr>
    </thead>

    <tbody>
  <?php foreach($students as $student) { ?>
<tr>
<td><?php echo strtoupper($student->studentname); ?></td>
<td><?php echo strtoupper($student->student_id); ?></td>
<td>
<button class='small-button button success'><a target="blank" href='print_result?session=<?php echo $session; ?>&amp;term=<?php echo $term; ?>&amp;student_id=<?php echo $student->student_id; ?>&amp;class=<?php echo $class;?>&amp;class_division=<?php echo $class_division; ?>'>View Result</a></button>
<button class='small-button button warning' onclick='openCommentForm(<?php echo '"'.$student->student_id.'","'.$session.'","'.$term.'","'.$class.'","'.$class_division.'"'; ?>)'>Comment</button>

</td>
</tr>
    <?php } ?>
     </tbody>
    </table>

<?php } ?>

<!--
<div class="m-content">
<?php //echo form_open('school_settings/insert_teacher_comment');?>
<?php //echo $message;?>
<div class="flex-grid">


      
<div align="right">
<button class="button small-button success" onclick="openCommentForm()">New Comment</button>
</div>
                 <table class="table striped border hovered bordered comments">
                     
                 </table>
                 
                 </div>
                 </div>
                                  <div class="remodal-bg">
<div class="limiter">
<div class="remodal" data-remodal-id="createmodal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="row">
  <div class="cell colspan1">
  <strong>Comment: </strong>
  </div>
  <div class="cell colspan5" align="left">
  <div class="input-control text full-size">
  <input type="text" id="commentcreate">
  </div>
  </div>
  </div>
  <div class="row">
  <div class="cell colspan2">
  <button class="button small-button success" type="button" onclick="addComment()">Create</button>
  </div>
  </div>
  </div>
  </div>
  </div>
                 <div class="remodal-bg">
<div class="limiter">
<div class="remodal" data-remodal-id="modal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="row">
  <div class="cell colspan1">
  <strong>Comment: </strong>
  </div>
  <div class="cell colspan5" align="left">
  <div class="input-control text full-size">
  <input type="text" id="commenttext">
  </div>
  </div>
  </div>
  <div class="row">
  <div class="cell colspan2">
  <button class="button small-button success" onclick="updateComment()">Submit</button>
  </div>
  </div>
  </div>
  </div>
  </div>
				 </body> -->
	<script>


        function openCommentForm(id,session,term,clas,class_division)
        {
            _student_id = id;
            _session = session;
            _term = term;
            _class = clas;
            _class_division = class_division;
            $("#spinner").css({"display":"block", "background-attachment":"fixed"})
            getPrincipalComment();
            $("#spinner").css({"display":"none", "background-attachment":"fixed"})
            var inst = $('[data-remodal-id=createmodal]').remodal();
            inst.open();
        }

        function getPrincipalComment()
        {
          $.post("getPrincipalComment_Ajax",
                    {
                        student_id: _student_id,
                        session: _session,
                        term: _term,
                        class: _class,
                        class_division: _class_division,
                    },
                    function(data)
                    {
                        result = JSON.parse(data);
                        $('#name').text(result[1][0].surname+' '+result[1][0].firstname+' '+result[1][0].othername)
                        $('#class').text(result[1][0].class)
                        $('#commentcreate').val(result[0][0].comment)

                    });
        }

        function addComment()
        {
          var inst = $('[data-remodal-id=createmodal]').remodal();
            inst.close();
            
            var comment = $('#commentcreate').val();
            console.log(comment);
            swal({   
                title: "Are you sure?",   
                text: "Verify that the Comment is okay",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, 
                function()
                { 
                    $("#spinner").css({"display":"block", "background-attachment":"fixed"})
                    $.post("insertPrincipalComment_Ajax",
                    {
                        student_id: _student_id,
                        session: _session,
                        term: _term,
                        class: _class,
                        class_division: _class_division,
                        comment: comment
                    },
                    function(data)
                    {
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        swal("SUCCESS", data, "success")
                        $('#commentcreate').text("")
                        

                    });
                });

        }

        
    </script>