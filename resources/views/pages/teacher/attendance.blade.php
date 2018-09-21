@extends('layouts.nav')

@section('content')
<div class="row">
  <div class="col s12">
  <input type="hidden" value="{{ $schedule_id }}" id="schedule_id"/>
  <div class="row">
    <div class="camera-box">
      <div id="reader" style="width:300px;height:250px"></div>
      <div class="row">
        <div id="message" class="text-center"></div>
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