<div class="m-content">
<?php $CI =& get_instance(); ?>
<h3>CBT Score History</h3>
	<table class="table table-bordered" border="1">
		<thead>
			<tr>
			    <th>TITLE</th>
				<th>SUBJECT</th>
				<th>CLASS</th>
				<!--<th>TERM</th>-->
				<th>SCORE</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($quiz_history as $h) { ?>
			<tr>
			    <td><?= $h['title']; ?></td>
				<td><?= $h['subject_id']; ?></td>
				<td> <?php echo $h['class_id']; ?> </td>
				<!--<td>  </td>-->
				<td> <?php echo $h['total_score']; ?> </td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>