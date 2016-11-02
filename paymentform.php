<?php
session_start();
// //$paypal_id='info@codexworld.com'; // Business email ID
// $paypal_id='aistechnolabs11@gmail.com'; // Business email ID
// $service_tax = 4;

include 'config.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <link rel="shortcut icon" href="assets/images/favicon_1.ico">
        <title>Payment Form</title>
        <!--Morris Chart CSS -->
        <link rel="stylesheet" href="assets/plugins/morris/morris.css">
        <link href="assets/plugins/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
        <link href="assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
        <link href="assets/plugins/footable/css/footable.core.css" rel="stylesheet">
        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <script src="assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            
            
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">
                        
                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-8">
                                <h4 class="page-title">Payment Form</h4>
                                <ol class="breadcrumb">
                                    
                                </ol>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="row">
                                        <h4 class="m-t-0 m-l-10 header-title"><b>Add Payment Information</b></h4>
                                        <p class="text-muted m-b-30 m-l-10 font-13">Use the form below to add Payment Information.</p>
                                        <div class="col-md-8 m-b-10">
                                            <?php if(isset($_SESSION['error'])){?>
                                                <div class="col-sm-12" style="background-color:#EBEFF2;margin-bottom:20px;">
                                                    <h3><strong style="color:red">Validation Error !!!</strong></h3> <br>
                                                    <strong><?php echo $_SESSION['error']; ?></strong> 
                                                </div>
                                            <?php } ?>
                                            <form class="form-horizontal" role="form" action="payment.php" method="post" name="frmPayPal1" id="frmPayPal1">
                                                <div class="form-group">
                                                    <label for="inputEmail3" class="col-sm-3 control-label">Name <strong style="color:red">*</strong></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo (isset($_SESSION['old']['name']))?$_SESSION['old']['name']:'' ?>" class="form-control" name="name" id="name" placeholder="Enter name" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label">Email</label>
                                                    <div class="col-sm-9">
                                                        <input type="email" value="<?php echo (isset($_SESSION['old']['email']))?$_SESSION['old']['email']:'' ?>" class="form-control" name="email" placeholder="Enter Email id">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword4" class="col-sm-3 control-label">Contact Person<strong style="color:red">*</strong></label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="contact_person" required="required">
                                                            <option value=''>Select</option>
                                                            <?php foreach ($contact_person as $key => $value): ?>
                                                                <option value=<?php echo $key ?> <?php echo (isset($_SESSION['old']['contact_person']) && $_SESSION['old']['contact_person']==$key)?'selected':'' ?> > <?php echo $value ?></option>    
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label">Project Name<strong style="color:red">*</strong></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" value="<?php echo (isset($_SESSION['old']['item_name']))?$_SESSION['old']['item_name']:'' ?>" class="form-control" id="item_name" name="item_name" placeholder="Enter project name" required="required">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label">Amount (USD)<strong style="color:red">*</strong></label>
                                                    <div class="col-sm-4">
                                                        <?php $temp_amount = (isset($_SESSION['old']['amounts']) && is_numeric($_SESSION['old']['amounts']))?$_SESSION['old']['amounts']:0; ?>
                                                        <input type="text" value="<?php echo $temp_amount ?>" class="form-control" id="amount" name="amounts" onkeyUp="get_total(this);" placeholder="Enter amount" required="required">
                                                    </div>

                                                    <div>
                                                        <label for="inputPassword3" class="col-sm-3 control-label">Paypal Fee :</label>
                                                        <label for="inpu1" class="col-sm-2 control-label paypal-fee" style="text-align:center">
                                                            <?php $temp_paypal_fee = ($service_tax/100)*$temp_amount ?>
                                                            <?php echo $temp_paypal_fee; ?>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputPassword3" class="col-sm-3 control-label">Total</label>
                                                    <div class="col-sm-9">
                                                        <?php $total_amount = $temp_amount+$temp_paypal_fee; ?>
                                                        <input type="text" class="form-control" id="total" readonly="" name="total" value="<?php echo $total_amount; ?>" >
                                                        <input type="hidden" name="amount" id="tot_amount" value=""/>
                                                    </div>
                                                </div>
                                                <div class="form-group m-b-0">
                                                    <div class="col-sm-offset-3 col-sm-9">
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Pay Now</button>
                                                        <button type="button" class="btn btn-danger waves-effect waves-light" onClick="window.location.reload()">Reset</button>
                                                    </div>
                                                </div>
                                                
                                                <input type="hidden" name="business" value="<?php echo $paypal_id ?>">
                                                <input type="hidden" name="cmd" value="_xclick">
                                                <input type="hidden" name="item_number" value="1">
                                                <input type="hidden" name="credits" value="510">
                                                <input type="hidden" name="userid" value="1">
                                                <input type="hidden" name="cpp_header_image" value="assets/images/ais-logo.png">
                                                <input type="hidden" name="no_shipping" value="1">
                                                <input type="hidden" name="currency_code" value="USD">
                                                <input type="hidden" name="handling" value="0">
                                                <?php if ($_SERVER['HTTP_HOST']=='localhost'): ?>
                                                    <input type="hidden" name="cancel_return" value="<?php echo $local_cancel_return; ?>">
                                                    <input type="hidden" name="return" value="<?php echo $local_return; ?>">
                                                <?php else: ?>
                                                    <input type="hidden" name="cancel_return" value="<?php echo $live_cancel_return; ?>">
                                                    <input type="hidden" name="return" value="<?php echo $live_return; ?>">
                                                <?php endif ?>
                                                
                                            </form>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- container -->
                        
                    </div>
                    <!-- content -->
                    <!--<footer class="footer text-right"> 2015 © Flight Delays </footer>-->
                </div>
                <!-- ============================================================== -->
                <!-- End Right content here -->
                <!-- ============================================================== -->
            </div>
            <?php
                if(isset($_SESSION['old']) || isset($_SESSION['error'])){
                    unset($_SESSION['old'],$_SESSION['error']); 
                }
            ?>
            <!-- END wrapper -->
            <script>
            var resizefunc = [];
            </script>
            <!-- jQuery  -->
            <script src="assets/js/jquery.min.js"></script>
            <script src="assets/js/bootstrap.min.js"></script>
            <script src="assets/js/detect.js"></script>
            <script src="assets/js/fastclick.js"></script>
            <script src="assets/js/jquery.slimscroll.js"></script>
            <script src="assets/js/jquery.blockUI.js"></script>
            <script src="assets/js/waves.js"></script>
            <script src="assets/js/wow.min.js"></script>
            <script src="assets/js/jquery.nicescroll.js"></script>
            <script src="assets/js/jquery.scrollTo.min.js"></script>
            <script src="assets/plugins/peity/jquery.peity.min.js"></script>
            <!-- jQuery  -->
            <script src="assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
            <script src="assets/plugins/counterup/jquery.counterup.min.js"></script>
            <script src="assets/plugins/morris/morris.min.js"></script>
            <script src="assets/plugins/raphael/raphael-min.js"></script>
            <script src="assets/plugins/jquery-knob/jquery.knob.js"></script>
            <script src="assets/pages/jquery.dashboard_2.js"></script>
            <script src="assets/js/jquery.core.js"></script>
            <script src="assets/js/jquery.app.js"></script>
            <script type="text/javascript">
            jQuery(document).ready(function($) {
            $('.counter').counterUp({
            delay: 100,
            time: 1500
            });
            $(".knob").knob();
            });
            </script>
            <script src="assets/plugins/moment/moment.js"></script>
            <script src="assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
            
            <script src="assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
            <script src="assets/plugins/clockpicker/dist/jquery-clockpicker.min.js"></script>
            <script src="assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
            </script><script src="assets/plugins/footable/js/footable.all.min.js"></script>
            <script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
            <script src="assets/pages/jquery.footable.js"></script>
            <script type="text/javascript" src="assets/js/jquery.validate.min.js"></script>
            <script type="text/javascript" src="assets/js/additional-methods.min.js"></script> 
            <script type="text/javascript">
                function get_total(sender)
                {

                    var amount = parseFloat($(sender).val()) || 0;
                    var service_tax = "<?php echo $service_tax ?>";
                    var tax = (service_tax/100)*amount;
                    var total_amount = amount + parseFloat(tax);
                    
                    $('.paypal-fee').text(tax);
                    $('#total').val(total_amount);
                    $('#tot_amount').val(total_amount);
                    
                }
        
                // just for the demos, avoids form submit
                $("#frmPayPal1").validate({
                rules: {
                name: {required: true},
                contact_person: {required: true},
                item_name: {required: true},
                amounts: {required: true, number:true},
                email: {email:true}
                },
                messages: {
                
                },
                submitHandler: function (form) {
                form.submit();
                }
                });
            </script>
        </body>
    </html>