<div id="header" class="navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="navbar-inner">
        <div class="container-fluid">
            <!-- BEGIN LOGO -->
            <a class="brand" href="index.html">
                <img src="/static/img/logo.png" alt="showboom - 销售管理平台" />
            </a>
            <!-- END LOGO -->
            <!-- BEGIN RESPONSIVE MENU TOGGLER -->
            <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="arrow"></span>
            </a>
            <!-- END RESPONSIVE MENU TOGGLER -->
            <div id="top_menu" class="nav notify-row">
                <!-- BEGIN NOTIFICATION -->
                <ul class="nav top-menu">
                    <!-- BEGIN SETTINGS -->
                    <li class="dropdown">
                        <a class="dropdown-toggle element" data-placement="bottom" data-toggle="tooltip" href="#" data-original-title="Settings">
                            <i class="icon-cog"></i>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- END  NOTIFICATION -->
            <div class="top-nav ">
                <ul class="nav pull-right top-menu" >
                    <!-- BEGIN USER LOGIN DROPDOWN -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="/static/img/avatar1_small.jpg" alt="">
                            <span class="username">{$_SESSION['user_info']['user_nickname']}</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li style="padding-top: 8px"><a href="/admin/user/setself.html"><i class="icon-user"></i> 我的信息</a></li>
                            <li class="divider"></li>
                            <li style="padding-bottom:8px"><a href="/admin/auth/logout.html"><i class="icon-key"></i> 登出</a></li>
                        </ul>
                    </li>
                    <!-- END USER LOGIN DROPDOWN -->
                </ul>
                <!-- END TOP NAVIGATION MENU -->
            </div>
        </div>
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>

