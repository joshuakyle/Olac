@extends('layouts.nav')

@section('content')

<div class="col s12">

  <table class="striped highlight centered" id ="myTable">
    <thead>
      <tr>
        <th>Section Name</th>
        <th>Year Level</th>
        <th>Adviser</th>
        <th>Enrolled Students</th>
        <th>Maximum no. of Students</th>
        <th>Date Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @if($sections != null)
      @foreach($sections as $section)
      <tr class="{{ strtolower(str_replace(' Year', '', getYearText($section->year)))}}">
        <td>{{$section->section_name}}</td>
        <td>{{ getYearText($section->year) }}</td>
        <?php $teacher = $section->teacher();?>
        @if(is_null($teacher))
        <td class="unassigned">No Adviser</td>
        @else
        <td>{{ $teacher->last_name.', '. $teacher->first_name}}</td>
        @endif
        <td>{{ $section->student_count()}}</td>
        <td>{{ $section->capacity}}</td>
        <td>{{date("M d,Y",strtotime($section->created_at))}}</td>
        <td>
            <form method="GET" action="{{url('/section/delete').'/'.$section->id}}">
              @csrf
              <button type="button" data-id = "{{$section->id}}" class="btn waves-effect info-trigger blue darken-3"><i class="large material-icons">edit</i></button>
              <button type="button"  class="btn waves-effect  red darken-3 btn-confirm">
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
  <form id ="form" class="col s12 modal-form" method="POST" action="{{ route('add-section')}}">
    <h5><i class="material-icons prefix">create</i> Add Section</h5>
    @csrf
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">create</i>
        <input id="name" name="name" type="text">
        <label for="name">Section Name</label>
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
        <i class="material-icons prefix">people</i>
        <input id="capacity" name="capacity" type="number">
        <label for="capacity">Maximum number of Students</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_box</i>
        <select id="teacher" name="teacher">
          <option value="" disabled selected>Choose your option</option>
          @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->last_name.', '. $teacher->first_name }}</option>
          @endforeach
        </select>
        <label for="teacher">Adviser</label>
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
  <form id ="form" class="col s12 modal-form" method="POST" action="{{ route('update-section')}}">
    <h5><i class="material-icons prefix">person_add</i> Update Section</h5>
    @csrf
    <input id="_id" name="id" type="hidden">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">create</i>
        <input value ="0" id="_name" name="name" type="text">
        <label for="_name">Section Name</label>
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
        <i class="material-icons prefix">people</i>
        <input value ="0"  id="_capacity" name="capacity" type="number">
        <label for="_capacity">Maximum number of Students</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_box</i>
        <select id="_teacher" name="teacher">
          <option value="" disabled selected>Choose your option</option>
          @foreach($teachers as $teacher)
            <option value="{{ $teacher->id }}">{{ $teacher->last_name.', '. $teacher->first_name }}</option>
          @endforeach
        </select>
        <label for="_teacher">Adviser</label>
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
    $(function () {
    //   $('#myTable').DataTable({
    // });
      $('#myTable_length').hide();

      //forupdate
      $('.info-trigger').click(function(){
        var id = $(this).data('id');
        $.get("{{url('/section/info')}}/"+id,function(response){
            $('#_name').val(response.section_name);
            $('#_teacher').val(response.teacher_id).material_select();
            $('#_id').val(response.id);
            $('#_year').val(response.year).material_select();
            $('#_capacity').val(response.capacity);
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
    }); // end of document ready

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
</script>
@endsection