<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Web Mail</title>

    <!-- Bootstrap core CSS -->

    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <link href="/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="/css/custom.css" rel="stylesheet">
    <link href="/css/icheck/flat/green.css" rel="stylesheet" />
    <link href="/css/floatexamples.css" rel="stylesheet" type="text/css" />

    <script src="/js/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body class="nav-md">
@section('navigation')
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="{{ url('/home') }}" class="site_title"><i class="fa fa-paw"></i> <span>Web Mail</span></a>
                    </div>
                    <div class="clearfix"></div>
                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="/images/img.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome, {{ Auth::user()->name }}</span>
                            <h2></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->
                    <br />
                    @show
                            <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                    <li><a><i class="fa fa-home"></i> Cuenta <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="/cuenta/create">Crear Cuenta</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-edit"></i> Billetes <span class="fa fa-chevron-down"></span></a>

                                    </li>
                                    <li><a><i class="fa fa-desktop"></i> Cajero <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">

                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-table"></i> Usuarios <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                        </ul>
                                    </li>

                                    <li><a><i class="fa fa-home"></i> Cuenta <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                        </ul>
                                    </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="/images/img.png" alt="">{{Auth::user()->name}}
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->
        </div>
    </div>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/custom.js"></script>
    <!-- /footer content -->
</body>
</html>

