@extends('layouts.nav')

@section('content')
<div class="row">
    <div class="col s12">
        <div class="col s4 offset-s2">
            <form id="form-school">
            @csrf
            <div class="row">
                <div class="input-field col s6">
                    <input name="school_name" type="text" value="{{ $school->school_name }}" required>
                    <label for="school_name">School Name</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input name="school_address" type="text" value="{{ $school->school_address }}" required>
                    <label for="school_address">School Address</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="school_year" name="school_year" type="text" value="{{ $school->school_year }}" required>
                    <label for="school_year">School Year</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <p>Current Enrollment Year: <span style="color:green">{{ $school->enrollment_year }}</span></p>
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <button type="button" id="update" class="btn blue darken-6">Update</button>
                </div>
            </div>
            </form>
        </div>
        <div class="col s2 offset-s1">
            <div class="row">
                <?php if($school->status ==1 ){
                        $status = '<strong style="color:green">Ongoing</strong>';
                    }else{
                        $status = '<strong style="color:red">Paused</strong>';
                    }
                ?>
                <p for="school_year">School Enrollment Status : {!! $status !!}</p>
                @if($school->status == 1)
                <button type="button" data-value="0" class="btn-enroll btn blue">Pause Enrollment</button>
                @else
                <button type="button" data-value="1" class="btn-enroll btn green">Start Enrolllment</button>
                @endif
            </div>
            <div class="row">
                <p>Note: End school year will clear all the pending applicants and will set all the students in the database as (old students). And will not be able to see in the reports/dashboard and in the student list</p>
                <button type="button" id="btn-end-school" class="btn red">End School Year</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
@section('customjs')
<script type="text/javascript">
    $(function(){
        $('#school_year').mask('0000-0000');
    });

    $('#update').confirm({
        title: 'Please Authenticate Yourself!',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Enter password here</label>' +
        '<input type="password" placeholder="Password" class="name form-control" id="password" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var password = this.$content.find('#password').val();
                    if(!password){
                        $.alert('Provide a password');
                        return false;
                    }

                    $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{route('admin-data')}}",
                    data: {"_token": "{{ csrf_token() }}",data:password},
                    success: function(data) {
                      if (data.status == 1) {
                            var data = $('#form-school').serialize();
                             $.ajaxSetup({
                                headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                              });
                            $.ajax({
                                type: "POST",
                                cache: false,
                                url : "{{route('update-school-data')}}",
                                data: data,
                                success: function(data) {
                                    console.log(data);
                                    if (data.status == 1) {
                                    window.Materialize.toast(data.message,2000);
                                    }else if(data.status == 2){
                                        $.each(data.message,function(i,val){
                                            window.Materialize.toast(val,3000);
                                        });
                                    }else{
                                    // location.reload();
                                  }
                                }
                           });
                      }else{
                        window.Materialize.toast(data.message,2000);
                      }
                    }
                   });
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                 
                e.preventDefault();
                // jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });


    $('.btn-enroll').confirm({
        title: 'Please Authenticate Yourself!',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Enter password here</label>' +
        '<input type="password" placeholder="Password" class="name form-control" id="password" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var password = this.$content.find('#password').val();
                    if(!password){
                        $.alert('Provide a password');
                        return false;
                    }

                    $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{route('admin-data')}}",
                    data: {"_token": "{{ csrf_token() }}",data:password},
                    success: function(data) {
                      if (data.status == 1) {
                             $.ajaxSetup({
                                headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                              });
                            $.ajax({
                                type: "POST",
                                cache: false,
                                url : "{{route('update-enrollment')}}",
                                data: {"_token": "{{ csrf_token() }}"},
                                success: function(data) {
                                  if (data.status == 1) {
                                    location.reload();
                                  }else{
                                    window.Materialize.toast('Sorry, Please try again.',2000);
                                  }
                                }
                           });
                      }else{
                        window.Materialize.toast(data.message,2000);
                      }
                    }
                   });
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                 
                e.preventDefault();
                // jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

    $('#btn-end-school').confirm({
        title: 'Please Authenticate Yourself!',
        content: '' +
        '<form action="" class="formName">' +
        '<div class="form-group">' +
        '<label>Enter password here</label>' +
        '<input type="password" placeholder="Password" class="name form-control" id="password" required />' +
        '</div>' +
        '</form>',
        buttons: {
            formSubmit: {
                text: 'Submit',
                btnClass: 'btn-blue',
                action: function () {
                    var password = this.$content.find('#password').val();
                    if(!password){
                        $.alert('Provide a password');
                        return false;
                    }

                    $.ajax({
                    type: "POST",
                    cache: false,
                    url : "{{route('admin-data')}}",
                    data: {"_token": "{{ csrf_token() }}",data:password},
                    success: function(data) {
                      if (data.status == 1) {
                             $.ajaxSetup({
                                headers: {
                                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                              });
                            $.ajax({
                                type: "POST",
                                cache: false,
                                url : "{{route('end-school-year')}}",
                                data: {"_token": "{{ csrf_token() }}"},
                                success: function(data) {
                                  if (data.status == 1) {
                                    location.reload();
                                  }else{
                                    window.Materialize.toast('Sorry, Please try again.',2000);
                                  }
                                }
                           });
                      }else{
                        window.Materialize.toast(data.message,2000);
                      }
                    }
                   });
                }
            },
            cancel: function () {
                //close
            },
        },
        onContentReady: function () {
            // bind to events
            var jc = this;
            this.$content.find('form').on('submit', function (e) {
                 
                e.preventDefault();
                // jc.$$formSubmit.trigger('click'); // reference the button and click it
            });
        }
    });

</script>
@stop