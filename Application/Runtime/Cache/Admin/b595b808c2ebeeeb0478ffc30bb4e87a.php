<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>JoyRill智慧社区后台</title>
	<!-- Public core css/js -->
	<!-- Bootstrap core CSS -->

<link href="../../../Public/Admin/css/bootstrap.min.css" rel="stylesheet">

<link href="../../../Public/Admin/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="../../../Public/Admin/css/animate.min.css" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
      <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
<!-- Custom styling plus plugins -->
<link href="../../../Public/Admin/css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../../../Public/Admin/css/maps/jquery-jvectormap-2.0.3.css" />
<link href="../../../Public/Admin/css/icheck/flat/green.css" rel="stylesheet" />
<link href="../../../Public/Admin/css/floatexamples.css" rel="stylesheet" type="text/css" />

<script src="../../../Public/Admin/js/jquery.min.js"></script>
<script src="../../../Public/Admin/js/nprogress.js"></script>      
</head>
<body class="nav-md">
	<div class="container body">
<div class="main_container">

<div class="col-md-3 left_col">
  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
      <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>智慧社区后台</span></a>
    </div>
    <div class="clearfix"></div>

    <!-- menu prile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="../../../Public/Admin/images/img.jpg" alt="..." class="img-circle profile_img">
      </div>
      <div class="profile_info">
        <span>Welcome,</span>
        <h2>Admin</h2>
      </div>
    </div>
    <!-- /menu prile quick info -->

    <br />

    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

      <div class="menu_section">
        <h2>通用</h2>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-home"></i> 主页 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="index.html">控制台</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> 通知发布 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="#">小区通知</a>
              </li>
              <li><a href="#">政府公告</a>
              </li>
              <li><a href="#">办事指南</a>
              </li>
<!--               <li><a href="form_wizards.html">Form Wizard</a>
              </li>
              <li><a href="form_upload.html">Form Upload</a>
              </li>
              <li><a href="form_buttons.html">Form Buttons</a>
              </li> -->
            </ul>
          </li>
<!--           <li><a><i class="fa fa-desktop"></i> UI Elements <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="general_elements.html">General Elements</a>
              </li>
              <li><a href="media_gallery.html">Media Gallery</a>
              </li>
              <li><a href="typography.html">Typography</a>
              </li>
              <li><a href="icons.html">Icons</a>
              </li>
              <li><a href="glyphicons.html">Glyphicons</a>
              </li>
              <li><a href="widgets.html">Widgets</a>
              </li>
              <li><a href="invoice.html">Invoice</a>
              </li>
              <li><a href="inbox.html">Inbox</a>
              </li>
              <li><a href="calendar.html">Calendar</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-table"></i> Tables <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="tables.html">Tables</a>
              </li>
              <li><a href="tables_dynamic.html">Table Dynamic</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-bar-chart-o"></i> Data Presentation <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="chartjs.html">Chart JS</a>
              </li>
              <li><a href="chartjs2.html">Chart JS2</a>
              </li>
              <li><a href="morisjs.html">Moris JS</a>
              </li>
              <li><a href="echarts.html">ECharts </a>
              </li>
              <li><a href="other_charts.html">Other Charts </a>
              </li>
            </ul>
          </li> -->
        </ul>
      </div>
      <div class="menu_section">
        <h2>高级</h2>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-bug"></i> 业主管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="#">业主信息</a>
              </li>
              <li><a href="#">添加业主信息</a>
              </li>
              <li><a href="#">更新业主信息</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-bug"></i> 物业人员管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="#">物业人员信息</a>
              </li>
              <li><a href="#">添加物业人员信息</a>
              </li>
              <li><a href="#">更新物业人员信息</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-bug"></i> 超级管理员管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="#">超级管理员信息</a>
              </li>
              <li><a href="#">添加超级管理员信息</a>
              </li>
              <li><a href="#">更新超级管理员信息</a>
              </li>
            </ul>
          </li>                          
          <li><a><i class="fa fa-windows"></i> 权限管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="#">用户列表</a>
              </li>
              <li><a href="#">角色列表</a>
              </li>
              <li><a href="#">节点列表</a>
              </li>
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
            <img src="../../../Public/Admin/images/img.jpg" alt="">Admin
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="javascript:;">  账户信息</a>
            </li>
            <li>
              <a href="javascript:;">
<!--                 <span class="badge bg-red pull-right">50%</span> -->
                <span> 设置</span>
              </a>
            </li>
            <li>
              <a href="javascript:;"> 帮助</a>
            </li>
            <li><a onclick="logout()"><i class="fa fa-sign-out pull-right"></i> 退出系统</a>
            </li>
          </ul>
        </li>

        <li role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green">6</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image">
                                  <img src="../../../Public/Admin/images/img.jpg" alt="Profile Image" />
                              </span>
                <span>
                                  <span>Admin</span>
                <span class="time">3 分钟前</span>
                </span>
                <span class="message">
                                  通知内容1
                              </span>
              </a>
            </li>
            <li>
              <a>
                <span class="image">
                                  <img src="../../../Public/Admin/images/img.jpg" alt="Profile Image" />
                              </span>
                <span>
                                  <span>Admin</span>
                <span class="time">3 分钟前</span>
                </span>
                <span class="message">
                                  通知内容2
                              </span>
              </a>
            </li>
            <li>
              <div class="text-center">
                <a href="inbox.html">
                  <strong>查看所有通知</strong>
                  <i class="fa fa-angle-right"></i>
                </a>
              </div>
            </li>
          </ul>
        </li>

      </ul>
    </nav>
  </div>

</div>
<!-- /top navigation -->

  <script>
    //触发退出事件
    function logout(){
      $.ajax({
        type: "post",
        url: "/smart_community/index.php/Admin/Index/logout",
        data: {
          },
        dataType: "json",
        success: function(data) {
        	alert(data['info']);
        	location.href = 'http://' + data['data']['redirect_url'];
        },
        error: function(xhr, type, errorThrown) {
          //异常处理
          console.log(type);
        }
      });
    }
  </script>

	
	<!-- page content -->
	<div class="right_col" role="main">
	</div>
	<!-- /page content -->
	
	<!-- footer content -->
<footer>
  <div class="pull-right">
    <strong>Copyright &copy; 2016 <a href="http://www.joyrill.com">JoyRill</a>.</strong> All rights
    reserved.
  </div>
  <div class="clearfix"></div>
</footer>
<!-- /footer content -->
  </div>
</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
  <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
  </ul>
  <div class="clearfix"></div>
  <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script type="text/javascript" src="../../../Public/Admin/js/bootstrap.min.js"></script>
<!-- /footer content -->

<!-- gauge js -->
<!--   <script type="text/javascript" src="js/gauge/gauge.min.js"></script>
  <script type="text/javascript" src="js/gauge/gauge_demo.js"></script>
  bootstrap progress js
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  icheck
  <script src="js/icheck/icheck.min.js"></script>
  daterangepicker
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  chart js
  <script src="js/chartjs/chart.min.js"></script> -->

  <script src="../../../Public/Admin/js/custom.js"></script>

  <!-- flot js -->
  <!--[if lte IE 8]><script type="text/javascript" src="../../../Public/Admin/js/excanvas.min.js"></script><![endif]-->
<!--   <script type="text/javascript" src="js/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.orderBars.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.time.min.js"></script>
  <script type="text/javascript" src="js/flot/date.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.spline.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="js/flot/curvedLines.js"></script>
  <script type="text/javascript" src="js/flot/jquery.flot.resize.js"></script> -->
<!--     <div class="dialog">
        <div class="head">
            <a href="#" class="active login">登陆</a>
            <a href="#" class="register">注册</a>
        </div>
        <div class="content">
            <ul class="register">
                <form class="form-horizontal" method="post" action="<?php echo U('Admin/Login/signup');?>">
                    <li><input type="text" name="name" placeholder="用户名"/></li>
                    <li><input type="password" name="passwd" placeholder="密码"></li>
                    <li><input type="password" name="confirm" placeholder="确认密码"></li>
                    <li>
                        <input type="text" name="code" style="width:80px">
                        <img class="captcha" src="<?php echo U('Admin/Login/captcha');?>" alt="">
                    </li>
                    <li><input type="submit" value="提交"></li>
                </form>
            </ul>
            <ul class="login">
                <form class="form-horizontal" method="post" action="<?php echo U('Admin/Login/signin');?>">
                    <li><input type="text" name="name" placeholder="用户名"/></li>
                    <li><input type="password" name="passwd" placeholder="密码"></li>
                    <li>
                        <input type="text" name="code"  style="width:80px">
                        <img class="captcha" src="<?php echo U('Admin/Login/captcha');?>" alt="">
                    </li>
                    <li><input type="submit" value="提交"></li>
                </form>
            </ul>
        </div>
    </div> -->
</body>
</html>