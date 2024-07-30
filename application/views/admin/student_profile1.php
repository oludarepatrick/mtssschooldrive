<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<style type="text/css">
<!--
.style29 {font-family: Verdana, Arial, Helvetica, sans-serif}
.style33 {
	color: #000000;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.style34 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.style36 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #FFFFFF; }
.style37 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
#bg{ background-color:#00CCFF;}
-->
</style>


<body>

<form id="form1" name="form1" method="post" action="">

  <table width="10" border="0" align="center">
    <tr>
      <td height="62" align="center" colspan="10" bgcolor="#990000"><span class="style36">STUDENT'S PROFILE </span></td>
    </tr>
	<tr>
	<?php

    if ($query_student->num_rows() > 0)
{
 $row = $query_student->row();
		  
    ?>
	<td></td>
	<td colspan="9" align="center"><div align="center"><h1><?php echo $row->class; echo " "; echo $row->class_division; ?></h1></div><?php }?></td>
	</tr>
    <tr bordercolor="1" bgcolor="#FFFFFF">
      <td width="2%" height="5"><div>SN</div></td>
      <td>
        <label></label>
        <label>
      <div>CHECKBOX</div>
        </label>
     </td>
	  <td width="41%" height="48"><div>STUDENT NAMES</div></td>
      <td width="41%" height="48"><div>ADMISSION NO. </div></td>
      <td width="41%" height="48"><div>SEX</div></td>
	  <td width="41%" height="48"><div>BIRTH DATE </div></td>
	  <td width="41%" height="48"><div>PHONE NUMBER</div></td>
	  <td width="41%" height="48"><div>HOUSE</div></td>
	  <td width="41%" height="48"><div>STATUS</div></td>
		
    </tr>
	<?php
$i=0; 
    foreach ($query_student->result() as $row){
		  $i+=1;
    ?>
    <tr bordercolor="#000000" id="bg">
	
      <td height="54" bgcolor="#33CCFF" class="style34"><ol id="list">
    <?php echo "$i "; ?></ol></td>
      <td bgcolor="#33CCFF"><input type="checkbox" name="staudent_id" readonly="readonly" value="<?php echo $row->student_id;?>" /></td>
	  <td bgcolor="#33CCFF"><input name="stud_name" size="30" type="text" readonly="readonly" value="<?php echo $row->surname; echo " "; echo $row->firstname; echo " "; echo $row->othername;?>" /></td>
	  <td bgcolor="#33CCFF"><input name="stud_id" type="text" size="6" readonly="readonly" value="<?php echo $row->student_id;?>" /></td>
	  <td bgcolor="#33CCFF"><input name="sex" size="6" type="text" readonly="readonly" value="<?php echo $row->sex;?>"  /></td>
	  <td bgcolor="#33CCFF"><input name="dob" size="8" type="text" readonly="readonly" value="<?php echo $row->dob;?>"  /></td>
	  <td bgcolor="#33CCFF"><input name="phone" size="12" type="text" readonly="readonly" value="<?php echo $row->phone;?>"  /></td>
	  <td bgcolor="#33CCFF"><input name="house" size="6" type="text" readonly="readonly" value="<?php echo $row->house;?>"  /></td>
	  <td bgcolor="#33CCFF"><input name="status" size="6" type="text" readonly="readonly" value="<?php echo $row->status;?>"  /></td>
	  <?php } ?>
    </tr>
	<tr>
      <td height="20" bgcolor="#FFFFFF" colspan="4" align="right">&nbsp;</td>
	  
    </tr>
  </table>
</form>
</body>
</html>
