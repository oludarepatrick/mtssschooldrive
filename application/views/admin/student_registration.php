<script type="text/JavaScript">
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#profileimage').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#imgInp").change(function(){
    readURL(this);
});



</script>

<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class='warning_bg_1'><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<?php if($this->session->flashdata('message')) { ?>
<h4 class='message_bg_1'><?php echo $this->session->flashdata('message'); ?></h4>
<?php } ?>
<form action="" method="post" enctype="multipart/form-data">

<div class="flex-grid">
<h4 class="head_bg_1">Student Information</h4>

   
   <?php //echo img(array('src'=>'uploads/school_logo.png', 'width'=>300, 'heigth'=>50))?>
<div class="row">
<div class="cell colspan1">
<img id="output" style="width: 100px;" />
<input name="userfile" type="file" accept="image/*" onchange="loadFile(event)" class="button">
<script>
  var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
  };
</script>

    </div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<h6 class="tx-red"><?php echo form_error('surname');?></h6>
<label>Surname:</label>
<div class="input-control text full-size">
    <input name="surname" type="text">
</div>
</div>
<div class="cell colspan3">
<label>First Name:</label>
<div class="input-control text full-size">
    <input name="fname" type="text">
</div>
</div>
<div class="cell colspan3">
<label>Other Name:</label>
<div class="input-control text full-size">
    <input name="othername" type="text">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Class:</label>
<div class="input-control full-size">
<select name="class" class="select">
      <option value='<?php echo set_select('class', '', TRUE); ?>'>--SELECT--</option>
      <?php $i=0;  foreach($query_class->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('class',}else{?>
        <option value="<?php echo $val->class;//$klass['customername'];?>" class="<?php  //echo $klass['customername']; ?>" ><?php echo $val->class;?>        </option>
     <?php } ?>
</select>
</div>
</div> 
<div class="cell colspan3">
<label>Gender:</label>
<div class="input-control full-size">
<select name="gender" class="select">
      <option value="AL">--SELECT--</option>
      <option value="MALE">Male</option>
      <option value="FEMALE">Female</option>
</select>
</div>
</div> 
<div class="cell colspan3">
<label>Class Division:</label>
<div class="input-control full-size">
<select name="class_arm" class="select">
      <option value="">--SELECT--</option>
      <?php $i=0;  foreach($query_class_division->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('class',}else{?>
        <option value="<?php echo $val->division;//$klass['customername'];?>" class="<?php  //echo $klass['customername']; ?>" ><?php echo $val->division;?>        </option>
     <?php } ?>
</select>
</div>
</div> 
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Term:</label>
<div class="input-control full-size">
<select name="term" class="select">
      <option value="AL">--SELECT--</option>
      <option value="FIRST TERM">First Term</option>
      <option value="SECOND TERM">Second Term</option>
      <option value="THIRD TERM">Third Term</option>
</select>
</div>
</div> 
<div class="cell colspan3">
<p id="adminreport" style="color: red; font-size: 12px; font-weight:bold"></p>
<label>Admission Number: </label>
<div class="input-control text full-size">
    <input name="adminno" type="text" id="adminno" onkeyup="adminNoCheck()">
</div>
</div>
<div class="cell colspan3">
<label>House:</label>
<div class="input-control full-size">
<select name="house" class="select">
      <option value="">--SELECT--</option>
      <option value="BLUE HOUSE">Blue House</option>
      <option value="GREEN HOUSE">Green House</option>
      <option value="YELLOW HOUSE">Yellow House</option>
 <option value="PURPLE HOUSE">Purple House</option>
 <option value="WHITE HOUSE">White House</option>
</select>
</div>
</div> 
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Date of Admission:</label>
<div class="input-control text full-size" data-role="datepicker" data-format="dd/mm/yyyy">
    <input name="date_admission" type="text">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
<div class="cell colspan3">
<label>Last School Attended:</label>
<div class="input-control text full-size">
    <input name="last_school" type="text">
</div>
</div>
<div class="cell colspan3">
<label>Last Class:</label>
<div class="input-control text full-size">
    <input name="last_class" type="text">
</div>
</div>
<div class="cell colspan3">
<label>Session:</label>
<div class="input-control full-size">
        <select name="session" class="select">
        <option value="<?php echo set_select('session', '', TRUE); ?>">SELECT SESSION</option>
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
<hr />
<h4 class="head_bg_1">Personal Information</h4>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Date of Birth:</label>
<div class="input-control text full-size" data-role="datepicker" data-format="dd/mm/yyyy">
    <input name="dob" type="text">
    <button class="button"><span class="mif-calendar"></span></button>
</div>
</div>
<div class="cell colspan3">
<label>State of Origin:</label>
<div class="input-control full-size">
<select class="select" name="state" >
      <option value=""<?php echo set_select('state', '', TRUE); ?>>--SELECT--</option>
      <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
      <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
      <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
      <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
      <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
      <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
      <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
      <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
      <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
      <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
      <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
      <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
      <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
      <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
      <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
      <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
      <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
      <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
      <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
      <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
      <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
      <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
      <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
      <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
      <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
      <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
      <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
      <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
      <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
      <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
      <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
      <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
      <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
      <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
      <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
      <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
    <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
</select>
</div>
</div>
<div class="cell colspan3">
<label>Nationality:</label>
<div class="input-control text full-size">
    <input name="nationality" type="text">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Religion:</label>
<div class="input-control text full-size">
    <select class="select" name="religion">
    <option value="">--SELECT--</option>
    <option value="CHRISTIANITY">CHRISTIANITY</option>
    <option value="MUSLIM">MUSLIM</option>
    <option value="OTHERS">OTHERS</option>
    </select>
</div>
</div>
<div class="cell colspan3">
<label>Blood Group:</label>
<div class="input-control full-size">
   <select class="select" name="blood_group">
      <option value=""<?php echo set_select('blood_group', '', TRUE); ?>>--SELECT--</option>
      <option value="O+"<?php  echo set_select('blood_group','O+'); ?>>O+</option>
      <option value="A"<?php  echo set_select('blood_group','A'); ?>>A</option>
      <option value="B"<?php  echo set_select('blood_group','B'); ?>>B</option>
      <option value="O-"<?php  echo set_select('blood_group','O-'); ?>>-O</option>
    </select>
</div>
</div>
<div class="cell colspan3">
<label>Genotype:</label>
<div class="input-control full-size">
<select class="select" name="genotype">
          <option value=""<?php echo set_select('genotype', '', TRUE); ?>>--SELECT--</option>
      <option value="AS"<?php  echo set_select('genotype','AS'); ?>>AS</option>
          <option value="AA"<?php  echo set_select('genotype','AA'); ?>>AA</option>
          <option value="AC"<?php  echo set_select('genotype','AC'); ?>>AC</option>
          <option value="SC" <?php  echo set_select('genotype','SC'); ?>>SC</option>
          <option value="SS"<?php  echo set_select('genotype','SS'); ?>>SS</option>
          </select>
</div>
</div>
</div>
<hr />
<h4 class="head_bg_1">Parent | Guardian Information</h4>
<div class="row flex-just-sb">
<div class="cell colspan5">
<label>Name:</label>
<div class="input-control text full-size">
<input type="text" name="initial">
</div>
</div>
<div class="cell colspan3">
<label>Occupation:</label>
<div class="input-control text full-size">
<input type="text" name="occupation">
</div>
</div>
<div class="cell colspan3">
<label>City:</label>
<div class="input-control text full-size">
<input type="text" name="city">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan12">
<label>Address:</label>
<div class="input-control text full-size">
<input type="text" name="address">
</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>State of Residence:</label>
<div class="input-control full-size">
<select class="select" name="state2">
      <option value=""<?php echo set_select('state', '', TRUE); ?>>--SELECT--</option>
      <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
      <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
      <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
      <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
      <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
      <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
      <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
      <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
      <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
      <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
      <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
      <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
      <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
      <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
      <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
      <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
      <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
      <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
      <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
      <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
      <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
      <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
      <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
      <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
      <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
      <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
      <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
      <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
      <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
      <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
      <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
      <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
      <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
      <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
      <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
      <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
    <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
</select>
</div>
</div>
<div class="cell colspan5">
<label>Email:</label>
<div class="input-control text full-size">
<input type="text" name="email">
</div>
</div>
<div class="cell colspan3">
<label>Mobile Number:</label>
<div class="input-control text full-size">
<input type="text" name="phone">
</div>
</div>
</div>

<input type="submit" name="submit" value="Submit" class="button success loading-pulse lighten primary">
</div>

<!--

      </span></td>
      <td><span class="style31">Admission Number </span></td>
      <td><span class="style29">
        <label>
        <input name="adminno" type="text" value="" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td height="64" bgcolor="#FFFFFF"><span class="style31">House</span></td>
      <td bgcolor="#FFFFFF"><span class="style29">
        <label>
        <select name="house">
		<option value="">--SELECT--</option>
          <option value="BLUE HOUSE">Blue House</option>
          <option value="GREEN HOUSE">Green House</option>
          <option value="YELLOW HOUSE">Yellow House</option>
        </select>
        </label>
      </span></td>
      <td bgcolor="#FFFFFF"><span class="style20"><span class="style31">Date of Admission </span></span></td>
      <td bgcolor="#FFFFFF"><input name="textfield6" type="text" /></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">Last School Attended </span></td>
      <td><span class="style29">
        <label>
        <input name="textfield3" type="text" />
        </label>
      </span></td>
      <td><span class="style30">Last Class in Section </span></td>
      <td><span class="style29"></span></td>
    </tr>
    <tr>
      <td height="64" colspan="4" bgcolor="#000000"><span class="style3">Personal Information </span></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">Date of Birth</span></td>
      <td><input name="dob" type="text" value="" /></td>
      <td><span class="style30">State of Origin</span></td>
      <td><span class="style29">
        <select name="state" >
      <option value=""<?php echo set_select('state', '', TRUE); ?>>--SELECT--</option>
      <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
      <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
      <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
      <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
      <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
      <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
      <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
      <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
      <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
      <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
      <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
      <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
      <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
      <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
      <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
      <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
      <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
      <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
      <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
      <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
      <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
      <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
      <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
      <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
      <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
      <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
      <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
      <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
      <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
      <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
      <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
      <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
      <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
      <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
      <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
      <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
	  <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
</select>
      </span></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">Nationality</span></td>
      <td><input name="nationality" type="text" value="" /></td>
      <td><span class="style30">Religion</span></td>
      <td><input name="religion" type="text" /></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">
        <label>Blood Group </label>
      </span></td>
      <td><span class="style29">
        <select name="blood_group">
          <option value="">--SELECT--</option>
		  <option value="O+">O+</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="O-">-O</option>
          </select>
      </span></td>
      <td><span class="style30">Genotype</span></td>
      <td><span class="style29">
        <select name="genotype">
          <option>--SELECT--</option>
		  <option>AS</option>
          <option>AA</option>
          <option>AC</option>
          <option>SC</option>
          <option>SS</option>
          </select>
      </span></td>
    </tr>
    <tr>
      <td height="73" colspan="4" bgcolor="#FFFF00"><span class="style23">Parents | Guardian Information </span></td>
    </tr>
    <tr>
      <td height="38" bgcolor="#FFFFFF"><span class="style30">Name (Surname) </span></td>
      <td height="38" bgcolor="#FFFFFF"><span class="style30">
        <label>Initial</label>
      </span></td>
      <td height="38" bgcolor="#FFFFFF"><span class="style30">Title</span></td>
      <td height="38" bgcolor="#FFFFFF"><span class="style30">City</span></td>
    </tr>
    <tr>
      <td height="24" bgcolor="#FFFFFF"><input name="parent_surname" type="text" /></td>
      <td height="24" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="initial" type="text" />
        </label>
      </span></td>
      <td height="24" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="title" type="text" value="" />
        </label>
      </span></td>
      <td height="24" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="city" type="text" value="" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td height="42" bgcolor="#FFFFFF"><span class="style30">Address</span></td>
      <td height="42" bgcolor="#FFFFFF"><span class="style30">State</span></td>
      <td height="42" bgcolor="#FFFFFF"><span class="style30">Email</span></td>
      <td height="42" bgcolor="#FFFFFF"><span class="style30">Mobile Number </span></td>
    </tr>
    <tr>
      <td height="37" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <textarea name="address" ></textarea>
        </label>
      </span></td>
      <td height="37" bgcolor="#FFFFFF"><span class="style29">
        <select name="state2" >
      <option value=""<?php echo set_select('state', '', TRUE); ?>>--SELECT--</option>
      <option value="Abia"<?php  echo set_select('state', 'Abia'); ?>>Abia</option>
      <option  value="Abuja"<?php  echo set_select('state', 'Abuja'); ?>>Abuja</option>
      <option  value="Adamawa"<?php  echo set_select('state', 'Adamawa'); ?>>Adamawa</option>
      <option value="AkwaIbom"<?php  echo set_select('state', 'AkwaIbom'); ?>>AkwaIbom</option>
      <option  value="Anambra"<?php  echo set_select('state', 'Anambra'); ?>>Anambra</option>
      <option  value="Bauchi"<?php  echo set_select('state', 'Bauchi'); ?>>Bauchi</option>
      <option  value="Bayelsa"<?php  echo set_select('state', 'Bayelsa'); ?>>Bayelsa</option>
      <option  value="Benue"<?php  echo set_select('state', 'Benue'); ?>>Benue</option>
      <option  value="Borno"<?php  echo set_select('state', 'Borno'); ?>>Borno</option>
      <option  value="CrossRiver"<?php  echo set_select('state', 'CrossRiver'); ?>>CrossRiver</option>
      <option  value="Delta"<?php  echo set_select('state', 'Delta'); ?>>Delta</option>
      <option  value="Ebonyi"<?php  echo set_select('state', 'Ebonyi'); ?>>Ebonyi</option>
      <option  value="Edo"<?php   echo set_select('state', 'Edo'); ?>>Edo</option>
      <option  value="Ekiti"<?php  echo set_select('state', 'Ekiti'); ?>>Ekiti</option>
      <option  value="Enugu"<?php  echo set_select('state', 'Enugu'); ?>>Enugu</option>
      <option  value="Gombe"<?php  echo set_select('state', 'Gombe'); ?>>Gombe</option>
      <option  value="Imo"<?php  echo set_select('state', 'Imo'); ?>>Imo</option>
      <option  value="Jigawa"<?php  echo set_select('state', 'Jigawa'); ?>>Jigawa</option>
      <option  value="Kaduna"<?php  echo set_select('state', 'Kaduna'); ?>>Kaduna</option>
      <option  value="Kano"<?php  echo set_select('state', 'Kano'); ?>>Kano</option>
      <option  value="Katsina"<?php  echo set_select('state', 'Katsina'); ?>>Katsina</option>
      <option  value="Kebbi"<?php  echo set_select('state', 'Kebbi'); ?>>Kebbi</option>
      <option  value="Kogi"<?php  echo set_select('state', 'Kogi'); ?>>Kogi</option>
      <option  value="Kwara"<?php  echo set_select('state', 'Kwara'); ?>>Kwara</option>
      <option  value="Lagos"<?php  echo set_select('state', 'Lagos'); ?>>Lagos</option>
      <option  value="Nassarawa"<?php  echo set_select('state', 'Nassarawa'); ?>>Nassarawa</option>
      <option  value="Niger"<?php  echo set_select('state', 'Niger'); ?>>Niger</option>
      <option  value="Ogun"<?php  echo set_select('state', 'Ogun'); ?>>Ogun</option>
      <option  value="Ondo"<?php  echo set_select('state', 'Ondo'); ?>>Ondo</option>
      <option  value="Osun"<?php   echo set_select('state', 'Osun'); ?>>Osun</option>
      <option  value="Oyo"<?php  echo set_select('state', 'Oyo'); ?>>Oyo</option>
      <option  value="Plateau"<?php   echo set_select('state', 'Plateau'); ?>>Plateau</option>
      <option  value="Rivers"<?php  echo set_select('state', 'Rivers'); ?>>Rivers</option>
      <option  value="Sokoto"<?php  echo set_select('state', 'Sokoto'); ?>>Sokoto</option>
      <option  value="Taraba"<?php  echo set_select('state', 'Taraba'); ?>>Taraba</option>
      <option  value="Yobe"<?php  echo set_select('state', 'Yobe'); ?>>Yobe</option>
	  <option  value="Zamfara"<?php  echo set_select('state', 'Zamfara'); ?>>Zamfara</option>
</select>
      </span></td>
      <td height="37" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="email" type="text" onblur="MM_validateForm('textfield','','RisEmail');return document.MM_returnValue" value="" />
        </label>
      </span></td>
      <td height="37" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="phone" type="text" onblur="MM_validateForm('textfield','','NisNum');return document.MM_returnValue" value="" />
        </label>
      </span></td>
    </tr>
    <tr>
      <td height="73" bgcolor="#FFFFFF"><span class="style29">Occupation</span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input type="text" name="occupation" value="" />
        </label>
      </span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29"></span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29"></span></td>
    </tr>
    <tr>
      <td height="73" bgcolor="#FFFFFF"><span class="style30">
        <label></label>
      </span>        <span class="style29">
      <label></label>      
      <label></label>
      </span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29"></span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29"></span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input type="submit" name="Submit" value="Submit" />
        </label>
      </span></td>
    </tr>
    </div>
  </form>
  <p>&nbsp;</p>-->
</form>
</div>
</body>

<script>

function adminNoCheck()
        {
          var student_id = $('#adminno').val();
          $.post("checkAdminNo_Ajax",
                    {
                        student_id: student_id
                    },
                    function(data)
                    {
                        $('#adminreport').text(data)

                    });
        }

function showMyImage(fileInput){
var files = fileInput.files;
for(var i=0;i<files.length;i++)
{
var file = files[i];
var imageType = /image.*/;
if(!file.type.match(imageType)){
continue;
}
var img=document.getElementById("thumbnil");
img.file = file;
var reader = new FileReader();
reader.onload=(function(almg){
return function(e){
almg.src = e.target.result;
};
})(img);
reader.readAsDataURL(file);
}
}
</script>