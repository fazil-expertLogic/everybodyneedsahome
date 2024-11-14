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
		var name = $("#name").val();
		var email = $("#email").val();
		var pass = $("#pass").val();
		var cpass = $("#cpass").val();
		var validemail = isEmail(email);
		var role = $("#role").val();
		
		if( name )
			$( ".valid_use_name .help-block.with-errors" ).html( '' );
		else
			$( ".valid_use_name .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter UserName</li></ul>' );
		
		if( validemail )
			$( ".valid_use_email .help-block.with-errors" ).html( '' );
		else	
			$( ".valid_use_email .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please enter valid email</li></ul>' );
		
		if(  pass.length < 6 )
			$( ".valid_use_pass .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Password should at least 6 character</li></ul>' );
		else if(  pass != cpass ) {
			$( ".valid_use_pass .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Password and Confirm Password do not match</li></ul>' );
			sweetAlert("Oops...", "Password and Confirm Password do not match!!!", "error");return false;
		}
		else
			$( ".valid_use_pass .help-block.with-errors" ).html( '' );
		

		if( role )
			$( ".valid_use_role .help-block.with-errors" ).html( '' );
		else
			$( ".valid_use_role .help-block.with-errors" ).html( '<ul class="list-unstyled"><li>Please select role</li></ul>' );

		if( name && validemail && pass.length > 5 && pass == cpass ) {
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


	var stripe, elements, card;

	function initializeStripe() {
		console.log("Initializing Stripe...");
		if (!stripe) {
			stripe = Stripe('pk_test_51QK09gFvlUHXvmXR6KStptAv1Gs6hGaZ55eVnUGIJB49rXQxiq2Y9AU4j1xHAONGfLnS1lgfyhfFzEN55kjDfOnI00Kedj8TAE'); // Ensure publishable key is correctly fetched from the environment
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
	
			card = elements.create('card', { style: style });
			card.mount('#card-element');
			card.on('change', function (event) {
				const displayError = document.getElementById('card-errors');
				displayError.textContent = event.error ? event.error.message : '';
				console.log("Card change event:", event);
			});
		}
	}
	
	$(document).ready(function () {
		initializeStripe();
	
		$('#signUpForm').submit(function (event) {
			event.preventDefault(); // Prevent default form submission
			console.log('Form submission started.');
	
			if (card) {
				// Use Stripe.js to create a token
				stripe.createToken(card).then(function (result) {
					if (result.error) {
						// Handle any errors from Stripe.js
						const errorElement = document.getElementById('card-errors');
						errorElement.textContent = result.error.message;
						console.log("Stripe token creation error:", result.error.message);
					} else {
						console.log("Stripe token created successfully:", result.token);
	
						// Token created, append it to the form
						const form = document.getElementById('signUpForm');
						const hiddenInput = document.createElement('input');
						hiddenInput.setAttribute('type', 'hidden');
						hiddenInput.setAttribute('name', 'stripeToken');
						hiddenInput.setAttribute('value', result.token.id);
						form.appendChild(hiddenInput);
	
						// Append card details
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
						console.log("Submitting the form with Stripe token.");
						form.submit();
					}
				});
			} else {
				console.log("Card element not initialized.");
			}
		});
	});
	
	
/*
|--------------------------------------------------------------------------
| End
|--------------------------------------------------------------------------
*/