@php $layout = 'layouts.super_user_layout'; @endphp

{{-- Here I removed the @auth because the dashboard isn't loading properly --}}
@extends($layout)
@section('title', 'Dashboard')

@section('content_page')
    
    {{-- <div class="content-wrapper">
    <div class="container-fluid yes">
        <div>
            <img src="{{ asset('public/images/under construction.gif') }}" style="height:100vh; width:87vw;"> --}}
            {{-- <img src="{{ asset('public/images/background.png') }}" style="height:88vh; width:87vw;">
        </div>
    </div>
    </div> --}}

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="max-height: 77px; overflow: scroll;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title"><strong>PLC MODULE</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="small-box bg-info shadow">
                                            <a href="{{ route('jsox_plc_matrix') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>Sample Matrix</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-newspaper"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="small-box bg-info shadow">
                                            <a href="{{ route('plc_dashboard') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>3-Sets Documents</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-tachometer-alt"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="small-box bg-info shadow">
                                            <a href="{{ route('plc_evidences') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>Evidences</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-file-download"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="small-box bg-info shadow">
                                            <a href="{{ route('plc_capa') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>Corrective/Preventive Action</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-folder-open"></i>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>

                                    {{-- <div class="col-4">
                                        <div class="small-box bg-info shadow">
                                            <a href="{{ route('plc_category') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>PLC Listing</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-newspaper"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title"><strong>CLC / FCRP / IT-CLC EVIDENCES</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    {{-- <div class="col-4">
                                        <div class="small-box bg-warning shadow">
                                            <a href="{{ route('clc_dashboard') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>RCM / Self-assessment</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-tachometer-alt"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-4">
                                        <div class="small-box bg-warning shadow">
                                            <a href="{{ route('clc_category') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>CLC / FCRP / IT-CLC Listing</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-newspaper"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div> --}}

                                    <div class="col-4">
                                        <div class="small-box bg-warning shadow">
                                            <a href="{{ route('clc_evidences') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>CLC / FCRP / IT-CLC</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-file-download"></i>
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <label class="card-title"><strong>USER MODULE</strong></label>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <div class="small-box bg-secondary">
                                            <a href="{{ route('user_management') }}">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>User Management</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-users"></i>                                            
                                                    </div>   
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

            </div>
        </section>
    </div>
@endsection

<!-- {{-- JS CONTENT --}} -->
@section('js_content')
    <script type="text/javascript">

    </script>
@endsection
