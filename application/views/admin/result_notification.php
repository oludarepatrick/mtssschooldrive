<div class="m-content">
	<table class="table striped border bordered">
		<thead>
			<tr>
				<th>Session</th>
				<th>Term</th>
				<th>Notification status</th>
			</tr>
		</thead>
		<tbody>
<?php $i=0; ?>
		<?php foreach($sessions as $s) { ?>
			<tr>
				<td><?php echo $s->session; ?></td>
				<td><?php echo $s->term; ?></td>
				<td><select id="c_class<?php echo $i; ?>"><?php foreach($query_class->result() as $c) { ?>
						<option value="<?php echo $c->class; ?>"><?php echo $c->class; ?></option>
						<?php } ?>
					</select>
<select id="c_division<?php echo $i; ?>"><?php foreach($query_division->result() as $c) { ?>
						<option value="<?php echo $c->division; ?>"><?php echo $c->division; ?></option>
						<?php } ?>
					</select>

<button class="button primary" onclick="sendMessage('<?php echo $s->session; ?>', '<?php echo $s->term; ?>', '<?php echo $i; ?>')">Send Messages</button>
<?php $i++; ?>
			</tr>
		<?php } ?>
		</tbody>
	</table>
</div>
<script>
	function sendMessage(session, term, count)
	{
		$("#spinner").css({"display":"block", "background-attachment":"fixed"})
		$.post('send_result_notification',
		{
			"class": $('#c_class'+count).val(),
			"class_division": $('#c_division'+count).val(),
			"session": session,
			"term": term
		},
		function(data)
		{
			$("#spinner").css({"display":"none", "background-attachment":"fixed"})
			alert(data);
			
		});
	}
</script>