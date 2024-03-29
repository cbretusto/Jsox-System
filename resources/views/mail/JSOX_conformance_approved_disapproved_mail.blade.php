<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <style type="text/css">
            body{
                font-family: Arial;
                font-size: 15px;
            }

            .text-green{
                color: green;
                font-weight: bold;
            }

            /*.input[type="radio"]{
                font
            }*/
        </style>
    </head>
    <body>

        <div class="row">
            <div class="col-sm-12">
                <div class="row" style="margin: 1px 10px;">
                    <div class="col-sm-12">
                        <form id="frmSaveRecord">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label style="font-size: 18px;">Good day!</label><br>
                                    @if ($data['approval_status'] == 1)
                                        @if ( $data['category_name' ] < 10)
                                            <label style="font-size: 18px;">Please be informed that PMI-0{{ $data['category_name' ] }} Revision History has been approved as of today {{ \Carbon\Carbon::now()->toFormattedDateString() }} {{ \Carbon\Carbon::now()->isoFormat('LT') }}</label>
                                        @else
                                            <label style="font-size: 18px;">Please be informed that PMI-{{ $data['category_name' ] }} Revision History has been approved as of today {{ \Carbon\Carbon::now()->toFormattedDateString() }} {{ \Carbon\Carbon::now()->isoFormat('LT') }}</label>
                                        @endif
                                    @else
                                        @if ( $data['category_name' ] < 10)
                                            <label style="font-size: 18px;">Please be informed that PMI-0{{ $data['category_name' ] }} Revision History has been disapproved as of today {{ \Carbon\Carbon::now()->toFormattedDateString() }} {{ \Carbon\Carbon::now()->isoFormat('LT') }}</label>
                                        @else
                                            <label style="font-size: 18px;">Please be informed that PMI-{{ $data['category_name' ] }} Revision History has been disapproved as of today {{ \Carbon\Carbon::now()->toFormattedDateString() }} {{ \Carbon\Carbon::now()->isoFormat('LT') }}</label>
                                        @endif
                                    @endif
                                    
                                    <br><br>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label">Log-in to your Rapidx account and go to JSOX Database_3 Set Documents_Revision History </label><br><br>
                                        <label class="col-sm-12 col-form-label">Here's the link: http://rapidx/ </label>
                                    </div>
                                </div>

                                <br>
                                <br>

                                <div class="col-sm-12">
                                    <div class="form-group row">
                                        <label class="col-sm-12 col-form-label"><b> Notice of Disclaimer: </b></label>
                                        <br>
                                        <label class="col-sm-12 col-form-label"></label>   This message contains confidential information intended for a specific individual and purpose. If you are not the intended recipient, you should delete this message. Any disclosure,copying, or distribution of this message, or the taking of any action based on it, is strictly prohibited.</label>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <br><br>
                                    <label style="font-size: 18px;"><b>For concerns on using the form, please contact ISS at local numbers 205, or 208. You may send us e-mail at <a href="mailto: servicerequest@pricon.ph">servicerequest@pricon.ph</a></b></label>
                                </div>
                            </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>


        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    </body>
</html>