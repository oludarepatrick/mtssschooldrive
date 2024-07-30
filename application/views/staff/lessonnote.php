<div class="m-content">
<div class="panel_bg_2">
<?php if($message!="") {echo "<h4 class='message_bg_1'>".$message."</h4>";} ?>
<h4 class="head_bg_2"> LESSON NOTE </h4>
<form enctype="multipart/form-data" method="post" action="upload_lesson_note">
<div class="flex-grid">
<div class="cell colspan3">
<div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me to Upload LESSON NOTE" name="userfile">
        <button class="button"><span class="mif-folder"></span></button>
    
</div>
</div>
</div>
</div>

<div class="panel">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">LESSON NOTE</span>
    </div>
  <div class="content">
<div class="flex-grid margin2">
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>CLASS</label>

<div class="input-control full-size">
       <select name="class" class="select">
  <option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php  foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan3">
<label>CLASS DIVISION </label>
<div class="input-control full-size">
        <select name="session" class="select">
        <option>SELECT SESSION</option>
    <?php foreach($class_division as $div) {?>
    <option value="<?php echo $div->division; ?>"><?php echo $div->division; ?></option>
    <?php } ?>
      </select>

</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>CURRENT TERM: </label>
<div class="input-control full-size">
    <select name="term" class="select">
        <option value="">SELECT TERM</option>
        <option value="FIRST TERM">FIRST TERM</option>
    <option value="SECOND TERM">SECOND TERM</option>
    <option value="THIRD TERM">THIRD TERM</option>
    </select>
</div>
</div>

<div class="cell colspan3">
<label>CURRENT SESSION: </label>
<div class="input-control full-size ">
        <select name="session" class="select">
        <option>SELECT SESSION</option>
        <option value="2010/2011">2010/2011</option>
    <option value="2011/2012">2011/2012</option>
    <option value="2012/2013">2012/2013</option>
    <option value="2013/2014">2013/2014</option>
    <option value="2014/2015">2014/2015</option>
    <option value="2015/2016">2015/2016</option>
    <option value="2016/2017">2016/2017</option>
    <option value="2017/2018">2017/2018</option>
    <option value="2018/2019">2018/2019</option>
    <option value="2019/2020">2019/2020</option>
    <option value="2020/2021">2020/2021</option>
    <option value="2021/2022">2021/2022</option>
    <option value="2022/2023">2022/2023</option>
    <option value="2023/2024">2023/2024</option>
    <option value="2024/2025">2024/2025</option>    
      </select>
</div>
</div>
</div>
<div class="row">
<div class="cell colspan4">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">

</div>
    </div>
</div>
</div>
</div>
</form>
<h4 class="head_bg_1"> <span class="mif-file-download"></span>UPLOADED LESSON NOTES </h4>
<table class="table border bordered">
<tr>
<th>SN</th>
<th>Subject</th>
<th>Class</th>
<th>Term</th>
<th>Session</th>
<th>Date Submitted</th>
<th width="20">Comment</th>
<th width="12">Status</th>
<th>Actions</th>
</tr>
<?php foreach ($teacher_note->result() as $note) { 
  $i=0?>
<tr>
<td><?php echo ++$i; ?></td>
<td><?php echo $note->subject; ?></td>
<td><?php echo $note->class; ?></td>
<td><?php echo $note->term; ?></td>
<td><?php echo $note->session; ?></td>
<td><?php echo $note->uploaded_at; ?></td>
<td><?php echo $note->comment; ?></td>
<td><?php echo $note->status; ?></td>
<td><a href="get_note/<?php echo $note->filename; ?>"><span class="mif-download"></span>Download</a><br /><br /><a style="color: red" onclick="deleteNote(<?php echo $note->id; ?>)"><span class="mif-bin"></span>Delete</a></td>
</tr>
<?php } ?>
</table>
</div>
</div>

<script type="text/javascript">
  function deleteNote(id)
        {
            
            var _noteid = id;
            swal({   
                title: "Are you sure?",   
                text: "Delete ?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, 
                function()
                { 
                    $("#spinner").css({"display":"block", "background-attachment":"fixed"})
                    $.post("deleteNote_Ajax",
                    {
                        id: _noteid,
                    },
                    function(data)
                    {
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        swal("SUCCESS", data, "success")
                        $('#commentcreate').text("")
                        setTimeout(window.location.assign("view_lessonnote"), 3000)
                        

                    });
                });

        }
</script>
</body>
</html>