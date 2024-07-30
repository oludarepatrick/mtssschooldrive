<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class='warning_bg_1'><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<div class="panel_bg_2">
<h4 class="head_bg_2"> CLASS TIME-TABLE </h4>
</div>
<div class="flex-grid">
<div class="row">
<div class="cell colspan10">
<table class="table stripe border bordered">
<thead>
<tr>
<th>S/N</th>
<th>Class</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($timetable as $table) { ?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $table->class; ?></td>
<td><a href="<?php echo base_url().'uploads/timetable/'.$table->filename; ?>"><span class="mif-download"></span>Download</a></td>
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
                        setTimeout(window.location.assign("view_lessonnote"), 3000)
                        

                    });
                });
}
</script>