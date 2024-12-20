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
	
	
	function submitForm(){
		
		//process your form here.
		$( "#mgsFormSubmit" ).html( '' );
		$( "#final-step-buttons" ).html( '<div class="h3 text-center text-success"> You have finished all steps of this html form successfully </div>' );
		swal("Success!", "You have finished all steps successfully!", "success");
		
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
		var pass = $("#pass").val();
		var cpass = $("#pass_confirmation").val();




		var other_area_served_option = $('#other-area-served-option').is(':checked');
		if(other_area_served_option === true){
			var custom_area_served = $("#custom-area-served").val();
		}

		if (pass != cpass) {
			console.log(pass == cpass);
			$(".validpass .help-block.with-errors").html('<ul class="list-unstyled"><li>Password and Confirm Password do not match</li></ul>');
			sweetAlert("Oops...", "Password and Confirm Password do not match!!!", "error");
			return false;
		}
		else
			$(".validpass .help-block.with-errors").html('');

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
			if( provider_name && pass && company_name && type && address && city && state && zip && phone && email && validcusemail && website && custom_area_served) {
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

			if( provider_name && pass && company_name && type && address && city && state && zip && phone && email && validcusemail && website ) {
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
	
	function previousStep1() {
		$( "#section-1" ).removeClass( "slide-left" );
		$( "#section-1" ).addClass( "open" );
		$( "#section-2" ).removeClass( "open" );
		$( "#section-2" ).addClass( "slide-right" );
	}

	function nextStep3() {
		var membership_id = $('#membership_id').val(); 
		
		if(membership_id) {
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


	// ---------------------------------------------------------------------------------------------------
	function nextStep4() {
		console.log("asdasdads");
		
			$( "#section-3 .help-block.with-errors.mandatory-error" ).html( '' );
			$( "#section-3" ).removeClass( "open" );
			$( "#section-3" ).addClass( "slide-left" );
			$( "#section-4" ).removeClass( "slide-right" );
			$( "#section-4" ).addClass( "open" );
		
	}

	function previousStep3() {

		$( "#section-3" ).removeClass( "slide-left" );
		$( "#section-3" ).addClass( "open" );
		$( "#section-4" ).removeClass( "open" );
		$( "#section-4" ).addClass( "slide-right" );
	}












	// ----------------------------------------------------------------------------------------
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
	
	// ---------------------------------------------------- Stripe ----------------------------------------------------
	var stripe, elements, card;

    function initializeStripe() {
        console.log("Initializing Stripe...");
        if (!stripe) {
            stripe = Stripe("pk_test_51QK09gFvlUHXvmXR6KStptAv1Gs6hGaZ55eVnUGIJB49rXQxiq2Y9AU4j1xHAONGfLnS1lgfyhfFzEN55kjDfOnI00Kedj8TAE"); // Replace with your Stripe publishable key
        }
        if (!elements) {
            elements = stripe.elements();
        }
        if (!card) {
            const style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            card = elements.create('card', {
                style: style
            });
            card.mount('#card-element'); // Mount the card Element in the div
            card.on('change', function(event) {
                const displayError = document.getElementById('card-errors');
                displayError.textContent = event.error ? event.error.message : '';
            });
        }
    }

	$(document).ready(function() {
        initializeStripe();
    });

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
			console.log('form submitted');
			// Prevent the default form submission
   
		   if (card) {
			
			   event.preventDefault();
			   // Use Stripe.js to create a token
			   stripe.createToken(card).then(function(result) {
				
				   if (result.error) {
					   // Handle any errors from Stripe.js
					   const errorElement = document.getElementById('card-errors');
					   errorElement.textContent = result.error.message;
					   event.preventDefault();
				   } else {
   
					   // Token successfully created, insert token ID into the form
					   const form = document.getElementById('signUpForm');
					   const hiddenInput = document.createElement('input');
					   hiddenInput.setAttribute('type', 'hidden');
					   hiddenInput.setAttribute('name', 'stripeToken');
					   hiddenInput.setAttribute('value', result.token.id);
					   form.appendChild(hiddenInput);
   
					   // Include last 4 digits, expiration month, and year of the card from the token object
					   const hiddenInputLast4 = document.createElement('input');
					   hiddenInputLast4.setAttribute('type', 'hidden');
					   hiddenInputLast4.setAttribute('name', 'last4');
					   hiddenInputLast4.setAttribute('value', result.token.card.last4);
					   form.appendChild(hiddenInputLast4);
   
					   const hiddenInputExpMonth = document.createElement('input');
					   hiddenInputExpMonth.setAttribute('type', 'hidden');
					   hiddenInputExpMonth.setAttribute('name', 'exp_month');
					   hiddenInputExpMonth.setAttribute('value', result.token.card.exp_month);
					   form.appendChild(hiddenInputExpMonth);
   
					   const hiddenInputExpYear = document.createElement('input');
					   hiddenInputExpYear.setAttribute('type', 'hidden');
					   hiddenInputExpYear.setAttribute('name', 'exp_year');
					   hiddenInputExpYear.setAttribute('value', result.token.card.exp_year);
					   form.appendChild(hiddenInputExpYear);
   
					   // Submit the form
					   form.submit();
					   submitForm();
				   }
			   });
		   } else {
			   event.preventDefault();
			   // No Stripe card required, submit the form directly
			   document.getElementById('signUpForm').submit();
		   }
		}
	});
	// ---------------------------- Zip Code ----------------------------
	document.addEventListener('DOMContentLoaded', (event) => {
		// ------------------ phone ----------------------------
		const phoneInput = document.getElementById('phone');
		phoneInput.addEventListener('input', function (e) {
			let value = e.target.value.replace(/\D/g, '');
			let formattedValue = '';
	
			if (value.length > 0) {
				formattedValue += value.substring(0, 3);
			}
			if (value.length > 3) {
				formattedValue += '-' + value.substring(3, 6);
			}
			if (value.length > 6) {
				formattedValue += '-' + value.substring(6, 10);
			}
	
			e.target.value = formattedValue;
		});
	
		phoneInput.addEventListener('keydown', function (e) {
			if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
				e.preventDefault();
			}
		});
		// ----------------------- Zip code ---------------------------------------------
		const zipInput = document.getElementById('zip');

		zipInput.addEventListener('input', function (e) {
			let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters
			let formattedValue = '';

			// Format as XXXXX or XXXXX-XXXX
			if (value.length > 0) {
				formattedValue += value.substring(0, 5);
			}
			if (value.length > 5) {
				formattedValue += '-' + value.substring(5, 9);
			}

			e.target.value = formattedValue;
		});

		zipInput.addEventListener('keydown', function (e) {
			// Allow only numeric keys, backspace, delete, left arrow, right arrow
			const allowedKeys = [8, 46, 37, 39];
			const isNumericKey = (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105);

			if (!isNumericKey && !allowedKeys.includes(e.keyCode)) {
				e.preventDefault();
			}
		});
	});
	// ------------------------------------------- Password ---------------------------------------------------------- 
	// Toggle visibility for new password
	const togglePassword = document.getElementById("toggle-password");
	const newPassword = document.getElementById("pass");
	togglePassword.addEventListener("click", function () {
		// Toggle the type attribute
		const type = newPassword.getAttribute("type") === "password" ? "text" : "password";
		newPassword.setAttribute("type", type);
		// Toggle the eye icon
		this.querySelector("i").classList.toggle("ti-eye");
		this.querySelector("i").classList.toggle("ti-eye-check");
	});

	// Toggle visibility for confirm password
	const togglePasswordConfirm = document.getElementById("toggle-password-confirm");
	const confirmPassword = document.getElementById("pass_confirmation");
	togglePasswordConfirm.addEventListener("click", function () {
		// Toggle the type attribute
		const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
		confirmPassword.setAttribute("type", type);
		// Toggle the eye icon
		this.querySelector("i").classList.toggle("ti-eye");
		this.querySelector("i").classList.toggle("ti-eye-check");
	});

	// Validate password and confirmation on keyup
	document.getElementById('pass').addEventListener('keyup', validatePasswordMatch);
	document.getElementById('pass_confirmation').addEventListener('keyup', validatePasswordMatch);

	function validatePasswordMatch() {
		const password = document.getElementById('pass').value;
		const confirmPassword = document.getElementById('pass_confirmation').value;
		const feedback = document.getElementById('password-feedback');

		if (password !== confirmPassword) {
			feedback.textContent = "Passwords do not match!";
			feedback.style.color = "red";
		} else {
			feedback.textContent = "Passwords match.";
			feedback.style.color = "green";
		}
	}
	
/*
|--------------------------------------------------------------------------
| End
|--------------------------------------------------------------------------
*/