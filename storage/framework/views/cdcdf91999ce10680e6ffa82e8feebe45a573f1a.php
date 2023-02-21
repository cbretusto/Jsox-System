<?php $layout = 'layouts.super_user_layout'; ?>

<?php if(auth()->guard()->check()): ?>
    <?php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.super_user_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 3){
            $layout = 'layouts.user_layout';
        }
    ?>
<?php endif; ?>



<?php $__env->startSection('title', 'Blank Page'); ?>

<?php $__env->startSection('content_page'); ?>

    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            /* white-space:nowrap; */
            vertical-align: middle;
        }
        table.table thead th{
            text-align: center;
            white-space:nowrap;
            vertical-align: middle;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Sample Matrix</h1>
                    </div>
                </div>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-body">
                                <ul class="nav nav-tabs" id="tabjsoxPlcMatrices" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link" id="tabMatrixRecordRecord" data-toggle="tab" href="#matrixRecord" role="tab" aria-controls="matrixRecord" aria-selected="false">Matrix</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" id="tabJsoxPlcMatrix" data-toggle="tab" href="#jsoxPlcMatrix" role="tab" aria-controls="jsoxPlcMatrix" aria-selected="false">Reference</a>
                                    </li>
                                </ul>

                                <div class="tab-content table-responsive" id="tabjsoxPlcMatrices">
                                    <div class="tab-pane fade show active" id="matrixRecord" role="tabpanel" aria-labelledby="tabMatrixRecordRecord">
                                        <div style="float: right;">                   
                                            <button class="btn btn-info mt-1" data-toggle="modal" data-target="#modalAddMatrix" id="btnShowAddMatrixModal"><i class="fa fa-plus"></i>  Add Matrix </button>
                                        </div> <br><br>
                                        <div class="table responsive" style="height: 640px; overflow: scroll;">
                                            <table id="tblMatrix" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Status</th>
                                                        <th rowspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                        <th colspan="3" class="bg-success">1st Test Assessment</th>
                                                        <th colspan="2" class="bg-primary">2nd Test Roll-forward / Follow-up</th>
                                                        <th rowspan="2">Action</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-success">Non Key Control /<br> IT Control</th>
                                                        <th class="bg-success">TS Key Controls</th>
                                                        <th class="bg-success">CN Key Controls</th>
                                                        <th class="bg-primary">Key Controls</th>
                                                        <th class="bg-primary">Controls Evaluated as</th>
                                                    </tr>
                                                </thead>            
                                            </table>
                                        </div>
                                    </div>
                                    
                                    <div class="tab-pane fade" id="jsoxPlcMatrix" role="tabpanel" aria-labelledby="tabJsoxPlcMatrix">
                                        <div style="float: right;">                   
                                            <button class="btn btn-info mt-1" data-toggle="modal" data-target="#modalAddJsoxPlcMatrix" id="btnShowAddJsoxPlcMatrixModal"><i class="fa fa-plus"></i>  Add Reference </button>
                                        </div> <br><br>
                                        <div class="table responsive" style="height: 640px; overflow: scroll;">
                                            <table id="tblJsoxPlcMatrix" class="table table-sm table-bordered table-striped table-hover w-100" style="white-space: pre-wrap;">
                                                <thead>
                                                    <tr style="text-align:center">
                                                        <th>Process Name</th>
                                                        <th>Control No.</th>
                                                        <th>Documents</th>
                                                        <th>Frequency</th>
                                                        <th>No. of Samples</th>
                                                        <th>In-Charge</th>
                                                        <th>Status</th>
                                                        <th style="width: 20%">Action</th>
                                                    </tr>
                                                </thead>            
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!------------------------------------ START MATRIX ------------------------------------>
            <!-- ADD MODAL START -->
            <div class="modal fade" id="modalAddMatrix">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Matrix</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formAddMatrix">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <input type="hidden" class="form-control">                                     
                                        </div>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control">                                     
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Frequency:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                            </div>
                                            <textarea type="text" class="form-control" id="txtAddFrequency" name="frequency" autocomplete="off"></textarea>
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><strong>Non-Key or IT Controls: </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddNonKeyItControl" name="nonkey_it_control" autocomplete="off">
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>TS Key Controls: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddTsKeyControl" name="ts_key_control" autocomplete="off"> 
                                        </div>  
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>CN Key Controls: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtAddCnKeyControl" name="cn_key_control" autocomplete="off"> 
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong> Key Controls: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtAddKeyControl" name="key_control" autocomplete="off"> 
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Controls Evaluated as: &nbsp;</strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtAddControlEvaluated" name="control_evaluated" autocomplete="off"> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnAddMatrix" class="btn btn-dark"><i id="iBtnAddMatrixIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- ADD MODAL END -->

            <!-- EDIT MODAL START -->
            <div class="modal fade" id="modalEditMatrix">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Matrix</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formEditMatrix">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <input type="hidden" class="form-control" name="matrix_id" id="txtEditMatrixId"> 
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Frequency: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <textarea type="text" class="form-control" id="txtEditFrequency" name="frequency" autocomplete="off"></textarea>
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><strong>Non-Key or IT Controls: </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditNonKeyItControl" name="nonkey_it_control" autocomplete="off">
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>TS Key Controls: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditTsKeyControl" name="ts_key_control" autocomplete="off"> 
                                        </div>  
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>CN Key Controls: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtEditCnKeyControl" name="cn_key_control" autocomplete="off"> 
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong> Key Controls: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtEditKeyControl" name="key_control" autocomplete="off"> 
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Controls Evaluated as: &nbsp;</strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtEditControlEvaluated" name="control_evaluated" autocomplete="off"> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnEditMatrix" class="btn btn-dark"><i id="iBtnEditMatrixIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- EDIT MODAL END -->

            <!-- CHANGE STAT MODAL START -->
            <div class="modal fade" id="modalChangeMatrixStat">
                <div class="modal-dialog">
                    <div class="modal-content modal-sm">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title" id="h4ChangeMatrixStat"><i class="fa fa-user"></i> Change Status</h4>
                            <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formChangeMatrixStat">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <label id="lblChangeMatrixStatLabel"></label>
                                <input type="text" name="matrix_id" id="txtChangeMatrixId">
                                <input type="text" name="status" id="txtChangeMatrixStat">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                <button type="submit" id="btnChangeMatrixStat" class="btn btn-dark"><i id="iBtnChangeMatrixStatIcon" class="fa fa-check"></i> Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- CHANGE STAT MODAL END -->
            <!------------------------------------ END MATRIX ------------------------------------>


            <!------------------------------------ START REFERENCE ------------------------------------>
            <!-- ADD MODAL START -->
            <div class="modal fade" id="modalAddJsoxPlcMatrix">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Reference</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formAddJsoxPlcMatrix">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <br>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Process Name: </strong></span>
                                            </div>
                                            <select class="form-control select2bs4 selectJsoxPlcMatrix"  id="selAddJsoxPlcMatrix" name="process_name" style="width: 70%;">
                                            <!-- Code generated -->    
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <input type="hidden" class="form-control">                                     
                                        </div>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control">                                     
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Control No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddControlNo" name="control_no" autocomplete="off"> 
                                        </div> 
                                    </div>
                                    <div class="border-top border-bottom">
                                        <div class="col-sm-12 float-right" id="divAddDocument">
                                            <input type="hidden" name="document_number" id="addDocumentCounter" value="1">
                                            <button type="button" class="btn btn-sm btn-dark float-right mb-2 mt-1" id="addRowDocument"><i class="fa fa-plus"></i> Add Row</button>
                                            <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 mt-1 d-none" id="removeRowDocument"><i class="fas fa-times"></i> Remove Row</button>
                                        </div>
                                        <div class="form-group col-sm-12 flex-column d-flex" id="idDocumentDiv"> 
                                            <div class="input-group mb-1">
                                                <div class="input-group-prepend">
                                                    -<span class="input-group-text ml-2" id="inputGroup-sizing-default"><strong>1. Document: &nbsp;&nbsp;&nbsp; </strong></span>
                                                </div>
                                                <input type="text" class="form-control" id="txtAddDocument_1" name="document_1" autocomplete="off"> 
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex mt-2"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Frequency: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddFrequency" name="frequency" autocomplete="off"> 
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>No. of Sample: </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddSamples" name="samples" autocomplete="off"> 
                                        </div>  
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>In-Charge: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtAddInCharge" name="in_charge" autocomplete="off"> 
                                        </div> 
                                        <input type="hidden" class="form-control" id="txtAddCreatedBy" name="created_by" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnAddJsoxPlcMatrix" class="btn btn-dark"><i id="iBtnAddJsoxPlcMatrixIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- ADD MODAL END -->

            <!-- EDIT MODAL START -->
            <div class="modal fade" id="modalEditJsoxPlcMatrix">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i>  Reference</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formEditJsoxPlcMatrix">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <input type="hidden" class="form-control" name="jsox_plc_matrix_id" id="txtEditJsoxPlcMatrixId"> 
                                        <br>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Process Name: </strong></span>
                                            </div>
                                            <select class="form-control select2bs4 selectJsoxPlcMatrix"  id="selEditJsoxPlcMatrix" name="process_name" style="width: 70%;">
                                            <!-- Code generated -->    
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <input type="hidden" class="form-control">                                     
                                        </div>
                                        <div class="input-group">
                                            <input type="hidden" class="form-control">                                     
                                        </div>
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Control No: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditControlNo" name="control_no"> 
                                        </div> 
                                    </div>

                                    
                                    <div class="border-top border-bottom">
                                        <div class="col-sm-12 float-right" id="divAddDocumentEdit">
                                            <input type="hidden" name="document_number" id="addDocumentCounterEdit" value="1">
                                            <button type="button" class="btn btn-sm btn-dark float-right mb-2 mt-1" id="addRowDocumentEdit"><i class="fa fa-plus"></i> Add Row</button>
                                            <button type="button" class="btn btn-sm btn-danger float-right mr-2 mb-2 mt-1 d-none" id="removeRowDocumentEdit"><i class="fas fa-times"></i> Remove Row</button>
                                        </div>
                                        <div class="form-group col-sm-12 flex-column d-flex" id="idDocumentDivEdit"> 

                                            <div class="input-group mb-1">
                                                <div class="input-group-prepend">
                                                    -<span class="input-group-text ml-2" id="inputGroup-sizing-default"><strong>1. Document: &nbsp;&nbsp;&nbsp; </strong></span>
                                                </div>
                                                <input type="text" class="form-control" id="txtEditDocument_1" name="document_1" autocomplete="off"> 
                                            </div> 
                                        </div>
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex mt-2"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Frequency: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditFrequency" name="frequency"> 
                                        </div> 
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>No. of Sample: </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditSamples" name="samples"> 
                                        </div>  
                                    </div>

                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>In-Charge: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong></span>
                                            </div> 
                                            <input type="text" class="form-control" id="txtEditInCharge" name="in_charge"> 
                                        </div> 
                                        <input type="hidden" class="form-control" id="txtUpdatedBy" name="updated_by" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnEditJsoxPlcMatrix" class="btn btn-dark"><i id="iBtnEditJsoxPlcMatrixIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- EDIT MODAL END -->

            <!-- CHANGE STAT MODAL START -->
            <div class="modal fade" id="modalChangeJsoxPlcMatrixStat">
                <div class="modal-dialog">
                    <div class="modal-content modal-sm">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title" id="h4ChangeJsoxPlcMatrixStat"><i class="fa fa-user"></i> Change Status</h4>
                            <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formChangeJsoxPlcMatrixStat">
                            <?php echo csrf_field(); ?>
                            <div class="modal-body">
                                <label id="lblChangeJsoxPlcMatrixStatLabel"></label>
                                <input type="hidden" name="jsox_plc_matrix_id" id="txtChangeJsoxPlcMatrixId">
                                <input type="hidden" name="status" id="txtChangeJsoxPlcMatrixStat">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                <button type="submit" id="btnChangeJsoxPlcMatrixStat" class="btn btn-dark"><i id="iBtnChangeJsoxPlcMatrixStatIcon" class="fa fa-check"></i> Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- CHANGE STAT MODAL END -->
            <!------------------------------------ END REFERENCE ------------------------------------>

        </section>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">
        let dataTableMatrix;
        let dataTableJsoxPlcMatrix;

        $(document).ready(function () {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblMatrix tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            $(document).on('click','#tblJsoxPlcMatrix tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // ======================= MATRIX DATA TABLE =======================        
            dataTableMatrix = $("#tblMatrix").DataTable({ 
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_matrix",
                },

                "columns":[
                    { "data" : "status", orderable:false, searchable:false },
                    { "data" : "frequency", orderable:false, searchable:false },
                    { "data" : "nonkey_it_controls", orderable:false, searchable:false },
                    { "data" : "ts_key_control", orderable:false, searchable:false },
                    { "data" : "cn_key_control", orderable:false, searchable:false },
                    { "data" : "key_controls", orderable:false, searchable:false },
                    { "data" : "controls_evaluated", orderable:false, searchable:false },
                    { "data" : "action", orderable:false, searchable:false }
                ],
                "columnDefs": [
                    { className: 'align-middle', targets: [0] },
                ],
            });// END OF DATATABLE

            // ======================= JSOX PLC MATRIX DATA TABLE =======================
            GetPlcCategory($(".selectJsoxPlcMatrix"));
        
            dataTableJsoxPlcMatrix = $("#tblJsoxPlcMatrix").DataTable({ 
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_jsox_plc_matrix",
                },

                "columns":[
                    { "data" : "process_name" },
                    { "data" : "control_no" },
                    // { "data" : "document" },
                    { "data" : "documentsxz" },
                    { "data" : "frequency" },
                    { "data" : "samples" },
                    { "data" : "in_charge" },
                    { "data" : "status" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
                "columnDefs": [
                    { className: 'align-middle', targets: [6] },
                ],
            });// END OF DATATABLE

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddJsoxPlcMatrixModal, .actionEditClcEvidences', function() {
                $.ajax({
                    url: "get_rapidx_user",
                    method: "get",
                    dataType: "json",
                    beforeSend: function(){    
                    },
                    success: function(response){
                        let result = response['get_user'];
                        console.log(result[0].name);
                        $('#txtAddCreatedBy').val(result[0].name);
                        $('#txtUpdatedBy').val(result[0].name);
                    },
                });
            });

            // ============================= M A T R I X =============================
            //============================ ADD MATRIX ============================
            $("#formAddMatrix").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddMatrix();
                dataTableMatrix.draw(); // reload datatables asynchronously
            });

            //============================== EDIT MATRIX ==============================
            $(document).on('click', '.actionEditMatrix', function(){
                let matrixId = $(this).attr('matrix-id'); 

                $("#txtEditMatrixId").val(matrixId);

                GetMatrixByIdToEdit(matrixId); 
            });
            $("#formEditMatrix").submit(function(event){
                event.preventDefault();
                EditMatrix();
            });

            //============================== CHANGE USER STATUS ==============================
            $(document).on('click', '.actionChangeMatrixStat', function(){
                let matrixStat = $(this).attr('status'); 
                let matrixId = $(this).attr('matrix-id'); 
                $("#txtChangeMatrixStat").val(matrixStat);  
                $("#txtChangeMatrixId").val(matrixId); 

                if(matrixStat == 1){
                    $("#lblChangeMatrixStatLabel").text('Are you sure to activate?'); 
                    $("#h4ChangeMatrixStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangeMatrixStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeMatrixStat").html('<i class="fa fa-ban"></i> Deactivate!');
                }
            });

            $("#formChangeMatrixStat").submit(function(event){
                event.preventDefault();
                ChangeMatrixStatus();
            });

            // ============================= JSOX PLC MATRIX =============================
            //============================ ADD JSOX PLC MATRIX ============================
            $("#formAddJsoxPlcMatrix").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddJsoxPlcMatrix();
                dataTableJsoxPlcMatrix.draw(); // reload datatables asynchronously
            });
            // VALIDATION(errors)
            $("#selAddJsoxPlcMatrix").removeClass('is-invalid');
            $("#selAddJsoxPlcMatrix").attr('title', '');
            $("#txtAddControlNo").removeClass('is-invalid');
            $("#txtAddControlNo").attr('title', '');
            $("#txtAddDocument").removeClass('is-invalid');
            $("#txtAddDocument").attr('title', '');
            $("#txtAddFrequency").removeClass('is-invalid');
            $("#txtAddFrequency").attr('title', '');
            $("#txtAddSamples").removeClass('is-invalid');
            $("#txtAddSamples").attr('title', '');
            $("#txtAddInCharge").removeClass('is-invalid');
            $("#txtAddInCharge").attr('title', '');

            //============================== EDIT JSOX PLC MATRIX ==============================
            // actionEditClcCategory is generated by datatables and open the modalEditClcCategory(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditJsoxPlcMatrix', function(){
                // the jsox_plc_matrix-id(attr) is inside the datatables of ClcCategoryController that will be use to collect the jsox_plc_matrix-id
                let JsoxPlcMatrixId = $(this).attr('jsox_plc_matrix-id'); 

                // after clicking the actionEditClcCategory(button) the JsoxPlcMatrixId will be pass to the txtEditClcCategoryId(input=hidden) and when the form is submitted this 
                // will be pass to ajax and collect jsox_plc_matrix-id that will be use to query the jsox_plc_matrix-id in the ClcCategoryController to update the report
                $("#txtEditJsoxPlcMatrixId").val(JsoxPlcMatrixId);

                // COLLECT THE file_recordId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS //
                    //GetClcCategoryByIdToEdit() function is inside ClcCategory.js and pass the JsoxPlcMatrixId as an argument when passing the ajax that will be use to query 
                    // the jsox_plc_matrix-id of get_clc_category_by_id() method inside ClcCategoryController and pass the fetched report based on that query as $clc_category_id(variable) 
                    // to pass the values in the inputs of modalEditClcCategory and also to validate the fetched values, inside GetClcCategoryByIdToEdit under ClcCategory.js
                    GetJsoxPlcMatrixByIdToEdit(JsoxPlcMatrixId); 
            });
                // The EditClcCategory(); function is inside public/js/my_js/ClcCategory.js
                // after the submission, the ajax request will pass the formEditClcCategory(form) of its data(input) in the uri(edit_cls_category)
                // then the controller will handle that uri to use specific method called edit_cls_category() inside ClcCategoryController
            $("#formEditJsoxPlcMatrix").submit(function(event){
                event.preventDefault();
                EditJsoxPlcMatrix();
            });

            //============================== CHANGE USER STATUS ==============================
            // aChangeUserStat is generated by datatables and open the modalChangeClcCategoryStat(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionChangeJsoxPlcMatrixStat', function(){
                let jsoxplcmatrixStat = $(this).attr('status'); // the status will collect the value (1-active, 2-inactive)
                let jsoxplcmatrixId = $(this).attr('jsox_plc_matrix-id'); // the clc_categories-id(attr) is inside the datatables of UserController that will be use to collect the clc_categories-id
                // console.log(jsoxplcmatrixId);
                $("#txtChangeJsoxPlcMatrixStat").val(jsoxplcmatrixStat); // collect the user status id the default is 2, this will be use to change the user status when the formChangeClcCategoryStat(form) is submitted
                $("#txtChangeJsoxPlcMatrixId").val(jsoxplcmatrixId); // after clicking the aChangeUserStat(button) the clccategoryId will be pass to the clc_category_id(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the status of the user

                if(jsoxplcmatrixStat == 1){
                    $("#lblChangeJsoxPlcMatrixStatLabel").text('Are you sure to activate?'); 
                    $("#h4ChangeJsoxPlcMatrixStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangeJsoxPlcMatrixStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeJsoxPlcMatrixStat").html('<i class="fa fa-ban"></i> Deactivate!');
                }
            });

            // ChangeClcCategoryStatus(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formChangeClcCategoryStat(form) of data(input) in the uri(change_clc_category_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_stat() inside UserController
            $("#formChangeJsoxPlcMatrixStat").submit(function(event){
                event.preventDefault();
                ChangeJsoxPlcMatrixStatus();
            });

            //============================= ADD DOCUMENT MULTIPLE=============================
            let documentCounter = 1;
            $('#addRowDocument').on('click', function(){
                documentCounter++;
                if(documentCounter > 1){
                    $('#removeRowDocument').removeClass('d-none');
                }
                console.log('document Row(+):', documentCounter);
                let html;

                // html ='<div class="form-group col-sm-12">';
                    html ='<div class="input-group divDocumentHeader_'+documentCounter+'">';
                    html +='    <div class="input-group-prepend ">';
                    html +='        -<span class="input-group-text ml-2 mt-2" id="inputGroup-sizing-default"><strong>'+documentCounter+'. Document: &nbsp;&nbsp;&nbsp; </strong></span>';
                    html +='    </div>';
                    html +='    <input type="text" class="form-control mt-2" id="txtAddDocument_'+documentCounter+'" name="document_'+documentCounter+'" autocomplete="off"> ';
                    html +='</div>';
                // html +='</div>';

                $('#addDocumentCounter').val(documentCounter);
                $('#idDocumentDiv').append(html);
            });
            

            //============================= REMOVE ADD DOCUMENT MULTIPLE=============================
            $("#divAddDocument").on('click', '#removeRowDocument', function(e){
                let plcCapaCapaAnalysis =  $('#removeRowDocument').val();

                if(documentCounter > 1){
                    $('.divDocumentHeader_'+documentCounter).remove();
                    // $('#cardCapaAnalysis').find('#row_'+documentCounter).remove();
                    documentCounter--;
                    $('#addDocumentCounter').val(documentCounter).trigger('change');
                    console.log('document Row(-):' + documentCounter);
                }

                if(documentCounter < 2){
                    $('#removeRowDocument').addClass('d-none');
                }
            });

            //============================= EDIT DOCUMENT MULTIPLE=============================
            let documentCounterEdit = 1;
            $('#addRowDocumentEdit').on('click', function(){
                documentCounterEdit++;
                if(documentCounterEdit > 1){
                    $('#removeRowDocumentEdit').removeClass('d-none');
                }
                console.log('document Edit Row(+):', documentCounterEdit);
                let html;

                // html ='<div class="form-group col-sm-12">';
                    html ='<div class="input-group divDocumentEditHeader_'+documentCounterEdit+'">';
                        html +='<div class="input-group-prepend ">';
                        html +='-<span class="input-group-text ml-2 mt-2" id="inputGroup-sizing-default"><strong>'+documentCounterEdit+'. Document: &nbsp;&nbsp;&nbsp; </strong></span>';
                        html +='</div>';
                        html +=' <input type="text" class="form-control mt-2" id="txtEditDocument_'+documentCounterEdit+'" name="document_'+documentCounterEdit+'" autocomplete="off"> ';
                    html +='</div>';
                // html +='</div>';
                        
                

                $('#addDocumentCounterEdit').val(documentCounterEdit);
                $('#idDocumentDivEdit').append(html);
            });

            //============================= REMOVE EDIT DOCUMENT MULTIPLE=============================
            $("#divAddDocumentEdit").on('click', '#removeRowDocumentEdit', function(e){
                let plcCapaCapaAnalysis =  $('#removeRowDocumentEdit').val();

                if(documentCounterEdit > 1){
                    $('.divDocumentEditHeader_'+documentCounterEdit).remove();
                    documentCounterEdit--;
                    $('#addDocumentCounterEdit').val(documentCounterEdit).trigger('change');
                    console.log('document Edit Row(-):' + documentCounterEdit);
                }

                if(documentCounterEdit < 2){
                    $('#removeRowDocumentEdit').addClass('d-none');
                }
            });

            // DISABLED ENTER KEY EXCEPT FOR TEXTAREA
            $(document).on("keydown", ":input:not(textarea)", function(event) {
                if(event.key == "Enter") {
                    event.preventDefault();
                }
            });

            //==================================== RESIZE TEXTAREA ====================================
            document.querySelectorAll("textarea").forEach(function (size) {
            size.addEventListener("input", function () {
                var resize = window.getComputedStyle(this);
                // reset height to allow textarea to shrink again
                this.style.height = "auto";
                // when "box-sizing: border-box" we need to add vertical border size to scrollHeight
                this.style.height = (this.scrollHeight + parseInt(resize.getPropertyValue("border-top-width")) + parseInt(resize.getPropertyValue("border-bottom-width"))) + "px";
            });
        });

        }); // JQUERY DOCUMENT READY END
    </script>                  
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/jsox_plc_matrix.blade.php ENDPATH**/ ?>