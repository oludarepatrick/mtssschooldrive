
<style>
#req{ color:#FF0000; font-size:16px; font-weight:bold;}
#name{ color:#000033; font-size:15px; font-weight:bold;}
#re{ color:#FF9900; font-size:13px; font-weight: 100;}
#req2{ color:#FF0000; font-size:10px;}
#bd{ border:1px solid #C9C9C9; background-color: #FAFAFA}
.error{ vertical-align:top}
</style>
<?php echo link_tag('css/mystyles.css');?>
<?php echo form_open('receipt/invoice');?>
<body>

<div style="border-style:groove"  style="background-color:#00CCFF" style="height:50%">
<form method="get" enctype="multipart/form-data" >


<table width="150" border="0">
<span class="girl"><?php echo img(array('src'=>'asset/images/headstonelogo.png', 'width'=>300, 'heigth'=>50))?></span>
 <div> <td colspan="4" ><div class="req"  align="right" >REQUIRED<label id="req">*</label>&nbsp;&nbsp;<?php //echo img($star);?>&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr><tr>
 <?php 
//$i=0; 
//foreach($result as $val):
//foreach ($result as $row){
foreach ($query->result() as $row){
	//$i+=1;
?>

  <td><legend >CUSTOMER'SDETAILS</legend></td>
  <td><label></label></td>
  <td><label id="name"><?php echo $row->companyname; ?></label></br>
  <label id="re">Phone: <?php echo $row->phone1; echo ", "; echo $row->phone2;?></label>
  <label id="re">Email:<?php echo $row->email1; echo ", "; echo $row->email2;?></label>
 <label id="re">Website:<?php echo $row->site; ?></label>  </td></tr>
  <tr>
  
    <td>
	<label> RECEIPT</label>	</td>
    <td></td>
    <td></td>
  </tr>
  <tr>
    <td><label> Customer's Name<label id="req">*</label><label id="req2"><?php echo form_error('cusname');?></label> </label><input type="text" name="cusname" value="<?php echo set_value('cusname');?>" size="40" /></td>
    <td>Phone<label id="req">*</label><label id="req2"><?php echo form_error('cusphone');?></label><input type="text" name="cusphone"  value="<?php echo set_value('cusphone');?>" /></td>
    <td>Email<label id="req">*</label><label id="req2"><?php echo form_error('cusemail');?></label><input type="text" name="cusemail" value="<?php echo set_value('cusemail');?>" size="25" /></td>
  </tr>
  <tr>
    <td><label> Customer's Address<label id="req">*</label> </label><label id="req2"><?php echo form_error('address');?></label><input type="text" name="address" value="<?php echo set_value('address');?>" size="40"/></td>
    <td><label>Invoice Date<label id="req">*</label></label><label id="req2"><?php echo form_error('invoicedate');?></label></td>
    <td><input type="text" id="invoicedate" name="invoicedate" value="<?php echo set_value('invoicedate');?>" placeholder="dd/mm/yy"/></td>
  </tr>
  <tr>
    <td><label>Contact Person<label id="req">*</label><label id="req2"><?php echo form_error('contact');?></label> </label><input type="text" name="contact" value="<?php echo set_value('contact');?>" size="30" /></td>
    <td><label>Invoice No</label></td>
    <td><input type="text" name="invoiceno" value="<?php  $a = uniqid(); echo strtoupper($a);?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><label>Reference No</label></td>
    <td><input type="text" name="refno" value="<?php  $b = rand(); echo $b;?>" readonly="readonly"/> </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><label>Vat</label></td>
    <td><input type="text" name="vat" value="5" /></td>
	<td><label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><label>Description<label id="req">*</label></label><label id="req2"><?php echo form_error('description');?></label></td>
    <td><label>Quantity<label id="req">*</label></label><label id="req2"><?php echo form_error('quantity');?></label></td>
    <td><label>Price<label id="req">*</label></label><label id="req2"><?php echo form_error('price');?></label></td>
	<td><label>Discount</label></td>
	<td><label>Amount NGN</label></td>
  </tr>
  <tr>
  
    <td><input type="text" name="description"  size="50" value="<?php echo set_value('description');?>"  /> </td>
	
    <td><input type="text" name="quantity" id="quantity" value="<?php echo set_value('quantity');?>"/><?php //$a =$_GET['quantity'];?></td>
    <td><input type="text" name="price" id="price" value="<?php echo set_value('price');?>" /><?php //$b = $_GET['price']; ?></td>
	<td><input type="text" name="discount" id="discount" value="<?php echo set_value('discount');?>" /><?php //$c =$_GET['discount'];?></td>
	<td><input type="text" name="amount" size="10" id="amount" readonly="true" value="<?php  //echo $val->amount;// $a= $_GET['quantity']; $b= $_GET['price']; $c= $_GET['discount']; $d = $a * $b *$c / 100; echo $amount= $a * $b - $d; ?>" /></td>
  </tr>
  <tr>
    <td><input type="text" name="supervisor" size="50" value="<?php echo set_value('supervisor');?>" /></td>
    <td><input type="text" name="quantity2" size="20" value="<?php echo set_value('quantity2');?>" /></td>
    <td><input type="text" name="price2" size="20" value="<?php echo set_value('price2');?>" /></td>
	<td><input type="text" name="discount2" value="" /></td>
	<td><input type="text" size="10" readonly="readonly" name="amount2" value="" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
	<td><label>Sub-Total</label></td>
	<td><input type="text" size="10" name="subtotal" readonly value="<?php //echo $amount;?>"/><?php //$e=$_GET['subtotal'];?></td>
  </tr>
  <tr>
    <td><label>Due Date</label></td>
    <td><input type="text" name="duedate" id="duedate" value="" placeholder="dd/mm/yy"/></td>
    <td>&nbsp;</td>
    <td><label>Total Service Tax 5%</label></td>
    <td><input type="text" size="10" name="servicetax" readonly value="<?php //$vat=$_GET['servicetax']; $vat= $amount/100 *5; echo $vat;?>"/></td>
  </tr>
  <tr>
    <td><label>Make Cheque To<label id="req">*</label></label></td>
    <td><input type="text" readonly="readonly"  value="<?php echo $row->accountname; ?>" name="chequeto" /></td>
    <td>&nbsp;</td>
    <td><label>Total NGN</label></td>
    <td><input type="text" size="10" name="total" readonly value="<?php //$total=$_GET['total']; $total=$amount+$vat; echo $total;?>" /></td>
  </tr>
  <tr>
    <td><input type="text" name="bank1" readonly="readonly" value="<?php echo $row->bank1; ?>"/></td>
      <td>Account Number<input type="text" name="account1" readonly="readonly" value="<?php echo $row->account1; ?>" /></td>
    <td>&nbsp;</td>
    <td><label>Less Amount Paid</label></td>
    <td><input type="text" size="10" name="amountpaid" value="" /></td>
  </tr>

  <tr>
    <td><input type="text" name="bank2" readonly="readonly" value="<?php echo $row->bank2; ?>" /></td>
    <td><input type="text" name="account2" readonly="readonly" value="<?php echo $row->account2; ?>" /></td>
    <td>&nbsp;</td>
    <td><label>Amount Due</label></td>
    <td><input type="text" size="10" name="amountdue" readonly value="" /></td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="submit" name="submit" value="SAVE"/></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td> </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <?php  } ?>
  <?php 
/*if ($action =="cal"){
$dis = $quantity * $price / 100 * $discount;
$total = $quantity * $price - $dis;
echo $total;

}*/
?>
</table>
</div>
</div>


	<script>
	$(function() {
		$( "#invoicedate" ).datepicker({changeMonth: true, 
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		yearRange: '1980:2100',
		
		
		});
		
		$( "#tabs" ).tabs();//this create a tab for you and den u have to set something in the html part my-code6.html
	  $( "input[type=submit], a, button" )//this create a button for u. u have to set something in the html part my-code6.html
      .button()
      .click(function( event ) {
        //event.preventDefault();
      
  });
	});
	</script>
<script type="text/javascript">

$(document).ready(function () {


$('#duedate').datepicker({
		changeMonth: true, 
		changeYear: true,
		dateFormat: 'dd/mm/yy',
		yearRange: '1980:2100',
		
		
		});
		
});
</script>