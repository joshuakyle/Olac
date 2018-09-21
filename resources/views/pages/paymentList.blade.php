@extends('layouts.nav')

@section('content')
<div class="row">
    <div class="col s12">
        @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-success" role="alert">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        
    </div>
    @endif
</div>
</div>
@endsection