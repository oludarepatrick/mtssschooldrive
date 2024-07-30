<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<body>
<div class="m-content">
<div class="panel_bg_2">
<div class="panel">
<div class="heading">
<span class="mif-user icon "></span>
        <span class="title">Student Promotion</span>
    </div>	
<div class="example1" data-text="example">
<form action="confirm_promotion" method="post">
<table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
 <thead>
  <tr>
	  <th>SN</th>
	  <th>CHECK</th>
      <th>ADMIN. NO</th>
	  <th>SURNAME</th>
	  <th>FIRSTNAME</th>
	  <th>CLASS</th>
	  <th>ARM</th>
	  <th>SESSION</th>
	  <th>STATUS</th>
	 

    </tr>
    </thead>
	

       <tbody>
	   <?php
$i=0; 
  
   foreach ($all_student->result() as $row)
   {
      /*echo $row->staff_id;
      echo $row->name;
      echo $row->password;*/
    
		  $i+=1;
    ?>
	   <tr>
	
      <td><?php echo "$i "; ?></td>
	  <td><input type="checkbox" id="id" name="id[]" value="<?php echo $row->student_id; ?>" /></td>
      <td><?php echo $row->student_id;?></td>
	  <td><?php echo $row->surname;?></td>
	  <td><?php echo $row->firstname;?></td>
	  <td><?php echo $row->class; ?></td>
	  <td><?php echo $row->class_division; ?></td>
	  <td><?php echo $row->session; ?></td>
	   <td><?php echo $row->status; ?></td>

    </tr>
    <?php } ?>
	</tbody>
            </table>
			
<div class="flex-grid">	
<div class="panel">
<div class="heading">
<span class="mif-keyboard icon "></span>
        <span class="title">Promote Student</span>
    </div>		
<div class="row flex-just-sb">
	<div class="cell colspan3">
	<div class="input-control full-size">
	<select name="classes" class="select">
 	<option value="<?php echo set_select('classes', '', TRUE); ?>">SELECT CLASSES</option>
 <?php  foreach($query_classes->result() as $val){?>
  <option value="<?php echo $val->class;?>" ><?php echo $val->class;?></option>
  <?php } ?>
</select>
</div>
</div>
<div class="cell colspan3">
<div class="input-control full-size">
      <select name="class_arm" class="select">
        <option value="<?php echo set_select('class_arm', '', TRUE); ?>">SELECT ARMS</option>
        <?php $i=0;  foreach($query_division->result() as $val){ $i+=1;?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?></option>
        <?php } ?>
      </select>
</div>
</div>
<div class="cell colspan3">
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
<div class="row flex-just-sb">
<div class="cell colspan3">
 <input type="submit" name="submit" id="submit" value="Promote"   class="button primary loading-cube" />
	</div>	
	</div>
	</div>
		</form>	
	</div>
	</div>
</body>
</html>
