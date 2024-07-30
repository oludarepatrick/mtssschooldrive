<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.style3 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #FFFFFF;
	font-size: 18px;
}
.style15 {font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; color: #FF00FF; }
.style20 {color: #000000}
.style23 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #006600;
}
.style26 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 18px; }
.style28 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 14px; color: #000000; }
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style30 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style31 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #000000; }
body {
	background-color: #FDFDFD;
}
-->
</style>
<script type="text/JavaScript">
/*<!--
function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_validateForm() { //v4.0
  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
    if (val) { nm=val.name; if ((val=val.value)!="") {
      if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
        if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
      } else if (test!='R') { num = parseFloat(val);
        if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
        if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
          min=test.substring(8,p); max=test.substring(p+1);
          if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
    } } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
  } if (errors) alert('The following error(s) occurred:\n'+errors);
  document.MM_returnValue = (errors == '');
}*/
//-->
</script>
</head>

<body>
<form action="" method="post">
<table width="57%" border="0" align="center" bgcolor="#FFFF00">
  <tr>
    <td height="56" bgcolor="#66FF33"><span class="style3">Student Registration </span></td>
  </tr>
</table>

  <table width="57%" border="0" align="center">
    <tr>
      <td width="30%" height="170"><div align="center"><img src="" alt="" name="Passport" width="236" height="180" id="Passport" style="background-color: #33FF00" /></div></td>
      <td width="18%" rowspan="2">&nbsp;</td>
      <td width="52%" rowspan="2"><?php echo $sucess; ?></td>
    </tr>
    <tr>
      <td height="37"><input name="file" type="file" class="style15" size="10" /></td>
    </tr>
  </table>
  <table width="57%" border="0" align="center">
    <tr>
      <td height="62" colspan="4" bgcolor="#FFFF00"><span class="style26">Student Information </span></td>
    </tr>
    <tr>
      <td width="20%" height="48" bgcolor="#FFFFCC"><span class="style28">Surname </span></td>
      <td width="21%" bgcolor="#FFFFCC"><span class="style29">
        <label>
        <input name="surname" type="text" value="<?php  echo set_value('surname');?>" />
        </label>
      </span><?php echo form_error('surname');?></td>
      <td width="20%" bgcolor="#FFFFCC"><span class="style30">Other Name </span></td>
      <td width="39%" bgcolor="#FFFFCC"><span class="style29">
        <label>
        <input name="othername" type="text" value="<?php  echo set_value('othername');?>" />
        </label>
      </span><?php //echo form_error('othername');?></td>
    </tr>
    <tr>
      <td height="54"><span class="style28">First Name</span></td>
      <td><span class="style29">
        <label>
        <input name="fname" type="text" value="<?php  echo set_value('fname')?>" />
        </label>
      </span><?php echo form_error('fname');?></td>
      <td><span class="style31">Class</span></td>
      <td><span class="style29">
        <label>
        <select name="class">
		<option value="<?php echo set_select('class', '', TRUE); ?>">--SELECT--</option>
      	<?php $i=0;  foreach($query_class->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->class; ?>" ><?php echo $val->class;?>  </option>
     <?php } ?>
        </select>
        </label>
      </span><?php echo form_error('class');?></td>
    </tr>
    <tr>
      <td height="53" bgcolor="#FFFFFF"><span class="style28">Gender</span></td>
      <td bgcolor="#FFFFFF"><span class="style29">
        <label>
        <select name="gender">
		<option value=""<?php echo set_select('gender', '', TRUE); ?>>--SELECT--</option>
          <option value="MALE" <?php  echo set_select('gender','MALE'); ?>>Male</option>
          <option value="FEMALE"<?php  echo set_select('gender','FEMALE'); ?>>Female</option>
        </select>
        </label>
      </span><?php echo form_error('gender');?></td>
      <td bgcolor="#FFFFFF"><span class="style31">Class Division </span></td>
      <td bgcolor="#FFFFFF"><span class="style29">
        <label>
        <select name="class_arm">
		<option value="<?php echo set_select('class_arm', '', TRUE); ?>">--SELECT--</option>
      	<?php $i=0;  foreach($query_class_division->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('class',}else{?>
        <option value="<?php echo $val->division;//$klass['customername'];?>" class="<?php  //echo $klass['customername']; ?>" ><?php echo $val->division;?>   		  </option>
     <?php } ?>
        </select>
        </label>
      </span><?php echo form_error('class_arm');?></td>
    </tr>
    <tr>
      <td height="56"><span class="style28">Term</span></td>
      <td><span class="style29">
        <label>
        <select name="term">
		<option value=""<?php echo set_select('term', '', TRUE); ?>>--SELECT--</option>
          <option value="FIRST TERM">First Term</option>
          <option value="SECOND TERM">Second Term</option>
          <option value="THIRD TERM">Third Term</option>
        </select>
        </label>
      </span><?php echo form_error('term');?></td>
      <td><span class="style31">Admission Number </span></td>
      <td><span class="style29">
        <label>
        <input name="adminno" type="text" value="<?php  echo set_value('adminno');?>" />
        </label>
      </span><?php echo form_error('adminno');?></td>
    </tr>
    <tr>
      <td height="64" bgcolor="#FFFFFF"><span class="style31">House</span></td>
      <td bgcolor="#FFFFFF"><span class="style29">
        <label>
        <select name="house">
		<option value=""<?php echo set_select('house', '', TRUE); ?>>--SELECT--</option>
        <?php $i=0;  foreach($query_house->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('class',}else{?>
        <option value="<?php echo $val->house_type;//$klass['customername'];?>" class="<?php  //echo $klass['customername']; ?>" ><?php echo $val->house_type;?>   		  </option>
     <?php } ?>
        </label>
      </span></td>
      <td bgcolor="#FFFFFF"><span class="style20"><span class="style31">Date of Admission </span></span></td>
      <td bgcolor="#FFFFFF"><input name="date_admission" type="text" value="<?php  echo set_value('date_admision')?>" /></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">Last School Attended </span></td>
      <td><span class="style29">
        <label> 
        <input name="last_school" type="text" value="<?php  echo set_value('last_school');?>" />
        </label> 
      </span></td>
      <td><span class="style30">Last Class </span></td>
      <td><span class="style29"><span class="style30">
        <input name="last_class" type="text" value="<?php  echo set_value('last_class');?>" />
      </span></span></td>
    </tr>
    <tr>
      <td height="64" colspan="4" bgcolor="#000000"><span class="style3">Personal Information </span></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">Date of Birth</span></td>
      <td><input name="dob" type="text" value="<?php  echo set_value('dob');?>" /><?php echo form_error('dob');?></td>
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
      </span><?php echo form_error('state1');?></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">Nationality</span></td>
      <td><input name="nationality" type="text" value="<?php echo set_value('nationality'); ?>" /></td>
      <td><span class="style30">Religion</span></td>
      <td><select name="religion">
          <option value=""<?php echo set_select('religion', '', TRUE); ?>>--SELECT--</option>
		  <option value="CHRISTIANITY"<?php  echo set_select('religion','CHRISTIANITY'); ?>>CHRISTIANITY</option>
          <option value="MUSLIM"<?php  echo set_select('religion','MUSLIM'); ?>>MUSLIM</option>
          <option value="OTHER"<?php  echo set_select('religion','OTHERS'); ?>>OTHER</option>
          
          </select></td>
    </tr>
    <tr>
      <td height="64"><span class="style30">
        <label>Blood Group </label>
      </span></td>
      <td><span class="style29">
        <select name="blood_group">
          <option value=""<?php echo set_select('blood_group', '', TRUE); ?>>--SELECT--</option>
		  <option value="O+"<?php  echo set_select('blood_group','O+'); ?>>O+</option>
          <option value="A"<?php  echo set_select('blood_group','A'); ?>>A</option>
          <option value="B"<?php  echo set_select('blood_group','B'); ?>>B</option>
          <option value="O-"<?php  echo set_select('blood_group','O-'); ?>>-O</option>
          </select>
      </span></td>
      <td><span class="style30">Genotype</span></td>
      <td><span class="style29">
        <select name="genotype">
          <option value=""<?php echo set_select('genotype', '', TRUE); ?>>--SELECT--</option>
		  <option value="AS"<?php  echo set_select('genotype','AS'); ?>>AS</option>
          <option value="AA"<?php  echo set_select('genotype','AA'); ?>>AA</option>
          <option value="AC"<?php  echo set_select('genotype','AC'); ?>>AC</option>
          <option value="SC" <?php  echo set_select('genotype','SC'); ?>>SC</option>
          <option value="SS"<?php  echo set_select('genotype','SS'); ?>>SS</option>
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
      <td height="24" bgcolor="#FFFFFF"><input name="parent_surname" type="text" value="<?php  echo set_value('parent_surname');?>" /><?php echo form_error('parent_surname');?></td>
      <td height="24" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="initial" type="text" value="<?php  echo set_value('initial');?>" />
        </label>
      </span></td>
      <td height="24" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="title" type="text" value="<?php  echo set_value('title');?>" />
        </label>
      </span></td>
      <td height="24" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="city" type="text" value="<?php  echo set_value('city');?>" />
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
        <textarea name="address" ><?php  echo set_value('address');?></textarea>
        </label>
      </span><?php echo form_error('address');?></td>
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
        <input name="email" type="text" value="<?php  echo set_value('email');?>" />
        </label>
      </span><?php echo form_error('email');?></td>
      <td height="37" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input name="phone" type="text" value="<?php  echo set_value('phone');?>" />
        </label>
      </span><?php echo form_error('phone');?></td>
    </tr>
    <tr>
      <td height="73" bgcolor="#FFFFFF"><span class="style29">Occupation</span></td>
      <td height="73" bgcolor="#FFFFFF"><span class="style29">
        <label>
        <input type="text" name="occupation" value="<?php  echo set_value('occupation');?>" />
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
  </table>
  <p>&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>
