@extends('layouts.app')
@section('bgcolor')
bgcolor
@endsection
@section('content')
<div class="container" style="width:49%">
	<div class="col s8 offset-s2">
		<div style="margin-top: 6%;">
			<div class="row">
				<div class="col s6">
					<div class="card-panel">
						<div class="row">
							<div style="margin: auto;">
								<h5>Hello, {{ $student->guardian_name }}</h5>
								<p>Payment here</p>
								<form method="POST" action="{{ route('download-pdf') }}">
									@csrf
								<input value="{{ $student->id }}"" name="id" type="hidden">
								<button type="submit" class="btn">Download Registration Form</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>			
		</div>
	</div>
</div>
</div>

@endsection
@section('customjs')
<script type="text/javascript">
@if(session('status'))
  window.Materialize.toast('{{session('status')}}',5000);
@endif
@foreach ($errors->all() as $error)
  window.Materialize.toast('{{$error}}',5000);
@endforeach
</script>
@endsection