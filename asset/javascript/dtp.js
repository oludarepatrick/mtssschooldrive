






$(function() {
    $( "#datepicker" ).datepicker();//this create a datepicker for u. u have to set something in the html part my-code6.html
  

    $( "#tabs" ).tabs();//this create a tab for you and den u have to set something in the html part my-code6.html
	  $( "input[type=submit], a, button" )//this create a button for u. u have to set something in the html part my-code6.html
      .button()
      .click(function( event ) {
        event.preventDefault();
      
  });
  });