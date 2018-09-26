<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/olac-small.png') }}" />
    <?php
        if(Auth::user()->user_role == 0){
            $title = 'OLAC|Admin';
        }elseif(Auth::user()->user_role == 1){
            $title = 'OLAC|Teacher';
        }else{
            $title = 'OLAC|School System';
        }
    ?>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title}}</title>

   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com"><!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/datatables.css') }}" rel="stylesheet">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
     <ul id="slide-out" class="side-nav fixed">
        <li>
            <div class="user-view">
                <div class="background">
                    <img class="circle logo" src="{{asset('img/olac-logo.jpg')}}">
                </div>
            </div>
        </li>
        <li><div class="divider"></div></li>
        @if(Auth::user()->user_role == 0)
        <li class="{{ isset($module_name) ? ($module_name == 'dashboard') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('dashboard') }}"><i class="material-icons">dashboard</i>Dashboard</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'teacher-list') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('teacher-list') }}"><i class="material-icons">account_box</i>Teachers</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'section-list') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('section-list') }}"><i class="material-icons">dns</i>Section</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'subject-list') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('subject-list') }}"><i class="material-icons">dns</i>Subjects</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'schedule-list') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('schedule-list') }}"><i class="material-icons">date_range</i>Schedule</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'student-list') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('student-list') }}"><i class="material-icons">people</i>Students</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'school-option') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('school-option') }}"><i class="material-icons">vpn_lock</i>School Options</a></li>
        @elseif(Auth::user()->user_role == 1)
        {{-- <li class="{{ isset($module_name) ? ($module_name == 'dashboard') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('dashboard') }}"><i class="material-icons">dashboard</i>Dashboard</a></li> --}}
        <li class="{{ isset($module_name) ? ($module_name == 'attendance') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('teacherIndex') }}"><i class="material-icons">dashboard</i>Attendance</a></li>
        <li class="{{ isset($module_name) ? ($module_name == 'grades') ? 'active' : '' : ''}}"><a class="waves-effect" href="{{ route('gradesIndex') }}"><i class="material-icons">dashboard</i>Assign Grade</a></li>
        @endif
    </ul>
    <?php 
        if(Auth::user()->user_role == 0){
            //admin
            $role = 'Admin';
        }elseif(Auth::user()->user_role == 1){
            //teacher
            $role = 'Teacher';
        }else{
            //student
            $role = 'Student';
        }

        $showModule = [
            'section-list',
            'schedule-list',
            'subject-list',
            'student-list',
            'attendance',
            'grades'

        ];
    ?>

    <nav class="top-nav">
          <div class="nav-wrapper nav-color">
            <a href="#" data-activates="slide-out" class="button-collapse" id="nav-show"><i class="material-icons">menu</i></a>
            <a class="page-title title-nav">{{ isset($module_header) ? $module_header : ''}}</a>&nbsp;&nbsp;
            @if(Auth::user()->user_role == 0)
            <a id="unconfirmed" class="enrolless-btn modal-trigger" href="#enroll-modal" >New enrollee(s): <span>0</span></a>
            @endif
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <?php $name = Auth::user()->user_role == 0 ? Auth::user()->username : getTeacher(Auth::user()->id) ?>
                <li><a>{{ $role.', '.ucfirst($name) }}</a></li>
                <li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();">logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                </ul>
        </div>
    </nav>
<div id="enroll-modal" class="modal" >
  <form id ="form" class="col s12 modal-form" method="POST" action="">
    <h5><i class="material-icons prefix">lock</i> Enrollee List</h5>
    @csrf
    <table>
        <thead>
            <tr>
                <td>Option</td>
                <td>Student Name</td>
                <td>Student Year</td>
                <td>Guardian Contact Details</td>
                <td>Registration Date</td>
            </tr>
        </thead>
        <tbody id="table-body">
            
        </tbody>
    </table>
    <div class="row">
      <div class="input-field col s2 right-align">
       <button type="button" class="btn waves-effect waves-light blue darken-3" id="action">Submit</button>
       <button type="button" class="btn waves-effect waves-light red darken-3" id="reject">Reject</button>
     </div>
   </div>
 </form>
</div>
<main class="py-3">
    <div class="row">
        @yield('formSearch')
        @if(isset($module_name) ? in_array($module_name,$showModule) ? true : false : false)
            <div class="col s4">
                <div class="label-badge right-align">
                    <span class="z-depth-1 green"></span><span>: First Year</span>
                    <span class="z-depth-1 yellow"></span><span>: Second Year</span>
                    <span class="z-depth-1 red"></span><span>: Third Year</span>
                    <span class="z-depth-1 blue"></span><span>: Fourth Year</span>
                </div>
            </div>
        @endif
    </div>
    @yield('content')
</main>
<footer class="page-footer">
  <div class="footer-copyright">
    <div class="container center-align" style="font-size: 13px; padding-top: 11px">
    © Our Lada of Assumption College 2018
    </div>
  </div>
</footer>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
<script type="text/javascript">
    $('.datepicker').pickadate({
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 100, // Creates a dropdown of 15 years to control year,
        today: 'Today',
        clear: 'Clear',
        close: 'Ok',
        closeOnSelect: false, // Close upon selecting a date,
    });
    
    $('select').material_select();
    //initialize all modals           
    $('.modal').modal();
    //or by click on trigger
    $('.modal-trigger').modal();

    $(function(){
        var array_ids = [];
        $('.enrolless-btn').hide();
        @if(Auth::user()->user_role == 0)
            setInterval(function(){ 
                getUnconfirmedStudents();
            }, 1000);
        @endif


        function getUnconfirmedStudents() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data;
            $.ajax({
            type: "GET",
                url: "{{ url('/students/unconfirmed') }}",
                data: data,
                success: function (data) {
                    if(data > 0){
                        $('.enrolless-btn span').text(data);
                        $('.enrolless-btn').show();
                    }else{
                        $('.enrolless-btn').hide();
                    }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        }

        $('#unconfirmed').click(function(){
            var array_ids = [];
            $('#action').attr('disabled',true);
            $('#reject').attr('disabled',true);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var data;
            $.ajax({
            type: "GET",
                url: "{{ url('/students/unconfirmed/details') }}",
                data: data,
                success: function (data) {
                    $('#table-body').html('');
                    if(data.length != 0){
                        var html = '';
                        var url = '{{ route('download-pdf') }}';
                        var csrf = '@csrf';
                        $.each(data,function(key,val){
                            html += '<tr>';
                            html += '<td><p><input type="checkbox" data-id="'+val.id+'" class="checkbox-enroll" id="'+val.id+'"><label for="'+val.id+'"></lable</p></td>';
                            html += '<td>'+val.last_name+', '+val.first_name+' '+val.middle_name+'</td>';
                            html += '<td>'+getYearText(val.old_year_level+1)+'</td>';
                            html += '<td>'+val.guardian_email+'/'+val.guardian_number+'</td>';
                            html += '<td>'+val.created_at+'</td>';
                            html += '<td><form method="POST" action ="'+url+'">'+csrf+'<input type="hidden" name="id" value="'+val.id+'"><button type="submit" class="btn reg-form-dl"><i class="material-icons">cloud_download</i></button></form></td>';
                            html += '</tr>';
                        });
                        $('#table-body').append(html);
                        $('.checkbox-enroll').on('click',function(){
                            var id = $(this).data('id');
                            if($(this).is(':checked')){
                                array_ids.push(id);
                            }else{
                                var removeItem = id;
                                array_ids.splice(array_ids.indexOf(removeItem ), 1);
                            }

                            if(array_ids.length == 0 ){
                                $('#action').attr('disabled',true);
                                $('#reject').attr('disabled',true);
                            }else{
                                $('#action').attr('disabled',false);
                                $('#reject').attr('disabled',false);
                            }
                        });

                        $('#action').confirm({
                          title: 'Confirm!',
                          content: 'Are you sure to submit the form?',
                          buttons: {
                            confirm: function () {
                                loadingStart(1);
                              $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                type: "POST",
                                    url: "{{ route('update-studet-status') }}",
                                    data: {'ids':array_ids},
                                    success: function (data) {
                                        
                                        if(data.status == 1){
                                            window.Materialize.toast(data.message,3000);
                                            $('#enroll-modal').modal('close');
                                        }else if(data.status == 2){
                                            $.each(data.faileds,function(i,val){
                                                window.Materialize.toast(val.message,5000);
                                            });
                                        }else{
                                            window.Materialize.toast(data.message,5000);
                                            $('#enroll-modal').modal('close');
                                        }
                                        removeLoading(1);
                                    },
                                });
                            },
                            cancel: function () {
                              
                            },
                          }
                        });

                        $('#reject').confirm({
                          title: 'Confirm!',
                          content: 'Are you sure to reject the student(s)?',
                          buttons: {
                            confirm: function () {
                                loadingStart(0);
                              $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });
                                $.ajax({
                                type: "POST",
                                    url: "{{ route('update-studet-reject') }}",
                                    data: {'ids':array_ids},
                                    success: function (data) {
                                        
                                        if(data.status == 1){
                                            window.Materialize.toast(data.message,3000);
                                            $('#enroll-modal').modal('close');
                                        }
                                        removeLoading(0);
                                    },
                                });
                            },
                            cancel: function () {
                              
                            },
                          }
                        });
                    }
                }
            });
        });
        function loadingStart($option){
            if($option == 1){
                $('#action').text('Loading...');
            }else{
                $('#reject').text('Loading...');
            }

            $('#action').attr('disabled',true);
            $('#reject').attr('disabled',true);
            $('.checkbox-enroll').attr('disabled',true);
            $('.reg-form-dl').attr('disabled',true);
            
            
        }

        function removeLoading($option){
            if($option == 1){
                $('#action').text('Submit');
            }else{
                $('#reject').text('Reject');
            }

            $('#action').attr('disabled',false);
            $('#reject').attr('disabled',false);
            $('.checkbox-enroll').attr('disabled',false);
            $('.reg-form-dl').attr('disabled',false);
            
        }

        function getYearText(yearValue){
            if(yearValue == 1){
                return 'First Year';
            }
            else if(yearValue == 2){
                return 'Second Year';
            }
            else if(yearValue == 3){
                return 'Third Year';
            }
            else{
                return 'Fourth Year';
            }
        }

        
    });
</script>
@yield('customjs')
</html>
