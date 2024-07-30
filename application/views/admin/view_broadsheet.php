<!DOCTYPE html>
<html>
<head>
<script src="../../asset/javascript/jquery-1.9.0.js"></script>
<script src="../../asset/metrojs/fabric.js"></script>
<script src="../../asset/metrojs/metro.js"></script>
<script src="../../asset/metrojs/select2.min.js"></script>
<script src="../../asset/metrojs/select2.min.js"></script>
<script src="../../asset/metrojs/sweetalert.min.js"></script>
<script src="../../asset/metrojs/jquery.tablesorter.js"></script>
<script type="text/javascript" src="../../asset/metrojs/jquery.dataTables.min.js"></script>
<script>
$(function(){
$('.select').select2();
});
</script>
<?php echo link_tag('asset/metrocss/metro.css');?>
<?php echo link_tag('asset/metrocss/style.css');?>
<?php echo link_tag('asset/metrocss/sweetalert.css');?>
<?php echo link_tag('asset/metrocss/metro-icons.css');?>
<?php echo link_tag('asset/metrocss/metro-responsive.css');?>
<?php echo link_tag('asset/metrocss/metro-schemes.css');?>
<?php echo link_tag('asset/stuff/jquery-ui.css');?>
<?php //echo link_tag('asset/jQuery/jquery.min.js');?>
<?php //echo link_tag('asset/datatablesjs/jQuery/jquery.dataTables.min.js');?>
<?php echo link_tag('asset/metrocss/jquery.dataTables.min.css');?>
<style type="text/css">
  .flex-grid .row {
  display: -webkit-flex;
  display: flex;
  margin-bottom: -20px;
}

.broadsheet-container {
  width: 1200px;
  max-width: 1200px;
  margin-left: auto; 
  margin-right: auto;
  margin-bottom: 150px;
}

th {
  font-size: 12px;
}

#broadsheet-table {
  width: 100%;
}

/*#broadsheet-table tr {
  padding-top: 0;
  padding-bottom: 0;
}*/

#broadsheet-table, #broadsheet-table th, #broadsheet-table td {
  border: 1px solid #000000;
}

#broadsheet-table th, #broadsheet-table td {
  padding-left: 3px;
}

#broadsheet-table td {
  height: 20px;
}

#broadsheet-table td p {
  padding: 0;
  margin: 0;
}

#broadsheet-table tbody {
  background-color: #e6fae6;
}

#skills-table {
  width: 100%;
  margin-left: 30%
}

#skills-table, #skills-table th, #skills-table td {
  border: 1px solid #000000;
}

#rating-table {
  width: 100%;
  margin-left: 30%;
  margin-top: 10px;
}

#rating-table, #rating-table th, #rating-table td {
  border: 1px solid #000000;
}


@media print {
  body {
    width: 100%;
  }
  @page {
    margin: 1cm;
    }

}
@media print {
  #printPageButton {
    display: none;
  }
}
</style>
</head>
<body>

<?php

$j = 0; foreach ($broadsheet as $e) {
  $i = 0;
$a = 0;
  
  
  for($i=0;$i<count($e);$i++)
  {
    
    $a+=$e[$i]->totalscore;
  }
  $a = round($a/count($e),2);
  $totalscores[$j] = $a;
  $a = 0;
  $j++;
}
sort($totalscores);
?>
<div class="broadsheet-container" style="">
<div class="flex-grid">
<?php foreach($schinfo->result() as $row)
  {
  ?>
  <div class="row flex-just-center">
  <div class="cell colspan10">
  <h2 align="center" style="font-size: 16; font-style: bold; color: #9f1e45"> <?php echo $row->name; ?></h2>
  <p align="center" style="font-size: 12"> <?php echo $row->postal_add; ?></p>
  </div>
  <div class="cell">
  <img width="115" height="120" src="<?php echo base_url().$row->logo_url; ?>">
  </div>
  </div>
  <?php }?>
  <div class="row" style="margin-top: 2%;">
  <div class="cell colspan1">
  <p style="font-size: 12px; padding: 3px"><b>FORM MASTER </b></p>
  </div>
  <div class="cell colspan2">
    <p style="font-size: 12px; border: 1px solid black; padding: 3px"><?php echo $teachername[0]->name; ?></p>
  </div>
  <div class="cell colspan1" style="margin-left:10px">
  <p style="font-size: 12px; padding: 3px"><b>CLASS </b></p>
  </div>
  <div class="cell colspan1" style="margin-left: -25px;">
    <p style="font-size: 12px; border: 1px solid black; padding: 3px"><?php echo $teachername[0]->class.' '.$teachername[0]->class_arm; ?></p>
  </div>
  <div class="cell colspan1" style="margin-left: 4%">
  <p style="font-size: 12px; padding: 3px"><b>TERM </b></p>
  </div>
  <div class="cell colspan1" style="margin-left: -25px;">
    <p style="font-size: 12px; border: 1px solid black; padding: 3px"><?php echo $now[0]; ?></p>
  </div>
  <div class="cell colspan1" style="margin-left: 4%">
  <p style="font-size: 12px; padding: 3px"><b>SESSION </b></p>
  </div>
  <div class="cell colspan1" style="margin-left: -25px;">
    <p style="font-size: 12px; border: 1px solid black; padding: 3px"><?php echo $now[1]; ?></p>
  </div>
  <div class="cell colspan1" style="margin-left: 4%">
  <p style="font-size: 12px; padding: 3px"><b>AVERAGE SCORE </b></p>
  </div>
  <div class="cell colspan1">
    <p style="font-size: 12px; border: 1px solid black; padding: 3px"><?php $i=0; $a=[]; foreach($broadsheet as $result) {
      $a[$i]=0;
        foreach($result as $r) {
          $a[$i]+=$r->totalscore;
        }
        $a[$i] = $a[$i]/count($result);
        $i++;
      } 
      $b = 0;
      for($j=0;$j<count($a);$j++)
      {
        $b+=$a[$j];
      }
      echo round($b/count($broadsheet), 2);
      //var_dump($a);?></p>
  </div>
  </div>
  <div class="row" style="margin-top: 2%">
  <div class="cell colspan12">
  <table id="broadsheet-table">
    <thead>
      <tr>
      <th style="font-size: 12px; font-weight:bold;">SN</th>
      <th style="font-size: 12px; font-weight:bold;">Surname, Other Names</th>
      <th style="font-size: 12px; font-weight:bold;">Admin Number</th>
      <th colspan="<?php echo count($subjects); ?>" style="font-size: 12px; font-weight:bold;">Recorded in Percentages</th>
      <th></th>
      <th></th>
      <th width="70" style="font-size: 12px; font-weight:bold;">Total</th>
      <th width="70" style="font-size: 12px; font-weight:bold;">Average</th>
      <th width="50" style="font-size: 12px; font-weight:bold;">Position</th>
      <th width="70" style="font-size: 12px; font-weight:bold;">Remarks</th>
      </tr>
      <tr>
      <td></td>
      <td></td>
      <td></td>
      <?php $x=0; foreach($subjects as $s) { ?>
        <td id="subject<?php echo $x; ?>"><?php if(!is_int($s->subject)OR$s->subject==""){
       echo $s->subject; $x++;} ?></td>
        <?php } ?>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
    </thead>
    <tbody>
      
      <?php 
 foreach($broadsheet as $row) {?>
        <tr>
        <td class='result-row'><p style='font-size: 12px'><?php 
        $total = 0; foreach($row as $r)
        {
          $total+=$r->totalscore;
        }
          $average = $total/count($row);
        $average = round($average,2);
        for($i=0;$i<count($totalscores);$i++)
        {
          if($average==$totalscores[$i])
          {
            echo count($totalscores)-$i;
            //break;
          }
        }?></p></td>
      <td class='result-row'><p style='font-size: 12px'><?php echo strtoupper($row[0]->studentname); ?></p></td>
      <td class='result-row'><p style='font-size: 12px'><?php echo strtoupper($row[0]->student_id); ?></p></td>
        <?php $i=0;    
        for($j=0;$j<count($subjects);$j++)
        {
          for($i=0;$i<count($row);$i++) {
            if($row[$i]->subject==$subjects[$j]->subject)
            {
              $GLOBALS['check'] = 1;
              echo "<td class='result-row'><p style='font-size: 12px'>".$row[$i]->totalscore."</p></td>";
              break;
            }
            else
            {
              $GLOBALS['check'] = 0;
              //echo "<td>0</td>";
              //continue;
            }
          }
          if($GLOBALS['check'] == 0) {
            echo "<td class='result-row'><p style='font-size: 12px'>0</p></td>";
          }
        }
        ?>
        <td class='result-row'></td>
        <td class='result-row'></td>
        <td class='result-row'><p style='font-size: 12px'><?php $total = 0; foreach($row as $r)
        {
          $total+=$r->totalscore;
        }
        echo $total; ?>
        </p></td>
        <td class='result-row'><p style='font-size: 12px'><?php $average = $total/count($row);
        $average = round($average,2);
        echo $average; ?></p></td>
        <td class='result-row'><p style='font-size: 12px'><?php for($i=0;$i<count($totalscores);$i++)
        {
          if($average==$totalscores[$i])
          {

            echo count($totalscores)-$i;
            //break;
          }
        }?></p></td>
        <?php if($average<50) {echo "<td class='result-row' style='color: red; font-face:bold;'><b>FAIL</b></td>";} else {echo "<td class='result-row' style='color: green; font-face:bold;'><b>PASS</b></td>";} ?>
        </tr>
        <?php } ?>
        
    </tbody>
  </table>
    <div class="row">
  <div class="cell colspan9">
  <p style="color: blue">Broadsheet by schooldrive&nbsp;&nbsp;<a href="mailto:schooldrivesng@gmail.com">schooldrivesng@gmail.com</a></p>
  </div>
  <div class="cell colspan3">
  <p style="color: blue"><input id="printpagebutton" type="button" value="Print Broadsheet" onclick="printpage()"/><a href="broadsheet">&lt;Back</a></p>
  </div>
  </div>
  </div>
  </div>

  </div>
  </div>
<?php 
//$disp = $query_result->result_array();
//echo(count($disp));

//foreach($query_result->result() as $score){
//var_dump(count($broadsheet));

//echo("\r\n");
//var_dump($query_result->result_array());
//var_dump($e[0]);
//var_dump($e);

//}; ?>
<script type="text/javascript">
var i;
for(i=0;i<50;i++){
  var th = $('#subject'+i);
  var thtext = th.text();
  thtext = thtext.trim();
  var overwrite = thtext.split(' ');
  if (overwrite.length == 2)
  {
    thtext = overwrite[0].charAt(0)+'. '+overwrite[1];
  }
  else if (overwrite.length == 3)
  {
    thtext = overwrite[0].charAt(0)+'. '+overwrite[1].charAt(0)+'. '+overwrite[2].charAt(0);
  }
  th.text();
  th.html("<canvas id='subjectpic"+i+"'></canvas>")
  var canvas = new fabric.Canvas('subjectpic'+i, {
  selectionColor: 'blue',
  selectionLineWidth: 2,
  width: 20,
  height: 170
  // ...
});
var rect = new fabric.Rect();

var text = new fabric.Text(thtext, { fontSize: 12, left: 3, top: 168, color:'rgb(49,169,225)' });
text.set('angle', 270);

canvas.add(rect); // add object

canvas.add(text);
}
  
$(document).ready(function() 
    { 
        $("#broadsheet-table").tablesorter( {sortList: [[0,0], [1,0]]} ); 
    } 
); 

function printpage() {
        //Get the print button and put it into a variable
        var printButton = document.getElementById("printpagebutton");
        //Set the print button visibility to 'hidden' 
        printButton.style.visibility = 'hidden';
        //Print the page content
        window.print()
        printButton.style.visibility = 'visible';
    }
</script>
</body>

</html>
