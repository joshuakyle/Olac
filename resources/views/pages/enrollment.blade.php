@extends('layouts.app')
@section('bgcolor')
bgcolor
@endsection
@section('content')
<div class="container">
	<div class="fixed-action-btn">
	<a  class="btn-floating waves-light btn-large blue btn" href="{{url('/index')}}">
	    <i class="large material-icons">home</i>
	  </a>
	</div>
	<div class="col s8 offset-s2">
		<div class="container">
			<div class="form-bg">
				<div class="row">
					<div class="col s6">
						<div class="card-panel">
							<hr/>
							@csrf
							<div id="page-1">
								<form id="form-1" method="POST" action="">
									<h5> Parent/Guardian Details</h5>
									<hr/>
									<div class="row">
										<div class="input-field col s12">
											<input id="guardian_name" name="guardian_name" type="text" required>
											<label for="guardian_name">Full name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input name="relation" type="text" required>
											<label for="relation">Relation</label>
										</div>
										<div class="input-field col s6">
											<input name="occupation" type="text" required>
											<label for="occupation">Occupation</label>
										</div>
										<div class="input-field col s6">
											<input name="guardian_number" type="number" required>
											<label for="guardian_number">Contact Number</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input id="email" name="email" type="email" required>
											<label for="email">Email</label>
										</div>
										<div class="input-field col s6">
											<input id="confirm_email" name="confirm_email" type="email" required>
											<label for="confirm_email">Confirm Email</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field right-align col s12">
											<button id="next-1" data-current="1" type="submit" class="btn waves-effect waves-light blue darken-1" >Next</button>
										</div>
									</div>
								</form>
							</div>
							<div id="page-2">
								<h5>Student Details</h5>
								<hr/>
								<form id="form-2" method="POST" action="">
									<div class="row">
										<div class="input-field col s4">
											<input id="last_name" name="last_name" type="text" required>
											<label for="last_name">Last Name</label>
										</div>
										<div class="input-field col s4">
											<input id="first_name" name="first_name" type="text" required>
											<label for="first_name">First Name</label>
										</div>
										<div class="input-field col s4">
											<input id="middle_name" name="middle_name" type="text" required>
											<label for="middle_name">Middle Name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s3">
											<input id="birth_place" name="birth_place" type="text" required>
											<label for="birth_place">Address</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s3">
											<input id="birthdate" name="birthdate" class="datepicker" type="text" required>
											<label for="birthdate">Birthdate</label>
										</div>
										
										<div class="input-field col s3">
											<select id="gender" name="gender" required>
												<option value="" selected>Choose your option</option>
												<option value="1">Male</option>
												<option value="2">Female</option>
											</select>
											<label for="gender">Gender</label>
										</div>
										<div class="input-field col s3">
											<input id="religion" name="religion" type="text">
											<label for="religion">Religion</label>
										</div>
									</div>
									<hr/>
									<h6>Previous School Details</h6>
									<input id="old_student" name="old_student" type="checkbox">
									<label for="old_student">Old Student</label>
									<hr/>
									<div class="row">
										<div class="input-field col s4">
											<input id="school_name" name="school_name" type="text" required>
											<label for="school_name">School Name</label>
										</div>							   
									</div>
									<div class="row">
										<div class="input-field col s4">
											<input id="school_address" name="school_address" type="text" required>
											<label for="school_address">Address</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s4">
											<select id="gradelevel" name="grade/level" required>
												<option value="" selected>Choose your option</option>
												<option value="0">Grade 6</option>
												<option value="1">First Year</option>
												<option value="2">Second Year</option>
												<option value="3">Third Year</option>
											</select>
											<label for="gradelevel">Grade/Level</label>
										</div>
										<div class="input-field col s4">
											<input id="school_year" name="school_year" placeholder="0000-0000" type="text" required>
											<label for="school_year">SY</label>
										</div>
									</div>
									<hr/>
									<h6>Parents Details</h6>
									<hr/>
									<div class="row">
										<div class="input-field col s6">
											<input id="father_name" name="father_name" type="text" required>
											<label for="father_name">Father's name</label>
										</div>
										<div class="input-field col s6">
											<input id="mother_name" name="mother_name" type="text" required>
											<label for="mother_name">Mother's name</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input id="father_occupation" name="father_occupation" type="text">
											<label for="father_occupation">Father's Occupation</label>
										</div>
										<div class="input-field col s6">
											<input id="mother_occupation" name="mother_occupation" type="text">
											<label for="mother_occupation">Mother's Occupation</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field col s6">
											<input id="father_contact_number" name="father_contact_number" type="number">
											<label for="father_contact_number">Father's Contact Number</label>
										</div>
										<div class="input-field col s6">
											<input id="mother_contact_number" name="mother_contact_number" type="number">
											<label for="mother_contact_number">Mother's Contact Number</label>
										</div>
									</div>
									<div class="row">
										<div class="input-field left-align col s6">
											<button id="back-2" data-current="2" type="button" class="btn waves-effect waves-light blue darken-1" >Back</button>
										</div>
										<div class="input-field right-align col s6">
											<button id="next-2" data-current="2" type="submit" class="btn waves-effect waves-light blue darken-1" >Next</button>
										</div>
									</div>
								</form>
							</div>
							<div id="page-3">
								<form id="form-3" method="POST" action="">
									<h6>Payment Details</h6>
									<hr/>
									<div class="row">
										<div class="input-field col s4">
											<select id="mode" name="mode">
												<option value="" disabled selected>Choose your option</option>
												<option value="1">Cash</option>
												<option value="2">Monthly Payment</option>
											</select>
											<label >Mode of payment</label>
										</div>
									</div>
									<div class="row">
										<div style="margin:auto; width: 54%;">
											<table>
												<thead>
													<tr>
														<td>Payment</td>
														<td>Amount</td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>Cash/Total Payment</td>
														<td>P{{ peso($payment->full_amount) }}</td>
													</tr>
													<tr>
														<td>Down Payment</td>
														<td>P{{ peso($payment->down_payment) }}</td>
													</tr>
													<tr>
														<td>Monthly Payment</td>
														<td>P{{ peso($payment->monthly_payment) }}</td>
													</tr>
													<tr>
														<td>Tuition Fee</td>
														<td>P{{ peso($payment->tuition_fee) }}</td>
													</tr>
													<tr>
														<td>Energy Fee</td>
														<td>P{{ peso($payment->energy_fee) }}</td>
													</tr>
													<tr>
														<td>Internet Fee</td>
														<td>P{{ peso($payment->internet_lab) }}</td>
													</tr>
													<tr>
														<td>Speech Lab Fee</td>
														<td>P{{ peso($payment->speech_lab) }}</td>
													</tr>

												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="input-field left-align col s6">
											<button id="back-3" data-current="3" type="button" class="btn waves-effect waves-light blue darken-1" >Back</button>
										</div>
										<div class="input-field right-align col s6">
											<button id="next-3" data-current="3" type="submit" class="btn waves-effect waves-light blue darken-1" >Next</button>
										</div>
									</div>
								</form>
							</div>
							<div id="page-4" class="welcome">
								<div class="center-align">
								<h4>Thank you!</h4>
								<label style="color:red">Please be informed that we will send an email to your guardian email address within a day (working day). 
								For the registration form and Payment Url (for online payment). Thank you.</label>
								</div>
								<hr/>
								<div style="padding: 10px 20px;">
								<h5>School Reminders</h5>
								<p>a) Monthly Payments are due every first week of the month.</p>
								<p>b) Observe silence during class hour and lectures.</p>
								<p>c) Waste materials should be thrown in the waste can.</p>
								<p>d) Students should obeser cleanliness and orderliness and should not write anythin on the walls, chairs or other schoor properties.</p>
								<p>e) Student should always wear proper school uniform and ID.</p>
								<p>f) If you have any concern regarding your child, please visit and confer with the principal.</p>
								</div>
								<hr/>

								<div class="row">
									<div class="col s4 offset-s4">
										<form method="get" action="{{url('/index')}}">
											<button class="btn waves-effect waves-light blue darken-1" >Go back to Main Page.</button>
										</form>
									</div>
								</div>
							</div>

							<div id="page-5">
								<div class="row">
									<div style="text-align: center;padding: 50px;">
									<h4> We are sorry to say, That we already met the total of enrollees for <span class="year_level" style="color:red"></span> this year.</h4>
									<br/>
									<div class="center-align">
										<form method="get" action="{{url('/index')}}">
											<button class="btn waves-effect waves-light blue darken-1" >Go back to Main Page.</button>
										</form>
									</div>
									</div>
								</div>
								<hr/>
							</div>
							<div class="row">
								<div id="progress-id" class="col s8 card-panel offset-s4">
									<div class="progress-div">
										<p class="col s10 title">Guardian Details</p>
										<p class="col s2 right-align step">1/3</p>
									</div>
									<div class="progress">
										<div class="determinate" style="width: 30%"></div>
									</div>
								</div>
								<div class="col s2 ">
								</div>
							</div>
						</div>
					</div>
				</div>			
			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('customjs')
<script type="text/javascript">
	$('#page-2').hide();
	$('#page-3').hide();
	$('#page-4').hide();
	$('#page-5').hide();
	$(function(){
		$('#school_year').mask('0000-0000');
		$("#form-1").submit(function(e){
			showPage(2,1);
			return false;
		});

		$("#form-2").submit(function(e){
			showPage(3,2);
			return false;
		});

		$("#form-3").submit(function(e){
			sendRequest();
			return false;
		});

		$('#back-2').click(function(){
			showPage(1,2);
		});

		$('#back-3').click(function(){
			showPage(2,3);
		});

		function showPage(num,current){
			$('#page-'+current).hide(1000);
			$('#page-'+num).show(1000);
			getPercentage(num);
		}

		function getPercentage(val){
			var determinate = $('.determinate'),
			step = $('.step'),
			title = $('.title');

			if(val == 1){
				determinate.css("width","30%");
				step.text('1/3');
				title.text('Guardian Details');
				$('#next').text('Next');
			}else if(val == 2){
				determinate.css("width","75%");
				step.text('2/3');
				title.text('Student Details');
				$('#next').text('Next');
			}else if(val == 3){
				determinate.css("width","100%");
				step.text('3/3');
				title.text('Payment Details');
				$('#next').text('Submit');
			}
		}

		var email = $("#email")
		, confirm_email = $("#confirm_email");

		function validateEmail(){
			if(email.val() != confirm_email.val()) {
				document.getElementById("confirm_email").setCustomValidity("Email doesn't match!");
			}else{
				document.getElementById("confirm_email").setCustomValidity("");
			}
		}

		$('#email').on('keyup',function(){
			validateEmail();
		});

		$('#confirm_email').on('keyup',function(){
			validateEmail();
		});

		$('#old_student').change(function(){
	        if(this.checked){
	            $('#school_name').attr('disabled',true);
	            $('#school_address').attr('disabled',true);
	            $('#gradelevel').attr('disabled',true);
	            $('#school_year').attr('disabled',true);
	        }else{
	            $('#school_name').attr('disabled',false);
	            $('#school_address').attr('disabled',false);
	            $('#gradelevel').attr('disabled',false);
	            $('#school_year').attr('disabled',false);
	         }

    	});

		function sendRequest() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			var page1 = $('#form-1').serialize(),
			page2 = $('#form-2').serialize(),
			page3 =$('#form-3').serialize();
			var formData = page1+'&'+page2+'&'+page3;
			$.ajax({
			type: "POST",
				url: "{{ url('/addstudent') }}",
				data: formData,
				success: function (data) {
					if(data.status == 1){
						$('#page-3').hide(1000);
						$('#page-4').show(1000);
						$('#progress-id').hide();
					}else if(data.status == 2){
						$('#page-3').hide(1000);
						$('.year_level').text(data.year);
						$('#page-5').show(1000);
						$('#progress-id').hide();
					}else if(data.status == 3){
						$('#page-3').hide(1000);
						$('#page-2').show(1000);
						$('#progress-id').hide();
						window.Materialize.toast(data.message,7000);
					}
				},
				error: function (data) {
					console.log('Error:', data);
				}
			});
		}
	});
</script>
@endsection