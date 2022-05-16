<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="{{url('userhome')}}">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

		<li class="nav-item">
            <a class="nav-link collapsed"  href="Technology">
            <i class="bi bi-menu-button-wide"></i><span> Technology </span>
            </a>
            
        </li>
		
		<li class="nav-item">
            <a class="nav-link collapsed"  href="Project">
            <i class="bi bi-card-list"></i><span> Project </span>
            </a>
            
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed"  href="ProjectAllotment">
            <i class="bi bi-file-earmark"></i><span> Project Allotment </span>
            </a>
            
        </li>

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>leave</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('leave')}}">
              <i class="bi bi-circle"></i><span>Leave</span>
            </a>
          </li>
          {{-- <li>
            <a href="{{url('addleave')}}">
              <i class="bi bi-circle"></i><span>Add Leave</span>
            </a>
          </li> --}}
        </ul>
      </li><!-- End Components Nav -->
{{-- 
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-journal-text"></i><span>Forms</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="forms-elements.html">
              <i class="bi bi-circle"></i><span>Form Elements</span>
            </a>
          </li>
        </ul>
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Tables</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="tables-general.html">
              <i class="bi bi-circle"></i><span>General Tables</span>
            </a>
          </li>
          <li>
            <a href="tables-data.html">
              <i class="bi bi-circle"></i><span>Data Tables</span>
            </a>
          </li>
        </ul>
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#charts-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-bar-chart"></i><span>Charts</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="charts-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="charts-chartjs.html">
              <i class="bi bi-circle"></i><span>Chart.js</span>
            </a>
          </li>
        </ul>
      </li><!-- End Charts Nav --> --}}

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#icons-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-gem"></i><span>Daily Work Entry</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="icons-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{url('daily_work_entry')}}">
              <i class="bi bi-circle"></i><span>Daily Work Entry</span>
            </a>
          </li>
          {{-- <li>
            <a href="{{url('addwork')}}">
              <i class="bi bi-circle"></i><span>Add Work</span>
            </a>
          </li> --}}
        </ul>
      </li><!-- End Icons Nav -->

        <li class="nav-item">
            <a class="nav-link collapsed"  href="Attendance">
            <i class="bi bi-calendar-check"></i><span> Attendance </span>
            </a>
            
        </li>

      {{-- <li class="nav-item">
        <a class="nav-link collapsed" href="Dashboard">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
        </a>
    </li> --}}

   



    </ul>

  </aside>