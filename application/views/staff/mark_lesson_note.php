 <div class="remodal-bg">
<div class="limiter">
<div class="remodal" data-remodal-id="createmodal">
  <button data-remodal-action="close" class="remodal-close"></button>
  <div class="row">
  <div class="cell colspan1">
  <strong>Status: </strong>
  </div>
  <div class="cell colspan2" align="left">
  <select id="status" class="basic">
  	<option value="SELECT STATUS">SELECT STATUS</option>
  	<option value="APPROVED">APPROVED</option>
  	<option value="PENDING">PENDING</option>
  	<option value="ERRORS">ERRORS</option>
  </select>
  </div>
  </div>
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
  <button class="button small-button success" type="button" onclick="addComment()">Click to comment on Lesson Note</button>
  </div>
  </div>
  </div>
  </div>
  </div>

<div class="m-content">
<table class="table border striped bordered" style="width: 100%">
<thead>
<tr>
<th>S/N</th>
<th>Class</th>
<th>Subject</th>
<th>Term</th>
<th>Session</th>
<th>Uploaded At</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php $i=1; foreach($notes as $note) { ?>
<tr>
<td><?php echo $i; ?></td>
<td><?php echo $note->class; ?></td>
<td><?php echo $note->subject; ?></td>
<td><?php echo $note->term; ?></td>
<td><?php echo $note->session; ?></td>
<td><?php echo $note->uploaded_at; ?></td>
<td><a href="get_note/<?php echo $note->filename; ?>"><span class="mif-file-download"></span>Download</a>&nbsp;&nbsp;<a style="color: red; cursor: pointer;" onclick="commentNote(<?php echo $note->id; ?>)"><span class="mif-clipboard"></span>Comment</a></td>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</div>

<script type="text/javascript">
		$('.basic').fancySelect();

        function commentNote(id)
        {
            $('#commentcreate').text('')
            $('#status').val('')
            _noteid = id;
            $("#spinner").css({"display":"block", "background-attachment":"fixed"})
            getNoteComment();
            $("#spinner").css({"display":"none", "background-attachment":"fixed"})
            getNoteComment()
            
            

        }

        function getNoteComment()
        {
          $.post("getNoteComment_Ajax",
                    {
                        id: _noteid,
                    },
                    function(data)
                    {	
                    	var result = JSON.parse(data);
                        $('#commentcreate').val(result[0].comment)
                        $('#status').val(result[0].status)
                        var mySelect = $('.basic');
                        mySelect.trigger('update.fs');
                        var inst = $('[data-remodal-id=createmodal]').remodal();
                        inst.open();

                    });
          //var mySelect = $('.basic')
            //mySelect.trigger('update.fs');
        }


        function addComment()
        {
          var inst = $('[data-remodal-id=createmodal]').remodal();
            inst.close();
            
            var comment = $('#commentcreate').val();
            var status = $('#status').val();
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
                    $.post("insertNoteComment_Ajax",
                    {
                        id: _noteid,
                        comment: comment,
                        status: status
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