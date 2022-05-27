<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
      
      <li class="nav-item">
        <a class="nav-link " href="{{url('home')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link " href="{{url('employee')}}">
          <i class="bi bi-circle"></i>
          <span>Employee</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminTechnology')}}">
            <i class="bi bi-menu-button-wide"></i><span> Technology </span>
            </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProject')}}">
        <i class="bi bi-card-list"></i><span> Project </span>
        </a>
        
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="bi bi-file-earmark"></i><span> Project Allotment </span>
        </a>
        
    </li>
	
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="bi bi-file-earmark"></i><span> Project Milestones </span>
        </a>    
    </li>
	
	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="bi bi-file-earmark"></i><span> Task Allotment </span>
        </a>    
    </li>

	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="bi bi-file-earmark"></i><span> Daily Work Entry </span>
        </a>    
    </li>

	<li class="nav-item">
        <a class="nav-link collapsed"  href="{{url('AdminProjectAllotment')}}">
        <i class="bi bi-file-earmark"></i><span> Attendance </span>
        </a>    
    </li>
	
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Leave</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('all_leave')}}">
              <i class="bi bi-circle"></i><span>Leave</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

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