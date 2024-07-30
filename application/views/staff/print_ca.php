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
	width: 95%;
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
	<p style="text-align: center;">CONTINUOUS ASSESSMENT RESULT</p>
	<?php
		if (preg_match("/\bJSS\b/i", $result[0]->class))
            {
                ?><p style="text-align: center;">JUNIOR SECONDARY</p><?php
            }   else if(preg_match("/\bSSS\b/i", $result[0]->class)) {
                ?><p style="text-align: center;">SENIOR SECONDARY</p><?php
            }
	?>
	</div>
	<div class="cell">
	<img width="115" height="120" src="<?php echo base_url().$row->logo_url; ?>">
	</div>
	</div>
	<?php }?>
	<br><br>
	<div class="row">
	<div class="cell colspan12">
	<p><b>NAME OF STUDENT: </b><?php echo(strtoupper($result[0]->studentname)); ?></p>
	<p><b>ADMISSION NUMBER: </b><?php echo($result[0]->student_id); ?></p>
	<p><b>CLASS: </b><?php echo($result[0]->class); ?></p>
	</div>
	</div>
	<div class="row" style="margin-top: 2% ">
	<div class="cell colspan12">
	<table id="result-table">
	<thead>
	<tr>
	<td><p style="font-size: 11px; margin-left: 7px; color: #183292; font-weight:bold;">SUBJECT</p></td>
	<td style="width: 125px">MARKS (30/40)</td>
	<td style="width: 125px">GRADE</td>
	<td style="width: 125px">REMARKS</td>
	</tr>
	</thead>
	<tbody>
	<?php $j=0; foreach($result as $r) { ?>
	<tr>
	<td><p style="font-size: 10px; color: #183292; font-weight:bold;"><?php echo $r->subject; ?></p></td>
	<td><p style="font-size: 10px;"><?php echo $r->ca; ?></p></td>
	<td><p style="font-size: 11px;">
	<?php for($i=0;$i<count($grading);$i++) {
		if((int) $r->ca<=(int) $grading[$i]->higher && (int) $r->ca>=(int) $grading[$i]->lower) {
			$grade = $grading[$i]->grade;
		}
		
	} echo $grade; ?>
	</p>
	</td>
		<td>
		<p style="font-size: 11px;">
	<?php for($i=0;$i<count($grading);$i++) {
		if((int) $r->ca<=(int) $grading[$i]->higher && (int) $r->ca>=(int) $grading[$i]->lower) {
			$remark =  $grading[$i]->remark;
		}
		
	} echo $remark; ?>
	</p>
	</td>
	</tr>
	<?php $j++;} ?>
	</tbody>
		</table>
	</div>
	</div>
	
	<div class="row" style="margin-top: 3%;">
	<div class="cell colspan2">
	<p style="font-size: 11px; font-weight: bold; color: #183292">TOTAL MARK: </p>
	</div>
	<div class="cell colspan1">
	<p style="border: 2px solid #183292; padding: 5px; font-size: 11px"><?php $score = 0;
	foreach ($result as $r) {
		$score+=$r->ca;
	}
	echo $score;
	?></p>
	</div>
	<div class="cell colspan1">
	</div>
	<div class="cell colspan3">
	<p style="font-size: 11px; font-weight: bold; color: #183292">AVERAGE % SCORE: </p>
	</div>
	<div class="cell colspan1">
	<p style="border: 2px solid #183292; padding: 5px; font-size: 11px"><?php 
	echo round($score/count($result), 2);
	?></p>
	</div>
	</div>
	<div class="row" style="margin-top: 50px; margin-bottom: 50px">
	<div class="cell colspan1"></div>
	<div class="cell colspan3"><BR>
	    <p style="text-align: center; margin-left: 5%;"><img  src="<?php echo base_url().$mock_date[0]->signature; ?>"></p>
		<p style="border-top: 1px dotted #000; text-align: center;">Principal's Signature</p></BR>
	</div>
	<div class="cell colspan3"></div>
	<div class="cell colspan3">
	    
	    <p style="text-align: center; margin-left: 5%;"><br /><?php echo strtoupper($mock_date[0]->date); ?></p>
		<p style="border-top: 1px dotted #000; text-align: center;">Date</p>
	</div>
	</div>
<div class="row" style="margin-top: 5%; margin-bottom: 3%">
	<div class="cell colspan3">
	<caption>Key to Score Grading</caption>
	<table border="1" id="student_details">
	<thead>
	<tr>
	<th>Lower</th>
	<th>Higher</th>
	<th>Grade</th>
	<th>Remarks</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach($grading as $gr) { ?>
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
</div>
</div>
<br />
<br />
<?php var_dump($result[0][0]->studentname);
//var_dump($average_score);
$e = $tezz->result();
foreach($e as $d)
{
	$c[] = $d->ca;
}
//var_dump($skills);
//var_dump($first_result);
 ?>
 </body>
