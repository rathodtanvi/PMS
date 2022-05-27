<aside id="sidebar" class="sidebar">
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
        <a class="nav-link collapsed" href="{{url('AdminTechnology')}}">
            <i class="bi bi-menu-button-wide"></i><span> Technology </span>
        </a>       
    </li> 
    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProject')}}">
        <i class="bi bi-card-list"></i><span> Project </span>
        </a>
        
    </li>
    @endif
    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="fa fa-book"></i><span> Project Allotment </span>
        </a>
        
    </li>
	@if (Auth::user()->roles_id == 1)
	<li class="nav-item">
        <a class="nav-link collapsed"  href="#">
        <i class="fa fa-road"></i><span> Project Milestones </span>
        </a>    
    </li>
    @endif
	<li class="nav-item">
        <a class="nav-link collapsed"  href="#">
        <i class="bi bi-file-earmark"></i><span> Task Allotment </span>
        </a>    
    </li>
    @if (Auth::user()->roles_id == 2 || Auth::user()->roles_id == 3)
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('daily_work_entry')}}">
        <i class="fa fa-edit"></i><span> Daily Work Entry </span>
        </a>    
    </li>

	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="fa fa-calendar-check-o"></i><span> Attendance </span>
        </a>    
    </li>
	
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('all_leave')}}">
        <i class="fa fa fa-comment-o"></i><span> Leave </span>
        </a>    
    </li>
	

      <!-- <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-card-list"></i><span>Reports</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('admin_report_attendance')}}">
              <i class="bi bi-circle"></i><span>Attendance And Work Duration</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin_report_daily_work_entry')}}">
              <i class="bi bi-circle"></i><span>Daily Work Entry</span>
            </a>
          </li>
          <li>
            <a href="{{url('admin_report_project_total_hour')}}">
              <i class="bi bi-circle"></i><span>Project Total Hours</span>
            </a>
          </li>
          <li>
            <a href="{{url('project_summary')}}">
              <i class="bi bi-circle"></i><span>Project Summary</span>
            </a>
          </li>
          <li>
            <a href="{{url('employee_summary')}}">
              <i class="bi bi-circle"></i><span>Employee Summary</span>
            </a>
          </li>
          <li>
            <a href="{{url('project_history')}}">
              <i class="bi bi-circle"></i><span>Project History</span>
            </a>
          </li>
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Leave</span>
            </a>
          </li>
        </ul>
      </li> -->
      
    </ul>

  </aside>