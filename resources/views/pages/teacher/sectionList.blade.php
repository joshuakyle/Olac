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
        <table class="striped highlight centered" id ="myTable">
            <thead>
              <tr>
                <th>Time</th>
                <th>Year Level</th>
                <th>Subject</th>
                <th>Section</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if(!is_null($schedules))
              @foreach($schedules as $schedule)
              <?php
                $section  = $schedule->section();
                $subject  = $schedule->subject();
              ?>
              <tr class="{{ strtolower(str_replace(' Year', '', getYearText($subject->year)))}}">
                <td>{{$schedule->schedule_name}}</td>
                <td>{{ getYearText($subject->year)}}</td>
                <td >{{ $subject->subject_name}}</td>
                <td>{{ $section->section_name}}</td>
                <td class="">
                    <form method="post" action="{{route('attendance')}}">
                      @csrf
                      <input type="hidden" name="schedule_id" value="{{ $schedule->schedule_id  }}">
                      <button type="submit" class="btn waves-effectinfo-trigger green darken-3">
                        Start Attendance
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
</div>
@endsection
