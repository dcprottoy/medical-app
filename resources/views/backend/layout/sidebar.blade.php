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
            <a href="{{route('brand-image.home')}}" class="nav-link {{ Route::currentRouteName() == 'brand-image.home'||Route::currentRouteName() == 'brand-image.create'||Route::currentRouteName() == 'brand-image.edit' ? 'active' : ''}}" >
                <i class="nav-icon fab fa-forumbee"></i>
              <p>
                Brand Image
              </p>
            </a>
          </li> -->
          <li class="nav-item menu-open">
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('doctors.home')}}" class="nav-link {{ Route::currentRouteName() == 'doctors.home'||Route::currentRouteName() == 'doctors.create'||Route::currentRouteName() == 'doctors.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-user"></i>
                        <p>
                            Profile
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Application Setup -->
            <li class="nav-item ">
                <a href="#" class="nav-link">
                <i class="nav-icon fab fa-app-store"></i>
                <p>Application Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('servicecategory.home')}}" class="nav-link {{ Route::currentRouteName() == 'servicecategory.home'||Route::currentRouteName() == 'servicecategory.create'||Route::currentRouteName() == 'servicecategory.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Service Category</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('investigationequipments.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationequipments.home'||Route::currentRouteName() == 'investigationequipments.create'||Route::currentRouteName() == 'investigationequipments.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Equipment</p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Appointment Setup -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-sticky-note"></i>
                <p>Appointment Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('appointtype.home')}}" class="nav-link {{ Route::currentRouteName() == 'appointtype.home'||Route::currentRouteName() == 'appointtype.create'||Route::currentRouteName() == 'appointtype.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Appointment Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appointfee.home')}}" class="nav-link {{ Route::currentRouteName() == 'appointfee.home'||Route::currentRouteName() == 'appointfee.create'||Route::currentRouteName() == 'appointfee.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Appointment Fee</p>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- Investigation Setup -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-search-location"></i>
                <p>Investigation Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('investigationtype.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationtype.home'||Route::currentRouteName() == 'investigationtype.create'||Route::currentRouteName() == 'investigationtype.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Investigation Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('investigationgroup.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationgroup.home'||Route::currentRouteName() == 'investigationgroup.create'||Route::currentRouteName() == 'investigationgroup.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Investigation Group</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('investigationmain.home')}}" class="nav-link {{ Route::currentRouteName() == 'investigationmain.home'||Route::currentRouteName() == 'investigationmain.create'||Route::currentRouteName() == 'investigationmain.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Investigation</p>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- Service Setup -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user-nurse"></i>
                <p>Service Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('servicetype.home')}}" class="nav-link {{ Route::currentRouteName() == 'servicetype.home'||Route::currentRouteName() == 'servicetype.create'||Route::currentRouteName() == 'servicetype.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Service Type</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('service.home')}}" class="nav-link {{ Route::currentRouteName() == 'service.home'||Route::currentRouteName() == 'service.create'||Route::currentRouteName() == 'service.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Service</p>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- Prescription Setup -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa-file-word"></i>
                <p>Prescription Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('advices.home')}}" class="nav-link {{ Route::currentRouteName() == 'advices.home'||Route::currentRouteName() == 'advices.create'||Route::currentRouteName() == 'advices.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Advices</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('diagnosis.home')}}" class="nav-link {{ Route::currentRouteName() == 'diagnosis.home'||Route::currentRouteName() == 'diagnosis.create'||Route::currentRouteName() == 'diagnosis.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Diagnosis</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('examination.home')}}" class="nav-link {{ Route::currentRouteName() == 'examination.home'||Route::currentRouteName() == 'examination.create'||Route::currentRouteName() == 'examination.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Examination</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('referred.home')}}" class="nav-link {{ Route::currentRouteName() == 'referred.home'||Route::currentRouteName() == 'referred.create'||Route::currentRouteName() == 'referred.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Referred</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('usage.home')}}" class="nav-link {{ Route::currentRouteName() == 'usage.home'||Route::currentRouteName() == 'usage.create'||Route::currentRouteName() == 'usage.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Usage</p>
                        </a>
                    </li><li class="nav-item " >
                        <a href="{{route('dose.home')}}" class="nav-link {{ Route::currentRouteName() == 'dose.home'||Route::currentRouteName() == 'dose.create'||Route::currentRouteName() == 'dose.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Dose</p>
                        </a>
                    </li><li class="nav-item " >
                        <a href="{{route('doseduration.home')}}" class="nav-link {{ Route::currentRouteName() == 'doseduration.home'||Route::currentRouteName() == 'doseduration.create'||Route::currentRouteName() == 'doseduration.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Dose Duration</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('complaint.home')}}" class="nav-link {{ Route::currentRouteName() == 'complaint.home'||Route::currentRouteName() == 'complaint.create'||Route::currentRouteName() == 'complaint.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Complaint</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('complaintduration.home')}}" class="nav-link {{ Route::currentRouteName() == 'complaintduration.home'||Route::currentRouteName() == 'complaintduration.create'||Route::currentRouteName() == 'complaintduration.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Complaint Duration</p>
                        </a>
                    </li>
                </ul>
            </li>
             <!-- Hospital Management -->
            <li class="nav-item">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-h-square"></i>
                <p>Hospital Management
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('doctors.home')}}" class="nav-link {{ Route::currentRouteName() == 'doctors.home'||Route::currentRouteName() == 'doctors.create'||Route::currentRouteName() == 'doctors.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Doctors</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('patients.home')}}" class="nav-link {{ Route::currentRouteName() == 'patients.home'||Route::currentRouteName() == 'patients.create'||Route::currentRouteName() == 'patients.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Patients</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('departments.home')}}" class="nav-link {{ Route::currentRouteName() == 'departments.home'||Route::currentRouteName() == 'departments.create'||Route::currentRouteName() == 'departments.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Departments</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appoinments.home')}}" class="nav-link {{ Route::currentRouteName() == 'appoinments.home'||Route::currentRouteName() == 'appoinments.create'||Route::currentRouteName() == 'appoinments.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-calendar-check"></i>
                            <p>Appoinments</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('appointed.home')}}" class="nav-link {{ Route::currentRouteName() == 'appointed.home'||Route::currentRouteName() == 'appointed.create'||Route::currentRouteName() == 'appointed.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                        <p>
                            Today Appointments
                        </p>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- Billing Setup -->
            <li class="nav-item ">
                <a href="#" class="nav-link">
                <i class="nav-icon fas fa-cash-register"></i>
                <p>Billing Setup
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item " >
                        <a href="{{route('billing.home')}}" class="nav-link {{ Route::currentRouteName() == 'billing.home'||Route::currentRouteName() == 'billing.create'||Route::currentRouteName() == 'billing.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Billing</p>
                        </a>
                    </li>
                    <li class="nav-item " >
                        <a href="{{route('duecollection.home')}}" class="nav-link {{ Route::currentRouteName() == 'duecollection.home'||Route::currentRouteName() == 'duecollection.create'||Route::currentRouteName() == 'duecollection.edit' ? 'active' : ''}}" >
                            <i class="nav-icon fas fa-angle-double-right"></i>
                            <p>Due Collection</p>
                        </a>
                    </li>
                </ul>
            </li>
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
