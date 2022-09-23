
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="height: 100vh">

    <!-- System title and logo -->
    <a href="{{ route('dashboard') }}" class="brand-link">
        <img src="{{ asset('public/images/pricon_logo2.png') }}"
            alt="OITL"
            class="brand-image img-circle elevation-3"
            style="opacity: .8">

        <span class="brand-text font-weight-light font-size"><h5>JSOX System</h5></span>
    </a> <!-- System title and logo -->

    <!-- Sidebar -->
    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview">
                    <a href="{{ url('../RapidX') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-left"></i>
                        <p>Return to RapidX</p>
                    </a>
                </li>

                <li class="nav-item has-treeview" id="dashboard">
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p><strong>Dashboard</strong></p>
                    </a>
                </li>

                <li class="nav-header font-weight-bold"><strong>Administrator Management</strong></li>
                <li class="nav-item has-treeview d-none" id="user_management_id">
                    <a href="{{ route('user_management') }}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>User Mananagement</p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item has-treeview d-none" id="plc_category_id" >
                    <a href="{{ route('plc_category') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>PLC Listing</p>
                    </a>
                </li>

                <li class="nav-item has-treeview d-none" id="jsox_plc_matrix_id">
                    <a href="{{ route('jsox_plc_matrix') }}" class="nav-link">
                        <i class="nav-icon fas fa-clipboard"></i>
                        <p>Sample Matrix</p>
                    </a>
                </li>

                <li class="nav-item has-treeview d-none" id="plc_dashboard_id">
                    <a href="{{ route('plc_dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>3-Sets Documents</p>
                    </a>
                </li>

                <li class="nav-item has-treeview d-none" id="plc_evidences_id">
                    <a href="{{ route('plc_evidences') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-download"></i>
                        <p>Evidences</p>
                    </a>
                </li>

                <li class="nav-item has-treeview">
                    <a href="{{ route('plc_capa') }}" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <span>Corrective/Preventive <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Action (CAPA)</span>
                    </a>
                </li>

                <li class="nav-item has-treeview d-none" id="analytics_id">
                    <a href="{{ route('analytics') }}" class="nav-link">
                        <i class="nav-icon fas fa-folder"></i>
                        <p>Analytics</p>
                    </a>
                </li>

                <li class="nav-header"></li>
                <li class="nav-item has-treeview d-none" id="clc_category_id">
                    <a href="{{ route('clc_category') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <span>CLC / FCRP / IT-CLC <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Listing</span>
                    </a>
                </li>

                <li class="nav-item has-treeview d-none" id="clc_dashboard_id">
                    <a href="{{ route('clc_dashboard') }}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <span>RCM / Self-assessment</span>
                    </a>
                </li>

                <li class="nav-item has-treeview d-none" id="clc_evidences_id">
                    <a href="{{ route('clc_evidences') }}" class="nav-link">
                        <i class="nav-icon fas fa-file-download"></i>
                        <span>Evidences </span>
                    </a>
                </li>
            </ul>
        </nav>
    </div><!-- Sidebar -->
</aside>
