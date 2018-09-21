@extends('layouts.nav')

@section('content')
<div class="row">
    <div class="col s12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-success" role="alert">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
        <table class="striped highlight centered" id ="myTable">
            <thead>
              <tr>
                <th>Student Name</th>
                <th>Year Level</th>
                <th>Section</th>
                <th style="width: 295px;">Action</th>
              </tr>
            </thead>
            <tbody>
              @if(!is_null($students))
              @foreach($students as $student)
              <tr class="{{ strtolower(str_replace(' Year', '', getYearText($student->old_year_level+1)))}}">
                <td>{{$student->last_name.', '.$student->first_name.' '.getMiddleInitial($student->middle_name)}}</td>
                <td>{{ getYearText($student->old_year_level+1)}}</td>
                <td>{{ $section->section_name}}</td>
                <td>
                    <form method="post" >
                      @csrf
                      <input type="hidden" name="student_id" value="{{ $student->id  }}">
                      <button id="btn-{{ $student->id }}" type="button" data-id="{{ $student->id }}" class="btn waves-effect info-trigger">Show Grades</button>
                  </form>
                </td>
              </tr>
              <?php 
              switch($student->old_year_level+1){
                  case 1:
                  $grade = $student->first($subject_id);
                  break;
                  case 2:
                  $grade = $student->second($subject_id);
                  break;
                  case 3:
                  $grade = $student->third($subject_id);
                  break;
                  case 4:
                  $grade = $student->fourth($subject_id);
                  break;
                  default:
                  $grade = null;
                }
                $arr = [];
                foreach ($grade as $key => $value) {
                  $arr[$value->quarter] = $value;
                }
              ?>
              <tr id="grades-{{ $student->id }}" class="{{ strtolower(str_replace(' Year', '', getYearText($student->old_year_level+1)))}} grades">
                <td colspan="4" class="offset-s1">
                  <form id="form-{{ $student->id }}">
                    @csrf
                    <input type="hidden" name="subject_id" value="{{ $subject_id }}">
                    <input type="hidden" name="student_id" value="{{ $student->id }}">
                    @for($i = 1; $i <= 4; $i++)
                    <div class="input-field col s2 {{ $i == 1 ? 'offset-s1' : ''}}">
                      <input id="quarter-{{ $student->id }}-{{ $i }}" name="{{ str_replace(" ","_",strtolower(getQuarterName($i))) }}" type="number" max="99" value="{{ isset($arr[$i]) ? ($i == $arr[$i]->quarter) ? $arr[$i]->score : '' : '' }}">
                      <label for="quarter-{{ $student->id }}-{{ $i }}">{{ getQuarterName($i) }}</label>
                    </div>
                    @endfor
                    <div class="input-field col s1">
                      <button type="button" class="btn waves-effect save green" data-id="{{ $student->id }}"><i class="material-icons">save</i></button>
                    </div>
                    </form>
                </td>
              </tr>
            @endforeach
            @else
            @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
@section('customjs')
  <script type="text/javascript">
     $('.modal').modal();
     $('.grades').hide();
    //or by click on trigger
    // $('.modal-trigger').modal();
    // $('.info-trigger').click(function(){
    //   var id = $(this).data('id');
    //   var year = $(this).data('year');
    //   $.get("{{url('/student/grade')}}/"+id+"/"+year,function(val){
    //     console.log(val);
    //     $('#modal1').modal('open');
    //   });
    // });

    $('.info-trigger').click(function(){
      if($(this).text() == 'Show Grades'){
        $(this).text('Hide Grades');
      }else{
        $(this).text('Show Grades');
      }
      var id = $(this).data('id');
      $('#grades-'+id).toggle(500);
    });

    $('.save').click(function(){
      var id = $(this).data('id');
      var data = $('#form-'+id).serialize();
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });

      $.ajax({
      type: "POST",
        url: "{{ route('updateGrade') }}",
        data: data,
        success: function (data) {
          $('#btn-'+id).text('Show Grades');
          $('#grades-'+id).hide(500);
          window.Materialize.toast(data.message,3000);
        },
      });
    });
  </script>
@stop
