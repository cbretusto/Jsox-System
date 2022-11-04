@php $layout = 'layouts.super_user_layout'; @endphp

@auth
    @php
        if(Auth::user()->user_level_id == 1){
            $layout = 'layouts.super_user_layout';
        }
        else if(Auth::user()->user_level_id == 2){
            $layout = 'layouts.admin_layout';
        }
        else if(Auth::user()->user_level_id == 3){
            $layout = 'layouts.user_layout';
        }
    @endphp
@endauth

{{-- Here I removed the @auth because the dashboard isn't loading properly --}}
@extends($layout)
@section('title', 'CLC Module')

@section('content_page')

    <style type="text/css">
        table{
            color: black;
        }

        table.table tbody td{
            vertical-align: middle;
            text-align: center;
        }
    </style>

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>CLC Module</h1>
                        {{-- @php
                            echo exec("script.bat"); 
                        @endphp  --}}
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
                            <div class="card-header">
                                <h3 class="card-title">CLC Category</h3>
                            </div>
                            <div class="card-body">
                                <div style="float: right;">                   
                                    <button class="btn btn-info" data-toggle="modal" data-target="#modalAddClcCategory" id="btnShowAddClcCategoryModal"><i class="fa fa-plus"></i>  Add CLC Module </button>
                                </div> <br><br>
                                <div class="table responsive">
                                    <table id="tblClcCategory" class="table table-sm table-bordered table-striped table-hover" style="width: 100%;">
                                        <thead>
                                            <tr style="text-align:center">
                                            <th>Category</th>
                                            <th style="width: 20%">Status</th>
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

            <!-- ADD MODAL START -->
            <div class="modal fade" id="modalAddClcCategory">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> CLC CATEGORY</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formAddClcCategory">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <br>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Category: &nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtAddClcCategory" name="category" autocomplete="off"> 
                                        </div> 
                                        <input type="hidden" class="form-control" id="txtAddCreatedBy" name="created_by" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnAddClcCategory" class="btn btn-dark"><i id="iBtnAddClcCategoryIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- ADD MODAL END -->

            <!-- EDIT MODAL START -->
            <div class="modal fade" id="modalEditClcCategory">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title"><i class="fab fa-stack-overflow"></i> CLC CATEGORY</h4>
                            <button type="button" style="color: #fff;" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formEditClcCategory">
                            @csrf
                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-sm-12 flex-column d-flex"> 
                                        <input type="hidden" class="form-control" name="clc_categories_id" id="txtEditClcCategoryId">
                                        <br>
                                        <div class="input-group mb-4">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-default"><strong>Category: &nbsp;&nbsp;&nbsp; </strong></span>
                                            </div>
                                            <input type="text" class="form-control" id="txtEditClcCategory" name="category" autocomplete="off"> 
                                        </div> 
                                        <input type="hidden" class="form-control" id="txtEditupdatedBy" name="updated_by" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" id="btnEditClcCategory" class="btn btn-dark"><i id="iBtnEditClcCategoryIcon" class="fa fa-check"></i> Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- EDIT MODAL END -->

            <!-- CHANGE STAT MODAL START -->
            <div class="modal fade" id="modalChangeClcCategoryStat">
                <div class="modal-dialog">
                    <div class="modal-content modal-sm">
                        <div class="modal-header bg-dark">
                            <h4 class="modal-title" id="h4ChangeClcCategoryStat"><i class=""></i> Change Status</h4>
                            <button type="button" style="color: #fff" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" id="formChangeClcCategoryStat">
                            @csrf
                            <div class="modal-body">
                                <label id="lblChangeClcCategoryStatLabel"></label>
                                <input type="hidden" name="clc_category_id" id="txtChangeClcCategoryId">
                                <input type="hidden" name="status" id="txtChangeClcCategoryStat">
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                <button type="submit" id="btnChangeClcCategoryStat" class="btn btn-dark"><i id="iBtnChangeClcCategoryStatIcon" class="fa fa-check"></i> Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> <!-- CHANGE STAT MODAL END -->

        </section>
    </div>

@endsection
@section('js_content')
    <script type="text/javascript">
        let dataTableClcCategory;

        $(document).ready(function () {
            bsCustomFileInput.init();
            //Initialize Select2 Elements
            $('.select2').select2();

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            });

            $(document).on('click','#tblClcCategory tbody tr',function(e){
                $(this).closest('tbody').find('tr').removeClass('table-active');
                $(this).closest('tr').addClass('table-active');
            });

            // ======================= CLC CATEGORY  DATA TABLE =======================
            dataTableClcCategory = $("#tblClcCategory").DataTable({ 
                "processing" : false,
                "serverSide" : true,
                "ajax" : {
                    url: "view_clc_category",
                },

                "columns":[
                    { "data" : "category" },
                    { "data" : "status" },
                    { "data" : "action", orderable:false, searchable:false }
                ],
            });// END OF DATATABLE

            // ============================ AUTO ADD CREATED BY USER ============================
            $(document).on('click', '#btnShowAddClcCategoryModal, .actionEditClcCategory', function() {
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
                        $('#txtEditupdatedBy').val(result[0].name);
                    },
                });
            });

            //============================ ADD CLC CATEGORY ============================
            $("#formAddClcCategory").submit(function(event){
                event.preventDefault(); // to stop the form submission
                AddClcCategory();
                dataTableClcCategory.draw(); // reload datatables asynchronously
            });
            // VALIDATION(errors)
            $("#txtAddClcCategory").removeClass('is-invalid');
            $("#txtAddClcCategory").attr('title', '');
            $("#txtAddCreated_by").removeClass('is-invalid');
            $("#txtAddCreated_by").attr('title', '');

            //============================== EDIT REPORT ==============================
            // actionEditClcCategory is generated by datatables and open the modalEditClcCategory(modal) to collect the id of the specified rows
            $(document).on('click', '.actionEditClcCategory', function(){
                // the clc_categories-id(attr) is inside the datatables of ClcCategoryController that will be use to collect the clc_categories-id
                let clc_categoryId = $(this).attr('clc_categories-id'); 

                // after clicking the actionEditClcCategory(button) the clc_categoryId will be pass to the txtEditClcCategoryId(input=hidden) and when the form is submitted this 
                // will be pass to ajax and collect clc_categories-id that will be use to query the clc_categories-id in the ClcCategoryController to update the report
                $("#txtEditClcCategoryId").val(clc_categoryId);

                // COLLECT THE file_recordId AND PASS TO INPUTS, BASED ON THE CLICKED ROWS //
                    //GetClcCategoryByIdToEdit() function is inside ClcCategory.js and pass the clc_categoryId as an argument when passing the ajax that will be use to query 
                    // the clc_categories-id of get_clc_category_by_id() method inside ClcCategoryController and pass the fetched report based on that query as $clc_category_id(variable) 
                    // to pass the values in the inputs of modalEditClcCategory and also to validate the fetched values, inside GetClcCategoryByIdToEdit under ClcCategory.js
                    GetClcCategoryByIdToEdit(clc_categoryId); 

                // READ ONLY
                // $("#txtEditReportName_of_File").attr('disabled', 'disabled');
                // $("#txtEditReportUploaded_Date").attr('disabled', 'disabled');
                // $("#txtEditReportName_of_Author").attr('disabled', 'disabled');
                // $("#txtEditReportUploaded_File").attr('disabled', 'disabled');
            });
                // The EditClcCategory(); function is inside public/js/my_js/ClcCategory.js
                // after the submission, the ajax request will pass the formEditClcCategory(form) of its data(input) in the uri(edit_cls_category)
                // then the controller will handle that uri to use specific method called edit_cls_category() inside ClcCategoryController
            $("#formEditClcCategory").submit(function(event){
                event.preventDefault();
                EditClcCategory();
            });

            //============================== CHANGE USER STATUS ==============================
            // aChangeUserStat is generated by datatables and open the modalChangeClcCategoryStat(modal) to collect and change the id & status of the specified rows
            $(document).on('click', '.actionChangeClcCategoryStat', function(){
                let clccategoryStat = $(this).attr('status'); // the status will collect the value (1-active, 2-inactive)
                let clccategoryId = $(this).attr('clc_categories-id'); // the clc_categories-id(attr) is inside the datatables of UserController that will be use to collect the clc_categories-id
                console.log(clccategoryId);
                $("#txtChangeClcCategoryStat").val(clccategoryStat); // collect the user status id the default is 2, this will be use to change the user status when the formChangeClcCategoryStat(form) is submitted
                $("#txtChangeClcCategoryId").val(clccategoryId); // after clicking the aChangeUserStat(button) the clccategoryId will be pass to the clc_category_id(input=hidden) and when the form is submitted this will be pass to ajax and collect user-id that will be use to query the user-id in the UserController to update the status of the user

                if(clccategoryStat == 1){
                    $("#lblChangeClcCategoryStatLabel").text('Are you sure to activate?'); 
                    $("#h4ChangeClcCategoryStat").html('<i class="fa fa-check"></i> Activate!');
                }
                else{
                    $("#lblChangeClcCategoryStatLabel").text('Are you sure to deactivate?');
                    $("#h4ChangeClcCategoryStat").html('<i class="fa fa-times"></i> Deactivate!');
                }
            });

            // ChangeClcCategoryStatus(); function is inside public/js/my_js/User.js
            // after the submission, the ajax request will pass the formChangeClcCategoryStat(form) of data(input) in the uri(change_clc_category_stat)
            // then the controller will handle that uri to use specific method called change_clc_category_stat() inside UserController
            $("#formChangeClcCategoryStat").submit(function(event){
                event.preventDefault();
                ChangeClcCategoryStatus();
            });

        }); // JQUERY DOCUMENT READY END
    </script>                  
@endsection
