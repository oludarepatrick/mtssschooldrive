(function($){
    $.fn.limit  = function(options) {
        var defaults = {
        limit: 200,
        id_result: false,
        alertClass: false,
		sms : 0,
		count: 0,
		target_id: "",
        }
        var options = $.extend(defaults,  options);
        return this.each(function() {
            var maxLimit = options.limit;
			var sms = options.sms;
			var count = options.count;
			var target = options.target_id;
            if(options.id_result != false)
            {
                //$("#"+options.id_result).append("You have <strong>"+  max+"</strong> max remaining");
				 $("#"+options.id_result).append("<strong>"+  count+"  </strong> characters / <strong>"+  sms +"</strong> SMS / <strong>"+  maxLimit+"  </strong> remaining ")
            }
            $(this).keyup(function(){
                if($(this).val().length > maxLimit){
                    $(this).val($(this).val().substr(0, maxLimit));
                }
                if(options.id_result != false)
                {
					var remaining =  maxLimit - $(this).val().length;
					count = $(this).val().length;
					sms = Math.ceil(count/160);
					
					/*if(count <=160 && count >=1 ){
							sms = 1;
					}else if (count <=320 && count >=161 ){
							sms = 2;
					}else if (count <=440 && count >=321){
							sms = 3;
					}
                  			*/	
					
                    $("#"+options.id_result).html("<strong>"+  count+"  </strong> characters / <strong>"+  sms +"</strong> SMS / <strong>"+  remaining+"</strong>  remaining ");
                    if(remaining <= 10)
                    {
                        $("#"+options.id_result).addClass(options.alertClass);
                    }
                    else
                    {
                        $("#"+options.id_result).removeClass(options.alertClass);
                    }
					
					$("#"+options.target_id).val(sms);
                }
            });
        });
    };
})(jQuery);
		 
		 
function Indicator(field, indicator, max)  {
	 var remaining = 0;
	 var page = 0;
	 //alert(indicator);
	 // if the length of the string in the input field is greater than the max value, trim it
	 //alert('We are here!');
	 if (field.value.length > max)
	 field.value = field.value.substring(0, max);
	 else {
	 // calculate the remaining characters
	 xters = field.value.length; 
	 remaining = max - field.value.length;
	 page = Math.ceil(field.value.length/160);
	 //indicator.value ='Characters = '+xters+' Pages ='+page+' Remaining '+remaining;
	// indicator.value =  xters+" characters / "+  page +" SMS / "+  remaining+" remaining ";
	 indicator.value = page;
  	}
}
  
  function countR(txtarea, target){
	var txtRef = trim(txtarea.value,',');
	var temp_array = new Array();
	
	if (txtRef != ""){
		temp_array = txtRef.split(",");
		document.getElementById("recp").innerHTML=temp_array.length;
		target.value =temp_array.length;
	}
	else{
		document.getElementById("recp").innerHTML=0;
		target.value =0
	}
}//countR(txtarea)
function trim (str, charlist) {
    var whitespace, l = 0, i = 0;
    str += '';
    
    if (!charlist) {
        // default list
        whitespace = " \n\r\t\f\x0b\xa0\u2000\u2001\u2002\u2003\u2004\u2005\u2006\u2007\u2008\u2009\u200a\u200b\u2028\u2029\u3000";
    } else {
        // preg_quote custom list
        charlist += '';
        whitespace = charlist.replace(/([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '\$1');
    }
    
    l = str.length;
    for (i = 0; i < l; i++) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(i);
            break;
        }
    }
    
    l = str.length;
    for (i = l - 1; i >= 0; i--) {
        if (whitespace.indexOf(str.charAt(i)) === -1) {
            str = str.substring(0, i + 1);
            break;
        }
    }
    
    return whitespace.indexOf(str.charAt(0)) === -1 ? str : '';
}	

function smsAmount()
	{
		var sms_qty = trim(document.frmPricing.smsqty.value);
		var amount = 0;		
		if (sms_qty <  1000){
			amount = 2.5 * sms_qty;
		}
		else if(sms_qty < 5000) {
			amount = 2.3 * sms_qty;
		}
		else if(sms_qty < 10000){
			amount = 2 * sms_qty;
		}
		else if(sms_qty < 50000){
			amount = 1.8 * sms_qty;
		}
		else if(sms_qty < 100000){
			amount = 1.6 * sms_qty;
		}
		else if(sms_qty > 99999){
			amount = 1.4 * sms_qty;
		}
		amount = Math.round(amount);
		document.frmPricing.amount.value = amount;
		//document.getElementById("recp").innerHTML=temp;
}//function smsAmount()

function smsQty()
	{
		var sms_qty = 0;
		var amount = trim(document.frmPricing.amount.value);
		var rate = 0;		
		if (amount <  2300){
			rate = 2.5;
		}
		else if(amount < 10000) {
			rate = 2.3;
		}
		else if(amount < 10000){
			rate = 2;
		}
		else if(amount < 80000){
			rate = 1.8;
		}
		else if(amount < 100000){
			rate = 1.6;
		}
		else if(amount > 99999){
			rate = 1.4;
		}
		sms_qty = amount/rate;
		sms_qty = Math.round(sms_qty);
		document.frmPricing.smsqty.value = sms_qty;
		//document.getElementById("recp").innerHTML=temp;
}//function smsQty()		 
		 
		 
		 
		 
		 		 
		 
		 