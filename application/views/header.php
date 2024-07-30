<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!--<link rel="stylesheet"  href="../../asset/mycss.css"type="text/css"/>-->
<?php echo link_tag('asset/css/mycss.css');?>
<?php echo link_tag('asset/css/jsDatePick_ltr.min.css');?>
<?php echo link_tag('asset/css/jquery-ui-1.10.0.custom.css');?>


<?php $link = array(
          'href' => 'asset/css/reset.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
);
$link2 = array(
          'href' => 'asset/css/demo.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
);
$link3 = array(
          'href' => 'asset/css/simplemodal.css',
          'rel' => 'stylesheet',
          'type' => 'text/css',
          'media' => 'screen'
);

echo link_tag($link);echo link_tag($link2); echo link_tag($link3); //echo link_tag('asset/css/reset.css');?>
<?php //echo link_tag('asset/css/demo.css');?>
<?php //echo link_tag('asset/css/simplemodal.css');?>
 
    <script src="../../asset/javascript/mootools-core-1.3.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../asset/javascript/mootools-more-1.3.1.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../asset/javascript/simple-modal.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../asset/javascript/demo.js" type="text/javascript" charset="utf-8"></script>

<style>
.ui-datepicker {
	font-size:70%
}
</style>
<script src="../../asset/javascript/jquery-1.9.0.js"></script>
<script src="../../asset/javascript/jquery-ui-1.10.0.custom.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>
    
    <script>
	$(function(){
		$( "#datepicker2" ).datepicker();
	});
	</script>

<script type="text/javascript" src="../../asset//javascript/jsDatePick.min.1.3.js"></script>
<!---->

<script type="text/javascript">
$(document).ready(function(){  
    $("#menu li a.main-link").hover(function(){  
		 $("#menu li a.main-link").removeClass("active");  
		 $(this).addClass("active");
		 $(".sub-links").hide();  
		 $(this).siblings(".sub-links").fadeIn(); 
    });   
  
});  
</script>

<script type="text/javascript" language="javascript">
 var request = null;

   try {
     request = new XMLHttpRequest();
   } catch (trymicrosoft) {
     try {
       request = new ActiveXObject("Msxml2.XMLHTTP");
     } catch (othermicrosoft) {
       try {
         request = new ActiveXObject("Microsoft.XMLHTTP");
       } catch (failed) {
         request = null;
       }
     }
   }

   if (request == null)
     alert("Error creating request object!");

	function get_amount_due(){
		var order = document.getElementById("order").value;
		
		/*alert("You are welcome," + order);*/
		var url = "<?= site_url('payment/dueamount');?>"  + "/" + order;
		request.open("GET", url, true);
		request.onreadystatechange = updatePage;
     	request.send(null);
		
	}
	
	function updatePage(){
		if(request.readyState == 4){
			if(request.status == 200){
			/*Get response from the server*/
			var due_amount = request.responseText;
			/*Update the page*/
			document.getElementById('due').value = due_amount;
			}else{
				alert("Error! Request Status is" + request.status);
			}
		}
	}

</script>

<script>
$("alert").addEvent("click", function(){
  var SM = new SimpleModal({"btn_ok":"Alert button"});
      SM.show({
        "title":"Title",
        "contents":"Your message..."
      });
});
</script>
</head>

<body  id="mainbg">

<div id="header_in">
<div id="powerd"><a href="http://fruitfulness-inc.com" target="_blank"><?php echo img('asset/images/headstone_logo.gif');?><!--<img src="../../asset/images/powered.gif" width="250" height="35" title="Author is developed by Abstract Innovations" alt="Abstract Logo" longdesc="http://abstract-inv.com" />--></a></div>
<div id="logo"></div>
<div id="link">
<ul id="menu">

</div>