<head>

	<?php echo link_tag('asset/metrocss/metro.css');?>
<?php echo link_tag('asset/metrocss/style.css');?>
<?php echo link_tag('asset/metrocss/metro-icons.css');?>
<?php echo link_tag('asset/metrocss/metro-responsive.css');?>
<?php echo link_tag('asset/metrocss/metro-schemes.css');?>
<script src="../../asset/javascript/jquery-1.9.0.js"></script>
<script src="../../asset/metrojs/metro.js"></script>
<script src="../../asset/metrojs/select2.min.js"></script>
<script src="../../asset/metrojs/select2.min.js"></script>
<script src="../../asset/metrojs/sweetalert.min.js"></script>
<style type="text/css">
	.flex-grid .row {
  display: -webkit-flex;
  display: flex;
  margin-bottom: -2%;
}
@media print {
	body {
		width: 100%;
	}
	@page {
		margin: 0.1cm;
		}

}
</style>
</head>
<div class="flex-grid">
<?php foreach($schinfo->result() as $row)
	{
	?>
	<div class="row flex-just-center">
	<div class="cell colspan10">
	<h1 align="center" style="font-size: 30; font-style: bold;"> <?php echo $row->name; ?></h1>
	<p align="center" style="font-size: 12"> <?php echo $row->postal_add; ?></p>
	</div>
	<div class="cell">
	<img width="115" height="120" src="<?php echo base_url().$row->logo_url; ?>">
	</div>
	</div>
	<?php }?>
	<br><br>
	<div class="row flex-just-end">
	<div class="cell colspan4">
	<table>
	<tr>
	<td align="right"><b style="font-size: 14">NEXT TERM BEGINS: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $session; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 14">SESSION: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $session; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 14">TERM: </b></td>
	<td><p style="font-size: 10; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $term; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 14">CLASS: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $class; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 14">STATUS: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $class; ?></p></td>
	</tr>
	</table>
	</div>
	</div>
	<br><br>
	<div class="row flex-just-sb">
	<div class="cell colspan1">
	<p><b style="font-size: 12">NAME: </b></p>
	</div>
	<div class="cell colspan4">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php foreach($result as $r){echo(strtoupper($r->studentname));} ?></p>
	</div>
	<div class="cell colspan3">
	<p><b style="font-size: 12">ADM. NUMBER: </b></p>
	</div>
	<div class="cell colspan3">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php foreach($result as $r){echo($r->student_id);} ?></p>
	</div>
	</div>
	<div class="row flex-just-sb">
	<div class="cell colspan3">
	<p><b style="font-size: 12">NUMBER IN CLASS: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;00</p>
	</div>
	<div class="cell colspan1">
	<p><b style="font-size: 12">HOUSE: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php foreach($result as $r){echo($r->student_id);} ?></p>
	</div>
	<div class="cell colspan1">
	<p><b style="font-size: 12">SEX: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;MALE</p>
	</div>
	<div class="cell colspan2">
	<p><b style="font-size: 12">DATE OF BIRTH: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;00</p>
	</div>
	</div>
	<div class="row flex-just-sb">
	<div class="cell colspan2">
	<p><b style="font-size: 12">AVERAGE AGE IN CLASS: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;00</p>
	</div>
	<div class="cell colspan3">
	<p><b style="font-size: 12">NO OF TIME SCHOOL OPENED: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php foreach($result as $r){echo($r->student_id);} ?></p>
	</div>
	<div class="cell colspan2">
	<p><b style="font-size: 12">NO OF TIME PRESENT: </b></p>
	</div>
	<div class="cell colspan1">
	<p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;MALE</p>
	</div>
	</div>
</div>
<?php //var_dump($result->result());
//var_dump($skills->result());
 ?>