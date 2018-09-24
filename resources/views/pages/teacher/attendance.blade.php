@extends('layouts.nav')

@section('content')
<div class="row">
  <div class="col s12">
  <div class="row">
    <div class="camera-box">
      <div id="reader" style="width:300px;height:250px"></div>
      <div class="row">
        <div id="message" class="text-center"></div>
      </div>
      <div class="row">
        <form method="POST" action="{{ route('end-attendance')}}">
          @csrf
          <input type="hidden" value="{{ $schedule_id }}" id="schedule_id" name="schedule_id"/>
          <input type="hidden" value="{{ $schedule->subject()->id }}" id="subject_id" name="subject_id"/>
          <input type="hidden" value="{{ $schedule->section()->id }}" id="section_id" name="section_id"/>
        <button class="btn red">End Attendance</button>
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
  var val = $('#schedule_id').val();
  $('#message').html('<span class="text-success send-true">Scanning now....1</span>');
  if (data!='') {
   $.ajax({
    type: "POST",
    cache: false,
    url : "{{route('checkUser')}}",
    data: {"_token": "{{ csrf_token() }}",data:data,"id":val},
    success: function(data) {
      if (data.status == 1) {
        window.Materialize.toast(data.message,2000);
      }else{
        window.Materialize.toast(data.message,2000);
        // $(location).attr('href', '{{url('/')}}');
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
</script>
@endsection