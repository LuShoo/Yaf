<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>showboom - 销售管理平台</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <link href="/static/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/static/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet"/>
    <link href="/static/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link href="/static/css/style.css" rel="stylesheet"/>
    <link href="/static/css/style_responsive.css" rel="stylesheet"/>
    <link href="/static/css/style_default.css" rel="stylesheet" id="style_color"/>
    <link href="/static/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/static/assets/uniform/css/uniform.default.css"/>
    <!-- Load javascripts at bottom, this will reduce page load time -->
    <script src="/static/js/jquery-1.8.3.min.js"></script>
    <script src="/static/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="/static/js/jquery.blockui.js"></script>
    </head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="fixed-top">
<!-- BEGIN HEADER -->
{include ../../Admin/views/header.tpl}
<!-- END HEADER -->
<!-- BEGIN CONTAINER -->
<div id="container" class="row-fluid">
    <!-- BEGIN SIDEBAR -->
    {include ../../Admin/views/menu.tpl}
    <!-- END SIDEBAR -->
    <!-- BEGIN PAGE -->
    <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->
            <div class="row-fluid">
                <div class="span12">
                    <!-- BEGIN THEME CUSTOMIZER-->
                    <div id="theme-change" class="hidden-phone">
                        <i class="icon-cogs"></i>
                        <span class="settings">
                            <span class="text">Theme:</span>
                            <span class="colors">
                                <span class="color-default" data-style="default"></span>
                                <span class="color-gray" data-style="gray"></span>
                                <span class="color-purple" data-style="purple"></span>
                                <span class="color-navy-blue" data-style="navy-blue"></span>
                            </span>
                        </span>
                    </div>
                    <div class="widget">
                        <div class="widget-body" style="margin-top:20px;display: block; height:720px;">
                            <div  style="display: block; text-align: center; line-height:500px; font-size: 80px;">
                                欢迎来到秀豹管理平台!
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <!--<div class="span12"> -->
                    <!-- BEGIN BORDERED TABLE widget-->
                <!--<div class="widget">
                    <div class="widget-title">
                        <h4><i class="icon-reorder"></i>Bordered Table</h4>
                    <span class="tools">
                    <a href="javascript:;" class="icon-chevron-down"></a>
                    <a href="javascript:;" class="icon-remove"></a>
                    </span>
                    </div>
                    <div class="widget-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th class="hidden-phone">Username</th>
                                <th>Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Rafiqul</td>
                                <td>Islam</td>
                                <td class="hidden-phone">dk123</td>
                                <td><span class="label label-success">Approved</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Mosaddek</td>
                                <td>Hossain</td>
                                <td class="hidden-phone">mos123</td>
                                <td><span class="label label-info">Pending</span></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Dulal</td>
                                <td>Khan</td>
                                <td class="hidden-phone">lorem</td>
                                <td><span class="label label-warning">Suspended</span></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Sumon</td>
                                <td>Ahmed</td>
                                <td class="hidden-phone">ispum</td>
                                <td><span class="label label-danger">Blocked</span></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>-->
                <!-- END BORDERED TABLE widget-->
                <!--</div>-->
            </div>

            <!-- END PAGE CONTENT-->
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
    <!-- END CONTAINER -->
    <!-- BEGIN FOOTER -->
    {include ../../Admin/views/footer.tpl}
</div>
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        App.init();
    });
</script>
</body>
<!-- END BODY -->
</html>