<div class="m-content">
<h3>CREATE EXAM</h3>
<div class="grid">
    <div class="row cells12">
        <div class="cell offset9 colspan2"><button class="button" id="add-exam-modal">Add Exam</button></div>
    </div>
    <div class="row cells12">
        <table class="table striped hovered border bordered">
            <thead>
                <tr>
                    <th>S/N</th>
                    <th>Subject</th>
                    <th>Class</th>
                    <th>Session</th>
                    <th>Term</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach($exams as $e) { ?>
                    <tr>
                        <td><?php echo($i); $i++ ?></td>
                        <td><?php echo($e->subject); ?></td>
                        <td><?php echo($e->class); ?></td>
                        <td><?php echo($e->session); ?></td>
                        <td><?php echo($e->term); ?></td>
                        <td><button class="button" onclick="location.href='/index.php/cbt/edit_theory/<?php echo($e->id); ?>'">Edit Questions</button><button class="button exam-options" data-exam-id="<?php echo($e->id); ?>">Exam Options</button><!--<button class="button">View Exam</button>--></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>

<div class="remodal" data-remodal-id="exam-option-modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2>Edit Option</h2>
    <div class="grid">
        <div class="row cells12">
            <div class="cell colspan3">
                <select id="edit-subject">
                    <option value="">SUBJECT</option>
                    <?php foreach($subjects as $s) { ?>
                    <option value="<?php echo(strtolower($s->subject)); ?>"><?php echo($s->subject); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="cell colspan3">
                  <select id="edit-class">
                      <option value="">CLASS</option>
                      <?php foreach($classes as $c) { ?>
                      <option value="<?php echo(strtolower($c->class)); ?>"><?php echo($c->class); ?></option>
                      <?php } ?>
                  </select>
            </div>
            <div class="cell colspan3">
                <select id="edit-term">
                    <option value="">TERM</option>
                    <option value="FIRST TERM">FIRST TERM</option>
                    <option value="SECOND TERM">SECOND TERM</option>
                    <option value="THIRD TERM">THIRD TERM</option>
                </select>
          </div>
      </div>
      <div class="row cells12">
          <div class="cell colspan3">
                <label>Time(mins):</label>
                <input type="text" id="edit-time">
          </div>
          <div class="cell colspan3">
          	<label>Exam Visible</label>
          	<input type="checkbox" id="edit-visibility">
          </div>

      </div>
    </div>
    <br>
    <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
    <button id="edit-exam-option" class="remodal-confirm">OK</button>
</div>

<div class="remodal" data-remodal-id="add-exam-modal">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h2>Add Exam</h2>
    <div class="grid">
        <div class="row cells12">
            <div class="cell colspan4">
                <select id="subject">
                    <option value="">SUBJECT</option>
                    <?php foreach($subjects as $s) { ?>
                    <option value="<?php echo(strtolower($s->subject)); ?>"><?php echo($s->subject); ?></option>
                    <?php } ?>
                </select>
            </div>
              <div class="cell colspan4">
                  <select id="class">
                      <option value="">CLASS</option>
                      <?php foreach($classes as $c) { ?>
                      <option value="<?php echo(strtolower($c->class)); ?>"><?php echo($c->class); ?></option>
                      <?php } ?>
                  </select>
            </div>
            <div class="cell colspan4">
                <select id="term">
                    <option value="">TERM</option>
                    <option value="FIRST TERM">FIRST TERM</option>
                    <option value="SECOND TERM">SECOND TERM</option>
                    <option value="THIRD TERM">THIRD TERM</option>
                </select>
          </div>
      </div>
  </div>
  <br>
  <button data-remodal-action="cancel" class="remodal-cancel">Cancel</button>
  <button id="add-exam" class="remodal-confirm">OK</button>
</div>
<script>
    $("#add-exam-modal").on("click", function()
    {
        var inst = $('[data-remodal-id=add-exam-modal]').remodal();
        inst.open();
    })
    $("#add-exam").on("click", function()
    {
        $("#spinner").css({"display":"block", "background-attachment":"fixed"});
        $.post('/index.php/cbt/create_theory',
        {
            'subject':  $('#subject').val(),
            'class':    $('#class').val(),
            'term':     $('#term').val()
        },
        function(data)
        {
            console.log(data);
            $("#spinner").css({"display":"none", "background-attachment":"fixed"});
            var inst = $('[data-remodal-id=add-exam-modal]').remodal();
            inst.close();
            alert(data);
            location.reload()
        })
    })

    $('.exam-options').on('click', function()
    {
        exam_id = $(this).attr('data-exam-id');
        $.post('/index.php/cbt/theory_exam_options',
        {
            exam_id: exam_id
        },
        function(data){
            var inst = $('[data-remodal-id=exam-option-modal]').remodal();
            inst.open();
            var result = JSON.parse(data);
            $("#edit-time").val(result[0].time)
            $("#edit-subject").val(result[0].subject.toLowerCase())
            $("#edit-class").val(result[0].class.toLowerCase())
            $("#edit-term").val(result[0].term)
            if(result[0].visible=="1")
            {
            	$("edit-visibility").attr("checked", "checked");
            }
        })
    })

    $('#edit-exam-option').on('click', function()
    {
        var exam_time = $("#edit-time").val()
        var subject = $("#edit-subject").val()
        var clas = $("#edit-class").val()
        var term = $("#edit-term").val()
        $.post('/index.php/cbt/update_theory',
        {
            exam_id: exam_id,
            time: exam_time,
            subject: subject,
            'class': clas,
            'term': term,
            'visibility': $('#edit-visibility:checked').length,
        },
        function(data){
            alert("Updated");
            location.reload()
        })
    })
</script>
