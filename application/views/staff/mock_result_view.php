<div class="m-content">
<form action="" method="post">
<div class="panel_bg_2">
<div class="flex-grid">
<div class="row flex-just-sb">
<div class="cell colspan2">
<select id="class" class="basic" name="class">
<option>SELECT CLASS</option>
</select>
</div>
<div class="cell colspan2">
<select id="class_division" class="basic" name="class_division">
<option>SELECT DIVISION</option>
</select>
</div>
<div class="cell colspan2">
<select id="term" class="basic" name="term">
<option>SELECT TERM</option>
</select>
</div>
<div class="cell colspan2">
<select id="session" class="basic" name="session">
<option>SELECT SESSION</option>
</select>
</div>
<div class="cell colspan1">
<button type="submit" class="button success" onclick="getResults()">Submit</button>
</div>
</div>
</div>
</div>
</form>
</div>
<?php if(isset($results)) { ?>
<div class="m-content">
<?php if($this->session->flashdata('warning')) { ?>
<h4 class="warning_bg_1"><?php echo $this->session->flashdata('warning'); ?></h4>
<?php } ?>
<div class="example1" data-text="example">
    <table class="dataTable striped hovered border" id="myTable">
    <thead>
    <tr>
    <th>Result</th></tr></thead>
    <tbody>
      <?php foreach($results as $result) { ?>
      <tr>
      
        <td>
        <div class="flex-grid">
      <div class="row flex-just-sb">
      <div class="cell colspan7">
      <p><b>Name: </b> <?php echo $result[0]->studentname; ?></p>
        <p><b>Admin No. : </b><?php echo $result[0]->student_id; ?></p>
        <p><b>Class : </b><?php echo $result[0]->class; ?></p>
        <p><b>Class Division : </b><?php echo $result[0]->class_division; ?></p>
        </div>
        <div class="cell colspan4">
        <img src="<?php echo base_url().'uploads/perm_upload/student/'.$result[0]->student_id.'.jpg';?>" width="200" height="100">
        </div>
        </div>
        <div class="row">

        <table class="table border bordered">
        <thead>
          <tr>
            <th>Subject</th>
            <th>Exam</th>
          </tr>
        </thead>
        <?php for($i=0; $i<count($result); $i++) {?>
        <tr><td><?php echo $result[$i]->subject; ?></td>
       <td><?php echo $result[$i]->exam; ?></td>
       </tr>
        <?php } ?>
        <tr><td colspan="4"><a target="blank" onclick="print_result()" href="print_mock_result?session=<?php echo $result_details[3]; ?>&amp;term=<?php echo $result_details[2]; ?>&amp;class=<?php echo $result_details[0]; ?>&amp;class_division=<?php echo $result_details[1]; ?>&amp;student_id=<?php echo $result[0]->student_id; ?>" class="button success">Print Result</a></td></tr>
        </table>
        </div>
        </div>

        </td>

      </tr>
      <?php } ?>
      </tbody>
    </table>
    </div>
    </div>
    <?php } ?>
<script>
$('#myTable').dataTable( {
  "lengthMenu": [ 1, 5, 10 ]
} );
$('.basic').fancySelect();
$.post("getAllClasses_Ajax",
        {
            check: 1
        },
        function(data1){
        	console.log(data1);
          var classes = JSON.parse(data1);
          //console.log(data);
          var i;
          for(i=0;i<classes.length;i++)
          {
            var c = $('#class');
            c.append('<option value="'+classes[i].class+'">'+classes[i].class+'</option>')
          }
          var mySelect = $('.basic')
           mySelect.trigger('update.fs');
            });

$.post("getAllClassDivisions_Ajax",
        {
            check: 1
        },
        function(data1){
        	console.log(data1);
          var class_division = JSON.parse(data1);
          //console.log(data);
          var i;
          for(i=0;i<class_division.length;i++)
          {
            var c = $('#class_division');
            c.append('<option value="'+class_division[i].division+'">'+class_division[i].division+'</option>')
          }
          var mySelect = $('.basic')
           mySelect.trigger('update.fs');
            });
$.post("getTermMock_Ajax",
        {
            check: 1
        },
        function(data1){
        	console.log(data1);
          var term = JSON.parse(data1);
          //console.log(data);
          var i;
          for(i=0;i<term.length;i++)
          {
            var c = $('#term');
            c.append('<option value="'+term[i].term+'">'+term[i].term+'</option>')
          }
          var mySelect = $('.basic')
           mySelect.trigger('update.fs');
            });

$.post("getSessionsMock_Ajax",
        {
            check: 1
        },
        function(data1){
        	console.log(data1);
          var session = JSON.parse(data1);
          //console.log(data);
          var i;
          for(i=0;i<session.length;i++)
          {
            var c = $('#session');
            c.append('<option value="'+session[i].session+'">'+session[i].session+'</option>')
          }
          var mySelect = $('.basic')
           mySelect.trigger('update.fs');
            });

/*function getResults()
{
	var term = $('#term').val();
	var clas = $('#class').val();
	var session = $('#session').val();
	var class_division = $('#class_division').val();
	if(term=="SELECT TERM"||clas=="SELECT CLASS"||session=="SELECT SESSION"||class_division=="SELECT DIVISION")
	{
		swal("Notice!", "Please Select Search Criterias");
	}
	else
	{
		$.post("getResults_Ajax",
        {
            term: term,
            class: clas,
            session: session,
            class_division: class_division
        },
        function(data1){
        	console.log(data1);
          results = JSON.parse(data1);
          var l = results.length;
          var i;
          $('.pagelinks').append('<ul class="pagelink">')
          var j=1;
          for(i=0;i<l;i++)
          {
          	
          	$('.pagelink').append('<li><a href="#" onclick="changepage('+i+')">'+j+'</a></li>')
          	j++;
          }
          $('.pagelinks').append('</ul>')

          //console.log(data);
          //var i;
          /*for(i=0;i<session.length;i++)
          {
            var c = $('#session');
            c.append('<option value="'+session[i].session+'">'+session[i].session+'</option>')
          }
          var mySelect = $('.basic')
           mySelect.trigger('update.fs');
            });
	}
}

function changepage(num)
{
	var d = $('#pagedata');

}*/
</script>
<style type="text/css">
	ul.pagelink {
		list-style: none;
	}
	ul.pagelink li {
		display: inline;
		padding: 0;
		margin: 0;
	}
	ul.pagelink li a {
		width: auto;
		border: 1px solid #345aab;
		background-color: #5b78b6;
		float: left;
    	padding: 2px 5px;
    	margin: 2px;
    	color: #ffffff;
	}

</style>