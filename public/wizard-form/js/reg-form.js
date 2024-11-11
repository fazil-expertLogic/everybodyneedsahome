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
				// if( log ) alert(log);
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
		var cus_name = $("#cus_name").val();
		var cus_email = $("#cus_email").val();
		var validcusemail = isEmail(cus_email);
		var cus_dob = $("#cus_dob").val();
		var cus_ss = $("#cus_ss").val();
		var cus_ms = $("#cus_ms").val();
		var cus_is_child = $("#cus_is_child").val();
		var cus_address = $("#cus_address").val();
		var cus_city = $("#cus_city").val();
		var cus_state = $("#cus_state").val();
		var cus_zip = $("#cus_zip").val();
		var cus_phone = $("#cus_phone").val();
		
		
		
		if( cus_name )
			$( ".valid_cus_name .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_name .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter name</li></ul>' );
		
		if( validcusemail )
			$( ".valid_cus_email .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_email .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter valid email</li></ul>' );

		if( cus_dob )
			$( ".valid_cus_dob .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_dob .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of birth</li></ul>' );

		if( cus_ss )
			$( ".valid_cus_ss .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_ss .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter social security number</li></ul>' );
		
		if( cus_ms )
			$( ".valid_cus_ms .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_ms .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select marital status</li></ul>' );

		if( cus_is_child )
			$( ".valid_cus_is_child .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_is_child .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select marital status</li></ul>' );

		if( cus_address )
			$( ".valid_cus_address .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_address .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select enter address</li></ul>' );	

		if( cus_city )
			$( ".valid_cus_city .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_city .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select enter city</li></ul>' );

		if( cus_state )
			$( ".valid_cus_state .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_state .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select state</li></ul>' );


		if( cus_zip )
			$( ".valid_cus_zip .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_zip .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select zip</li></ul>' );
		
			
		if( cus_phone )
			$( ".valid_cus_phone .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_cus_phone .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select phone</li></ul>' );	

		// if(  pass.length < 6 )
		// 	$( ".validpass .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Password should at least 6 character</li></ul>' );
		// else if(  pass != cpass ) {
		// 	$( ".validpass .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Password and Confirm Password do not match</li></ul>' );
		// 	sweetAlert("Oops...", "Password and Confirm Password do not match!!!", "error");return false;
		// }
		// else
		// 	$( ".validpass .help-block.with-errors" ).html( '' );
		
		// if( cus_name && validcusemail && pass.length > 5 && pass == cpass ) {
		if( cus_name && validcusemail && cus_dob && cus_ss && cus_ms && cus_is_child && cus_address && cus_city && cus_state && cus_zip && cus_phone) {
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
	function previousStep1() {
		$( "#section-1" ).removeClass( "slide-left" );
		$( "#section-1" ).addClass( "open" );
		$( "#section-2" ).removeClass( "open" );
		$( "#section-2" ).addClass( "slide-right" );
	}
	
	//checking validation before going to step 3
	function nextStep3() {
		var cus_pp = $("#cus_pp").val();
		var cus_dfc = $("#cus_dfc").val();
		var cus_con = $("#cus_con").val();
		var cus_conq = $("#cus_conq").val();
		var cus_sex_off = $("#cus_sex_off").val();
		var cus_is_offend_minor = $("#cus_is_offend_minor").val();
		// var lname = $("#lname").val();
		// var gender = $("#gender").val();
		// var birthdate = $("#birthdate").val();
		// var address = $("#address").val();
		// var phone = $("#phone").val();
		// var preferedcontact = $('input[name=preferedcontact]:checked').val();		
		
		if( cus_pp )
			$( ".valid_cus_pp .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_pp .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );
		
		if( cus_dfc )
			$( ".valid_cus_dfc .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_dfc .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		if( cus_con )
			$( ".valid_cus_con .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_con .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		if( cus_conq )
			$( ".valid_cus_conq .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_conq .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		if( cus_sex_off )
			$( ".valid_cus_sex_off .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_sex_off .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );

		if( cus_is_offend_minor )
			$( ".valid_cus_is_offend_minor .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_is_offend_minor .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>' );
		
		// if( lname )
		// 	$( ".validlname .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validlname .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Last Name</li></ul>' );
		
		// if( gender )
		// 	$( ".validgender .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validgender .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Gender</li></ul>' );
		
		// if( birthdate )
		// 	$( ".validbirthdate .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validbirthdate .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Date Of Birth</li></ul>' );
		
		// if( address )
		// 	$( ".validaddress .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validaddress .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Address</li></ul>' );
		
		// var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		// if (filter.test(phone)) {
		// 	$( ".validphone .help-block.with-errors" ).html( '' );
		// 	var validphone = 1;
		// }
		// else{
		// 	$( ".validphone .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter valid Phone</li></ul>' );
		// 	var validphone = 0;
		// }
		
		// if( preferedcontact )
		// 	$( ".validpreferedcontact .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validpreferedcontact .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Prefered Contact Method</li></ul>' );
		
		if( cus_pp && cus_dfc && cus_con && cus_conq && cus_sex_off && cus_is_offend_minor) {
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
		
		//inputed value
		// var uname = $("#cus_name").val();
		// var email = $("#email").val();
		// var pass = $("#pass").val();
		// var fname = $("#fname").val();
		// var lname = $("#lname").val();
		// var gender = $("#gender").val();
		// var birthdate = $("#birthdate").val();
		// var address = $("#address").val();
		// var phone = $("#phone").val();
		// var preferedcontact = $('input[name=preferedcontact]:checked').val();
		// var paymenttype = $("#paymenttype").val();
		// var hname = $("#hname").val();
		// var cardnumber = $("#cardnumber").val();
		// var cvc = $("#cvc").val();
		// var expirydate = $("#expirydate").val();
		
		//write inputed data
		// $( "#unameData" ).html( '<strong>UserName:</strong> '+ uname );
		// $( "#emailData" ).html( '<strong>email:</strong> '+ email );
		// $( "#passData" ).html( '<strong>Password:</strong> *****' );
		// $( "#firstNameData" ).html( '<strong>First Name:</strong> '+ fname );
		// $( "#lastNameData" ).html( '<strong>Last Name:</strong> '+ lname );
		// $( "#genderData" ).html( '<strong>Gender:</strong> '+ gender );
		// $( "#birthdateData" ).html( '<strong>Date Of Birth:</strong> '+ birthdate );
		// $( "#addressData" ).html( '<strong>Address:</strong> '+ address );
		// $( "#phoneData" ).html( '<strong>Phone:</strong> '+ phone );
		// $( "#preferedcontactData" ).html( '<strong>Prefered Contact Method:</strong> '+ preferedcontact );
		// $( "#paymenttypeData" ).html( '<strong>Payment Type:</strong> '+ paymenttype );
		// $( "#hnameData" ).html( '<strong>Card Holder Name:</strong> '+ hname );
		// $( "#cardnumberData" ).html( '<strong>Card Number:</strong> '+ cardnumber );
		// $( "#cvcData" ).html( '<strong>CVC:</strong> ***' );
		// $( "#expirydateData" ).html( '<strong>Expiry Date:</strong> '+ expirydate );
		
		// if( paymenttype )
		// 	$( ".validpaymenttype .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validpaymenttype .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Payment Type</li></ul>' );
		
		// if( hname )
		// 	$( ".validhname .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validhname .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Card Holder Name</li></ul>' );
		
		// var re16digit = /^\d{16}$/;
		
		// if( cardnumber && re16digit.test(cardnumber) )
		// 	$( ".validcardnumber .help-block.with-errors" ).html( '' );
		// else {
		// 	$( ".validcardnumber .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter 16 digit Card Number</li></ul>' );
		// 	return false;
		// }
		
		// if( cvc )
		// 	$( ".validcvc .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validcvc .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter CVC</li></ul>' );
		
		// if( expirydate )
		// 	$( ".validexpirydate .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".validexpirydate .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Expiry Date</li></ul>' );
		
		// if( $('#aggre').is(":checked") )
		// 	$( ".validagree .help-block.with-errors" ).html( '' );
		// else{
		// 	$( ".validagree .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Agree with terms &amp; conditions</li></ul>' );
		// 	sweetAlert("Oops...", "Please Agree with terms & conditions!", "error");return false;
		// }
		
		var cus_food = $("#cus_food").val();
		var cus_cloth = $("#cus_cloth").val();
		var cus_shelter = $("#cus_shelter").val();
		var cus_tra = $("#cus_tra").val();
		var cus_emp = $("#cus_emp").val();
		var cus_extra_income = $("#cus_extra_income").val();
		var cus_church = $("#cus_church").val();
		var cus_other_church = $("#cus_other_church").val();
		var cus_bcert = $("#cus_bcert").val();
		// var cus_born_state = $("#cus_born_state").val();
		var cus_state_id = $("#cus_state_id").val();
		// var cus_state_no = $("#cus_state_no").val();
		var cus_d_lice = $("#cus_d_lice").val();
		// var cus_lice_no = $("#cus_lice_no").val();
		var cus_ss_card = $("#cus_ss_card").val();
		// var cus_ssc_no = $("#cus_ssc_no").val();



		if( cus_food )
			$( ".valid_cus_food .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_food .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_cloth )
			$( ".valid_cus_cloth .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_cloth .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_shelter )
			$( ".valid_cus_shelter .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_shelter .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );
		
		if( cus_tra )
			$( ".valid_cus_tra .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_tra .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_emp )
			$( ".valid_cus_emp .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_emp .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_extra_income )
			$( ".valid_cus_extra_income .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_extra_income .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_church )
			$( ".valid_cus_church .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_church .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_other_church )
			$( ".valid_cus_other_church .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_other_church .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_bcert )
			$( ".valid_cus_bcert .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_bcert .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		// if( cus_born_state )
		// 	$( ".valid_cus_born_state .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".valid_cus_born_state .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_state_id )
			$( ".valid_cus_state_id .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_state_id .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		// if( cus_state_no )
		// 	$( ".valid_cus_state_no .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".valid_cus_state_no .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		if( cus_d_lice )
			$( ".valid_cus_d_lice .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_d_lice .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		// if( cus_lice_no )
		// 	$( ".valid_cus_lice_no .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".valid_cus_lice_no .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter license number</li></ul>' );

		if( cus_ss_card )
			$( ".valid_cus_ss_card .help-block.with-errors" ).html( '' );
		else
			$( ".valid_cus_ss_card .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );

		// if( cus_ssc_no )
		// 	$( ".valid_cus_ssc_no .help-block.with-errors" ).html( '' );
		// else
		// 	$( ".valid_cus_ssc_no .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select</li></ul>' );
		
		if( cus_food && cus_cloth && cus_shelter && cus_tra && cus_emp && cus_extra_income && cus_church  && cus_bcert && cus_born_state && cus_state_id && cus_d_lice && cus_ss_card ) {
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




	// =======================================================================================================================================
	function previousStep5() {
		$( "#section-5" ).removeClass( "slide-left" );
		$( "#section-5" ).addClass( "open" );
		$( "#section-6" ).removeClass( "open" );
		$( "#section-6" ).addClass( "slide-right" );
	}


	function nextStep7() {
		console.log("asdasdads");
		var cus_more_friends = $('#cus_more_friends').val(); 
		var cus_is_inv_rom = $('#cus_is_inv_rom').val(); 
		var cus_is_mental_ill = $('#cus_is_mental_ill').val(); 
		var cus_phy_dis = $('#cus_phy_dis').val(); 
		var cus_comments = $('#cus_comments').val();
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
			$( "#section-6 .help-block.with-errors.mandatory-error" ).html( '' );
			$( "#section-6" ).removeClass( "open" );
			$( "#section-6" ).addClass( "slide-left" );
			$( "#section-7" ).removeClass( "slide-right" );
			$( "#section-7" ).addClass( "open" );
		}
		else {
			$( "#section-6 .help-block.with-errors.mandatory-error" ).html( '<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>' );
			sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
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

	function payment_plan(){
		console.log("adasd");
		$('input[name="plan"]').on('change', function() {
			if ($('#monthly-tab').is(':checked')) {
				$('#monthly').addClass('show active');
				$('#yearly').removeClass('show active');
			} else if ($('#yearly-tab').is(':checked')) {
				$('#yearly').addClass('show active');
				$('#monthly').removeClass('show active');
			}
		});
	}
/*
|--------------------------------------------------------------------------
| End
|--------------------------------------------------------------------------
*/