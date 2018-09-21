@extends('layouts.nav')

@section('content')
<div class="row">
<div class="col s12">
  <table class="striped highlight centered" id ="myTable">
    <thead>
      <tr>
        <th>Name</th>
        <th>Email/Contact</th>
        <th>Contract Type</th>
        <th>Date Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @if($teachers != null)
      @foreach($teachers as $teacher)
      <tr>
        <td>{{$teacher->last_name}}, {{$teacher->first_name}}</td>
        <td>{{$teacher->email}}/{{$teacher->contact_number}}</td>
        <td>{{ $teacher->type == 1 ? 'Full-time' : 'Part-time'}}</td>
        <td>{{date("M d,Y",strtotime($teacher->created_at))}}</td>
        <td>
            <form method="GET" action="{{url('/teacher/delete').'/'.$teacher->user_id}}">
              @csrf
              <button type="button" data-id = "{{$teacher->id}}" class="btn waves-effect info-trigger blue darken-3"><i class="large material-icons">edit</i></button>
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
</div>

<div class="fixed-action-btn horizontal">
  <a  class="btn-floating waves-light btn-large red btn modal-trigger pulse" href="#modal1">
    <i class="large material-icons">person_add</i>
  </a>
</div>
<!-- Modal Structure -->
<div id="modal1" class="modal">
  <form class="col s12 modal-form" method="POST" action="{{ route('addTeacher')}}">
    <h5><i class="material-icons prefix">person_add</i> Add Teacher</h5>
    @csrf
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input id="first_name" name="first_name" type="text">
        <label for="first_name">First Name</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input id="last_name" name="last_name" type="text">
        <label for="last_name">Last Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">email</i>
        <input id="email" name="email" type="email">
        <label for="email">Email</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">contact_phone</i>
        <input id="contact_number" name="contact_number" type="number">
        <label for="contact_number">Contact Number</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <select id="gender" name="gender">
          <option value="" disabled selected>Choose your option</option>
          <option value="Male">Male</option>
          <option value="Femal">Female</option>
        </select>
        <label for="gender">Gender</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">perm_contact_calendar</i>
        <input id="birthdate" name="birthdate" type="text" class="datepicker">
        <label for="birthdate">Birthdate</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">person_outline</i>
        <input id="username" name="username" type="text">
        <label for="username">Username</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">lock_outline</i>
        <input id="password" name="password" type="password">
        <label for="password">Password</label>
      </div>
    </div>
    <div class="row">
      <div class="col s6">
          <input type="checkbox" id="fulltime" name="fulltime" class="filled-in">
          <label for="fulltime">Full-time Teacher</label>
      </div>
      <div class="input-field col s2 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Submit <i class="material-icons right">send</i></button>
     </div>
   </div>
 </form>
</div>
</div>

<!-- Modal Structure -->
<div id="modal2" class="modal">
  <form class="col s12 modal-form" method="POST" action="{{ route('updateTeacher')}}">
    <h5><i class="material-icons prefix">assignment_ind</i> Update Teacher</h5>
    @csrf
    <input type="hidden" id="_id" name="id">
    <input type="hidden" id="_user_id" name="user_id">
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <input value="0" id="_first_name" name="first_name" type="text">
        <label class="active" for="first_name">First Name</label>
      </div>
      <div class="input-field col s6">
        <input value="0" id="_last_name" name="last_name" type="text">
        <label class="active" for="last_name">Last Name</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">email</i>
        <input value="0" id="_email" name="email" type="email">
        <label class="active" for="email">Email</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">contact_phone</i>
        <input value="0" id="_contact_number" name="contact_number" type="number">
        <label class="active" for="contact_number">Contact Number</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">account_circle</i>
        <select id="_gender" name="gender">
          <option value="" disabled selected>Choose your option</option>
          <option value="Male">Male</option>
          <option value="Female">Female</option>
        </select>
        <label class="active" for="gender">Gender</label>
      </div>
      <div class="input-field col s6">
        <i class="material-icons prefix">perm_contact_calendar</i>
        <input value="0" id="_birthdate" name="birthdate" type="text" class="datepicker">
        <label class="active" for="birthdate">Birthdate</label>
      </div>
    </div>
    <div class="row">
      <div class="input-field col s6">
        <i class="material-icons prefix">person_outline</i>
        <input value="0" id="_username" readonly="" name="username" type="text">
        <label class="active" for="username">Username</label>
      </div>
      <div class="input-field col s6">

        <i class="material-icons prefix">lock_outline</i>
        <input value="0" id="_password" name="password" type="password" disabled="">
        <label class="active" for="password">Password</label>
      </div>
    </div>
    <div class="row">
     <div class=" col s6">
          <input type="checkbox" id="_fulltime" name="fulltime" class="filled-in">
          <label for="_fulltime">Full-time Teacher</label>
      </div>
     <div class="input-field col s6 right-align">
       <button type="submit" class="btn waves-effect waves-light blue darken-3" name="action">Update <i class="material-icons right">send</i></button>
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
      // $('#myTable').DataTable({
      //   "lengthMenu": [[25], [25]]
      // });

      $('#myTable_length').hide();
        //initialize all modals           
        $('.modal').modal();
        //or by click on trigger
        $('.modal-trigger').modal();

        $('.info-trigger').click(function(){
          var id = $(this).data('id');
          $.get("{{url('/teacher/info')}}/"+id,function(response){
            $.each(response,function(i,val){
              $('#_username').val(val.username);
              $('#_password').val(val.password);
              $('#_first_name').val(val.first_name);
              $('#_last_name').val(val.last_name);
              $('#_gender').val(val.gender).material_select();
              $('#_birthdate').val(val.birth_date);
              $('#_contact_number').val(val.contact_number);
              $('#_email').val(val.email);
              $('#_id').val(val.id);
              $('#_user_id').val(val.user_id);
              if(val.type == 1){
                $('#_fulltime').attr('checked','checked');
              }else{
                 $('#_fulltime').attr('checked',false);
              }
            });
            $('#modal2').modal('open');
          });
        });
        @if(session('status'))
          window.Materialize.toast('{{session('status')}}',5000);
        @endif
        @foreach ($errors->all() as $error)
          window.Materialize.toast('{{$error}}',5000);
        @endforeach

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