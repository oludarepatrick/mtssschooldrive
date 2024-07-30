<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=0.1">
<style>
#overlay {
  position: fixed;
  display: none;
  border:2px solid black;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(1,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}
.overlay .closebtn {
        position: absolute;
        top: 10px;
        border:1px solid black;
        right: 45px;
        width: 50%;
        height: 50%;
        background: red;
        font-size: 150px;}
#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 16px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
</head>
<body>

<div class="m-content">
<div id="overlay" onclick="off()">
  <div id="text">
      <a href="javascript:void(0)" class="closebtn" onclick="off()">&times;</a>
      <h3>WELCOME TO MOUNTAIN-TOP SCHOOLS EXAM PORTAL.</h3>
      <p>Kindly ensure to have all you need with you before starting this exam.</p>
  <p>Time allocated to each SUBJECT is 8 MINUTES except MATHEMATICS which is 15 MINUTES.</p>
  <p>If you're unable to finish all questions before your time expire, the system will submit for you and time-out.</p>
  <p>Kindly ensure to <b>ONLY CLICK SUMBIT BUTTON ONCE WHEN YOU HAVE ANSWERED ALL QUESTIONS</b>.</p>
  <p>It is important that you <B>ONLY CLICK SUBMIT BUTTON ONCE</B> to avoid any error when you are ready to submit your work.</p>
  <p>Be sure to have good internet connection before starting.</p>
  <p>Please ensure to read each questions thoroughly before selecting the appropriate answer from the options provided.</p>
  <p>Click on the Next/Previous button to navigate through the questions. You can also click the numbers to navigate through the questions</p>
  <p>Feel free to contact us if you have any issue.</p>
  <p>We are proud of your success/accomplishment so far and the MOUNTAIN-TOP SCHOOLS CELEBRATE YOU!!!.</p>
  <p>CLICK ON THIS INSTRUCTION OR CLOSE BUTTON TO CLOSE ME.</p>
  <p>CLICK ON TAKE EXAM BUTTON TO START.</p>
  </div>
  
</div>

<div style="padding:20px">
  
  
</div>

<div class="grid">
    <div class="row cells12">
        <div class="cell colspan4">
        
	<h2>Select Exam</h2>
	</div>
	<div class="cell colspan3 offset3">
	<button class="button" onclick="location.href='/index.php/cbt/history'">View Exam History</button>
	</div>
</div>
	<table class="table">
		<thead>
			<tr>
				<th>SUBJECT</th>
				<th>TAKE EXAM</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($exams as $e){ ?>
			<tr>
				<td><?php echo strtoupper($e->subject); ?></td>
				<td><button class="button" onclick="location.href='/index.php/cbt/take_exam/<?php echo $e->id; ?>'">TAKE EXAM</button></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>

<script>
document.addEventListener('DOMContentLoaded', on());
function on() {
  document.getElementById("overlay").style.display = "block";
}

function off() {
  document.getElementById("overlay").style.display = "none";
}
</script>
   
</body>
</html>