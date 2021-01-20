<!-- New Side Bar -->
<div class="sidebar" data-color="red">
  <div class="logo">
    <img src="{{asset('images/Logo.png')}}" alt="SIP SBCA" class="simple-text logo-normal siplogo">
  </div>
  <div class="logo">
    <img src="{{asset('images/me.jpg')}}" alt="SIP SBCA" class="simple-text logo-normal profilepic">
    <center> <h5 style="color:white; font-family:AgencyFB; font-style:Wide Black; font-size:18px;"> 2015301118 <br/> San Gabriel, Christ Caezar </h5> </center>
    </div>
    <div class="sidebar-wrapper" id="sidebar-wrapper">
      <ul class="nav">
        @if (Auth::user()->role_id == Status::STUDENT)
          <li class="active ">
            <a href="/home">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Dashboard</p>
            </a>  
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
              <a href="/student/during-internship">
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
            <a href="#">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">During Internship</p>
            </a>
          </li>
          <li class="active ">
            <a href="#">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">Post Internship</p>
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
            <a href="#">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">During Internship</p>
            </a>
          </li>
          <li class="active ">
            <a href="#">
              <i class="now-ui-icons files_box"></i>
              <p style="font-size:14px;">End of Internship</p>
            </a>
          </li>
        @endif
    </ul>
  </div>
</div>