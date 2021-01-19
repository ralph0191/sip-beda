<div class="border-right" id="sidebar-wrapper">
    <div style="background-color:#980e0e; " class="sidebar-heading"><img src="{{asset('images/sbcalogo.png')}}" alt="SBCA" style="height: 1.5rem; width: 11rem;"> </div>
      <div class="list-group list-group-flush">
      
        @if (Auth::user()->role_id == Status::STUDENT)
          <a href="/home" class="list-group-item list-group-item-action">Dashboard</a>
          @if (Auth::user()->student->studentProgress->read_form == Status::NOT_STARTED)
            <a href="/student/intent-form" class="list-group-item list-group-item-action ">Intent-Form</a>
          @elseif (Auth::user()->student->studentProgress->read_form == Status::APPROVED && Auth::user()->student->studentProgress->pre_internship_progress == Status::PENDING)
            <a href="/student/pre-internship" class="list-group-item list-group-item-action ">Pre-Internship</a>
          @elseif (Auth::user()->student->studentProgress->during_internship_progress == Status::PENDING)
            <a href="/student/during-internship" class="list-group-item list-group-item-action ">During-Internship</a>
          @elseif (Auth::user()->student->studentProgress->end_internship_progress == Status::PENDING)
          
          @endif
        @elseif (Auth::user()->role_id == Status::SIP)
          <a href="/home" class="list-group-item list-group-item-action">Dashboard</a>
          <a href="/sip/pre-internship-table" class="list-group-item list-group-item-action ">Pre-Internship</a>
          <a href="#" class="list-group-item list-group-item-action ">During-Internship</a>
          <a href="#" class="list-group-item list-group-item-action ">Post-Internship</a>
          <a href="#" class="list-group-item list-group-item-action ">Dept-Chairs</a>
        @elseif (Auth::user()->role_id == Status::DEPT_CHAIR)
          <a href="/dept-chair/intent-form" class="list-group-item list-group-item-action ">Intent-Forms</a>
          <a href="#" class="list-group-item list-group-item-action ">During Internship</a>
          <a href="#" class="list-group-item list-group-item-action ">End of Internship</a>
        @endif
  </div>
</div>