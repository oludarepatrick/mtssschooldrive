
<div class="m-content">
  <div class="tabcontrol" data-role="tabcontrol">
  <ul class="tabs">
    <li><a href="#frame1">Classes</a></li>
    <li><a href="#frame2">Class Arms</a></li>
    <li><a href="#frame3">Subject</a></li>
  </ul>
    <div class="frames">
        <div class="frame" id="frame1"> 
  <form id="form1" name="form1" method="post" action="school_settings/class_form">
<h4 class="head_bg_2">CLASS LIST AND ENTRY </h4>
<table class="table striped hovered cell-hovered border" id="table1">
    
  </table>
  </form>
  <div class="panel_bg_2">
  <div class="flex-grid">
  <form id="form_class" name="form_class" method="post" action="">
<h4 class="head_bg_1">CLASS ENTRY</h4>
 <?php //echo $message1; ?>

<div class="row flex-just-sb">
<div class="cell colspan2"><p>New Class: </p></div>
<div class="cell colspan7">
<div class="input-control text full-size">
        <input name="enter_class" id="enter_class" type="text" size="45" />
</div>
</div>
<div class="cell colspan2">
       <input type="button" id="submit" value="Update" class="button success" onclick="enterClass()">
</div>
</div>
</form>
</div>
    </div>
    </div>
    
        <div class="frame" id="frame2">
    <form id="form2" name="form2" method="post" action="school_settings/class_div_form">
    <h4 class="head_bg_2">CLASS ARM AND ENTRY </h4>
    <table class="table striped hovered cell-hovered border" id="table2">

    
  </table>
  </form>
  <div class="panel_bg_2">
  <div class="flex-grid">
  <form id="form1" name="form1" method="post" action="">
<h4 class="head_bg_1">CLASS ARM ENTRY  </h4>
<?php //echo $message; ?>
<div class="row flex-just-sb">
<div class="cell colspan2"><p> New Class Arm </p></div>
<div class="cell colspan7">
<div class="input-control text full-size">
        <input name="enter_classdiv" id="enter_classdiv" type="text" size="45" />
</div>
</div>
<div class="cell colspan2">
<input type="button" id="submit" value="Update" class="button success" onclick="enterClassDiv()">
       
</div>
</div>
</form>
</div>
</div>

    </div>

  
        <div class="frame" id="frame3">
    <form id="form2" name="form2" method="post" action="school_settings/class_subject">
<h4 class="head_bg_2">SUBJECT LIST AND ENTRY </h4>
  <table class="table striped hovered cell-hovered border" id="table3">
  
  </table>
  </form>
  <div class="panel_bg_2">
  <div class="flex-grid">
  <form id="form1" name="form1" method="post" action="">
<h4 class="head_bg_1">SUBJECT ENTRY  </h4>
<div class="row flex-just-sb">
<div class="cell colspan2"><p> New Subject: </p></div>
<div class="cell colspan7">
<div class="input-control text full-size">
        <input name="subject" id="subject" type="text" size="45" />
</div>
</div>
<div class="cell colspan2">
<input type="button" id="submit" value="Update" class="button success" onclick="enterSubject()">
        
</div>
</div>
   
</form>
</div>
</div>


    </div>
  
    </div>


</body>
</html>

<script>

$.post("getClassesSubjects_Ajax",
        {
            check: 1
        },
        function(data){

          var result = JSON.parse(data);
          test = result;
          var t1 = $('#table1')
          t1.empty();
          t1.append('<thead><tr><th>SN</th><th>CLASSES</th><th>DELETE CLASS</th></tr></thead><tbody>');
          var j = 1;
          var i;
          for(i=0;i<result[0].length;i++){
            t1.append("<tr><td>"+j+"</td><td>"+result[0][i].class+"</td><td><button type='button' class='button mini-button danger' onclick=\"Ajax_Delete('"+result[0][i].id+"')\">Delete</button></td></tr>");
            j++;
          }
          t1.append("</tbody>");
          var t2 = $('#table2')
          t2.empty();
          t2.append('<thead><tr><th>SN</th><th>CLASS DIVISION</th><th>DELETE CLASS DIVISION</th></tr></thead><tbody>')
          var j = 1;
          var i;
          for(i=0;i<result[2].length;i++){
            t2.append("<tr><td>"+j+"</td><td>"+result[2][i].division+"</td><td><button type='button' class='button mini-button danger' onclick=\"Ajax_Delete_Arm('"+result[2][i].id+"')\">Delete</button></td></tr>");
            j++;
          }
          t2.append("</tbody>");

          var t3 = $('#table3')
          t3.empty();
          t3.append('<thead><tr><th>SN</th><th>SUBJECT</th><th>DELETE SUBJECT</th></tr></thead><tbody>')
          var j = 1;
          var i;
          for(i=0;i<result[1].length;i++){
            t3.append("<tr><td>"+j+"</td><td>"+result[1][i].course+"</td><td><button type='button' class='button mini-button danger' onclick=\"Ajax_Delete_Subject('"+result[1][i].s_n+"')\">Delete</button></td></tr>");
            j++;
          }
          t3.append("</tbody>");



        })

function updateclass()
{
  $.post("getClassesSubjects_Ajax",
        {
            check: 1
        },
        function(data){

          var result = JSON.parse(data);
          test = result;
          var t1 = $('#table1')
          t1.empty();
          t1.append('<thead><tr><th>SN</th><th>CLASSES</th><th>DELETE CLASS</th></tr></thead><tbody>');
          var j = 1;
          var i;
          for(i=0;i<result[0].length;i++){
            t1.append("<tr><td>"+j+"</td><td>"+result[0][i].class+"</td><td><button type='button' class='button mini-button danger' onclick=\"Ajax_Delete('"+result[0][i].id+"')\">Delete</button></td></tr>");
            j++;
          }
          t1.append("</tbody>")
          var t2 = $('#table2')
          t2.empty();
          t2.append('<thead><tr><th>SN</th><th>CLASS DIVISION</th><th>DELETE CLASS DIVISION</th></tr></thead><tbody>')
          var j = 1;
          var i;
          for(i=0;i<result[2].length;i++){
            t2.append("<tr><td>"+j+"</td><td>"+result[2][i].division+"</td><td><button type='button' class='button mini-button danger' onclick=\"Ajax_Delete_Arm('"+result[2][i].id+"')\">Delete</button></td></tr>");
            j++;
          }
          t2.append("</tbody>");

          var t3 = $('#table3')
          t3.empty();
          t3.append('<thead><tr><th>SN</th><th>SUBJECT</th><th>DELETE SUBJECT</th></tr></thead><tbody>')
          var j = 1;
          var i;
          for(i=0;i<result[1].length;i++){
            t3.append("<tr><td>"+j+"</td><td>"+result[1][i].course+"</td><td><button type='button' class='button mini-button danger' onclick=\"Ajax_Delete_Subject('"+result[1][i].s_n+"')\">Delete</button></td></tr>");
            j++;
          }
          t3.append("</tbody>");



        })
}



$(document).ready(function(){
$("#form_class").submit(function(event){
event.preventDefault();
var newclass = document.getElementById("enter_class").value;
//var studentid = document.getElementById("studentid").value;
var dataString = 'enter_class=' + newclass;
if(newclass=""){
alert("please fill");
}
else
{
$.ajax({
type:"POST",
dataType:'json',
url:"<?php echo base_url();?> index.php/school_settings/ajax_class_form",

//data:dataString,
cache:false,
success:function(html){
alert(html);
}
});
}
});
});


function enterClass()
{
  var enter_class = $('#enter_class').val();
  console.log(enter_class);
  if(enter_class == "") {
    $('#enter_class').html('Class field cannot be empty');
    swal("Error", "Class field cannot be empty!", "error");
  }
  else {
  $.post("ajax_class_form",
  {
   enter_class:enter_class
   },
  function(data){
  //console.log(data);
  //window.alert(data);
  if(data == "SUCCESS")
  {

    swal("SUCCESS!", "Class Added", "success");
  }
  });
}
updateclass();
$('#enter_class').val("");
} 

function enterClassDiv()
{
  var enter_classdiv = $('#enter_classdiv').val();
  console.log(enter_classdiv);
  if(enter_classdiv == "") {
    $('#enter_classdiv').html('Class Arm field cannot be empty');
    swal("Error", "Class Arm field cannot be empty!", "error");
  }
  else {
  $.post("Ajaxclass_div_form",
  {
   enter_classdiv:enter_classdiv
   },
  function(data){
  //console.log(data);
  //window.alert(data);
  if(data == "SUCCESS")
  {
    updateclass();
    swal("SUCCESS!", "Class Arm Created Successfully!","success");
    $('#enter_classdiv').val("");
  }
  });
}
}

function enterSubject()
{
  var subject = $('#subject').val();
  console.log(subject);
  if(subject == "") {
    $('#subject').html('Subject field cannot be empty');
    swal("Error", "Subject field cannot be empty!", "error");
  }
  else {
    $("#spinner").css({"display":"block", "background-attachment":"fixed"})
  $.post("Ajaxsubject_form",
  {
   subject:subject
   },
  function(data){
  //console.log(data);
  //window.alert(data);
  $("#spinner").css({"display":"none", "background-attachment":"fixed"})
  if(data == "SUCCESS")
  {
    updateclass();
    $('#subject').val("");
    swal("SUCCESS!", "Subject Created Successfully!", "success");
  }
  });
}
}

function Ajax_Delete(id){
      if (confirm("Are You Sure You Want to Delete Class?")) { 
       
    $.post("Ajax_deleteclass",
        {
            id: id
        },
    
        function(data){
      console.log(data);
      //$("#dialog").html(data);
      //var artisandetails = JSON.parse(data);
      
      
  if(data == "SUCCESS")
  {

    swal("SUCCESS!","Class Deleted Successfully!","success");
  }

});
}
updateclass();
}

function Ajax_Delete_Arm(id){
      if (confirm("Are You Sure You Want to Delete This Class Arm?")) { 
       
    $.post("Ajax_deleteclassArm",
        {
            id: id
        },
    
        function(data){
      console.log(data);
      //$("#dialog").html(data);
      //var artisandetails = JSON.parse(data);
      
      
        updateclass();
  if(data == "SUCCESS")
  {

    swal("SUCCESS!", "Class Arm Deleted Successfully!", "success");
  }

});
}
}

function Ajax_Delete_Subject(id){
      if (confirm("Are You Sure You Want to Delete This Subject?")) { 
       
    $.post("Ajax_deleteSubject",
        {
            id: id
        },
    
        function(data){
      console.log(data);
      //$("#dialog").html(data);
      //var artisandetails = JSON.parse(data);
      
      
     
  if(data == "SUCCESS")
  {
    updateclass();

    swal("SUCCESS!", "Subject Deleted Successfully!", "success");
  }

});
}
}
</script>