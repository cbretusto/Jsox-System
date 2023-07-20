<?php $layout = 'layouts.super_user_layout'; ?>



<?php $__env->startSection('title', 'JSOX'); ?>

<?php $__env->startSection('content_page'); ?>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>PLC Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">PLC Category Management</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="user-management-tab" data-toggle="tab" href="#user-management" role="tab" aria-controls="user-management" aria-selected="true">PLC Category Management Tab</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="user-management" role="tabpanel" aria-labelledby="user-management-tab">
                                <div>
                                <button class="btn btn-primary myButton" id="" data-toggle="modal" data-target="#modalAddPlcCategory"
                                style="float: right;"><i class="fa fa-plus fa-md"></i> Add
                                PLC Category</button></div><br><br>
                            </div>

                            <div class="table-responsive">
                                <table id="plcCategoryTable"
                                    class="table table-sm table-bordered table-striped table-hover"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 40%">PLC Category</th>
                                            <th style="width: 10%">Status</th>
                                            <th style="width: 10%">Action</th>
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
    </section>
</div>


    <!-- MODALS -->
    <div class="modal fade" id="modalAddPlcCategory">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> Add PLC Category</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form id="formAddPlcCategory">
            <?php echo csrf_field(); ?>
            <div class="modal-body">
                <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                    <label>PLC Category</label>
                        <input type="text" class="form-control" name="plc_category" id="txtAddPlcCategory">
                        

                    </div>
                </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                <button type="submit" id="btnAddPlcCategory" class="btn btn-dark"><i id="BtnAddPlcCategoryIcon" class="fa fa-check"></i> Save</button>
            </div>
            </form>
        </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


    <!-- EDIT MODAL START -->
    <div class="modal fade" id="modalEditPLCCategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h4 class="modal-title"><i class="far fa-edit"></i> Edit PLC Category</h4>
                    <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close" btn-sm>
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="editPlcCategoryForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>PLC Category</label>
                                    <input type="hidden" class="form-control" name="plc_category_id" id="txtPlcCategoryId">
                                    <input type="text" class="form-control" name="edit_plc_category" id="txtEditPLCCategory">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnEditPlcCategory" class="btn btn-dark"><i id="iBtnEditPlcCategoryIcon" class="fa fa-check"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- EDIT MODAL END -->

    <!-- DEACTIVATE CONTRACTOR MODAL START -->
    <div class="modal fade" id="modalDeactivatePlcCategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title"><i class="far fa-file"></i>&nbsp;&nbsp;Deactivate PLC Category</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="deactivatePlcCategoryForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">
                            <label class="text-secondary mt-2">Are you sure you want to deactivate this PLC Category?</label>
                            <input type="hidden" class="form-control" name="plc_category_id" id="deactivatePlcCategoryID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnDeactivatePlcCategory" class="btn btn-danger"><i id="deactivateplcCategoryIcon"
                                class="fa fa-check"></i> Deactivate</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- DEACTIVATE CONTRACTOR MODAL END -->

    <!-- ACTIVATE CONTRACTOR MODAL START -->
    <div class="modal fade" id="modalActivatePlcCategory">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h4 class="modal-title"><i class="far fa-file"></i>&nbsp;&nbsp;Activate PLC Category</h4>
                    <button type="button" style="color: #fff" class="close" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" id="activatePlcCategoryForm">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <div class="row d-flex justify-content-center">

                            <label class="text-secondary mt-2">Activate this PLC Category?</label>
                            <input type="hidden" class="form-control" name="plc_category_id" id="activatePlcCategoryID">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" id="btnActivatePlcCategory" class="btn btn-success"><i id="activatePlcCategoryIcon"
                                class="fa fa-check"></i> Activate</button>
                    </div>
                </form>
            </div>
        </div>
    </div><!-- ACTIVATE CONTRACTOR MODAL END -->

    <!-- DELETE MODAL START -->
    


<?php $__env->stopSection(); ?>



<?php $__env->startSection('js_content'); ?>
    <script type="text/javascript">

        // ============================== VIEW PLC CATEGORY DATATABLES  START ==============================
        dataTablePlcCategory = $("#plcCategoryTable").DataTable({
            "processing" : false,
            "serverSide" : true,
            "responsive": true,
            // "scrollX": true,
            // "scrollX": "100%",
            "language": {
                "info": "Showing _START_ to _END_ of _TOTAL_ records",
                "lengthMenu":     "Show _MENU_ records",
            },
            "ajax" : {
                url: "view_plc_category", // this will be pass in the uri called view_users_archive that handles datatables of view_users_archive() method inside UserController
            },
            "columns":[
                { "data" : "plc_category",orderable:false},
                { "data" : "status",orderable:false},
                { "data" : "action",orderable:false},
            ],
            // "aoColumnDefs": [{ "bVisible": false, "aTargets": [2] }]
        });
        //VIEW PLC CATEGORY DATATABLES END

        //===== ADD USER APPROVER =====//
        $('#btnAddPlcCategory').on('click', function(event) {
            event.preventDefault(); // to stop the form submission
            AddPlcCategory();
        });
        //===== ADD USER APPROVER END =====//

           //============================== EDIT PLC CATEGORY ==============================
            // actionEditUser is generated by datatables and open the modalEditUser(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditPlcCategory', function(){
                // the user-id (attr) is inside the datatables of UserController that will be use to collect the user-id
                let plcCategoryID = $(this).attr('plc_category-id');

                // after clicking the actionEditUser(button) the userId will be pass to the txtEditUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user
                $("#txtPlcCategoryId").val(plcCategoryID);

                // COLLECT THE userId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS
                // GetUserByIdToEdit() function is inside User.js and pass the userId as an argument when passing the ajax that will be use to query the user-id of get_user_by_id() method inside UserController and pass the fetched user based on that query as $user(variable) to pass the values in the inputs of modalEditUser and also to validate the fetched values, inside GetUserByIdToEdit under User.js
                GetPlcCategoryID(plcCategoryID);
            });

            // The EditUser(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formEditUser(form) of its data(input) in the uri(edit_user)
            // then the controller will handle that uri to use specific method called edit_user() inside UserController
            $("#editPlcCategoryForm").submit(function(event){
                event.preventDefault();
                EditPlcCategory();
            });

             // DEACTIVATE PLC CATEGORY
          $(document).on('click', '.actionDeactivatePlcCategory', function() {

            let plcCategoryID = $(this).attr('plc_category-id');

            $("#deactivatePlcCategoryID").val(plcCategoryID);
            });
            $("#deactivatePlcCategoryForm").submit(function(event) {
            event.preventDefault();
            DeactivatePlcCategory();
            });
            // DEACTIVATE PLC CATEGORY END

            // ACTIVATE APPROVER
         $(document).on('click', '.actionActivatePlcCategory', function() {

            let plcCategoryID = $(this).attr('plc_category-id');

            $("#activatePlcCategoryID").val(plcCategoryID);
            });

            $("#activatePlcCategoryForm").submit(function(event) {
            event.preventDefault();
            ActivatePlcCategory();
            });
            // ACTIVATE APPROVER END

            $(document).keypress(function(event){
                if (event.which == '13') {
                event.preventDefault();
                }
            });

            //============================== DELETE USER ==============================
            // actionDeleteUser is generated by datatables and open the modalDeleteUser(modal) to collect the id of the specified rows
            // $(document).on('click', '.actionDeletePlcCategory', function(){
                // the user-id(attr) is inside the datatables of UserController that will be use to collect the user-id

                // let plcCategoryID = $(this).attr('plc_category-id');

                // after clicking the actionEditUser(button) the userId will be pass to the txtDeleteUserId(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the user

            //     $("#txtDeletePlcCategoryId").val(plcCategoryID);
            // });
            // $("#deletePlcCategoryForm").submit(function(event){
            //     event.preventDefault();
            //     DeletePlcCategory();

            // });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Jsox/resources/views/plc_category.blade.php ENDPATH**/ ?>