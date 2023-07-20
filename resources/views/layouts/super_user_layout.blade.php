@php
    session_start();
    $isLogin = false;
    if(isset($_SESSION['rapidx_user_id'])){
        $isLogin = true;
    }
@endphp
@if($isLogin)
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>JSOX System | @yield('title')</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/favicon.ico') }}">

            <!-- CSS LINKS -->
            @include('shared.css_links.css_links')
        </head>
        <body class="hold-transition sidebar-mini">
            <input type="hidden" id="login_id" value="<?php echo $_SESSION['rapidx_user_id']; ?>">
            <input type="hidden" id="login_name" value="<?php echo $_SESSION["rapidx_name"]; ?>">
            <div class="wrapper">
                @include('shared.pages.super_user_header')
                @include('shared.pages.super_user_nav')
                @yield('content_page')
                @include('shared.pages.super_user_footer')
            </div>

            <!-- JS LINKS -->
            @include('shared.js_links.js_links')
            @yield('js_content')
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
@else
<script type="text/javascript">
    window.location = "../RapidX/";
</script>
@endif
