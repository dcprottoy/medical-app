<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="{{asset('backend/adminlte/dist/img/AdminLTELogo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Alif Medical Centre</span>
    </a>
    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('backend/adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li> -->
          <!-- <li class="nav-item " >
            <a href="{{route('brand-image.home')}}" class="nav-link {{ Route::currentRouteName() == 'brand-image.home'||Route::currentRouteName() == 'brand-image.create'||Route::currentRouteName() == 'brand-image.edit' ? "active" : ""}}" >
                <i class="nav-icon fab fa-forumbee"></i>
              <p>
                Brand Image
              </p>
            </a>
          </li> -->
          <li class="nav-item menu-open">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>DOCTOR'S PANNEL
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('doctors.home')}}" class="nav-link {{ Route::currentRouteName() == 'doctors.home'||Route::currentRouteName() == 'doctors.create'||Route::currentRouteName() == 'doctors.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                        <p>
                            Profile
                        </p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appointed.home')}}" class="nav-link {{ Route::currentRouteName() == 'appointed.home'||Route::currentRouteName() == 'appointed.create'||Route::currentRouteName() == 'appointed.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-procedures"></i>
                        <p>
                            Today Appointments
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
          <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Hospital Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('doctors.home')}}" class="nav-link {{ Route::currentRouteName() == 'doctors.home'||Route::currentRouteName() == 'doctors.create'||Route::currentRouteName() == 'doctors.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Doctors</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('patients.home')}}" class="nav-link {{ Route::currentRouteName() == 'patients.home'||Route::currentRouteName() == 'patients.create'||Route::currentRouteName() == 'patients.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>Patients</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('departments.home')}}" class="nav-link {{ Route::currentRouteName() == 'departments.home'||Route::currentRouteName() == 'departments.create'||Route::currentRouteName() == 'departments.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>Departments</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appoinments.home')}}" class="nav-link {{ Route::currentRouteName() == 'appoinments.home'||Route::currentRouteName() == 'appoinments.create'||Route::currentRouteName() == 'appoinments.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Appoinments</p>
                        </a>
                    </li>
                </ul>
          </li>
          <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Prescription Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('advices.home')}}" class="nav-link {{ Route::currentRouteName() == 'advices.home'||Route::currentRouteName() == 'advices.create'||Route::currentRouteName() == 'advices.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Advices</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('diagnosis.home')}}" class="nav-link {{ Route::currentRouteName() == 'diagnosis.home'||Route::currentRouteName() == 'diagnosis.create'||Route::currentRouteName() == 'diagnosis.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Diagnosis</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('complaint.home')}}" class="nav-link {{ Route::currentRouteName() == 'complaint.home'||Route::currentRouteName() == 'complaint.create'||Route::currentRouteName() == 'complaint.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Complaint</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('complaintduration.home')}}" class="nav-link {{ Route::currentRouteName() == 'complaintduration.home'||Route::currentRouteName() == 'complaintduration.create'||Route::currentRouteName() == 'complaintduration.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Complaint Duration</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appointtype.home')}}" class="nav-link {{ Route::currentRouteName() == 'appointtype.home'||Route::currentRouteName() == 'appointtype.create'||Route::currentRouteName() == 'appointtype.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Appointment Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appointfee.home')}}" class="nav-link {{ Route::currentRouteName() == 'appointfee.home'||Route::currentRouteName() == 'appointfee.create'||Route::currentRouteName() == 'appointfee.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Appointment Fee</p>
                        </a>
                    </li>
                </ul>
          </li>

          <!-- Investigation Setup Start -->
          <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>Investigation Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('investigationequipments.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationequipments.home'||Route::currentRouteName() == 'investigationequipments.create'||Route::currentRouteName() == 'investigationequipments.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Equipment</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('investigationtype.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationtype.home'||Route::currentRouteName() == 'investigationtype.create'||Route::currentRouteName() == 'investigationtype.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>Investigation Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('investigationmain.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationmain.home'||Route::currentRouteName() == 'investigationmain.create'||Route::currentRouteName() == 'investigationmain.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-procedures"></i>
                            <p>Investigation</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appoinments.home')}}" class="nav-link {{ Route::currentRouteName() == 'appoinments.home'||Route::currentRouteName() == 'appoinments.create'||Route::currentRouteName() == 'appoinments.edit' ? "active" : ""}}" >
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Appoinments</p>
                        </a>
                    </li>
                </ul>
          </li>
          <!-- Investigation Setup End -->

          <!-- Log Out Button Start -->
          <li class="nav-item">

            <a href="{{route('logout.get')}}" class="nav-link">
            <i class="nav-icon fas fa-sign-in-alt"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
          <!-- Log Out Button End -->

        </ul>
      </nav>
    </div>
  </aside>
