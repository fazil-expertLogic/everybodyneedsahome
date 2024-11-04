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

			$(this).find(":input[required]").each(function() {
				if (!this.checkValidity()) {
					console.log("Invalid field name:", $(this).attr("name"));
					$(this).addClass("is-invalid");  // Optionally add an error class
				} else {
					$(this).removeClass("is-invalid");  // Optionally remove error class
				}
			});
			
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
		var property_name = $("#property_name").val();
		var property_description = $("#property_description").val();
		var property_address = $("#property_address").val();
		var city = $("#city").val();
		var state = $("#state").val();
		var zipcode = $("#zipcode").val();
		var category = $("#category").val();

		console.log(property_name,property_description,property_address,city,state,zipcode,category);
		if( property_name )
			$( ".valid_property_name .help-block.with-errors" ).html( '' );
		else
			$( ".valid_property_name .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter name</li></ul>' );

		if( property_description )
			$( ".valid_property_description .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_property_description .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of birth</li></ul>' );

		if( property_address )
			$( ".valid_property_address .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_property_address .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter social security number</li></ul>' );
		
		if( city )
			$( ".valid_city .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_city .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select marital status</li></ul>' );

		if( state )
			$( ".valid_state .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_state .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select marital status</li></ul>' );

		if( zipcode )
			$( ".zipcode .help-block.with-errors" ).html( '' );
		else	
			$( ".zipcode .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select enter address</li></ul>' );	

		if( category )
			$( ".valid_category .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_category .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select enter city</li></ul>' );
		
		if(property_name && property_description && property_address && city && state && zipcode && category ) {
			
			$( "#section-1 .help-block.with-errors" ).html( '' );
			$( "#section-1" ).removeClass( "open" );
			$( "#section-1" ).addClass( "slide-left" );
			$( "#section-2" ).removeClass( "slide-right" );	
			$( "#section-2" ).addClass( "open" );
		}
		else {
			console.log(property_name,property_description,property_address,city,state,zipcode,category);
			$( "#section-1 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
			sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
		}
	}
	function previousStep1() {
		$( "#section-1" ).removeClass( "slide-left" );
		$( "#section-1" ).addClass( "open" );
		$( "#section-2" ).removeClass( "open" );
		$( "#section-2" ).addClass( "slide-right" );
	}
	
	//checking validation before going to step 3
	function nextStep3() {
		var property_management_address = $("#property_management_address").val();
		var property_management_city = $("#property_management_city").val();
		var property_management_state = $("#property_management_state").val();
		var property_management_zipcode = $("#property_management_zipcode").val();
		
		
		if( property_management_address )
			$( ".valid_property_management_address .help-block.with-errors" ).html( '' );
		else
			$( ".valid_property_management_address .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );
		
		if( property_management_city )
			$( ".valid_property_management_city .help-block.with-errors" ).html( '' );
		else
			$( ".valid_property_management_city .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		if( property_management_state )
			$( ".valid_property_management_state .help-block.with-errors" ).html( '' );
		else
			$( ".valid_property_management_state .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		if( property_management_zipcode )
			$( ".valid_property_management_zipcode .help-block.with-errors" ).html( '' );
		else
			$( ".valid_property_management_zipcode .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		
		if( property_management_address && property_management_city && property_management_state && property_management_zipcode ) {
			$( "#section-2 .help-block.with-errors.mandatory-error" ).html( '' );
			$( "#section-2" ).removeClass( "open" );
			$( "#section-2" ).addClass( "slide-left" );
			$( "#section-3" ).removeClass( "slide-right" );
			$( "#section-3" ).addClass( "open" );
		}
		else {
			$( "#section-2 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
			sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
		}		
	}
	function previousStep2() {
		$( "#section-2" ).removeClass( "slide-left" );
		$( "#section-2" ).addClass( "open" );
		$( "#section-3" ).removeClass( "open" );
		$( "#section-3" ).addClass( "slide-right" );
	}	
	
	//checking validation before going to final step and writing/showing inputed data for confirmation	
	function nextStep4() {
		
		
		var number_of_bedrooms_house = $("#number_of_bedrooms_house").val();
		var number_of_bath_house = $("#number_of_bath_house").val();
		var utilities_inscluded = $("#utilities_inscluded").val();
		var rent_unit = $("#rent_unit").val();
		var unit_deposit = $("#unit_deposit").val();
		var unit_fee = $("#unit_fee").val();
		var is_property_occupied = $("#is_property_occupied").val();
		
		if( number_of_bedrooms_house )
			$( ".valid_number_of_bedrooms_house .help-block.with-errors" ).html( '' );
		else
			$( ".valid_number_of_bedrooms_house .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( number_of_bath_house )
			$( ".valid_number_of_bath_house .help-block.with-errors" ).html( '' );
		else
			$( ".valid_number_of_bath_house .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( utilities_inscluded )
			$( ".valid_utilities_inscluded .help-block.with-errors" ).html( '' );
		else
			$( ".valid_utilities_inscluded .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );
		
		if( rent_unit )
			$( ".valid_rent_unit .help-block.with-errors" ).html( '' );
		else
			$( ".valid_rent_unit .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( unit_deposit )
			$( ".valid_unit_deposit .help-block.with-errors" ).html( '' );
		else
			$( ".valid_unit_deposit .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( unit_fee )
			$( ".valid_unit_fee .help-block.with-errors" ).html( '' );
		else
			$( ".valid_unit_fee .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( is_property_occupied )
			$( ".valid_is_property_occupied .help-block.with-errors" ).html( '' );
		else
			$( ".valid_is_property_occupied .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		
		if( number_of_bedrooms_house && number_of_bath_house && utilities_inscluded && rent_unit && unit_deposit && unit_fee && is_property_occupied ) {
			$( "#section-3 .help-block.with-errors.mandatory-error" ).html( '' );
			$( "#section-3" ).removeClass( "open" );
			$( "#section-3" ).addClass( "slide-left" );
			$( "#section-4" ).removeClass( "slide-right" );
			$( "#section-4" ).addClass( "open" );
		}
		else {
			$( "#section-3 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
			sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
		}
			
	}	
	function previousStep3() {
		$( "#section-3" ).removeClass( "slide-left" );
		$( "#section-3" ).addClass( "open" );
		$( "#section-4" ).removeClass( "open" );
		$( "#section-4" ).addClass( "slide-right" );
	}

	function nextStep5() {
		var cus_insurace = $("#cus_insurace").val();
		if(cus_insurace == 1){
			var cus_carrier = $("#cus_carrier").val();
			var cus_mem_id = $("#cus_mem_id").val();
			var cus_grp_no = $("#cus_grp_no").val();
	
			if( cus_insurace )
				$( ".valid_cus_insurace .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_insurace .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );
	
			if( cus_carrier )
				$( ".valid_cus_carrier .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_carrier .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter carrier</li></ul>' );
	
			if( cus_mem_id )
				$( ".valid_cus_mem_id .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_mem_id .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter member id</li></ul>' );
			
			if( cus_grp_no )
				$( ".valid_cus_grp_no .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_grp_no .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );
	
			if( cus_insurace && cus_carrier && cus_mem_id && cus_grp_no ) {
				$( "#section-4 .help-block.with-errors.mandatory-error" ).html( '' );
				$( "#section-4" ).removeClass( "open" );
				$( "#section-4" ).addClass( "slide-left" );
				$( "#section-5" ).removeClass( "slide-right" );
				$( "#section-5" ).addClass( "open" );
			}
			else {
				$( "#section-4 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
				sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
			}
		}else{
			if( cus_insurace )
				$( ".valid_cus_insurace .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_insurace .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

			if( cus_insurace ) {
				$( "#section-4 .help-block.with-errors.mandatory-error" ).html( '' );
				$( "#section-4" ).removeClass( "open" );
				$( "#section-4" ).addClass( "slide-left" );
				$( "#section-5" ).removeClass( "slide-right" );
				$( "#section-5" ).addClass( "open" );
			}
			else {
				$( "#section-4 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
				sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
			}
		}
	}

	function previousStep4() {
		$( "#section-4" ).removeClass( "slide-left" );
		$( "#section-4" ).addClass( "open" );
		$( "#section-5" ).removeClass( "open" );
		$( "#section-5" ).addClass( "slide-right" );
	}


	function nextStep6() {

		var cus_more_friends = $('#cus_more_friends').val(); 
		var cus_is_inv_rom = $('#cus_is_inv_rom').val(); 
		var cus_is_mental_ill = $('#cus_is_mental_ill').val(); 
		var cus_phy_dis = $('#cus_phy_dis').val(); 
		var cus_comments = $('#cus_comments').val();
		if(cus_more_friends == 1){
			var cus_counselor = $('#cus_counselor').val(); 
			if( cus_counselor )
				$( ".valid_cus_counselor .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_counselor .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter carrier</li></ul>' );

			if( cus_more_friends )
				$( ".valid_cus_more_friends .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_more_friends .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

			if( cus_is_inv_rom )
				$( ".valid_cus_is_inv_rom .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_is_inv_rom .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter member id</li></ul>' );
			
			if( cus_is_mental_ill )
				$( ".valid_cus_is_mental_ill .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_is_mental_ill .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );

			if( cus_phy_dis )
				$( ".valid_cus_phy_dis .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_phy_dis .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );

			if( cus_comments )
				$( ".valid_cus_comments .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_comments .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );	

			if(cus_more_friends && cus_counselor && cus_is_inv_rom && cus_is_mental_ill && cus_phy_dis && cus_comments ) {
				$( "#section-5 .help-block.with-errors.mandatory-error" ).html( '' );
				$( "#section-5" ).removeClass( "open" );
				$( "#section-5" ).addClass( "slide-left" );
				$( "#section-6" ).removeClass( "slide-right" );
				$( "#section-6" ).addClass( "open" );
			}
			else {
				$( "#section-5 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
				sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
			}

		}else{
			if( cus_more_friends )
				$( ".valid_cus_more_friends .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_more_friends .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

			if( cus_is_inv_rom )
				$( ".valid_cus_is_inv_rom .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_is_inv_rom .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter member id</li></ul>' );
			
			if( cus_is_mental_ill )
				$( ".valid_cus_is_mental_ill .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_is_mental_ill .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );

			if( cus_phy_dis )
				$( ".valid_cus_phy_dis .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_phy_dis .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );

			if( cus_comments )
				$( ".valid_cus_comments .help-block.with-errors" ).html( '' );
			else
				$( ".valid_cus_comments .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter group no</li></ul>' );	

			if(cus_more_friends && cus_is_inv_rom && cus_is_mental_ill && cus_phy_dis && cus_comments ) {
				$( "#section-5 .help-block.with-errors.mandatory-error" ).html( '' );
				$( "#section-5" ).removeClass( "open" );
				$( "#section-5" ).addClass( "slide-left" );
				$( "#section-6" ).removeClass( "slide-right" );
				$( "#section-6" ).addClass( "open" );
			}
			else {
				$( "#section-5 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
				sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
			}
		}
	}
	function birthDiv() {
		var selectedValue = $('#cus_bcert').val();
		if (selectedValue === '1') {
			$('#birthDiv').show();
		} else if (selectedValue === '2') {
			$('#birthDiv').hide();
		}
	}

	function stateDiv() {
		var selectedValue = $('#cus_state_id').val();
		if (selectedValue === '1') {
			$('#stateDiv').show();
		} else if (selectedValue === '2') {
			$('#stateDiv').hide();
		}
	}

	function licenseDiv() {
		var selectedValue = $('#cus_d_lice').val();
		if (selectedValue === '1') {
			$('#licenseDiv').show();
		} else if (selectedValue === '2') {
			$('#licenseDiv').hide();
		}
	}

	function securityDiv() {
		var selectedValue = $('#cus_ss_card').val();
		if (selectedValue === '1') {
			$('#securityDiv').show();
		} else if (selectedValue === '2') {
			$('#securityDiv').hide();
		}
	}

	function insuranceDiv() {
		var selectedValue = $('#cus_insurace').val();
		if (selectedValue === '1') {
			$('#insuranceDiv').show();
		} else if (selectedValue === '2') {
			$('#insuranceDiv').hide();
		}
	}
	
	function friendsDiv() {
		var selectedValue = $('#cus_more_friends').val();
		if (selectedValue === '1') {
			$('#friendsDiv').show();
		} else if (selectedValue === '2') {
			$('#friendsDiv').hide();
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
		var cus_bcert = $('#cus_bcert').val();
		if (cus_bcert === '1') {
			$('#birthDiv').show();
		} else if (cus_bcert === '2') {
			$('#birthDiv').hide();
		}
		var cus_state_id = $('#cus_state_id').val();
		if (cus_state_id === '1') {
			$('#stateDiv').show();
		} else if (cus_state_id === '2') {
			$('#stateDiv').hide();
		}
		var cus_d_lice = $('#cus_d_lice').val();
		if (cus_d_lice === '1') {
			$('#licenseDiv').show();
		} else if (cus_d_lice === '2') {
			$('#licenseDiv').hide();
		}
		var cus_ss_card = $('#cus_ss_card').val();
		if (cus_ss_card === '1') {
			$('#securityDiv').show();
		} else if (cus_ss_card === '2') {
			$('#securityDiv').hide();
		}
		var cus_insurace = $('#cus_insurace').val();
		if (cus_insurace === '1') {
			$('#insuranceDiv').show();
		} else if (cus_insurace === '2') {
			$('#insuranceDiv').hide();
		}
		var cus_more_friends = $('#cus_more_friends').val();
		if (cus_more_friends === '1') {
			$('#friendsDiv').show();
		} else if (cus_more_friends === '2') {
			$('#friendsDiv').hide();
		}

		var cus_is_child = $('#cus_is_child').val();
		if (cus_is_child === '1') {
			$('#childinfobox').show();
		} else if (cus_is_child === '2') {
			$('#childinfobox').hide();
		}
		
	}
	
	
	
	function toggleDiv() {
		var selectedValue = $('#cus_is_child').val();
		if (selectedValue === '1') {
			$('#childinfobox').show();
		} else if (selectedValue === '2') {
			$('#childinfobox').hide();
		}
	}




	var count = 1; 
	function addchild() {
		var newChildInfoBox = `
			<div class="col-sm-12 col-lg-12" id="childinfobox` + count + `">
				<div id="child-boxes-container">
					<div class="row childBOX">
						<div class="col-sm-6 col-lg-6">
							<fieldset class="mb-3">
								<label for="child_name_`+count+`" class="form-label">Child Name<span class="text-danger">*</span></label>
								<input type="text" class="form-control py-2" value="" name="child_name[]" id="child_name_`+count+`" >
							</fieldset>
						</div>

						<div class="col-sm-6 col-lg-6">
							<fieldset class="">
								<label for="child_age_`+count+`" class="form-label">Child Age<span class="text-danger">*</span></label>
								<select name="child_age[]" class="form-select" id="child_age_`+count+`" aria-label="" >
									<option value="0" selected="">0+</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
								</select>
							</fieldset>
						</div>
					</div>
				</div>

				<div class="mb-3 text-end">
					<a href="#" class="delete-child-box text-danger" onclick="deletechild(`+count+`)">Delete</a> <span class="separator">|</span>
					<a href="#" id="add-new-child" onclick="addchild()" class="text-blue">Add new</a>
				</div>
			</div>
			`;
			$('#child-info-container').append(newChildInfoBox);
			console.log(count);
			count++;
	}

	function deletechild(id){
		$('#childinfobox'+id).remove();
	}
	
/*
|--------------------------------------------------------------------------
| End
|--------------------------------------------------------------------------
*/