<html>
<body>
<style>
.size{ width:290px}
</style>
<div class="m-content">
<?php //echo form_open('school_settings/insert_teacher_comment');?>
<?php //echo $message;?>
<div class="flex-grid">


 <p style="color: red; font-weight: bold;">Comments can only be entered for current term and session</p>     
<div align="right">

                 <table class="table striped border hovered bordered students">
                     
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
  <select class="basic" id="commentfrombank" onchange="inputComment()">
  <option>SELECT COMMENT OR ENTER COMMENT IN TEXT BOX</option>
  </select>
  <div class="cell colspan5" align="left">
  <textarea id="resultcomment" style="width: 100%"></textarea>
  </div>
  </div>
  <div class="row">
  <div class="cell colspan2">
  <button class="button small-button success" type="button" onclick="submitComment()">Enter Comment</button>
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
         </html>
	<script>
    $.post("getTeacherComments_Ajax",
        {
            check: 1
        },
        function(data1){
          var comms = JSON.parse(data1);
          //console.log(data);
          for(i=0;i<comms.length;i++)
          {
            var c = $('#commentfrombank');
            c.append('<option value="'+comms[i].comment+'">'+comms[i].comment+'</option>')
          }
            });
          
    $.post("getClassTeacherStudents_Ajax",
        {
            check: 1
        },
        function(data2){
          var students = JSON.parse(data2);
          //console.log(data2);
          $('.students').append('<thead><tr><th>sn</th><th>Student Name</th><th>Comment</th></tr></thead>');
          var i;
          var j;
          j=0; 
          $('.teachers').append('<tbody>')
          clas = students[1].class;
          clas_division = students[1].class_division;
          for(i=0; i<=students.length; i++)
          {
              j++
              
              $('.students').append('<tr><td>'+j+'</td><td id="'+j+'">'+students[i].surname+" "+students[i].firstname+" "+students[i].othername+'</td><td><button class="button mini-button warning" onclick=teacherComment("'+students[i].student_id+'")>Comment</button></td></tr>');

             
          }
          $('.students').append('</tbody>')
        });
        $("table").dataTable();
      

       function inputComment()
       {
        var c = $('#commentfrombank').val();
        $('#resultcomment').val(c)
       }

        function teacherComment(id)
        {
          student_id = id;
          $.post("getCommentOnStudentResult_Ajax",
            {
                student_id: student_id
            },
            function(data){
              console.log(data);
              var comment = $('#resultcomment').val(data);
            });
          var inst = $('[data-remodal-id=createmodal]').remodal();
          inst.open();
          
        }

        function submitComment()
        {
          var id = student_id;
          var comment = $('#resultcomment').val();

          $.post("submitClassTeacherComment_Ajax",
          {
              student_id: id,
              comment: comment,
              class: clas,
              class_division: clas_division
          },
          function(data){
            console.log(data)
            var inst = $('[data-remodal-id=createmodal]').remodal();
            inst.close();
            $('#commentfrombank').val('');
            $('#resultcomment').val('');
            swal("Notice!", "Comment has been Submitted!", "success")

          });
        }


        /*function(data)
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
        }*/
    </script>