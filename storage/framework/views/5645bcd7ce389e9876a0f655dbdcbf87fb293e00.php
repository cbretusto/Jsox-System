<?php
    session_start();
    $isLogin = false;
    if(isset($_SESSION['rapidx_user_id'])){
        $isLogin = true;
    }
?>
<?php if($isLogin): ?>
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>JSOX System | <?php echo $__env->yieldContent('title'); ?></title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image/png" href="<?php echo e(asset('public/images/favicon.ico')); ?>">

            <!-- CSS LINKS -->
            <?php echo $__env->make('shared.css_links.css_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </head>
        <body class="hold-transition sidebar-mini">
            <input type="hidden" id="login_id" value="<?php echo $_SESSION['rapidx_user_id']; ?>">
            <input type="hidden" id="login_name" value="<?php echo $_SESSION["rapidx_name"]; ?>">
            <div class="wrapper">
                <?php echo $__env->make('shared.pages.super_user_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->make('shared.pages.super_user_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php echo $__env->yieldContent('content_page'); ?>
                <?php echo $__env->make('shared.pages.super_user_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            <!-- JS LINKS -->
            <?php echo $__env->make('shared.js_links.js_links', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php echo $__env->yieldContent('js_content'); ?>
        </body>

        <script>
            verifyUser();
            function verifyUser(){
                var loginName = $('#login_name').val();
                console.log('Session(Admin/User):', loginName);

                $.ajax({
                    url: "get_user_log",
                    method: "get",
                    data: {
                        loginName : loginName
                    },
                    dataType: "json",

                    success: function(response){
                        if(response['result'].length == 0){
                            window.location.href = 'error';
                        }
                        else{
                            for(let i = 0; i<response['result'].length;i++){
                                if(response['result'][i]['user_level_id'] == 1){
                                    $('#user_management_id').addClass('d-none');
                                    $('#plc_category_id').addClass('d-none');
                                    // $('#plc_dashboard_id').addClass('d-none');
                                    $('#clc_evidences_id').addClass('d-none');

                                    $('.myButton').addClass('d-none');
                                }
                                if(response['result'][i]['user_level_id'] == 2){
                                    $('#user_management_id').addClass('d-none');
                                    $('#plc_category_id').addClass('d-none');
                                    // $('#plc_dashboard_id').addClass('d-none');
                                    $('#clc_evidences_id').addClass('d-none');

                                    $('.myButton').addClass('d-none');
                                }
                                // if(response['result'][i]['user_level_id'] == 3){
                                //     // $('#user_management_id').removeClass('d-none');
                                //     // $('#plc_category_id').removeClass('d-none');
                                //     // $('#jsox_plc_matrix_id').removeClass('d-none');
                                //     // $('#plc_dashboard_id').removeClass('d-none');
                                //     // $('#clc_dashboard_id').removeClass('d-none');
                                //     // $('#clc_evidences_id').removeClass('d-none');

                                //     // $('#plc_evidences_id').removeClass('d-none');
                                //     // $('#analytics_id').removeClass('d-none');
                                // }
                            }
                        }
                    }
                });
            }
        </script>
    </html>
<?php else: ?>
<script type="text/javascript">
    window.location = "../RapidX/";
</script>
<?php endif; ?>
<?php /**PATH /var/www/Jsox/resources/views/layouts/super_user_layout.blade.php ENDPATH**/ ?>