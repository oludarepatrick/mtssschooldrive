<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<style>
.size{ width:290px}
</style>
<?php //echo form_open_multipart('upload/do_upload');?>
<?php //echo form_open('school_settings/insert_comment');?>
<?php //echo $message;?>
<div class="m-content">
<div class="flex-grid">
<form  method="post"  data-hint-easing="easeOutBounce" data-hint-mode="hint"
        data-role="validator"
        data-on-error-input="notifyOnErrorInput"
        data-show-error-hint="true" action="">
		<!--<div class="input-control text" style="display:none">
<input type="text" readonly="readonly" name="comment_category" value="PRINCIPAL">
</div>-->

<div class="cell colspan7">
<div class="input-control text full-size">
 <div class="input-control file full-size" data-role="input">
        <input type="file" placeholder="Click Me To Upload Lesson Note" name="file" size="20" data-validate-hint-position="bottom"  data-validate-func="required"           
            data-validate-hint="Please Select the file you want to upload!">
            <span class="input-state-error mif-warning"></span>
            <span class="input-state-success mif-checkmark"></span> 
        <button class="button"><span class="mif-folder"></span></button>
    </div>
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Teacher's Name:</label>
<div class="input-control text full-size">
    <input name="tname" type="text">
</div>
</div>
<div class="cell colspan3">
<label>Subject:</label>
<div class="input-control full-size">
<select name="subject" class="select">
      <option value="">--SELECT--</option>
	  <?php foreach($query_subject->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('subject',}else{?>
      <option value="<?php echo $val->course;?>" ><?php echo $val->course;?> </option>
     <?php } ?>
</select>
</div>
</div> 
<div class="cell colspan3">
<label>Class:</label>
<div class="input-control full-size">
<select name="class" class="select">
      <option value="">--SELECT--</option>
      <?php $i=0;  foreach($query_class->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('class',}else{?>
        <option value="<?php echo $val->class;?>" ><?php echo $val->class;?>        </option>
     <?php } ?>
</select>
</div>
</div> 
</div>
<div class="row flex-just-sb">
<div class="cell colspan3">
<label>Class Arm:</label>
<div class="input-control full-size">
<select name="class_arm" class="select">
      <option value="">--SELECT--</option>
      <?php $i=0;  foreach($query_division->result() as $val){ $i+=1;//if($success ==TRUE){echo set_select('class',}else{?>
        <option value="<?php echo $val->division;?>" ><?php echo $val->division;?>        </option>
     <?php } ?>
</select>
</div>
</div> 
<div class="cell colspan3">
<label>Term:</label>
<div class="input-control text full-size">
  <select name="term" class="select">
      <option value="AL">--SELECT--</option>
      <option value="FIRST TERM">First Term</option>
      <option value="SECOND TERM">Second Term</option>
      <option value="THIRD TERM">Third Term</option>
</select>
</div>
</div>
<div class="cell colspan3">
<label>Session:</label>
<div class="input-control full-size">
	  <select name="session" class="select">
        <option value="">SELECT SESSION</option>
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
<div class="cell colspan5">
       <input type="submit" name="submit" value="Save" class="button success loading-pulse lighten primary">
</div>
</div>
</div>

</form>
</div>

     
	 
	 
         <div>
                <table class="table striped hovered cell-hovered border bordered">
                 <thead>
                 <tr>
                 <th width="2%">Sn</th>
                 <th width="20%" >Teacher's Name</th><br />
				<th width="20%" >Subject</th>
                 <th width="20%" >Date Uploaded</th>
				 <th width="20%" >Class</th>
				 <th width="20%" >Arm</th>
				 <th width="20%" >Term</th>
				 <th width="20%" >Session</th>
                 <th width="3%">Edit/Delete</th>
                <!-- <th>Class Division</th>-->
                 </tr>
                </thead>
                <tbody>
                <?php 
                 $i =0;
               // foreach($comments->result() as $val){
                	$i+=1;
				
               ?>
                 <tr>
                 <td  width="2%" class="" ><?php //echo $i; ?>
                 <input type="hidden" id="id" value="<?php //echo $val->comment_id;?>" /></td>
                 <td width="20%" class="comment"><?php //echo $val->principal_comment; ?>
                 <input type="hidden" id="type" name="type" value="<?php //echo $type ?>" /></td>
                 
                 <td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
				<td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
				<td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
				<td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
				<td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
				<td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
				<td class="editBox" width="3%"> <!--<div class="editBox">-->
                    <span class="edit"><?php //echo img($edit);?>&nbsp;&nbsp;</span>
                    <span class="del"><?php if($i == 1){}else{ }//echo img($del); }?></span>
                    
                </td>
                 </tr>
                 <?php
					//}               
                  ?>
                
                 </tbody>
                 </table>
				 </div>
                 </div>
				 </body> 
				 
				 
				 <script>
        function notifyOnErrorInput(input){
            var message = input.data('validateHint');
            /*$.Notify({
                caption: 'Error',
                content: message,
                type: 'alert'
            });*/
        }
    </script>
</body>
</html>
