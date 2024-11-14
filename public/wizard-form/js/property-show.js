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
		
			
			$( "#section-1 .help-block.with-errors" ).html( '' );
			$( "#section-1" ).removeClass( "open" );
			$( "#section-1" ).addClass( "slide-left" );
			$( "#section-2" ).removeClass( "slide-right" );	
			$( "#section-2" ).addClass( "open" );
		
	}
	function previousStep1() {
		$( "#section-1" ).removeClass( "slide-left" );
		$( "#section-1" ).addClass( "open" );
		$( "#section-2" ).removeClass( "open" );
		$( "#section-2" ).addClass( "slide-right" );
	}
	
	//checking validation before going to step 3
	function nextStep3() {
	
			$( "#section-2 .help-block.with-errors.mandatory-error" ).html( '' );
			$( "#section-2" ).removeClass( "open" );
			$( "#section-2" ).addClass( "slide-left" );
			$( "#section-3" ).removeClass( "slide-right" );
			$( "#section-3" ).addClass( "open" );
		
	}
	function previousStep2() {
		$( "#section-2" ).removeClass( "slide-left" );
		$( "#section-2" ).addClass( "open" );
		$( "#section-3" ).removeClass( "open" );
		$( "#section-3" ).addClass( "slide-right" );
	}	
	
	//checking validation before going to final step and writing/showing inputed data for confirmation	
	function nextStep4() {
		
			$( "#section-3 .help-block.with-errors.mandatory-error" ).html( '' );
			$( "#section-3" ).removeClass( "open" );
			$( "#section-3" ).addClass( "slide-left" );
			$( "#section-4" ).removeClass( "slide-right" );
	}	
	function previousStep3() {
		$( "#section-3" ).removeClass( "slide-left" );
		$( "#section-3" ).addClass( "open" );
		$( "#section-4" ).removeClass( "open" );
		$( "#section-4" ).addClass( "slide-right" );
	}

	function nextStep5() {
		
				$( "#section-4 .help-block.with-errors.mandatory-error" ).html( '' );
				$( "#section-4" ).removeClass( "open" );
				$( "#section-4" ).addClass( "slide-left" );
				$( "#section-5" ).removeClass( "slide-right" );
				$( "#section-5" ).addClass( "open" );
		
	}

	function previousStep4() {
		$( "#section-4" ).removeClass( "slide-left" );
		$( "#section-4" ).addClass( "open" );
		$( "#section-5" ).removeClass( "open" );
		$( "#section-5" ).addClass( "slide-right" );
	}


	function nextStep6() {

		
				$( "#section-5 .help-block.with-errors.mandatory-error" ).html( '' );
				$( "#section-5" ).removeClass( "open" );
				$( "#section-5" ).addClass( "slide-left" );
				$( "#section-6" ).removeClass( "slide-right" );
				$( "#section-6" ).addClass( "open" );
			
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