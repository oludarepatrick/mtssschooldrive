<style>
.size{ width:290px}
</style>
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
				 </body> 
	<script>
    $.post("getTeacherComments_Ajax",
        {
            check: 1
        },
        function(data)
        {
            var comments = JSON.parse(data);
            $('.comments').append('<thead><tr><th>sn</th><th>Comment</th><th>Change/Delete</th></tr></thead>');
            var i;
            var j;
            j=0; 
            $('.comments').append('<tbody>')
            for(i=0; i<=comments.length; i++)
            {
                j++
                
                $('.comments').append('<tr><td>'+j+'</td><td id="'+j+'">'+comments[i].comment+'</td><td><a href="#" class="button mini-button warning" onclick="editComment('+comments[i].id+')">Edit</a>&nbsp;&nbsp;<a href="#" class="button mini-button danger" onclick="deleteComment('+comments[i].id+')">Delete</a></td></tr>');
               
            }
            $('.comments').append('</tbody>')

        })

        function openCommentForm()
        {
            var inst = $('[data-remodal-id=createmodal]').remodal();
            inst.open();
        }

        function addComment()
        {
            
            var comment = $('#commentcreate').val();
            console.log('comment')
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
                    $.post("createComment_Ajax",
                    {
                        comment: comment,
                        owner: "teacher"
                    },
                    function(data)
                    {
                        $('.comments').empty();
                        getComments()
                        var inst = $('[data-remodal-id=createmodal]').remodal();
                        inst.close();
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        $('#commenttext').val("")

                    });
                });

        }

        function deleteComment(id)
        {
            var id = id;
            swal({   
                title: "Are you sure?",   
                text: "Delete the Comment?",   
                type: "warning",   
                showCancelButton: true,   
                confirmButtonColor: "#DD6B55",   
                confirmButtonText: "Procced!",   
                closeOnConfirm: true 
            }, 
                function()
                { 
                    $("#spinner").css({"display":"block", "background-attachment":"fixed"})
                    $.post("deleteComment_Ajax",
                    {
                        id: id,
                    },
                    function(data)
                    {
                        $('.comments').empty();
                        getComments()
                        var inst = $('[data-remodal-id=modal]').remodal();
                        inst.close();
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        $('#commenttext').val("")

                    });
                });
        }

        function getComments()
        {
            $.post("getTeacherComments_Ajax",
        {
            check: 1
        },
        function(data)
        {
            var comments = JSON.parse(data);
            $('.comments').append('<thead><tr><th>sn</th><th>Comment</th><th>Change/Delete</th></tr></thead>');
            var i;
            var j;
            j=0; 
            $('.comments').append('<tbody>')
            for(i=0; i<=comments.length; i++)
            {
                j++
                
                $('.comments').append('<tr><td>'+j+'</td><td id="'+j+'">'+comments[i].comment+'</td><td><a href="#" class="button mini-button warning" onclick="editComment('+comments[i].id+')">Edit</a>&nbsp;&nbsp;<a href="#" class="button mini-button danger" onclick="deleteComment('+comments[i].id+')">Delete</a></td></tr>');
               
            }
            $('.comments').append('</tbody>')

        })
        }

        function notifyOnErrorInput(input){
            var message = input.data('validateHint');
            /*$.Notify({
                caption: 'Error',
                content: message,
                type: 'alert'
            });*/
        }
        function editComment(id)
        {
            var comment = $('#'+id+'').text();
            identity = id;
            var inst = $('[data-remodal-id=modal]').remodal();
            inst.open();
            $('#commenttext').val(comment)
        }

        function updateComment()
        {
            var comment = $('#commenttext').val()
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
                    $.post("updateComment_Ajax",
                    {
                        comment: comment,
                        id: identity
                    },
                    function(data)
                    {
                        $('.comments').empty();
                        getComments()
                        var inst = $('[data-remodal-id=modal]').remodal();
                        inst.close();
                        $("#spinner").css({"display":"none", "background-attachment":"fixed"})
                        $('#commenttext').val("")

                    });
                });
        }
    </script>