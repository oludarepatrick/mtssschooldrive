<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class='warning_bg_1'><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<div class="panel_bg_2">
<h4 class="head_bg_2"> CLASS TIME-TABLE </h4>
<form enctype="multipart/form-data" method="post" action="">
<div class="flex-grid">
<div class="row">
<div class="cell colspan3">
<div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me to Upload Timetable" name="userfile" onChange="showMyImage(this)">
        <button class="button"><span class="mif-folder"></span></button>
    
</div>
</div>
</div>
</div>

<div class="panel">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">Time-Table Info</span>
    </div>
	<div class="content">
<div class="flex-grid">
<div class="row flex-just-sb" style="margin-top: 1%; padding: 1%;">
<div class="cell colspan4">
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

<div class="cell colspan4">
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
<div class="row" style="padding: 1%">
<div class="cell colspan4">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">

</div>
    </div>
</div>
</div>
</div>
</form>
</div>
<div class="flex-grid">
<div class="row">
<div class="cell colspan10">
<table class="table stripe border bordered">
<thead>
<tr>
<th>S/N</th>
<th>Class</th>
<th>Term</th>
<th>Session</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($timetable as $table) { ?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $table->class." ".$table->class_division; ?></td>
<td><?php echo $table->term; ?></td>
<td><?php echo $table->session; ?></td>
<td><a href="<?php echo base_url().'uploads/timetable/'.$table->filename; ?>"><span class="mif-download"></span>Download</a><a style="color: red" onclick="deleteTimetable(<?php echo $table->id; ?>)"><span class="mif-bin"></span>Delete</a></td>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>




<script type="text/javascript">
$(document).ready(function()
{
$('#photoimg').live('change', function()
{
$("#preview").html('');
$("preview").html('<img src="loader.gif" alt="uploading".../>');
$("#imageform").ajaxform(
{
target: '#preview'
}).submit();
});
});

function deleteTimetable(id)
{
	var _tableid = id;
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
                    $.post("deleteTimetable_Ajax",
                    {
                        id: _tableid,
                    },
                    function(data)
                    {
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        swal("SUCCESS", data, "success")
                        $('#commentcreate').text("")
                        setTimeout(window.location.assign("timetable"), 3000)
                        

                    });
                });
}
</script>