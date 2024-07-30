<div class="m-content">

<form action="" method="post">
<div class="panel_bg_2">
<div class="flex-grid">
<div class="row flex-just-sb">
<div class="cell colspan2">
<select id="term" class="basic" name="term">
<option>SELECT TERM</option>
<option value="FIRST TERM">FIRST TERM</option>
<option value="SECOND TERM">SECOND TERM</option>
<option value="THIRD TERM">THIRD TERM</option>
</select>
</div>
<div class="cell colspan2">
<select id="session" class="basic" name="session">
<option>SELECT SESSION</option>
</select>
</div>
<div class="cell colspan1">
<button type="submit" class="button success" onclick="getResults()">Submit</button>
</div>
</div>
</div>
</div>
</form>

<?php if(isset($result)) {?>
<div class="flex-grid">
      <div class="row flex-just-sb">
      <div class="cell colspan7">
      <p><b>Name: </b> <?php echo $result[0]->studentname; ?></p>
        <p><b>Admin No. : </b><?php echo $result[0]->student_id; ?></p>
        <p><b>Class : </b><?php echo $result[0]->class; ?></p>
        <p><b>Class Division : </b><?php echo $result[0]->class_division; ?></p>
        </div>
        <div class="cell colspan4">
        <img src="<?php echo base_url().'uploads/perm_upload/student/'.$result[0]->student_id.'.jpg';?>" width="200" height="100">
        </div>
        </div>
        <div class="row">
<table class="table border bordered">
        <thead>
          <tr>
            <th>Subject</th>
            
            <th>Exam</th>
            <th>Total</th>
          </tr>
        </thead>
        <?php for($i=0; $i<count($result); $i++) {?>
        <tr><td><?php echo $result[$i]->subject; ?></td>
        
       <td><?php echo $result[$i]->exam; ?></td>
       <td><?php echo $result[$i]->exam; ?></td>
       </tr>
        <?php } ?>
        <tr><td colspan="4"><a target="blank" onclick="print_result()" href="print_mock_result?term=<?php echo $result_details[2]; ?>&amp;session=<?php echo $result_details[3]; ?>&amp;class=<?php echo $result_details[0]; ?>&amp;class_division=<?php echo $result_details[1]; ?>&amp;student_id=<?php echo $result[1]->student_id; ?>" class="button success">Print Result</a></td></tr>
        </table>
        </div>
        </div>

        </td>

      </tr>

      </tbody>
    </table>
    </div>
    </div>
<?php } ?>
</div>

<script type="text/javascript">
$('.basic').fancySelect();
	$.post("getSessionsMock_Ajax",
        {
            check: 1
        },
        function(data1){
        	console.log(data1);
          var session = JSON.parse(data1);
          //console.log(data);
          var i;
          for(i=0;i<session.length;i++)
          {
            var c = $('#session');
            c.append('<option value="'+session[i].session+'">'+session[i].session+'</option>')
          }
          var mySelect = $('.basic')
           mySelect.trigger('update.fs');
            });

</script>