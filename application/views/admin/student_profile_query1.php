<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<form id="form1" name="form1" method="post" action="">
<div>
  <table width="10" border="0" align="center">
  <tr><td align="center" class="4"><div><?php echo $message;?></div></td></tr>
    <tr>.
	<td>
	<div> <select name="classes">
 <option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php  foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select></div>	</td>
	<td>
      <select name="class_arm">
        <option value="<?php echo set_select('class_arm', '', TRUE); ?>">SELECT ARMS</option>
        <?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
        <?php } ?>
      </select></td>
<td><div>
  <select name="term">
    <option value="<?php echo set_select('term', '', TRUE); ?>">SELECT TERM</option>
    <option value="FIRST TERM" >FIRST TERM</option>
    <option value="SECOND TERM" >SECOND TERM</option>
	 <option value="THIRD TERM" >THIRD TERM</option>
  </select>
</div></td>
<td><div><select name="session">
        <option value="<?php echo set_select('session', '', TRUE); ?>">SELECT SESSION</option>
      	<option value="2010/2011">2010/2011</option>
		<option value="2011/2012"> 2011/2012</option>
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
	  </div></td>
	  <td><div><input type="submit" value="Send"/></div></td>
	</tr>
</table>
</div>
</form>
</body>
</html>
