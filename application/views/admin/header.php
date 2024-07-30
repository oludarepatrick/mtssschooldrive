<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>School Manager</title>
<?php echo link_tag('asset/images/favi1.png', 'shortcut icon', 'image/x-icon'); ?>
<?php echo link_tag('asset/metrocss/metro.css');?>
<?php echo link_tag('asset/metrocss/remodal.css');?>
<?php echo link_tag('asset/metrocss/remodal-default-theme.css');?>
<?php echo link_tag('asset/metrocss/style.css');?>
<?php echo link_tag('asset/metrocss/sweetalert.css');?>
<?php echo link_tag('asset/metrocss/metro-icons.css');?>
<?php echo link_tag('asset/metrocss/metro-responsive.css');?>
<?php echo link_tag('asset/metrocss/metro-schemes.css');?>
<?php echo link_tag('asset/stuff/jquery-ui.css');?>
<?php echo link_tag('asset/metrocss/fancySelect.css');?>
<?php //echo link_tag('asset/jQuery/jquery.min.js');?>
<?php echo link_tag('asset/datatablesjs/jQuery/jquery.dataTables.min.js');?>
<?php echo link_tag('asset/metrocss/jquery.dataTables.min.css');?>
<script src="../../asset/metrojs/jquery-3.0.0.js"></script>
<!--<script src="../../asset/metrojs/metro.js"></script>-->
<script src="../../asset/metrojs/jquery.form.js"></script>
<script src="../../asset/metrojs/select2.min.js"></script>
<script src="../../asset/metrojs/sweetalert.min.js"></script>
<script src="../../asset/metrojs/remodal.js"></script>
<script src="../../asset/metrojs/fancySelect.js"></script>
<script src="../../asset/metrojs/bootpag.min.js"></script>
<script type="text/javascript" src="../../asset/metrojs/jquery.dataTables.min.js"></script>
<script>
$(function(){
$('.select').select2();
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
   


<?php /*$link = array(
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


echo link_tag($link);echo link_tag($link2); echo link_tag($link3); //echo link_tag('asset/css/reset.css');*/?>
<?php //echo link_tag('asset/css/demo.css');?>


<?php //echo link_tag('asset/css/simplemodal.css');?>
</head>
<body>
<div id="spinner" style="display: none; width:100%; height: 100%; background-color: rgba(0, 0, 0, 0.8); z-index: 99999999999; position: fixed">
<img src="../../asset/images/squares.gif" style="position: fixed; top: 30%; left: 40%">

</div>
     <div class="app-bar" align="left" style="border-style:double; border-bottom-color:#990000; background-color:#990000;">
    <div class="flex-grid">
    <div class="row flex-just-sb" style="margin-bottom: 0">
    <div class="cell colspan1">
    <img style="width:100%" src="<?php echo base_url().'uploads/mtpa_school_logo.png'?>">
    </div>
    <div class="cell colspan10">
    <?php foreach($schinfo->result() as $row)
  {
  ?>
  <h3> <?php echo $row->name; ?></h3>
  <span> <?php echo $row->postal_add; ?></span>
  <?php }?>
  </div>
    </div>
    </div>
    </div>
    <!--<script src="../../asset/javascript/mootools-core-1.3.1.js" type="text/javascript" charset="utf-8"></script>
    <script src="../../asset/javascript/mootools-more-1.3.1.1.js" type="text/javascript" charset="utf-8"></script>-->
<!--script  type="text/javascript" src="asset/jQuery/jquery-ui.js"></script>-->



<!--<div id="header_in">
<div id="powerd"><a href="http://fruitfulness-inc.com" target="_blank"><?php //echo img('asset/images/headstone_logo.gif');?><!--<img src="../../asset/images/powered.gif" width="250" height="35" title=" is developed" alt=" Logo" longdesc="http://" />--><!--</a></div>
<div id="logo"></div>
</div>-->