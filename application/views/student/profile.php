<style type="text/css">
	div[class="flex-grid"] div[class="row"]:nth-child(even) {
		/*background-color: rgba(174,24,24,0.2);*/
		padding-left: 0.5%;
		background-color: rgba(0,86,150,0.2);
	}

	div[class="flex-grid"] div[class="row"]:nth-child(odd) {
		padding-left: 0.5%;
	}
</style>
<div class="m-content">
<div class="flex-grid">
<div class="row">
</div>
<div class="row">
<div class="cell colspan2">
<h5>NAME: </h5>
</div>
<div class="cell colspan4">
<h5><?php echo $studentdetails->surname." ".$studentdetails->firstname." ".$studentdetails->othername; ?>
</h5> 
</div>
</div>
<div class="row">
<div class="cell colspan2">
<h5>GENDER: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->sex; ?></h5>
</div>
<div class="cell colspan2">
<h5>DATE OF BIRTH: </h5>
</div>
<div class="cell colspan2">
<h5><?php echo $studentdetails->dob; ?></h5>
</div>
</div>
<div class="row">
<div class="cell colspan2">
<h5>NATIONALITY: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->nationality; ?></h5>
</div>
<div class="cell colspan2">
<h5>STATE OF ORIGIN: </h5>
</div>
<div class="cell colspan2">
<h5><?php echo $studentdetails->state_of_origin; ?></h5>
</div>
<div class="cell colspan1">
<h5>CITY: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->city; ?></h5>
</div>
</div>
<div class="row">
<div class="cell colspan2">
<h5>RELIGION: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->religion; ?></h5>
</div>
</div>
<div class="row">
<div class="cell colspan2">
<h5>CLASS: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->class." ".$studentdetails->class_division; ?></h5>
</div>
<div class="cell colspan1">
<h5>HOUSE: </h5>
</div>
<div class="cell colspan1">
<h5><?php echo $studentdetails->house; ?></h5>
</div>
</div>
<div class="row">
<div class="cell colspan2">
<h5>ADDRESS: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->address; ?></h5>
</div>
<div class="cell colspan2">
<h5>PHONE NUMBER: </h5>
</div>
<div class="cell colspan3">
<h5><?php echo $studentdetails->phone; ?></h5>
</div>
</div>
