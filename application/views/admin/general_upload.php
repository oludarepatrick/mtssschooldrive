<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class='warning_bg_1'><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<div class="panel_bg_2">

<h4 class="head_bg_2"> GENERAL UPLOADS </h4>
<p style="color: red">Files uploaded here are visible to all students in the class selected</p>
<form enctype="multipart/form-data" method="post" action="">
<div class="flex-grid">
<div class="cell colspan3">
<div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me to Upload" name="userfile">
        <button class="button"><span class="mif-folder"></span></button>
    
</div>
</div>
</div>
</div>

<div class="panel">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">GENERAL UPLOADS</span>
    </div>
  <div class="content">
<div class="flex-grid margin2">
<div class="row flex-just-sb">
<div class="cell colspan8">
<label>TITLE</label>
<div class="input-control text full-size">
<input type="text" name="title" placeholder="Title of Upload">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan8">
<label>DESCRIPTION</label>
<textarea name="description" style="width: 100%"></textarea>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>CLASS</label>

<div class="input-control full-size">
       <select name="class" class="select">
  <option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
  
 <?php
 $category = ($this->session->userdata['logged_in']['category']);
 if($category=="PRINCIPAL | HEADMASTER") 
    { ?>
    <option value="ALL CLASSES">ALL CLASSES</option>
    <?php foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php }
  } else { ?>
    <?php foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } }?>
</select>
</div>
</div>
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
    <div class="cell colspan3">
<label>CLASS DIVISION: </label>
<div class="input-control full-size">
    <select name="class_division" class="select">
    <option value="ALL">ALL DIVISIONS</option>
        <?php foreach($class_division as $class_div) { ?>
        <option value="<?php echo $class_div->division; ?>"><?php echo $class_div->division; ?></option>
        <?php } ?>
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
<h4 class="head_bg_1"> <span class="mif-file-download"></span>UPLOADS </h4>
<table class="table border bordered">
<tr>
<th>SN</th>
<th>Title</th>
<th>Class</th>
<th>Term</th>
<th>Session</th>
<th>Actions</th>
</tr>
<?php foreach ($uploads as $note) { 
  $i=0?>
<tr>
<td><?php echo ++$i; ?></td>
<td><?php echo $note->title; ?></td>
<td><?php echo $note->class." ".$note->class_division; ?></td>
<td><?php echo $note->term; ?></td>
<td><?php echo $note->session; ?></td>
<td><a href="<?php echo base_url().'uploads/general_upload/'.$note->filename; ?>"><span class="mif-download"></span>Download</a><br /><br /><a style="color: red" onclick="deleteNote(<?php echo $note->id; ?>)"><span class="mif-bin"></span>Delete</a></td>
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
                    $.post("deleteGeneralUpload_Ajax",
                    {
                        id: _noteid,
                    },
                    function(data)
                    {
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        swal("SUCCESS", data, "success")
                        $('#commentcreate').text("")
                        setTimeout(window.location.assign("general_upload"), 3000)
                        

                    });
                });

        }
</script>
</body>
</html>