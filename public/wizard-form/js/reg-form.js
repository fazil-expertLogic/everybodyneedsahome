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
			var mathPart_1 = parseInt( $("#mathfirstnum").val(), 10 );
			var mathPart_2 = parseInt( $("#mathsecondnum").val(), 10 );       
			var correctMathSolution = parseInt( ( mathPart_1 + mathPart_2 ), 10 );
			var inputHumanAns = $("#humanCheckCaptchaInput").val();
			if (inputHumanAns == correctMathSolution){
				//everything looks good!
				event.preventDefault();
				submitForm();					
			}
			else{
				submitMSG(false, "Please solve Human Captcha!!!");
				sweetAlert("Oops...", "Please solve Human Captcha!!!", "error");
				return false;
			}
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
		
		// var pass = $("#pass").val();
		// var cpass = $("#cpass").val();
		
		
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
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		var gender = $("#gender").val();
		var birthdate = $("#birthdate").val();
		var address = $("#address").val();
		var phone = $("#phone").val();
		var preferedcontact = $('input[name=preferedcontact]:checked').val();		
		
		if( fname )
			$( ".validfname .help-block.with-errors" ).html( '' );
		else
			$( ".validfname .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter First Name</li></ul>' );
		
		if( lname )
			$( ".validlname .help-block.with-errors" ).html( '' );
		else
			$( ".validlname .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Last Name</li></ul>' );
		
		if( gender )
			$( ".validgender .help-block.with-errors" ).html( '' );
		else
			$( ".validgender .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Gender</li></ul>' );
		
		if( birthdate )
			$( ".validbirthdate .help-block.with-errors" ).html( '' );
		else
			$( ".validbirthdate .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Date Of Birth</li></ul>' );
		
		if( address )
			$( ".validaddress .help-block.with-errors" ).html( '' );
		else
			$( ".validaddress .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Address</li></ul>' );
		
		var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
		if (filter.test(phone)) {
			$( ".validphone .help-block.with-errors" ).html( '' );
			var validphone = 1;
		}
		else{
			$( ".validphone .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter valid Phone</li></ul>' );
			var validphone = 0;
		}
		
		if( preferedcontact )
			$( ".validpreferedcontact .help-block.with-errors" ).html( '' );
		else
			$( ".validpreferedcontact .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Prefered Contact Method</li></ul>' );
		
		if( fname.length > 0 && fname && lname.length > 0 && lname && gender && birthdate.length > 4 && birthdate && phone.length > 4 && validphone > 0 && address.length > 0 && address && preferedcontact ) {
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
		var uname = $("#cus_name").val();
		var email = $("#email").val();
		var pass = $("#pass").val();
		var fname = $("#fname").val();
		var lname = $("#lname").val();
		var gender = $("#gender").val();
		var birthdate = $("#birthdate").val();
		var address = $("#address").val();
		var phone = $("#phone").val();
		var preferedcontact = $('input[name=preferedcontact]:checked').val();
		var paymenttype = $("#paymenttype").val();
		var hname = $("#hname").val();
		var cardnumber = $("#cardnumber").val();
		var cvc = $("#cvc").val();
		var expirydate = $("#expirydate").val();
		
		//write inputed data
		$( "#unameData" ).html( '<strong>UserName:</strong> '+ uname );
		$( "#emailData" ).html( '<strong>email:</strong> '+ email );
		$( "#passData" ).html( '<strong>Password:</strong> *****' );
		$( "#firstNameData" ).html( '<strong>First Name:</strong> '+ fname );
		$( "#lastNameData" ).html( '<strong>Last Name:</strong> '+ lname );
		$( "#genderData" ).html( '<strong>Gender:</strong> '+ gender );
		$( "#birthdateData" ).html( '<strong>Date Of Birth:</strong> '+ birthdate );
		$( "#addressData" ).html( '<strong>Address:</strong> '+ address );
		$( "#phoneData" ).html( '<strong>Phone:</strong> '+ phone );
		$( "#preferedcontactData" ).html( '<strong>Prefered Contact Method:</strong> '+ preferedcontact );
		$( "#paymenttypeData" ).html( '<strong>Payment Type:</strong> '+ paymenttype );
		$( "#hnameData" ).html( '<strong>Card Holder Name:</strong> '+ hname );
		$( "#cardnumberData" ).html( '<strong>Card Number:</strong> '+ cardnumber );
		$( "#cvcData" ).html( '<strong>CVC:</strong> ***' );
		$( "#expirydateData" ).html( '<strong>Expiry Date:</strong> '+ expirydate );
		
		if( paymenttype )
			$( ".validpaymenttype .help-block.with-errors" ).html( '' );
		else
			$( ".validpaymenttype .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Select Payment Type</li></ul>' );
		
		if( hname )
			$( ".validhname .help-block.with-errors" ).html( '' );
		else
			$( ".validhname .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Card Holder Name</li></ul>' );
		
		var re16digit = /^\d{16}$/;
		
		if( cardnumber && re16digit.test(cardnumber) )
			$( ".validcardnumber .help-block.with-errors" ).html( '' );
		else {
			$( ".validcardnumber .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter 16 digit Card Number</li></ul>' );
			return false;
		}
		
		if( cvc )
			$( ".validcvc .help-block.with-errors" ).html( '' );
		else
			$( ".validcvc .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter CVC</li></ul>' );
		
		if( expirydate )
			$( ".validexpirydate .help-block.with-errors" ).html( '' );
		else
			$( ".validexpirydate .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter Expiry Date</li></ul>' );
		
		if( $('#aggre').is(":checked") )
			$( ".validagree .help-block.with-errors" ).html( '' );
		else{
			$( ".validagree .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please Agree with terms &amp; conditions</li></ul>' );
			sweetAlert("Oops...", "Please Agree with terms & conditions!", "error");return false;
		}
		
		if( $('#aggre').is(":checked") && paymenttype && hname && cardnumber && cvc && expirydate ) {
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
	
/*
|--------------------------------------------------------------------------
| End
|--------------------------------------------------------------------------
*/