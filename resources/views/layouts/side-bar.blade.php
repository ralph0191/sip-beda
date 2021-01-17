<div class="border-right" id="sidebar-wrapper">
    <div style="background-color:#980e0e; " class="sidebar-heading"><img src="{{asset('images/sbcalogo.png')}}" alt="SBCA" style="height: 1.5rem; width: 11rem;"> </div>
      <div class="list-group list-group-flush">
      @if (Auth::user()->student)
          <a href="/home" class="list-group-item list-group-item-action">Dashboard</a>
          @if (Auth::user()->student->studentProgress->read_form == 0)
            <a href="/student/intent-form" class="list-group-item list-group-item-action ">Intent-Form</a>
          @elseif (Auth::user()->student->studentProgress->read_form == 2)
            <a href="/student/pre-internship" class="list-group-item list-group-item-action ">Pre-Internship</a>
          @endif
          
          
          {{-- <a href="#" class="list-group-item list-group-item-action ">Events</a> --}}
          {{-- <a href="#" class="list-group-item list-group-item-action ">Profile</a>
          <a href="#" class="list-group-item list-group-item-action ">Status</a> --}}
      @elseif (Auth::user()->sip)
        <a href="/home" class="list-group-item list-group-item-action">Dashboard</a>
        <a href="/student/pre-internship" class="list-group-item list-group-item-action ">Pre-Internship</a>
        <a href="/student/pre-internship" class="list-group-item list-group-item-action ">During-Internship</a>
        <a href="/student/pre-internship" class="list-group-item list-group-item-action ">Post-Internship</a>
      @elseif (Auth::user()->deptChair)
        
        {{-- <a href="#" class="list-group-item list-group-item-action ">Overview</a> --}}
        {{-- <a href="#" class="list-group-item list-group-item-action ">Events</a> --}}
        {{-- <a href="#" class="list-group-item list-group-item-action ">Profile</a>
        <a href="#" class="list-group-item list-group-item-action ">Status</a> --}}
      @endif
  </div>
</div>