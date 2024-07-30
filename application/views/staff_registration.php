
<div class="m-content">
<div class="row">
<div id="errors">
</div>
</div>
<?php if($this->session->flashdata('message')) { ?>
<h4 class="head_bg_1"><?php echo($this->session->flashdata('message')); ?></h4>
<?php } ?>
<form action="register_staff" method="post">
<h4 class="head_bg_1">Staff Information</h4>
<?php if(isset($message)) { ?>
<h5 class="message_bg_1"><?php echo $message; ?></h5>
<?php } ?>
<div class="flex-grid">
<div class="row flex-just-sb">
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('fname');?></h6>
<label>First Name:</label>
<div class="input-control text">
        <input id="fname" name="fname" type="text" />
</div>
</div>
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('surname');?></h6>
<label>Surname:</label>
<div class="input-control text">
  <input id="surname" name="surname" type="text" />
</div>
</div>
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('username');?></h6>
<label>Username:</label>
<div class="input-control text">
  <input id="username" name="username" type="text" />
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('password');?></h6>
<label>Password:</label>
<div class="input-control password">
  <input id="password" name="password" type="password" />
</div>
</div>
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('passconf');?></h6>
<label>Password Confirmation:</label>
<div class="input-control password">
  <input id="passconf" name="passconf" type="password"  />
 </div>
 </div>
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('phone');?></h6>
<label>Mobile Number:</label>
<div class="input-control text">
  <input id="phone" name="phone" type="text"  />
</div>
</div>

 </div>
 <div class="row flex-just-sb">
 <div class="cell colspan3">
 <h6 class="tx-red"><?php echo form_error('email');?></h6>
<label>Email:</label>
<div class="input-control text">
    <input id="email" name="email" type="text"  />
</div>
</div>
</div>
<hr />

<h4 class="head_bg_1">Class | Subject Details</h4>
<div class="row flex-just-sb">
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('staff_cat');?></h6>
<label>Teacher's Category</label>
<div class="input-control full-size">
  <select name="staff_cat" id="staff_cat" class="select" onchange="showDetail('staff_cat')">
    <option value="<?php echo set_select('class', '', TRUE); ?>">--SELECT--</option>
    <option value="CLASS TEACHER">CLASS TEACHER</option>
    <option value="SUBJECT TEACHER"<?php  echo set_select('staff_cat','SUBJECT TEACHER'); ?>>SUBJECT TEACHER</option>
    <option value="PRINCIPAL"<?php  echo set_select('staff_cat','PRINCIPAL'); ?>>PRINCIPAL | HM</option>
    <option value="CLASS | SUBJECT TEACHER"<?php  echo set_select('staff_cat','CLASS | SUBJECT TEACHER'); ?>>CLASS | SUBJECT TEACHER</option>
  </select>
</div>
</div>
<div class="cell colspan3" id="class" style="display:none">
<label>Class:</label>
<div class="input-control full-size">
      <select name="classes" class="select">
        <option>Select Class</option>
        <option>Basic Two</option>
        <option>Basic Three</option>
        <option>Basic Four</option>
        <option>Basic Five</option>
        <option>Basic Six</option>
      </select>
</div>
</div>
<div class="cell colspan3" id="class_arm" style="display:none">
<label>Class Arm:</label>
<div class="input-control full-size">
  <select name="class_arm" class="select">
    <option value="<?php echo set_select('class_arm', '', TRUE); ?>">--SELECT--</option>
  	<?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
    <option value="<?php echo $val->division;?>" ><?php echo $val->division;?>   		  </option>
 <?php } ?>
  </select>
</div>
</div>
</div>
<div id="subparent" style="display:none;">
<div class="row" id="subject1">
<div class="cell colspan12">
<label>Subject:</label>
<div class="input-control">
<select name="subject[]" class="select" id="subjects">
<option value="<?php echo set_select('subject', '', TRUE); ?>">--SELECT--</option>
    <?php $i=0;  foreach($query_subjects->result() as $value){ $i+=1;?>
    <option value="<?php echo $value->course;?>" ><?php echo $value->course;?></option>
 <?php } ?>

</select>&nbsp;<span class="icon mif-plus fg-blue" onclick="addSubject()"></span>
</div>
<br />
<div id="checkbox">
<?php $i=0;  foreach($query_classes->result() as $valu){ $i+=1;?>
    <label class="input-control checkbox small-check">
    <span class="caption"><?php echo($valu->class); ?></span>
    <input type="checkbox" name="class[0][]" value="<?php echo($valu->class); ?>">
    <span class="check"></span>
</label>
 <?php } ?>
</div>
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
  <input id="submitbutton" type="submit" name="Submit" value="Submit" />
</div>
</div>
</div>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
    $("#submitbutton").click(function(event){
        event.preventDefault();
          $('#errors').empty()
          var fname = $('#fname').val();
          var surname = $('#surname').val();
          var username = $('#username').val();
          var password1 = $('#password').val();
          var password2 = $('#passconf').val();
          var phone = $('#phone').val();
          var email = $('#email').val();
          if(password1!=password2){
            $('#errors').append('<p style="color: red">Passwords do not match</p>');
          }
          else if(fname==""||surname==""||username==""||phone==""||email=="")
          {
            $('#errors').append('<p style="color: red">All fields are required</p>');
          }
          else
          {
            $(this).unbind('click').click();
          }
    });
});
  function addSubject()
  {
    var lastel = $('div[id=subparent] div[class=row]:last-child').attr("id");
    console.log(lastel)
    lastel = lastel.replace(/subject/gi, "");
    var temp = $('#checkbox').html();
    if(typeof l == 'undefined') {
      l=0;
      ++l
    } else {
    ++l
    }
    var temp = temp.replace(/class\[0\]\[\]/gi, "class"+"["+l+"]"+"[]")

    var par = $('#subjects').html();
    var subparent = $('#subparent');
    var id_n = ++lastel;
    var icon = '&nbsp;<span class="icon mif-cross fg-blue" onclick="removeSubject(\'subject'+id_n+'\')"></span>';
    subparent.append('<div class="row" id="subject'+id_n+'"><div class="cell colspan12"><label>Subject: </label><div class="input-control"><select class="select" name="subject[]">'+par+'</select>'+icon+'</div><br />'+temp+'</div></div>')
$(function(){
        $(".select").select2();
    });

    console.log(id_n)
    console.log(lastel)
    lastel = null
  }

  function removeSubject(id_name)
  {
    $('#'+id_name).remove();
    console.log(id_name);
    --l
  }

  function showDetail(id_name)
  {
    var staff_cat = $('#'+id_name).val()
    console.log(staff_cat)
    if(staff_cat == 'CLASS | SUBJECT TEACHER') {
      $('#class').css('display', 'block')
      $('#class_arm').css('display', 'block')
      $('#subparent').css('display', 'block')
      $(function(){
        $(".select").select2();
    });
    } else if(staff_cat == 'CLASS TEACHER') {
      $('#class_arm').css('display', 'block')
      $('#class').css('display', 'block')
      $('#subparent').css('display', 'none')
      $(function(){
        $(".select").select2();
    });
    } else if(staff_cat == 'SUBJECT TEACHER') {
      $('#subparent').css('display', 'block')
      $('#class').css('display', 'none')
      $('#class_arm').css('display', 'none')
      $(function(){
        $(".select").select2();
    });
    } else {
      $('#class').css('display', 'none')
      $('#class_arm').css('display', 'none')
      $('#subparent').css('display', 'none')
    }

  }
</script>
</body>
</html>
