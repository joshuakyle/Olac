@extends('layouts.app')
@section('bgcolor')
bgcolor
@endsection
@section('content')
<div id="wrapper">
    <div class="row">
        <div class="col s4 ">
            <div id="login_div" style="max-width: 339px;    margin-top: 5%;">
                    <img class="circle logo" src="{{asset('img/olac-logo.jpg')}}">
                    <br/>
                    <br/>
            <div class="row" id="qr">
            <center>
                <div class="camera-box">
                  <div id="reader"  style="width:300px;height:250px;background-color: #eee"></div>
                  <div class="row">
                    <div id="message" class="text-center" style="margin: auto;">Put your ID's QR Code on the Camera's view.</div>
                  </div>
                </div>
            </center>
            <hr/>
            <button class="btn waves-effect" id="qr-btn">Login with Student Number</button>
            </div>
            <div id="credentials" class="row">
               <form id="student-login-form" style="margin:auto;">
                <div class="login input-field text-left">
                      <i class="material-icons prefix">person</i>
                      <input id="student_number" type="text" class=" form-control" data-error="{{ $errors->has('username') ? 'wrong' : '' }}" name="student_number" value="{{ old('username') }}" required autofocus>
                     
                       <label for="student_number" >Student Number</label>
                  </div>
                  <div class=" login input-field text-left">
                      <i class="material-icons prefix">lock_outline</i>
                          <input id="pin" type="password" class=" form-control" data-error="{{ $errors->has('pin') ? 'wrong' : '' }}" name="pin" required>
                          <label for="pin">PIN</label>
                  </div>
                  <div class="form-group">
                          <div style="">
                              <button type="button" id="btn-student-login" class="btn waves-effect waves-light blue darken-3">Check Grades</button>
                          </div>
                      </div>
               </form>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('customjs')
<script type="text/javascript" src="{{ asset('js/jsqrcode-combined.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/html5-qrcode.min.js') }}"></script>
<script type="text/javascript">
 $('#reader').html5_qrcode(function(data){
  $('#message').html('<span class="text-success send-true">Scanning now....1</span>');
  if (data!='') {
   $.ajax({
    type: "POST",
    cache: false,
    url : "{{route('studentGrade')}}",
    data: {"_token": "{{ csrf_token() }}",data:data},
    success: function(data) {
      console.log(data);
      if (data.status == 1) {
        window.location.href = data.redirect;
      }else{
        window.Materialize.toast(data.message,2000);
      }
    }
   });
 }else{return confirm('There is no  data');}
},
function(error){
  $('#message').html('Scan here'  );
}, function(videoError){
    window.Materialize.toast('There was a problem with your camera ');
}
);

$(function(){
  $('#credentials').hide();
  $('#qr-btn').click(function(){
    $('#qr').hide(1000);
    $('#credentials').show(1000);
  });
  $('#btn-student-login').click(function(){
    var id = $('#student_number').val(),
    pin = $('#pin').val();
     $.ajax({
    type: "POST",
    cache: false,
    url : "{{route('studentGradeLogin')}}",
    data: {"_token": "{{ csrf_token() }}",'id':id,'pin':pin},
    success: function(data) {
      console.log(data);
      if (data.status == 1) {
        window.location.href = data.redirect;
      }else{
        window.Materialize.toast(data.message,2000);
      }
    }
   });
  });
});
</script>
@endsection