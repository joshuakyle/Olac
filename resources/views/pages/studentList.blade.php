@extends('layouts.nav')

@section('formSearch')
<div class="col s6">
    <form method="get" action="{{ route('student-list') }}">
        <div class="col s5 offset-s2">
            <div class="input-field">
                <input placeholder ="Last name" id="lastname" name="lastname" type="text">
                <label for="text">Search by Last name</label>
            </div>
        </div>
        <div class="col s1">
            <button tye="submit" class="btn waves-effect"><i class="material-icons">youtube_searched_for</i></button>
        </div>
    </form>
</div>
@stop
@section('content')
<div class="row">
    <div class="col s12">
        <table class="striped highlight centered" id ="myTable">
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Section</th>
                    <th>Year</th>
                    <th>Status</th>
                    <th>Guardian Details</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($students->total() != 0)
                    @foreach($students as $student)
                    <tr class="{{ strtolower(str_replace(' Year', '', getYearText($student->old_year_level+1)))}}">
                        <td>{{ generateStudentNumber($student->old_year_level+1,$student->id) }}</td>
                        <td>{{ $student->last_name}}, {{$student->first_name}} {{ getMiddleInitial($student->middle_name) }}.</td>
                        <td>{{ $student->section()->section_name }}</td>
                        <td>{{ getYearText($student->year+1) }}</td>
                        <td>{{ getStudentStatus($student->status) }}</td>
                        <td>{{ $student->guardian_name }}/{{ $student->guardian_email }}/{{ $student->guardian_number }}</td>
                        <td>
                            <form method="POST" action="{{ route('qrgenerate') }}">
                            @csrf
                            <input type="hidden" name="qr" value="{{ $student->qr_code }}">
                            <input type="hidden" name="last_name" value="{{ $student->last_name }}">
                            <button type="button" data-id="{{ $student->id }}" class="btn waves-effect blue darken-3 info-trigger"><i class="material-icons">edit</i></button>
                            <button type="submit" class="btn waves-effect ">QRCode</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                @else
                <tr>
                    <td colspan="6">No student found</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Structure -->
<div id="modal1" class="modal">
  <form class="col s12 modal-form" method="POST" action="{{ route('student-update')}}">
    <h5><i class="material-icons prefix">folder_shared</i> Update Student Details</h5>
    @csrf
    <input type="hidden" id="student_id" name="student_id">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input value="0" id="first_name" name="first_name" type="text">
        <label class="active" for="first_name">First Name</label>
      </div>
      <div class="input-field col s6">
        <input value="0" id="last_name" name="last_name" type="text">
        <label class="active" for="last_name">Last Name</label>
      </div>
      <div class="input-field col s6">
        <input value="0" id="middle_name" name="middle_name" type="text">
        <label class="active" for="middle_name">Middle Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s8">
        <i class="material-icons prefix">home</i>
        <input value="0" id="address" name="address" type="text">
        <label class="active" for="address">Address</label>
      </div>
       <div class="input-field col s4">
        <i class="material-icons prefix">account_circle</i>
        <input value="0" id="religion" name="religion" type="text">
        <label class="active" for="religion">Religion</label>
      </div>
    </div>

    <div class="row">
      <div class="input-field col s12">
        <i class="material-icons prefix">contacts</i>
        <input value="0" id="guardian_name" name="guardian_name" type="text">
        <label class="active" for="guardian_name">Guardian Name</label>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">contacts</i>
        <input value="0" id="guardian_relation" name="guardian_relation" type="text">
        <label class="active" for="guardian_relation">Guardian Relation</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">contacts</i>
        <input value="0" id="guardian_occupation" name="guardian_occupation" type="text">
        <label class="active" for="guardian_occupation">Guardian Occupation</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s4">
        <i class="material-icons prefix">contact_phone</i>
        <input value="0" id="guardian_contact_number" name="guardian_contact_number" type="number">
        <label class="active" for="guardian_contact_number">Guardian Contact Number</label>
      </div>
      <div class="input-field col s4">
        <i class="material-icons prefix">contact_mail</i>
        <input value="0" id="guardian_email" name="guardian_email" type="email">
        <label class="active" for="guardian_email">Guardian Email</label>
      </div>
    </div>
    <hr/>
    <div class="row">
      <div class="input-field col s4">
        <i class="material-icons prefix">business</i>
        <input value="0" id="previous_school_name" name="previous_school_name" type="text">
        <label class="active" for="previous_school_name">Previous School Name</label>
      </div>
      <div class="input-field col s4">
        <i class="material-icons prefix">account_balance</i>
        <input value="0" id="previous_school_address" name="previous_school_address" type="text">
        <label class="active" for="previous_school_address">Previous School Adress</label>
      </div>
    </div>
    <div style="margin-bottom: 1rem;" class="input-field col s6 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Update <i class="material-icons right">send</i></button>
    </div>
   </div>
 </form>
</div>
@endsection
@section('customjs')
<script type="text/javascript">
     $('.modal').modal();
    //or by click on trigger
    $('.modal-trigger').modal();
    $('.info-trigger').click(function(){
          var id = $(this).data('id');
          $.get("{{url('/student/info')}}/"+id,function(val){
            console.log(val);
              $('#first_name').val(val.first_name);
              $('#last_name').val(val.last_name);
              $('#middle_name').val(val.middle_name);
              $('#address').val(val.address);
              $('#religion').val(val.religion);
              $('#guardian_name').val(val.guardian_name);
              $('#guardian_contact_number').val(val.guardian_number);
              $('#guardian_relation').val(val.guardian_relation);
              $('#guardian_occupation').val(val.guardian_occupation);
              $('#guardian_email').val(val.guardian_email);
              $('#student_id').val(val.id);
              $('#previous_school_address').val(val.old_school_address);
              $('#previous_school_name').val(val.old_school_name);
            $('#modal1').modal('open');
          });
        });
    @foreach ($errors->all() as $error)
      window.Materialize.toast('{{$error}}');
    @endforeach
    @if(session('status'))
      window.Materialize.toast('{{session('status')}}');
    @endif
</script>
@stop