/*
|--------------------------------------------------------------------------
| Imminent Template Main JS
|--------------------------------------------------------------------------
*/
document.addEventListener("touchstart", function () { }, false);
(function ($) {
	"use strict";

	/*
	|--------------------------------------------------------------------------
		Print Current Year in html footer copyright
	|--------------------------------------------------------------------------
	*/
	$('span#mgsYear').html(new Date().getFullYear());

	/*
	|--------------------------------------------------------------------------
	| Math Captcha for all Form
	|--------------------------------------------------------------------------
	*/
	$(function () {

		var randNumber_1 = parseInt(Math.ceil(Math.random() * 15), 10);
		var randNumber_2 = parseInt(Math.ceil(Math.random() * 15), 10);
		humanCheckCaptcha(randNumber_1, randNumber_2);

	});
	function humanCheckCaptcha(randNumber_1, randNumber_2) {
		$("#humanCheckCaptchaBox").html("Solve The Math ");
		$("#firstDigit").html('<input name="mathfirstnum" id="mathfirstnum" class="form-control" type="text" value="' + randNumber_1 + '" readonly>');
		$("#secondDigit").html('<input name="mathsecondnum" id="mathsecondnum" class="form-control" type="text" value="' + randNumber_2 + '" readonly>');
	}

	/*
	|--------------------------------------------------------------------------
	| Bootstrap Datepicker
	|--------------------------------------------------------------------------
	*/
	$(function () {

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

			$(this).find(":input[required]").each(function () {
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

	function submitForm() {

		//process your form here.
		$("#mgsFormSubmit").html('');
		$("#final-step-buttons").html('<div class="h3 text-center text-success"> You have finished all steps of this html form successfully </div>');
		swal("Success!", "You have finished all steps successfully!", "success");

	}

	//attachment Photo
	$(function () {

		$(document).on('change', ':file', function () {
			var input = $(this),
				numFiles = input.get(0).files ? input.get(0).files.length : 1,
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
			input.trigger('fileselect', [numFiles, label]);
		});

		$(':file').on('fileselect', function (event, numFiles, label) {

			var input = $(this).parents('.form-group').find(':text'),
				log = numFiles > 1 ? numFiles + ' files selected' : label;

			if (input.length) {
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
	$("#userfile").on('change', function () {
		readURL(this);
	});

	function formSuccess() {
		$("#signUpForm")[0].reset();
		submitMSG(true, "Registration Process Successfully!")
	}

	function formError() {
		$(".help-block.with-errors").removeClass('hidden');
	}

	function submitMSG(valid, msg) {
		if (valid) {
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
$(function () {
	$("#signUpForm").on('focus', ':input', function () {
		$(this).attr('autocomplete', 'off');
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
	var validemail = isEmail(email);
	var pass = $("#pass").val();
	var cpass = $("#pass_confirmation").val();
	var ssn = $("#ssn").val();
	var dob = $("#dob").val();
	var is_edit = $("#is_edit").val();
	console.log(is_edit);

	if (name)
		$(".valid_name .help-block.with-errors").html('');
	else
		$(".valid_name .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter name</li></ul>');

	if (validemail)
		$(".valid_email .help-block.with-errors").html('');
	else
		$(".valid_email .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter valid email</li></ul>');

	if (pass != cpass && is_edit == 0) {
		console.log(pass == cpass);
		$(".validpass .help-block.with-errors").html('<ul class="list-unstyled"><li>Password and Confirm Password do not match</li></ul>');
		sweetAlert("Oops...", "Password and Confirm Password do not match!!!", "error");
		return false;
	}
	else
		$(".validpass .help-block.with-errors").html('');

	if (ssn)
		$(".valid_ssn .help-block.with-errors").html('');
	else
		$(".valid_ssn .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter social security number</li></ul>');

	if (dob)
		$(".valid_dob .help-block.with-errors").html('');
	else
		$(".valid_dob .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter date of birth</li></ul>');

	if (is_edit == 1) {
		if (name && validemail && ssn && dob) {
			$("#section-1 .help-block.with-errors").html('');
			$("#section-1").removeClass("open");
			$("#section-1").addClass("slide-left");
			$("#section-2").removeClass("slide-right");
			$("#section-2").addClass("open");
		}
		else {
			$("#section-1 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
			sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
		}
	} else {
		if (name && validemail && pass && ssn && dob) {
			$("#section-1 .help-block.with-errors").html('');
			$("#section-1").removeClass("open");
			$("#section-1").addClass("slide-left");
			$("#section-2").removeClass("slide-right");
			$("#section-2").addClass("open");
		}
		else {
			$("#section-1 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
			sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
		}
	}
}
function previousStep1() {
	$("#section-1").removeClass("slide-left");
	$("#section-1").addClass("open");
	$("#section-2").removeClass("open");
	$("#section-2").addClass("slide-right");
}

//checking validation before going to step 3
function nextStep3() {
	var address = $("#address").val();
	var address2 = $("#address2").val();
	var city = $("#city").val();
	var state = $("#state").val();
	var zip_code = $("#zip_code").val();
	var phone = $("#phone").val();

	if (address)
		$(".valid_address .help-block.with-errors").html('');
	else
		$(".valid_address .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter address</li></ul>');

	if (address2)
		$(".valid_address2 .help-block.with-errors").html('');
	else
		$(".valid_address2 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter address</li></ul>');

	if (city)
		$(".valid_city .help-block.with-errors").html('');
	else
		$(".valid_city .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter city</li></ul>');

	if (state)
		$(".valid_state .help-block.with-errors").html('');
	else
		$(".valid_state .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter state</li></ul>');

	if (zip_code)
		$(".valid_zip_code .help-block.with-errors").html('');
	else
		$(".valid_zip_code .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter zip code</li></ul>');

	if (phone)
		$(".valid_phone .help-block.with-errors").html('');
	else
		$(".valid_phone .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter date of conviction</li></ul>');

	if (address && address2 && city && state && zip_code && phone) {
		$("#section-2 .help-block.with-errors.mandatory-error").html('');
		$("#section-2").removeClass("open");
		$("#section-2").addClass("slide-left");
		$("#section-3").removeClass("slide-right");
		$("#section-3").addClass("open");
	}
	else {
		$("#section-2 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
		sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
	}
}
function previousStep2() {
	$("#section-2").removeClass("slide-left");
	$("#section-2").addClass("open");
	$("#section-3").removeClass("open");
	$("#section-3").addClass("slide-right");
}

//checking validation before going to final step and writing/showing inputed data for confirmation	
function nextStep4() {

	var evicted = $("#evicted").val();
	var convicted = $("#convicted").val();

	if (evicted)
		$(".valid_evicted .help-block.with-errors").html('');
	else
		$(".valid_evicted .help-block.with-errors").html('<ul class="list-unstyled"><li>Please select</li></ul>');

	if (convicted)
		$(".valid_convicted .help-block.with-errors").html('');
	else
		$(".valid_convicted .help-block.with-errors").html('<ul class="list-unstyled"><li>Please select</li></ul>');

	if (evicted && convicted) {
		$("#section-3 .help-block.with-errors.mandatory-error").html('');
		$("#section-3").removeClass("open");
		$("#section-3").addClass("slide-left");
		$("#section-4").removeClass("slide-right");
		$("#section-4").addClass("open");
	}
	else {
		$("#section-3 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
		sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
	}

}
function previousStep3() {
	$("#section-3").removeClass("slide-left");
	$("#section-3").addClass("open");
	$("#section-4").removeClass("open");
	$("#section-4").addClass("slide-right");
}

function nextStep5() {

	var ref1_name = $("#ref1_name").val();
	var ref1_phone = $("#ref1_phone").val();
	var ref1_email = $("#ref1_email").val();

	var ref2_name = $("#ref2_name").val();
	var ref2_phone = $("#ref2_phone").val();
	var ref2_email = $("#ref2_email").val();

	var ref3_name = $("#ref3_name").val();
	var ref3_phone = $("#ref3_phone").val();
	var ref3_email = $("#ref3_email").val();

	var emergency_contact_name = $("#emergency_contact_name").val();
	var emergency_contact_phone = $("#emergency_contact_phone").val();
	var emergency_contact_email = $("#emergency_contact_email").val();



	if (ref1_name)
		$(".valid_ref1_name .help-block.with-errors").html('');
	else
		$(".valid_ref1_name .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 1 - Name</li></ul>');

	if (ref1_phone)
		$(".valid_ref1_phone .help-block.with-errors").html('');
	else
		$(".valid_ref1_phone .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 1 - Phone</li></ul>');

	if (ref1_email)
		$(".valid_ref1_email .help-block.with-errors").html('');
	else
		$(".valid_ref1_email .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 1 - email</li></ul>');


	if (ref2_name)
		$(".valid_ref2_name .help-block.with-errors").html('');
	else
		$(".valid_ref2_name .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 2 - Name</li></ul>');

	if (ref2_phone)
		$(".valid_ref2_phone .help-block.with-errors").html('');
	else
		$(".valid_ref2_phone .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 2 - Phone</li></ul>');

	if (ref2_email)
		$(".valid_ref2_email .help-block.with-errors").html('');
	else
		$(".valid_ref2_email .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 2 - email</li></ul>');

	if (ref3_name)
		$(".valid_ref3_name .help-block.with-errors").html('');
	else
		$(".valid_ref3_name .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 3 - Name</li></ul>');

	if (ref3_phone)
		$(".valid_ref3_phone .help-block.with-errors").html('');
	else
		$(".valid_ref3_phone .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 3 - Phone</li></ul>');

	if (ref3_email)
		$(".valid_ref3_email .help-block.with-errors").html('');
	else
		$(".valid_ref3_email .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Reference 3 - email</li></ul>');

	if (emergency_contact_name)
		$(".valid_emergency_contact_name .help-block.with-errors").html('');
	else
		$(".valid_emergency_contact_name .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Emergency Contact Name</li></ul>');

	if (emergency_contact_phone)
		$(".valid_emergency_contact_phone .help-block.with-errors").html('');
	else
		$(".valid_emergency_contact_phone .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Emergency Contact Phone</li></ul>');

	if (emergency_contact_email)
		$(".valid_emergency_contact_email .help-block.with-errors").html('');
	else
		$(".valid_emergency_contact_email .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Emergency Contact Email</li></ul>');

	if (ref1_name && ref1_phone && ref1_email && ref2_name && ref2_phone && ref2_email && ref3_name && ref3_phone && ref3_email && emergency_contact_name && emergency_contact_phone && emergency_contact_email) {
		$("#section-4 .help-block.with-errors.mandatory-error").html('');
		$("#section-4").removeClass("open");
		$("#section-4").addClass("slide-left");
		$("#section-5").removeClass("slide-right");
		$("#section-5").addClass("open");
	}
	else {
		$("#section-4 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
		sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
	}
}

function previousStep4() {
	$("#section-4").removeClass("slide-left");
	$("#section-4").addClass("open");
	$("#section-5").removeClass("open");
	$("#section-5").addClass("slide-right");
}


function nextStep6() {

	var employer_name = $('#employer_name').val();
	var employer_phone = $('#employer_phone').val();
	var income = $('#income').val();
	var expenses = $('#expenses').val();
	var rental_budget = $('#rental_budget').val();


	if (employer_name)
		$(".valid_employer_name .help-block.with-errors").html('');
	else
		$(".valid_employer_name .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Enter Employer Name</li></ul>');

	if (employer_phone)
		$(".valid_employer_phone .help-block.with-errors").html('');
	else
		$(".valid_employer_phone .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Enter Employer Phone</li></ul>');

	if (income)
		$(".valid_income .help-block.with-errors").html('');
	else
		$(".valid_income .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Enter Income</li></ul>');

	if (expenses)
		$(".valid_expenses .help-block.with-errors").html('');
	else
		$(".valid_expenses .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter group no</li></ul>');

	if (rental_budget)
		$(".valid_rental_budget .help-block.with-errors").html('');
	else
		$(".valid_rental_budget .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter group no</li></ul>');

	if (employer_name && employer_phone && income && expenses && rental_budget) {
		$("#section-5 .help-block.with-errors.mandatory-error").html('');
		$("#section-5").removeClass("open");
		$("#section-5").addClass("slide-left");
		$("#section-6").removeClass("slide-right");
		$("#section-6").addClass("open");
	}
	else {
		$("#section-5 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
		sweetAlert("Oops...", "Please Fill the Form Properly!", "error");
	}


}
function evictedDiv() {
	var selectedValue = $('#evicted').val();
	if (selectedValue === '1') {
		$('#evictedDiv').show();
	} else if (selectedValue === '2') {
		$('#evictedDiv').hide();
	}
}
function convictedDiv() {
	var selectedValue = $('#convicted').val();
	if (selectedValue === '1') {
		$('#convictedDiv').show();
	} else if (selectedValue === '2') {
		$('#convictedDiv').hide();
	}
}
function sexOffenderDiv() {
	var selectedValue = $('#sex_offender').val();
	if (selectedValue === '1') {
		$('#sexOffenderDiv').show();
	} else if (selectedValue === '2') {
		$('#sexOffenderDiv').hide();
	}
}

function probationDiv() {
	var selectedValue = $('#probation').val();
	if (selectedValue === '1') {
		$('#probationDiv').show();
	} else if (selectedValue === '2') {
		$('#probationDiv').hide();
	}
}
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


	//---------------------------  ssn -----------------------------------------------------------
	const ssnInput = document.getElementById('ssn');

	ssnInput.addEventListener('input', function (e) {
		let value = e.target.value.replace(/\D/g, ''); // Remove all non-digit characters
		let formattedValue = '';

		// Format as XXX-XX-XXXX
		if (value.length > 0) {
			formattedValue += value.substring(0, 3);
		}
		if (value.length > 3) {
			formattedValue += '-' + value.substring(3, 5);
		}
		if (value.length > 5) {
			formattedValue += '-' + value.substring(5, 9);
		}

		e.target.value = formattedValue;
	});

	ssnInput.addEventListener('keydown', function (e) {
		// Allow only numeric keys, backspace, delete, left arrow, right arrow
		const allowedKeys = [8, 46, 37, 39];
		const isNumericKey = (e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 96 && e.keyCode <= 105);

		if (!isNumericKey && !allowedKeys.includes(e.keyCode)) {
			e.preventDefault();
		}
	});
	// ------------------ phone ----------------------------
	const evictionPhoneInput = document.getElementById('eviction_phone');
	evictionPhoneInput.addEventListener('input', function (e) {
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

	evictionPhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});

	// ------------------ phone ----------------------------
	const probationOfficerPhoneInput = document.getElementById('probation_officer_phone');
	probationOfficerPhoneInput.addEventListener('input', function (e) {
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

	probationOfficerPhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});

	// ------------------ phone ----------------------------
	const ref1PhoneInput = document.getElementById('ref1_phone');
	ref1PhoneInput.addEventListener('input', function (e) {
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

	ref1PhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});

	// ------------------ phone ----------------------------
	const ref2PhoneInput = document.getElementById('ref2_phone');
	ref2PhoneInput.addEventListener('input', function (e) {
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

	ref2PhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});

	// ------------------ phone ----------------------------
	const ref3PhoneInput = document.getElementById('ref3_phone');
	ref3PhoneInput.addEventListener('input', function (e) {
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

	ref3PhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});
	// ---------------------------- Zip Code ----------------------------
	const zipInput = document.getElementById('zipcode');

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
	// ------------------ phone ----------------------------
	const emergencyContactPhoneInput = document.getElementById('emergency_contact_phone');
	emergencyContactPhoneInput.addEventListener('input', function (e) {
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

	emergencyContactPhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});

	// ------------------ phone ----------------------------
	const employerPhoneInput = document.getElementById('employer_phone');
	employerPhoneInput.addEventListener('input', function (e) {
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

	employerPhoneInput.addEventListener('keydown', function (e) {
		if ((e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105) && e.keyCode !== 8 && e.keyCode !== 46 && e.keyCode !== 37 && e.keyCode !== 39) {
			e.preventDefault();
		}
	});

});
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