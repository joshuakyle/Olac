@extends('layouts.nav')

@section('content')
<div class="col s12">

  <table class="striped highlight centered" id ="myTable">
    <thead>
      <tr>
        <th>Time</th>
        <th>Year Level</th>
        <th>Subject</th>
        <th>Section</th>
        <th>Teacher</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @if(!is_null($schedules))
      @foreach($schedules as $schedule)
      <tr class="{{ strtolower(str_replace(' Year', '', getYearText($schedule->year)))}}">
        <td>{{$schedule->schedule_name}}</td>
        <td>{{ getYearText($schedule->year)}}</td>
        <td class="{{ $schedule->subject_name ? '' : 'unassigned' }}">{{ $schedule->subject_name ? $schedule->subject_name : 'No Subject'}}</td>
        <td>{{ $schedule->section_name}}</td>
        <td>{{ $schedule->last_name.', '.$schedule->first_name}}</td>
        <td class="">
            <form method="GET" action="{{url('/schedule/delete').'/'.$schedule->schedule_id}}">
              @csrf
              <!-- <button type="button" data-id = "{{$schedule->schedule_id}}" class="btn waves-effect info-trigger blue darken-3"><i class="large material-icons">edit</i></button> -->
              <button type="button" class="btn waves-effectinfo-trigger red darken-3 btn-confirm">
                <i class="large material-icons">delete</i>
              </button>
          </form>
        </td>
      </tr>
    @endforeach
    @else
    @endif
</tbody>
</table>
<div class="fixed-action-btn horizontal">
  <a id="add"  class="btn-floating waves-light btn-large red btn modal-trigger pulse" href="#modal1">
    <i class="large material-icons">library_add</i>
  </a>
</div>
<div id="modal1" class="modal modal-small">
  <form id ="form" class="col s12 modal-form" method="POST" action="{{ route('add-schedule')}}">
    <h5><i class="material-icons prefix">date_range</i> Add Schedule</h5>
    @csrf
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">create</i>
         <select id="time" name="time">
          <option value="" disabled selected>Choose your option</option>
          @foreach(getListofSchedule() as $key => $time)
          <option value="{{ $key }}">{{ $time }}</option>
          @endforeach
        </select>
        <label for="time">Time</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">layers</i>
        <select id="subject" name="subject">
          <option value=""  selected>{{ count($subjects) == 0 ? 'No Subject available' : 'Choose your option' }}</option>

          @foreach($subjects as $key => $subject)
          <option value="{{ $subject->id }}">{{ $subject->year.'-'.$subject->subject_name }}</option>
          @endforeach
        </select>
        <label for="subject">Subject</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_box</i>
        <select id="teacher" name="teacher">
          <option value="" disabled selected>Choose your option</option>
        </select>
        <label for="teacher">Teacher</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">account_box</i>
        <select id="section" name="section">
          <option value="" disabled selected>Choose your option</option>
        </select>
        <label for="section">Section</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s2 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Submit <i class="material-icons right">send</i></button>
     </div>
   </div>
 </form>
</div>

<div id="modal2" class="modal modal-small">
  <form id ="form" class="col s12 modal-form" method="POST" action="{{ route('update-subject')}}">
    <h5><i class="material-icons prefix">person_add</i> Update Subject</h5>
    @csrf
    <input id="_id" name="id" type="hidden">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">create</i>
        <input value="0" id="_name" name="name" type="text">
        <label for="name">Subject Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">layers</i>
        <select id="_year" name="year">
          <option value="" disabled selected>Choose your option</option>
          <option value="1">First Year</option>
          <option value="2">Second Year</option>
          <option value="3">Third Year</option>
          <option value="4">Fourth Year</option>
        </select>
        <label for="year">Year Level</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s2 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Submit <i class="material-icons right">send</i></button>
     </div>
   </div>
 </form>
</div>
</div>
@endsection

@section('customjs')
<script type="text/javascript">
  (function ($) {
    $(function () {
    //   $('#myTable').DataTable({
    // });
      $('#myTable_length').hide();
        $('.info-trigger').click(function(){
          var id = $(this).data('id');
          $.get("{{url('/subject/info')}}/"+id,function(response){
              $('#_name').val(response.subject_name);
              $('#_id').val(response.id);
              $('#_year').val(response.year).material_select();
            $('#modal2').modal('open');
        });
      });
      @if(session('status'))
        window.Materialize.toast('{{session('status')}}');
      @endif

      @if($errors->any())
          @foreach ($errors->all() as $error)
            window.Materialize.toast('{{ $error }}');
          @endforeach
      @endif

      $('#time').on('change',function(){
        $('#teacher').html('').material_select();
        var id = $(this).val();
        $.get('{{ url('/teacher/availability') }}/'+id,function(data){
          var html = '<option value="" selected>Choose your option</option>';
          $.each(data,function(i,val){
            html +='<option value='+val.id+'>'+val.first_name+', '+val.last_name+'</option>';
          });
          $('#teacher').append(html).material_select();
        }); 

        $('#section').html('').material_select();
        $.get('{{ url('/section/availability') }}/'+id,function(data){
          var html = '<option value="" disabled selected>Choose your option</option>';
          $.each(data,function(i,val){
            html +='<option value='+val.id+'>'+val.year+'-'+val.section_name+'</option>';
          });
          $('#section').append(html).material_select();
        }); 
      });

      $('.btn-confirm').confirm({
        title: 'Confirm!',
        content: 'Are you sure to delete this section?',
        buttons: {
          confirm: function () {
            this.$target.closest("form").submit();
          },
          cancel: function () {
            
          },
        }
    });

    }); // end of document ready

})(jQuery); // end of jQuery name space

</script>
@endsection