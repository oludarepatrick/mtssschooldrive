<div class="m-content">
<?php echo $links; ?>
<form id="form1" name="form1" method="post" action="">
<h4 class="head_bg_2">TEACHER'S PROFILE</h4>
  <table class="table striped hovered cell-hovered border">
  <thead>
    <tr>
      <th>SN</th>
      <th></th>
	  <th>NAME</th>
      <th>EMAIL</th>
      <th>STATUS</th>
	  <th>CATEGORY</th>
	  <th>PHONE NO</th>
	  <th>USERNAME</th>
	  <th>PASSWORD</th>
    </tr>
    </thead>
    <tbody>
	<?php
$i=0; 
    foreach($query_teacher->result() as $row){
		  $i+=1;
    ?>
    <tr>
	
      <td><?php echo "$i "; ?></td>
      <td><input type="checkbox" size="1" name="staff_id" readonly="readonly" value="<?php echo $row['staff_id'];?>" /></td>
	  <td><input name="staff_name" type="text" readonly="readonly" value="<?php echo $row->name;?>" /></td>
	  <td><input name="email" type="text" readonly="readonly" value="<?php echo $row->email;?>" /></td>
	  <td><input name="status" size="2" type="text" readonly="readonly" value="<?php echo $row->status;?>"  /></td>
	  <td><input name="category" size="2" type="text" readonly="readonly" value="<?php echo $row->categories;?>"  /></td>
	  <td><input name="phone" type="text" size="10" readonly="readonly" value="<?php echo $row->phone;?>"  /></td>
	  <td><input name="username" size="10" type="text" readonly="readonly" value="<?php echo $row->username;?>"  /></td>
	  <td><input name="password" size="12" type="text" readonly="readonly" value="<?php echo $row->password;?>"  /></td>
    </tr>
    <?php } ?>
	
    </tbody>
  </table>
</form>
</div>
</body>
</html>
