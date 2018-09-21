<!DOCTYPE html>
<html>
<head>
	<title>{{ config('app.name', 'OLAC|Web site') }}</title>

	<style type="text/css">
		table, td ,tr{
			border: 1px black solid;
			border-collapse: collapse;

		}
		.name{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="body">
		<div class="header">
			<div class="logo"><img src="{{base_path('public/img/olac-logo.jpg')}}" width="150px" height="100px;" style="margin-left: 40%;"></div>
			<div class="logoname"><h5 style="color: #021ab2; margin-left: 30%;">OUR LADY OF ASSUMPTION COLLEGE TANAUAN</h5></div>
			<table style="margin-top: 20px; width: 100%;">
				<tr>
					<td colspan="2">Student No.: {{ generateStudentNumber($student->old_year_level+1,$student->id) }}</td>
					<td colspan="3" style="text-align: center;">School Year: {{ getSchoolYear() }}</td>
				</tr>
				<tr>
					<td colspan="3">Grade/Level: {{ getYearText($student->old_year_level+1) }}</td>
					<td colspan="1" style=" text-align: right;"><input type="checkbox" {{ $student->old_school_name == 'Our Lady of Assumption College' ? '' : 'checked' }}> New Student</td>
					<td colspan="1" style="text-align: right;"><input type="checkbox" {{ $student->old_school_name == 'Our Lady of Assumption College' ? 'checked' : ''  }}> Old Student</td>
				</tr>
			</table>
			<table style="width: 100%;">
				<tr>
					<td colspan="2">Full Name:</td>
					<td colspan=""> {{ $student->last_name }} </td>
					<td colspan=""> {{ $student->first_name }} </td>
					<td colspan=""> {{ $student->middle_name }} </td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td class="name">(Last Name)</td>
					<td class="name">(First Name)</td>
					<td class="name">(Middle Name)</td>
				</tr>
				<tr>
					<td><input type="checkbox" {{ $student->gender == 1 ? 'checked' : '' }}> Male</td>
					<td><input type="checkbox" {{ $student->gender == 2 ? 'checked' : '' }}> Female</td>
					<td colspan="3">Religion: {{ $student->religion }}</td>
				</tr>
				<tr>
					<td colspan="3">Birth Place: {{ $student->address }}</td>
					<td colspan="2">Birthdate: {{ $student->birthdate }}</td>
				</tr>
				<tr>
					<td colspan="4">Home Address: {{ $student->address }}</td>
					<td colspan="1">Tel No.: {{ $student->guardian_number }}</td>
				</tr>
				<tr>
					<td colspan="4">Name Of Guardian: {{ $student->guardian_name }}</td>
					<td colspan="1">Relation: {{ $student->guardian_relation }}</td>
				</tr>
				<tr>
					<td colspan="3">Parent Father: {{ $student->father()->parent_name }}</td>
					<td colspan="2">Occupation: {{ $student->father()->occupation }}</td>
				</tr>
				<tr>
					<td colspan="3">Parent Mother: {{ $student->mother()->parent_name }}</td>
					<td colspan="2">Occupation: {{ $student->mother()->occupation }}</td>
				</tr>
				<tr>
					<td colspan="3">Previous School: {{ $student->old_school_name }}</td>
					<td>Grade/Level: {{ getYearText($student->old_year_level) }}</td>
					<td>SY:{{ $student->old_school_year }}</td>
				</tr>
				<tr>
					<td colspan="5">School Address: {{ $student->school_address }}</td>
				</tr>
			</table>
			<table style="width: 100%">
				<tr>
					<th colspan="2">Assessment</th>
				</tr>
				<tr>
					<td>Mode of Payment:</td>
					<td>{{ $student->payment == 1 ? 'Cash' : 'Installment' }}</td>
				</tr>
				<tr>
					<td>Tuition Fee:</td>
					<td>{{ $payment->tuition_fee }}</td>
				</tr>
				<tr>
					<td>Upon Enrollment</td>
					<td>{{ $payment->down_payment }}</td>
				</tr>
				<tr>
					<td>Monthly Fee</td>
					<td>{{ $payment->monthly_payment }}</td>
				</tr>
				<tr>
					<td>Energy Fee</td>
					<td>{{ $payment->energy_fee }}</td>
				</tr>
				<tr>
					<td>Internet Lab</td>
					<td>{{ $payment->internet_lab }}</td>
				</tr>
				<tr>
					<td>Speech Lab</td>
					<td>{{ $payment->speech_lab }}</td>
				</tr>
				<tr>
					<td>Books:</td>
					<?php $book = $payment->book; ?>
					<td>{{ $book[$student->old_year_level+1] }}</td>
				</tr>
				<tr></tr>
			</table>
			<table style="width: 100%">
				<tr>
					<th colspan="5">Payment Record</th>
				</tr>
				<tr>
					<td colspan="1"></td>
					<td>Amount</td>
					<td>OR No.</td>
					<td>DATE</td>
					<td>REMARKS</td>
				</tr>
				<tr>
					<td>Reservation</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>Upon Enrollment</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>June</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>July</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>August</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>September</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>October</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>November</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>December</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>January</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>February</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>March</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</body>
</html>