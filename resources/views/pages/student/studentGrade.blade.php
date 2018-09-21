@extends('layouts.app')
@section('bgcolor')
bgcolor
@endsection
@section('content')
<div class="container" style="width:49%">
<div class="fixed-action-btn">
  <a class="btn-floating btn-large green">
    <i class="large material-icons">account_circle</i>
  </a>
  <ul>
  	<li><a  class="btn-floating waves-light btn-large red btn" href="{{url('/index')}}">
	    <i class="large material-icons">subdirectory_arrow_left</i>
	  </a>
	</li>
    <li><a class=" btn-floating  btn-large waves-effect waves-light btn modal-trigger" href="#modal1"><i class="material-icons">fiber_pin</i></a></li>
  </ul>
</div>

	<div class="col s8 offset-s2">
		<div style="margin-top: 6%;">
			<div class="row">
				<div class="col s6">
					<div class="card-panel">
						<div class="row">
							<div style="margin: auto;">
								<b>
								<p>Student name : {{$name}}</p>
								<p>Student Section : {{$student->section()->section_name}}</p>
								</b>
								<div class="center-align"><h5>Student Grades</h5></div>
								<table class="striped highlight centered responsive-table">
									<thead>
										<tr>
											<td style="width: 150px; text-align: center;">Subject Name</td>
											<td style="width: 120px; text-align: center;">1st Quarter</td>
											<td style="width: 120px; text-align: center;">2nd Quarter</td>
											<td style="width: 120px; text-align: center;">3rd Quarter</td>
											<td style="width: 120px; text-align: center;">4th Quarter</td>
											<td style="width: 120px; text-align: center;">Average</td>
										</tr>
									</thead>
									<tbody class="center-align">
										<?php 
											switch($year){
							                  case 1:
							                  $grade = $student->firstGrade($id);
							                  break;
							                  case 2:
							                  $grade = $student->secondGrade($id);
							                  break;
							                  case 3:
							                  $grade = $student->thirdGrade($id);
							                  break;
							                  case 4:
							                  $grade = $student->fourthGrade($id);
							                  break;
							                  default:
							                  $grade = null;
							                }

							                if(!is_null($grade)){
							                	$arr = [];
							                	$build = [];
							                	foreach ($grade as $key => $value) {
							                		$subject = $value->subject()->subject_name;
							                		if(in_array($subject, $arr)){
							                			$build[$subject][$value->quarter]=$value->score;
							                		}else{
							                			array_push($arr,$subject);
							                			$build[$subject][$value->quarter]=$value->score;
							                		}
							                	}
							                }
										?>

										@foreach($build as $subject => $val)
											<tr>
											<?php $average = 0; $count = 0;?>
											<td>{{$subject}}</td>
											@for($i = 1; $i <= 4; $i++)
												@if(isset($val[$i]))
												<td>{{ $val[$i] }}</td>
												<?php $average += $val[$i]; $count++;?>
												@else
												<td></td>
												@endif
											@endfor
											<td>{{round($average/$count,2)}}</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
</div>
<div id="modal1" class="modal modal-pin" style="top:10px !important;height:250px;" >
  <form id ="form" class="col s12 modal-form" method="POST" action="{{ route('update-pin')}}">
    <h5><i class="material-icons prefix">lock</i> Change pin</h5>
    @csrf
    <input id="id" name="id" type="hidden" value="{{ $student->id }}">
    <div class="row">
    	<div class="input-field col s4">
    		<input id="old_pin" type="password" maxlength="4" name="old_pin" pattern="[0-9]*" inputmode="numeric">
    		<label for="old_pin">Old Pin</label>
    	</div>
    	<div class="input-field col s4">
    		<input id="pin" type="password" maxlength="4" name="pin" pattern="[0-9]*" inputmode="numeric">
    		<label for="pin">New Pin</label>
    	</div>
    	<div class="input-field col s4">
    		<input id="pin_confirmation" type="password" maxlength="4" name="pin_confirmation" pattern="[0-9]*" inputmode="numeric">
    		<label for="pin_confirmation">Confirm New Pin</label>
    	</div>
    </div>
    <div class="row">
      <div class="input-field col s2 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Submit</button>
     </div>
   </div>
 </form>
</div>
@endsection
@section('customjs')
<script type="text/javascript">
@if(session('status'))
  window.Materialize.toast('{{session('status')}}',5000);
@endif
@foreach ($errors->all() as $error)
  window.Materialize.toast('{{$error}}',5000);
@endforeach
</script>
@endsection