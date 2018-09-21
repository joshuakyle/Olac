@extends('layouts.nav')

@section('content')
<div class="row">
  <div class="col s12">
      @if ($errors->any())
      <div class="alert alert-error" role="alert">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
    @endif
</div>
</div>
<div class="col s12">

  <table class="striped highlight centered" id ="myTable">
    <thead>
      <tr>
        <th>Subject Name</th>
        <th>Time</th>
        <th>Teacher</th>
        <th>Section</th>
        <th>Year Level</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @if($subjects != null)
      @foreach($subjects as $subject)
      <tr class="{{ strtolower(str_replace(' Year', '', getYearText($subject->year)))}}">
        <td>{{ $subject->subject_name}}</td>
        @if(!is_null($subject->schedule_id))
          <td>{{ $subject->time}}</td>
          <td>{{ $subject->first_name.', '.$subject->last_name }}</td>
          <td>{{ $subject->section}}</td>
        @else
        <td><i style="color:red;">No Time</i></td>
        <td><i style="color:red;">No Teacher</i></td>
        <td><i style="color:red;">No Section</i></td>
        @endif
        <td>{{getYearText($subject->year)}}</td>
        <td class="">
            <form method="GET" action="{{url('/subject/delete').'/'.$subject->id}}">
              @csrf
              <button type="button" data-id = "{{$subject->id}}" class="btn waves-effect info-trigger blue darken-3"><i class="large material-icons">edit</i></button>
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
  <form id ="form" class="col s12 modal-form" method="POST" action="{{ route('add-subject')}}">
    <h5><i class="material-icons prefix">create</i> Add Subject</h5>
    @csrf
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">create</i>
        <input id="name" name="name" type="text">
        <label for="name">Subject Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">layers</i>
        <select id="year" name="year">
          <option value="" disabled selected>Choose your option</option>
          <option value="1">First Year</option>
          <option value="2">Second Year</option>
          <option value="3">Third Year</option>
          <option value="4">Fourth Year</option>
        </select>
        <label for="year">Year Level</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">account_box</i>
        <select id="schedule" name="schedule">
          <option value="" disabled selected>No Schedule available yet.</option>
          {{-- @foreach($schedules as $schedule)
            <option value="{{ $schedule->schedule_id }}">{{ $schedule->schedule_name }}</option>
          @endforeach --}}
        </select>
        <label for="schedule">Schedule</label>
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
    <h5><i class="material-icons prefix">create</i> Update Subject</h5>
    @csrf
    <input type="hidden" id="_id" name="id">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">create</i>
        <input value="0"  id="_name" name="name" type="text">
        <label for="_name">Subject Name</label>
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
        <label for="_year">Year Level</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">account_box</i>
        <select id="_schedule" name="schedule">
          <option value="" disabled selected>Choose your option</option>
          {{-- @foreach($schedules as $schedule)
            <option value="{{ $schedule->schedule_id }}">{{ $schedule->schedule_name }}</option>
          @endforeach --}}
        </select>
        <label for="_schedule">Schedule</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s2 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Submit <i class="material-icons right">send</i></button>
     </div>
   </div>
 </form>s
</div>
</div>
@endsection

@section('customjs')
<script type="text/javascript">
  (function ($) {
    $(function () {
    //   $('#myTable').DataTable({
    // });
    // $('#myTable_length').hide();

      //onchange
      $('#year').on('change',function(){
        var id = $(this).val();
        getSchedOption(id,1,false);
      });

      $('#_year').on('change',function(){
        var id = $(this).val();
        getSchedOption(id,0,false);
      });

      //modal update
        $('.info-trigger').click(function(){
          var id = $(this).data('id');
          $.get("{{url('/subject/info')}}/"+id,function(response){
              getSchedOption(response.year,0,response.schedule_id);
              $('#_name').val(response.subject_name);
              $('#_id').val(response.id);
              $('#_schedule').append('<option value="'+response.schedule_id+'" selected>'+response.year+'-'+response.section_name+'('+response.schedule_name+')</option>').material_select();
              $('#_schedule').val(0).material_select();
              $('#_year').val(response.year).material_select();
            $('#modal2').modal('open');
        });

      });

      function getSchedOption(id,type,sc_id){
        var sched = type ? $('#schedule') : $('#_schedule');
        sched.html('').material_select();
        $.get('{{ url('/schedule/availability') }}/'+id,function(data){
          if(data.length != 0 || sc_id){
            var html = '<option value="0" '+sc_id ? "" : "selected"+'>Unassigned</option>';
            $.each(data,function(i,val){
              html +='<option value='+val.schedule_id+'>'+val.year+'-'+val.section_name+'( '+val.schedule_name+' )'+'</option>';
            });
            sched.append(html).material_select();
          }else{
            var html = '<option value="0" selected>No schedule available</option>';
            sched.append(html).material_select();
          }

        });
      }

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

      @if(session('status'))
        window.Materialize.toast('{{session('status')}}');
      @endif

      @if($errors->any())
          @foreach ($errors->all() as $error)
            window.Materialize.toast('{{ $error }}');
          @endforeach
      @endif
    }); // end of document ready

})(jQuery); // end of jQuery name space

</script>
@endsection