<?php $layout = 'layouts.super_user_layout'; ?>



<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_page'); ?>
    
    
            

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
                                            <a href="<?php echo e(route('jsox_plc_matrix')); ?>">
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
                                            <a href="<?php echo e(route('plc_dashboard')); ?>">
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
                                            <a href="<?php echo e(route('plc_evidences')); ?>">
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
                                            <a href="<?php echo e(route('plc_capa')); ?>">
                                                <div class="inner" style="height:100px;">
                                                    <span class="info-box-text position-absolute mt-4 ml-3"><h4><strong>Corrective/Preventive Action</strong></h4></span>
                                                    <div class="icon">
                                                        <i class="fas fa-folder-open"></i>
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                            <h3 class="card-title"><strong>CLC / FCRP / IT-CLC EVIDENCES</strong></h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    

                                    

                                    <div class="col-4">
                                        <div class="small-box bg-warning shadow">
                                            <a href="<?php echo e(route('clc_evidences')); ?>">
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

                

            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>

<!--  -->
<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/dashboard.blade.php ENDPATH**/ ?>