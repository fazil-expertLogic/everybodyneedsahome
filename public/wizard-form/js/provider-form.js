/*
|--------------------------------------------------------------------------
| Imminent Template Main JS
|--------------------------------------------------------------------------
*/
document.addEventListener("touchstart", function() {},false);
(function ($) {
	"use strict";
	
/*
|--------------------------------------------------------------------------
	Print Current Year in html footer copyright
|--------------------------------------------------------------------------
*/
	$('span#mgsYear').html( new Date().getFullYear() );
	
/*
|--------------------------------------------------------------------------
| Math Captcha for all Form
|--------------------------------------------------------------------------
*/	
	$(function(){
	
		var randNumber_1 = parseInt( Math.ceil( Math.random() * 15 ), 10 );
		var randNumber_2 = parseInt( Math.ceil( Math.random() * 15 ), 10 );       
		humanCheckCaptcha(randNumber_1, randNumber_2);
	 
	});
	function humanCheckCaptcha(randNumber_1, randNumber_2){
		$( "#humanCheckCaptchaBox" ).html( "Solve The Math " );
		$( "#firstDigit" ).html( '<input name="mathfirstnum" id="mathfirstnum" class="form-control" type="text" value="' + randNumber_1 + '" readonly>' );
		$( "#secondDigit" ).html( '<input name="mathsecondnum" id="mathsecondnum" class="form-control" type="text" value="' + randNumber_2 + '" readonly>' );
	}  
	
/*
|--------------------------------------------------------------------------
| Bootstrap Datepicker
|--------------------------------------------------------------------------
*/	
	$(function(){
		
		$('#date-of-birth input').datepicker({
			format: "dd MM, yyyy",
			startView: 2,
			todayBtn: "linked",
			todayHighlight: true,
			autoclose: true
		});
		
		$('#expirydate').datepicker({
			format: "MM, yyyy",   
			startView: 2,
			minViewMode: 1,
			startDate: "0d",
			todayBtn: "linked",
			todayHighlight: true,
			autoclose: true
		});
		
	});


/*
|--------------------------------------------------------------------------
| signUpForm
|--------------------------------------------------------------------------
*/	
	$("#signUpForm").validator().on("submit", function (event) {
		if (event.isDefaultPrevented()) {
			//handle the invalid form...
			formError();
			submitMSG(false, "Please fill in the form properly!");
		} else {
			// var mathPart_1 = parseInt( $("#mathfirstnum").val(), 10 );
			// var mathPart_2 = parseInt( $("#mathsecondnum").val(), 10 );       
			// var correctMathSolution = parseInt( ( mathPart_1 + mathPart_2 ), 10 );
			// var inputHumanAns = $("#humanCheckCaptchaInput").val();
			// if (inputHumanAns == correctMathSolution){
				//everything looks good!
				// event.preventDefault();
				submitForm();					
				return true;
			// }
			// else{
			// 	submitMSG(false, "Please solve Human Captcha!!!");
			// 	sweetAlert("Oops...", "Please solve Human Captcha!!!", "error");
			// 	return false;
			// }
		}
	});
	
	function submitForm(){
		
		//process your form here.
		$( "#mgsFormSubmit" ).html( '' );
		$( "#final-step-buttons" ).html( '<div class="h3 text-center text-success"> You have finished all steps of this html form successfully </div>' );
		swal("Good job!", "You have finished all steps successfully!", "success");
		
	}
	
	//attachment Photo
	$(function() {

		$(document).on('change', ':file', function() {
			var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
		});

		$(':file').on('fileselect', function(event, numFiles, label) {

			var input = $(this).parents('.form-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

			if( input.length ) {
				input.val(log);
			} else {
				if( log ) alert(log);
			}

		});
	  
	});
	
	//Preview Photo
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function (e) {
				$('#userPhoto').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	$("#userfile").on('change', function(){
		readURL(this);
	});
	
	function formSuccess(){
		$("#signUpForm")[0].reset();
		submitMSG(true, "Registration Process Successfully!")
	}
	
	function formError(){
		$(".help-block.with-errors").removeClass('hidden');
	}
	
	function submitMSG(valid, msg){
		if(valid){
			var msgClasses = "h3 text-center text-success";
		} else {
			var msgClasses = "h3 text-center text-danger";
		}
		$("#mgsFormSubmit").removeClass().addClass(msgClasses).text(msg);
	}

})(jQuery);
	
/*
|--------------------------------------------------------------------------
| overly
|--------------------------------------------------------------------------
*/				
	//autocomplete off	
	$(function() { 
		$( "#signUpForm" ).on( 'focus', ':input', function(){
			$( this ).attr( 'autocomplete', 'off' );
		});		
	});
	
	//check valid email	
	function isEmail(email) {
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		return regex.test(email);
	}
	
	//checking validation before going to step 2
	function nextStep2() {
		var provider_name = $("#provider_name").val();	
		var company_name = $("#company_name").val();
		var type = $("#type").val();	
		var address = $("#address").val();
		var city = $("#city").val();
		var state = $("#state").val();
		var zip = $("#zip").val();
		var phone = $("#phone").val();
		var email = $("#email").val();
		var validcusemail = isEmail(email);
		var website = $("#website").val();
		var other_area_served_option = $('#other-area-served-option').is(':checked');
		if(other_area_served_option === true){
			var custom_area_served = $("#custom-area-served").val();
		}


		if( provider_name )
			$( ".valid_prov_name .help-block.with-errors" ).html( '' );
		else
			$( ".valid_prov_name .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter name</li></ul>' );
		
		if( company_name )
			$( ".valid_prov_company_name .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_company_name .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter company name</li></ul>' );

		if( type )
			$( ".valid_prov_type .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_type .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select type</li></ul>' );

		if( address )
			$( ".valid_prov_address .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_address .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter address</li></ul>' );

		if( city )
			$( ".valid_prov_city .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_city .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter city</li></ul>' );

		if( state )
			$( ".valid_prov_state .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_state .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select state</li></ul>' );

		if( zip )
			$( ".valid_prov_zip .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_zip .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select zip</li></ul>' );

		if( phone )
			$( ".valid_prov_phone .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_phone .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select phone</li></ul>' );

		if( validcusemail )
			$( ".valid_prov_email .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_email .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select email</li></ul>' );

		if( website )
			$( ".valid_prov_website .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_prov_website .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select website</li></ul>' );
		
		if(other_area_served_option === true){
			if( custom_area_served )
				$( ".custom-area-served .help-block.with-errors" ).html( '' );
			else	
				$( ".custom-area-served .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Category </li></ul>' );
		}
		// ------------------------------------------------------------------------------------------------------------------------------------------------------------------
		if(other_area_served_option === true){
			if( provider_name && company_name && type && address && city && state && zip && phone && email && validcusemail && website && custom_area_served) {
				$( "#section-1 .help-block.with-errors" ).html( '' );
				$( "#section-1" ).removeClass( "open" );
				$( "#section-1" ).addClass( "slide-left" );
				$( "#section-2" ).removeClass( "slide-right" );
				$( "#section-2" ).addClass( "open" );
			}
			else {
				$( "#section-1 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
				sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
			}
		}else{

			if( provider_name && company_name && type && address && city && state && zip && phone && email && validcusemail && website ) {
				$( "#section-1 .help-block.with-errors" ).html( '' );
				$( "#section-1" ).removeClass( "open" );
				$( "#section-1" ).addClass( "slide-left" );
				$( "#section-2" ).removeClass( "slide-right" );
				$( "#section-2" ).addClass( "open" );
			}
			else {
				$( "#section-1 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
				sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
			}
		}

		
	}
	
	
	$('#childinfobox').hide();
	$('#birthDiv').hide();
	$('#stateDiv').hide();
	$('#licenseDiv').hide();
	$('#securityDiv').hide();
	$('#insuranceDiv').hide();
	$('#friendsDiv').hide();
	
	var is_edit = $('#is_edit').val();
	if(is_edit == 1){
		var other_area_served_option = $('#other-area-served-option').is(':checked');
		if (other_area_served_option === true) {
			$('#childinfobox').show();
		} else {
			$('#childinfobox').hide();
		}
	}
	
	
	
	function toggleDiv() {
		var other_area_served_option = $('#other-area-served-option').is(':checked');
		if (other_area_served_option === true) {
			$('#childinfobox').show();
		} else {
			$('#childinfobox').hide();
		}
	}




	
	
/*
|--------------------------------------------------------------------------
| End
|--------------------------------------------------------------------------
*/