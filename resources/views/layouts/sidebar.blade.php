<aside id="sidebar" class="sidebar" >
    <ul class="sidebar-nav" id="sidebar-nav">
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('home')}}">
          <i class="fa fa-dashboard"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->
      @if (Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('employee')}}">
          <i class="fa fa-users"></i>
          <span>Employee</span>
        </a>
      </li> 
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{url('Technology')}}">
            <i class="fa fa-bars"></i><span> Technology </span>
        </a>       
    </li> 
    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('project')}}">
        <i class="fa fa-list-alt"></i><span> Project </span>
        </a>
    </li>

    @endif
    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('projectAllotement')}}">
        <i class="fa fa-file"></i><span> Project Allotment </span>
        </a>
        
    </li>

	@if (Auth::user()->roles_id == 1)
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('ProjectMilestones')}}">
        <i class="fa fa-road"></i><span> Project Milestones </span>
        </a>    
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed"  href="{{url('Holiday')}}">
      <i class="fa fa-coffee "></i><span> Holiday </span>
      </a>    
   </li>
    @endif

   

    @if (Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3)
    <li class="nav-item">
      <a class="nav-link collapsed"  href="{{url('TaskAllotment')}}">
      <i class="fa fa-book"></i><span> Task Allotment </span>
      </a>    
  </li>
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('DailyWorkEntry')}}">
        <i class="fa fa-edit"></i><span> Daily Work Entry </span>
        </a>    
    </li>

	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('Attendance')}}">
        <i class="fa fa-calendar-check-o"></i><span> Attendance </span>
        </a>    
    </li>
	
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('leave')}}">
        <i class="fa fa fa-comment-o"></i><span> Leave </span>
        </a>    
    </li>
	@endif
 @if (Auth::user()->roles_id == 3)
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-card-list"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="{{url('report_attendance')}}">
          <i class="bi bi-circle"></i><span>Attendance</span>
        </a>
      </li>
      <li>
        <a href="{{url('report_daily_work_entry')}}">
          <i class="bi bi-circle"></i><span>Daily Work Entry</span>
        </a>
      </li>
      <li>
        <a href="{{url('report_project_total_hour')}}">
          <i class="bi bi-circle"></i><span>Project Total Hours</span>
        </a>
      </li>
      <li>
        <a href="charts-chartjs.html">
          <i class="bi bi-circle"></i><span>Leave</span>
        </a>
      </li>
    </ul>
  </li>
  @endif


  @if (Auth::user()->roles_id == 1 || Auth::user()->roles_id == 2)
    <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="fa fa-book"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('report_attendance')}}">
              <i class="fa fa-circle-o"></i><span>Attendance </span>
            </a>
          </li>
          <li>
            <a href="{{url('report_daily_work_entry')}}">
              <i class="fa fa-circle-o"></i><span>Daily Work Entry</span>
            </a>
          </li>
          <li>
            <a href="{{url('report_project_total_hour')}}">
              <i class="bi bi-circle"></i><span>Project Total Hours</span>
            </a>
          </li>
          <!-- <li>
            <a href="{{url('project_summary')}}">
              <i class="fa fa-circle-o"></i><span>Project Summary</span>
            </a>
          </li>
          <li>
            <a href="{{url('employee_summary')}}">
              <i class="fa fa-circle-o"></i><span>Employee Summary</span>
            </a>
          </li>
          <li>
            <a href="{{url('project_history')}}">
              <i class="fa fa-circle-o"></i><span>Project History</span>
            </a>
          </li> 
          <li>
            <a href="charts-chartjs.html">
              <i class="fa fa-circle-o"></i><span>Leave</span>
            </a>
          </li> 
        </ul>
      </li>
       
       @endif
    </ul>

  </aside>