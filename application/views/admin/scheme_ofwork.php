<body>
<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class='warning_bg_1'><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<div class="panel_bg_2">
<h4 class="head_bg_2"> SCHEME OF WORK </h4>
<p style="color: red">You can only upload for current term and session</p>
<div class="flex-grid">
<form enctype="multipart/form-data" action="" method="post">
<div class="cell colspan3">
<div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me to Upload SCHEME" name="userfile">
        <button class="button"><span class="mif-folder"></span></button>
    
</div>
</div>
</div>
</div>

<div class="panel">
	<div class="content">
<div class="flex-grid">

<div class="row">
<div class="cell colspan4">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">

</div>
    </div>
</div>
</div>
</div>
</form>
<table class="table striped border bordered">
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
<?php $i=1; foreach($scheme as $table) { ?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $table->class." ".$table->class_division; ?></td>
<td><?php echo $table->term; ?></td>
<td><?php echo $table->session; ?></td>
<td><a href="<?php echo base_url().'uploads/scheme_of_work/'.$table->filename; ?>"><span class="mif-download"></span>Download</a><a style="color: red" onclick="deleteScheme(<?php echo $table->id; ?>)"><span class="mif-bin"></span>Delete</a></td>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</div>
</body>
<script>
function deleteScheme(id)
{
	var _schemeid = id;
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
                    $.post("deleteScheme_Ajax",
                    {
                        id: _schemeid,
                    },
                    function(data)
                    {
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        swal("SUCCESS", data, "success")
                        $('#commentcreate').text("")
                        setTimeout(window.location.assign("scheme"), 3000)
                        

                    });
                });
}
</script>
</html>
