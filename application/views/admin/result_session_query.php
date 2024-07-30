<div class="m-content">
<div class="panel_bg_2">
<div class="flex-grid">
<form action="" method="">

<div class="row flex-just-sa">
<div class="cell colspan2">
<div class="input-control text full-size">
<input type="text" name="stud_id" placeholder="Type Student Id Here" value="" />
</div>
</div>
<div class="cell colspan3">
<div class="input-control full-size">
<select name="classes" class="select">
 <option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php $i=0;  foreach($query_class->result() as $val){ $i+=1;?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>\
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
<select name="class_arm" class="select">
        <option value="<?php echo set_select('class_arm', '', TRUE); ?>">--ARMS--</option>
      	<?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
     <?php } ?>
      </select>
</div>
</div>
<div class="cell colspan2">
<div class="input-control full-size">
	  <select name="session" class="select">
        <option value="<?php echo set_select('session', '', TRUE); ?>">--SESSION--</option>
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
</div>
</div>
<div class="cell colspan2">
	  <input type="submit" name="submit" value="Send" class="button success" />
</div>
</div>
</form>
</div>
</div>
</div>

</body>
</html>
