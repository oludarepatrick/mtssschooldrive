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
  margin-bottom: -20px;
}

th {
	font-size: 12px;
}

#result-table {
	width: 105%;
}

#result-table, #result-table th, #result-table td {
	border: 1px solid #9f1e45;
}

#result-table td {
	padding-left: 10px;
}

#student_details td { font-size:10px; font-weight:bold; 
}
#student_details {border-color:#CC0000;
}

#skills-table {
	width: 100%;
	margin-left: 30%
}

#skills-table, #skills-table th, #skills-table td {
	border: 1px solid #9f1e45;
}

#skills-table td {
	padding-left: 10px;
}

#rating-table {
	width: 100%;
	margin-left: 30%;
	margin-top: 10px;
}

#rating-table, #rating-table th, #rating-table td {
	border: 1px solid #9f1e45;
}


@media print {
	body {
		width: 100%;
	}
	@page {
		margin: 1cm;
		}

}
</style>
</head>
<body>

<div class="result-container" style="border: 3px solid #0072c6; padding: 10px;">
<div class="flex-grid">
<?php foreach($schinfo->result() as $row)
	{
	?>
	<div class="row flex-just-center">
	<div class="cell colspan10">
	<h1 align="center" style="color: #9f1e45; font-size: 30; font-style: bold; font-family: Arial Black;"> <?php echo $row->name; ?></h1>
	<p align="center" style="font-size: 12"> <?php echo $row->postal_add; ?></p>
	</div>
	<div class="cell">
	<img width="115" height="120" src="<?php echo base_url().$row->logo_url; ?>">
	</div>
	</div>
	<?php }?>
	<br><br>
	<div class="row">
	<div class="cell colspan3">
	<img src="<?php echo base_url().'uploads/perm_upload/student/'.$result[0]->student_id.'.jpg';?>">
	</div>
	<div class="cell colspan5">
	</div>
	<div class="cell colspan4" style="margin-left: -20px;">
	<table style="width: 100%">
	<tr>
	<td align="right"><b style="font-size: 12; color: #183292">NEXT TERM BEGINS: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $school_settings[0]->resumption; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 12; color: #183292">SESSION: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $session; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 12; color: #183292">TERM: </b></td>
	<td><p style="font-size: 10; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $term; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 12; color: #183292">CLASS: </b></td>
	<td><p style="font-size: 12; border: 1px black solid; padding: 2px;">&nbsp;&nbsp;<?php echo $class; ?></p></td>
	</tr>
	<tr>
	<td align="right"><b style="font-size: 12; color: #183292">STATUS: </b></td>
	<!-- <td><?php 	$score = 0;
	foreach ($result as $r) {
		$score+=$r->totalscore;
	}
	$ave = $score/count($result);
	if($ave<50)
	{
		echo "<p style='color: red;font-size: 12; border: 1px black solid; padding: 2px; font-weight:bold;'>FAIL</p>";
	}
	else if($ave>=50)
	{
		echo "<p style='color: green;font-size: 12; border: 1px black solid; padding: 2px; font-weight:bold;'>PASS</p>";
	} ?></td> -->
	<td id="status"></td>
	</tr>
	</table>
	</div>
	</div>
	<br><br>
	<table border="1" id="student_details">
	<tr>
	<td>
	NAME:
	</td>
	<td>
	<?php echo(strtoupper($result[0]->studentname)); ?>
	</td>
	<td>
	ADM. NUMBER:
	</td>
	<td>
	<?php echo($result[0]->student_id); ?>
	</td>
	<td>
	HOUSE:
	</td>
	<td>
	<?php echo $student_details[0]->house; ?>
	</td>
	</tr>
	<tr>
	<td>
	SEX:
	</td>
	<td>
	<?php echo $student_details[0]->sex; ?>
	</td>
	<td>
	DATE OF BIRTH: 
	</td>
	<td>
	<?php //echo $student_details[0]->dob; ?>
	</td>
	<td>
	NO OF TIME SCHOOL OPENED:
	</td>
	<td>
	<?php echo($school_settings[0]->school_open); ?>
	</td>
	</tr>
	<tr>
	<td>
	NO OF TIME(S) PRESENT: 
	</td>
	<td>
	<?php
	if($skills_row>0) { echo $skills[0]->no_presents;} ?>
	</td>
	<td>
	NO OF TIME(S) ABSENT:
	</td>
	<td>
	<?php if($skills_row>0) {echo $school_settings[0]->school_open-$skills[0]->no_presents;} ?>
	</td>
	<td>
	EXTRA CURRICULAR:
	</td>
	<td>
	<?php if($skills_row>0) {echo $skills[0]->extra_curriculum;} ?>
	</td>
	</tr>
	</table>
	<div class="row" style="margin-top: 2% ">
	<div class="cell colspan8">
	<table id="result-table">
	<thead>
	<tr>
	<th style="color: #183292">Max Mark Obtainable</th>
	<th style="color: #183292" colspan="3">Second Term Summary</th>
	<th colspan="3" style="color: #183292">Annual Term Summary</th>
	<th></th>
	<th></th>
	<th style="width: 60px;"></th>
	</tr>
	<tr>
	<td><p style="font-size: 11px; margin-left: 7px; color: #183292; font-weight:bold;">SUBJECT</p></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/ca_total.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/exam.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/total.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/bf2.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/cum2.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/totalscore_per.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/class_ave.gif"; ?>" /></td>
	<td style="width: 30px"><img src="<?php echo base_url()."/uploads/result_labels/grade.gif"; ?>" /></td>
	<td><p style="font-size: 11px; margin-left: 7px; color: #183292; font-weight:bold;">TEACHER&apos;S REMARK</p></td>
	</tr>
	<?php 
		$totalCummScore = 0;
		$j=0; 
		foreach($result as $r) { ?>
	<tr>
	<td><p style="font-size: 10px; color: #183292; font-weight:bold;"><?php echo $r->subject; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo $r->ca; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo $r->exam; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo $r->totalscore; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo $first_result[$j]->totalscore; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo $first_result[$j]->totalscore+$r->totalscore; $totalCummScore+= $first_result[$j]->totalscore+$r->totalscore; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo ($first_result[$j]->totalscore+$r->totalscore)/$num_of_terms; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo round($average_score[$j],2); ?></p></td>
	<td><p style="font-size: 11px;">
	<?php for($i=0;$i<count($grading);$i++) {
		if((int) $r->totalscore<=(int) $grading[$i]->higher && (int) $r->totalscore>=(int) $grading[$i]->lower) {
			$grade = $grading[$i]->grade;
		}
		
	} echo $grade; ?>
	</p>
	</td>
		<td>
		<p style="font-size: 11px;">
	<?php for($i=0;$i<count($grading);$i++) {
		if((int) $r->totalscore<=(int) $grading[$i]->higher && (int) $r->totalscore>=(int) $grading[$i]->lower) {
			$remark =  $grading[$i]->remark;
		}
		
	} echo $remark; ?>
	</p>
	</td>
	</tr>
	<?php $j++;} ?>
	</thead>
	</table>
        <table border="1" id="student_details">
	<table border="1" id="student_details">
	<thead>
		<tr><th style="color: #183292" colspan="4"><p style="font-size: 11px;">GRADE BREAKDOWN</p></th></tr>
	<tr>
	
	<td>Lower</td>
	<td>Higher</td>
	<td>Grade</td>
	<td>Remarks</td>
	</tr>
	</thead>
	<tbody>
	<?php $i=0; foreach($grading_break->result() as $gr) {  $i+=1; ?>
	<tr>
    <td><?php echo $gr->lower;?></td>
	<td><?php echo $gr->higher;?></td>
	<td><?php echo $gr->grade;?></td>
	<td><?php echo $gr->remark;?></td>
	</tr>
	<?php }?>
	</tbody>
	</table>
	</table>
	</div>
	
	<div class="cell colspan3">
	<?php if($skills_row>0) { ?>
	<table id="skills-table">
	<thead>
	<tr>
	<th style="color: #183292" colspan="2">PSYCHOMOTOR SKILLS</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">HANDWRITING</p></td>
	<td style="width:30px"><p style="font-size: 11px;"><?php echo $skills[0]->handwriting; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">VERBAL FLUENCY</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->fluency; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">GAMES &amp; SPORT</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->games; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">HANDLING TOOLS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->handling; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">DRAWING &amp; PAINTING</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->drawing; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">MUSICAL SKILLS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->musical; ?></p></td>
	</tr>
	<tr>
	<th style="color: #183292" colspan="2"><p style="font-size: 11px;">AFFECTIVE AREAS</p></th>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">PUNCTUALITY</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->punctuality; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">NEATNESS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->neatness; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">POLITENESS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->politeness; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">HONESTY</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->honesty; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">COOPERATION WITH OTHERS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->cooperation; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">LEADERSHIP</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->leadership; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">HELPING OTHERS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->helping; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">EMOTIONAL STABILITY</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->emotional; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">HEALTH</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->phy_health; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">ATTITUDE TO SCHOOL WORK</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->attitude; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">ATTENTIVENESS</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->attentiveness; ?></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; color: #183292">PERSEVERANCE</p></td>
	<td><p style="font-size: 11px;"><?php echo $skills[0]->perseverance; ?></p></td>
	</tr>
	</tbody>
	</table>
	<?php } else {?>
	<table id="skills-table">
	<thead>
	<tr>
	<th colspan="2">PSYCHOMOTOR SKILLS</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td><p style="font-weight: bold; font-size: 11px; ">HANDWRITING</p></td>
	<td style="width:30px"><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">VERBAL FLUENCY</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">GAMES &amp; SPORT</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">HANDLING TOOLS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">DRAWING &amp; PAINTING</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">MUSICAL SKILLS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<th colspan="2"><p style="font-size: 11px; color: #183292; font-weight:bold;">AFFECTIVE AREAS</p></th>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">PUNCTUALITY</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">NEATNESS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">POLITENESS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">HONESTY</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">COOPERATION WITH OTHERS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">LEADERSHIP</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">HELPING OTHERS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">EMOTIONAL STABILITY</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">HEALTH</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">ATTITUDE TO SCHOOL WORK</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">ATTENTIVENESS</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	<tr>
	<td><p style="font-size: 11px; color: #183292; font-weight: bold;">PERSEVERANCE</p></td>
	<td><p style="font-size: 11px;"></p></td>
	</tr>
	</tbody>
	</table>
	<?php } ?>
	<table id="rating-table">
	<thead>
	<tr>
	<th style="color: #183292">KEY</th>
	<th style="color: #183292">RATING</th>
	</tr>
	</thead>
	<tbody>
	<?php $i = count($key_rating); foreach($key_rating as $r) { ?>
	<tr>
	<td><p style="font-size: 11px; font-weight: bold; margin-left: 10px; color: #183292"><?php echo $i; ?></p></td>
	<td><p style="font-size: 11px; color: #9f1e45; font-weight: bold;"><?php echo $r->title; ?></p></td>
	</tr>
	<?php $i--; } ?>
	</tbody>
	</tbody>
	</table>
	</div>
	</div>
	<div class="row" style="margin-top: 3%;">
	<div class="cell colspan2">
	<p style="font-size: 11px; font-weight: bold; color: #183292">TERM TOTAL: </p>
	</div>
	<div class="cell colspan1" style="margin-left: -40px; margin-right: 20px">
	<p style="border: 2px solid #183292; padding: 5px; font-size: 11px"><?php $score = 0;
	foreach ($result as $r) {
		$score+=$r->totalscore;
	}
	echo $score;
	?></p>
	</div>
	<div class="cell colspan3">
	<p style="font-size: 11px; font-weight: bold; color: #183292">TERM AVG. % SCORE: </p>
	</div>
	<div class="cell colspan1" style="margin-left: -70px; margin-right: 20px">
	<p style="border: 2px solid #183292; padding: 5px; font-size: 11px"><?php 
	echo round($score/count($result), 2);
	?></p>
	</div>
	<div class="cell colspan2">
	<p style="font-size: 11px; font-weight: bold; color: #183292">TOTAL CUMM.: </p>
	</div>
	<div class="cell colspan1" style="margin-left: -40px; margin-right: 20px">
	<p style="border: 2px solid #183292; padding: 5px; font-size: 11px"><?php echo $totalCummScore; ?></p>
	</div>
	<div class="cell colspan2">
	<p style="font-size: 11px; font-weight: bold; color: #183292">TOTAL CUMM. AVE.: </p>
	</div>
	<div class="cell" style="margin-right: 20px">
	<p style="border: 2px solid #183292; padding: 5px; font-size: 11px"><?php echo $totalCummScore/$num_of_terms; ?></p>
	</div>



	</div>
	
	<div class="row" style="margin-top: 2%">
	<div class="cell colspan5">
	<p style="font-size: 11px; font-weight: bold; color: #183292">FORM TEACHER'S COMMENT: </p>
	</div>
	<div class="cell colspan7">
	<p style="border: 1px solid #183292; padding: 5px; font-size: 11px"><?php if(isset($teacher_comment[0]->comment)) {echo $teacher_comment[0]->comment;} ?><br /><br /><?php echo strtoupper($teachername[0]->name); ?></p>
	</div>
	</div>
	<div class="row">
	<div class="cell colspan5">
	<p style="font-size: 11px; font-weight: bold; color: #183292">PRINCIPAL'S COMMENT: </p>
	</div>
	<div class="cell colspan7">
	<p style="border: 1px solid #183292; padding: 5px; font-size: 11px"><?php if(isset($principal_comment[0]->comment)) {echo $principal_comment[0]->comment;} ?><br /><br /><?php echo strtoupper($principalname[0]->name); ?></p>
	</div>
	</div>
</div>
</div>
<br />
<br />
<?php //var_dump($result);
//var_dump($average_score);
$e = $tezz->result();
foreach($e as $d)
{
	$c[] = $d->totalscore;
}
//var_dump($skills);
//var_dump($first_result);
 ?>
 </body>

  <script>
 if(<?php echo $totalCummScore/count($result); ?> < 50 )
 {
	$('#status').html(`<p style='color: red;font-size: 12; border: 1px black solid; padding: 2px; font-weight:bold;'>FAILED</p>`)
 } else {
	 $('#status').html(`<p style='color: green;font-size: 12; border: 1px black solid; padding: 2px; font-weight:bold;'>PASSED</p>`)
 }
	
 </script>