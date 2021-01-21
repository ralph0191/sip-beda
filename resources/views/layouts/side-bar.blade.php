<!-- New Side Bar -->
<div class="sidebar" data-color="red">
  <div class="logo">
    <img src="{{asset('images/Logo.png')}}" alt="SIP SBCA" class="simple-text logo-normal siplogo">
  </div>
  <div class="logo">
    <img src="{{asset('images/me.jpg')}}" alt="SIP SBCA" class="simple-text logo-normal profilepic">
    <center> 
      <h5 style="color:white; font-family:AgencyFB; font-style:Wide Black; font-size:18px;">
        @if (Auth::user()->role_id == Status::STUDENT) 
          {{ Auth::user()->student->student_number}} 
        @elseif (Auth::user()->role_id == Status::SIP)
          {{ Auth::user()->sip->employee_number}}
        @elseif (Auth::user()->role_id == Status::DEPT_CHAIR)
          {{ Auth::user()->deptChair->employee_number}}
        @endif 
        <br/>
        @if (Auth::user()->role_id == Status::STUDENT) 
          {{Auth::user()->last_name . ',' . Auth::user()->first_name}}
        @elseif (Auth::user()->role_id == Status::SIP)
          {{ Auth::user()->sip->employee_number}}
        @elseif (Auth::user()->role_id == Status::DEPT_CHAIR)
          {{ Auth::user()->deptChair->employee_number}}
        @endif 
      </h5> 
    </center>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        @if (Auth::user()->role_id == Status::STUDENT)
          <li class="active ">
            <a href="/home"><i class="now-ui-icons files_box"></i><p style="font-size:14px;">Dashboard</p></a>  
          </li>
          @if (Auth::user()->student->studentProgress->read_form == Status::NOT_STARTED)
            <li class="active ">
              <a href="/student/intent-form">
                <i class="now-ui-icons files_box"></i>
                <p style="font-size:14px;">Intent Form</p>
              </a>
            </li>
          @elseif (Auth::user()->student->studentProgress->read_form == Status::APPROVED && Auth::user()->student->studentProgress->pre_internship_progress == Status::PENDING)
            <li class="active ">
              <a href="/student/pre-internship">
                <i class="now-ui-icons files_box"></i>
                <p style="font-size:14px;">Pre-Internship</p>
              </a>
            </li>
          @elseif (Auth::user()->student->studentProgress->during_internship_progress == Status::PENDING)
            <li class="active ">
              <a href="/student/during-internship">
                <i class="now-ui-icons files_box"></i>
                <p style="font-size:14px;">During Internship</p>
              </a>
            </li>
          @elseif (Auth::user()->student->studentProgress->end_internship_progress == Status::PENDING)
            <li class="active ">
              <a href="/student/end-internship">
                <i class="now-ui-icons files_box"></i>
                <p style="font-size:14px;">End of Internship</p>
              </a>
            </li>
          @endif
        @elseif (Auth::user()->role_id == Status::SIP)
          <li class="active ">
            <a href="/home">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Dashboard</p>
            </a>
          </li>
          <li class="active ">
            <a href="/sip/pre-internship-table">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Pre Internship</p>
            </a>
          </li>
          <li class="active ">
            <a href="/sip/during-internship">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">During Internship</p>
            </a>
          </li>
          <li class="active ">
            <a href="/sip/end-internship-table">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Post Internship</p>
            </a>
          </li>
          
          <li class="active ">
            <a href="/sip/dept-chairs">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Dept Chairs</p>
            </a>
          </li>
        @elseif (Auth::user()->role_id == Status::DEPT_CHAIR)
          <li class="active ">
            <a href="/dept-chair/intent-form">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Intent Form</p>
            </a>
          </li>
          <li class="active ">
            <a href="/dept-chair/during-internship">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">During Internship</p>
            </a>
          </li>
          <li class="active ">
            <a href="/dept-chair/end-internship">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">End of Internship</p>
            </a>
          </li>
          {{-- <a href="/home" class="list-group-item list-group-item-action">Dashboard</a>
          <a href="/sip/pre-internship-table" class="list-group-item list-group-item-action ">Pre-Internship</a>
          <a href="/sip/during-internship" class="list-group-item list-group-item-action ">During-Internship</a>
          <a href="/sip/end-internship-table" class="list-group-item list-group-item-action ">Post-Internship</a> --}}
          {{-- <a href="#" class="list-group-item list-group-item-action ">Dept-Chairs</a> --}}
        {{-- @elseif (Auth::user()->role_id == Status::DEPT_CHAIR)
          <a href="/dept-chair/intent-form" class="list-group-item list-group-item-action ">Intent-Forms</a>
          <a href="/dept-chair/during-internship" class="list-group-item list-group-item-action ">During Internship</a>
          <a href="#" class="list-group-item list-group-item-action ">End of Internship</a> --}}
        @endif
    </ul>
  </div>
</div>