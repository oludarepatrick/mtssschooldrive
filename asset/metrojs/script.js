function upSchDetails()
{
	var schname = $('#schname').val();
	var schmotto = $('#schmotto').val();
	var address = $('#address').html();
	var postal = $('#postal').html();
	var email = $('#email').val();
	var website = $('#website').val();
	var phone = $('#phone').val();
	var schlevel = $('#schlevel').val();
	var junsenior = $('#junsenior').val();
	console.log(junsenior)
	if(schname == "") {
		$('#schnameErr').html('The name field is required');
		swal("Error", "The name field is required", "error");
	} else if (schmotto == "") {
		$('#schmottoErr').html('The Motto field is required');
		swal("Error", "The Motto field is required", "error");
	} else if (address == "") {
		$('#addressErr').html('The Address Field is required');
		swal("Error", "The Address field is required", "error");
	} else if (email == "") {
		$('#emailErr').html('The Email field is required');
		swal("Error", "The Email field is required", "error");
	} else if (phone == "") {
		$('phoneErr').html('The Phone Number field is required')
		swal("Error", "The Phone Number field is required", "error");
	} else {
	$.post("school_details",
	{
		schname: schname,
		schmotto: schmotto,
		address: address,
		postal: postal,
		email: email,
		website: website,
		phone: phone,
		schlevel: schlevel,
		junsenior: junsenior
	},
	function(data){
	console.log(data);
	if(data == "SUCCESS")
	{
		swal("Successfully Updated!")
	}
	
	})
}
}

function hhh()
{
$.post("url",
{
	data:data,
},
function(data){
	//what to do when data is recieved
})
}