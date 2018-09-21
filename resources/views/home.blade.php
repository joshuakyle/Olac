@extends('layouts.nav')

@section('content')
<div class="container">
    <div class="row justify-content-center">
          <div class="col s4 ">
            <div class="card-panel blue lighten-5 z-depth-1">
              <div class="valign-wrapper">
                <div class="col s2">
                  <i class="material-icons medium">people</i>
                </div>
                <div class="col s10">
                  <span class="black-text" style="font-size: 20px;">
                    Enrolled Students : {{ $student_confirmed }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card-panel blue lighten-5 z-depth-1">
              <div class="valign-wrapper">
                <div class="col s2">
                  <i class="material-icons medium">people_outline</i>
                </div>
                <div class="col s10">
                  <span class="black-text" style="font-size: 20px;">
                    Unconfirmed Students : {{ $student_unconfirmed }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card-panel blue lighten-5 z-depth-1">
              <div class="valign-wrapper">
                <div class="col s2">
                  <i class="material-icons medium">people</i>
                </div>
                <div class="col s10">
                  <span class="black-text" style="font-size: 20px;">
                    Total Students : {{ $total_students }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          </div>
          <div class="row">
          <div class="col s4">
            <div class="card-panel blue lighten-5 z-depth-1">
              <div class="valign-wrapper">
                <div class="col s2">
                  <i class="material-icons medium">account_box</i>
                </div>
                <div class="col s10">
                  <span class="black-text" style="font-size: 20px;">
                    Teachers : {{ $teacher }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card-panel blue lighten-5 z-depth-1">
              <div class="valign-wrapper">
                <div class="col s2">
                  <i class="material-icons medium">layers</i>
                </div>
                <div class="col s10">
                  <span class="black-text" style="font-size: 20px;">
                    Subject : {{ $subject }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col s4">
            <div class="card-panel blue lighten-5 z-depth-1">
              <div class="valign-wrapper">
                <div class="col s2">
                  <i class="material-icons medium">view_comfy</i>
                </div>
                <div class="col s10">
                  <span class="black-text" style="font-size: 20px;">
                    Section : {{ $section }}
                  </span>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
@endsection
