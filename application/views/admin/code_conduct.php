<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div class="m-content">
<div class="panel_bg_2">
<h4 class="head_bg_2"> CODE OF CONDUCT </h4>
<div class="flex-grid">
<div class="cell colspan3">
<div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me to Upload CODE OF CONDUCT" name="userfile"  accept="image/*" onChange="showMyImage(this)">
        <button class="button"><span class="mif-folder"></span></button>
    
</div>
</div>
</div>
</div>

<div class="panel" data-role="draggable">
<div class="heading">
        <span class="mif-event-available icon"></span>
        <span class="title">CODE OF CONDUCT INFO</span>
    </div>
	<div class="content">
<div class="flex-grid">
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>CLASS</label>

<div class="input-control full-size">
       <select name="classes" class="select">
 	<option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php  foreach($query_class->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan4">
<label>CLASS DIVISION </label>
<div class="input-control full-size">
        <select name="session" class="select">
        <option>SELECT SESSION</option>
      	<option value="A">A</option>
		<option value="SCIENCE">SCIENCE</option>
		<option value="COMMERCIAL">COMMERCIAL</option>
		<option value="ART">ART</option>		
      </select>

</div>
</div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan4">
<label>CURRENT TERM: </label>
<div class="input-control full-size">
    <select name="term" class="select">
        <option value="">SELECT TERM</option>
      	<option value="FIRST TERM">FIRST TERM</option>
		<option value="SECOND TERM">SECOND TERM</option>
		<option value="THIRD TERM">THIRD TERM</option>
		</select>
</div>
</div>

<div class="cell colspan4">
<label>CURRENT SESSION: </label>
<div class="input-control full-size ">
        <select name="session" class="select">
        <option>SELECT SESSION</option>
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
<div class="row">
<div class="cell colspan4">
        <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">

</div>
    </div>
</div>
</div>
</div>
</body>
</html>
