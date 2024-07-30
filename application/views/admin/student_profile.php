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
#abc {
width:100%;
height:100%;
opacity:.95;
top:0;
left:0;
display:none;
position:fixed;
background-color:#313131;
overflow:auto
}
div#btndiv{ display:none;
}
img#close {
position:absolute;
right:-14px;
top:-14px;
cursor:pointer
}
div#popupContact {
position:absolute;

left:50%;
top:17%;
margin-left:-202px;
font-family:'Raleway',sans-serif
}
form#formcon {
max-width:300px;
min-width:250px;
padding:10px 50px;
border:2px solid gray;
border-radius:10px;
font-family:raleway;
background-color:#fff
}
p {
margin-top:30px
}
h2 {
background-color:#FEFFED;
padding:20px 35px;
margin:-10px -50px;
text-align:center;
border-radius:10px 10px 0 0
}
hr {
margin:10px -50px;
border:0;
border-top:1px solid #ccc
}
input[type=text]#inputcon{
width:82%;
padding:10px;
margin-top:30px;
border:1px solid #ccc;
padding-left:40px;
font-size:16px;
font-family:raleway
}
#name {
background-image:url(../images/name.jpg);
background-repeat:no-repeat;
background-position:5px 7px
}
#email {
background-image:url(../images/email.png);
background-repeat:no-repeat;
background-position:5px 7px
}
textarea#textcon {
background-image:url(../images/msg.png);
background-repeat:no-repeat;
background-position:5px 7px;
width:82%;
height:95px;
padding:10px;
resize:none;
margin-top:30px;
border:1px solid #ccc;
padding-left:40px;
font-size:16px;
font-family:raleway;
margin-bottom:30px
}
#submit {
text-decoration:none;
width:100%;
text-align:center;
display:block;
background-color:#FFBC00;
color:#fff;
border:1px solid #FFCB00;
padding:10px 0;
font-size:20px;
cursor:pointer;
border-radius:5px
}
span#spancon {
color:red;
font-weight:700;
}
button {
width:10%;
height:45px;
border-radius:3px;
background-color:#cd853f;
color:#fff;
font-family:'Raleway',sans-serif;}
</style>

<form id="form1" name="form1" method="post" action="">
     <h4 class="head_bg_2">STUDENT'S PROFILE </h4>
     	<?php

    if ($query_student->num_rows() > 0)
{
 $row = $query_student->row();
		  
    ?>
	<h4 class="message_bg_1"><?php echo $row->class; echo " "; echo $row->class_division; ?></h4><?php }?>
      <div class="example1" data-text="example">
            <table id="example_table" class="dataTable striped hovered cell-hovered border" data-role="datatable" data-searching="true">
<thead>
<tr>
      <th>SN</th>
	  <th>STUDENT NAMES</th>
      <th>ADMISSION NO.</th>
      <th>SEX</th>
	  <th>BIRTH DATE</th>
	  <th>PHONE NUMBER</th>
	  <th>HOUSE</th>
	  <th>STATUS</th>
		
    </tr>
    </thead>
	
    <tbody>
	<?php
$i=0; 
    foreach ($query_student->result() as $row){
		  $i+=1;
    ?>
    <tr>
	
      <td><?php echo "$i "; ?></td>
    
	  <td><?php echo $row->surname; echo " "; echo $row->firstname; echo " "; echo $row->othername;?></td>
	  <td><?php echo $row->student_id;?></td>
	  <td><?php echo $row->sex;?></td>
	  <td><?php echo $row->dob;?></td>
	  <td><?php echo $row->phone;?></td>
	  <td><?php echo $row->house;?></td>
	  <td><?php echo $row->status;?></td>
	    </tr>
		 <?php } ?>
    </tbody>
  </table>
  </div>
</form>



<body id="body" style="overflow:hidden;">
<div id="abc">
<!-- Popup Div Starts Here -->
<div id="popupContact">
<!-- Contact Us Form -->
<form action="#" id="formcon" method="post" name="formcon">
<img id="close" src="images/3.png" onclick ="div_hide()">
<h2>Contact Us</h2>
<hr>
<input id="inputcon" name="name" placeholder="Name" type="text"><br />
<input id="email" name="email" placeholder="Email" type="text"><br />
<textarea id="textcon" name="message" placeholder="Message"></textarea><br />
<a href="javascript:%20check_empty()" id="submit">Send</a>
</form>
</div>
</div>
<!-- Popup Div Ends Here -->
</div>
</body>
</html>

<script>
function check_empty() {
if (document.getElementById('name').value == "" || 

document.getElementById('email').value == "" || document.getElementById

('msg').value == "") {
alert("Fill All Fields !");
} else {
document.getElementById('form').submit();
alert("Form Submitted Successfully...");
}
}
//Function To Display Popup
function div_show() {
document.getElementById('abc').style.display = "block";
}
//Function to Hide Popup
function div_hide(){
document.getElementById('abc').style.display = "none";
}
function btndiv_hide(){
document.getElementById('btndiv').style.display = "none";
}
function btndiv_show() {
document.getElementById('btndiv').style.display = "block";
}

</script>