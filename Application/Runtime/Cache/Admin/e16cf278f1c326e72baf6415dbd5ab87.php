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

<link href="/smart_community/Public/admin/css/bootstrap.min.css" rel="stylesheet">

<link href="/smart_community/Public/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
<link href="/smart_community/Public/admin/css/animate.min.css" rel="stylesheet">

<!--[if lt IE 9]>
      <script src="../assets/js/ie8-responsive-file-warning.js"></script>
      <![endif]-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      
<!-- Custom styling plus plugins -->
<link href="/smart_community/Public/admin/css/custom.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/smart_community/Public/admin/css/maps/jquery-jvectormap-2.0.3.css" />
<link href="/smart_community/Public/admin/css/icheck/flat/green.css" rel="stylesheet" />
<link href="/smart_community/Public/admin/css/floatexamples.css" rel="stylesheet" type="text/css" />    
<script src="/smart_community/Public/admin/js/jquery.min.js"></script>

<script type="text/javascript"
	src="/smart_community/Public/admin/ueditor/ueditor.config.js"></script>
<script type="text/javascript"
	src="/smart_community/Public/admin/ueditor/ueditor.all.js"></script>
</head>
<body class="nav-md">
	<div class="container body">
<div class="main_container">

<div class="col-md-3 left_col">
  <div class="left_col scroll-view">

    <div class="navbar nav_title" style="border: 0;">
      <a href="<?php echo U('Admin/Index/index');?>" class="site_title"><i class="fa fa-paw"></i> <span>智慧社区后台</span></a>
    </div>
    <div class="clearfix"></div>

    <!-- menu prile quick info -->
    <div class="profile">
      <div class="profile_pic">
        <img src="/smart_community/Public/admin/images/img.jpg" alt="..." class="img-circle profile_img">
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
              <li><a href="<?php echo U('Admin/Index/index');?>">控制台</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-edit"></i> 通知发布 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Notice/index','notice_type=1');?>">小区通知</a>
              </li>
              <li><a href="<?php echo U('Admin/Notice/index','notice_type=2');?>">政府公告</a>
              </li>
              <li><a href="<?php echo U('Admin/Notice/index','notice_type=3');?>">办事指南</a>
              </li>
              </li>
              <li><a href="<?php echo U('Admin/Article/index');?>">文章</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h2>高级</h2>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-bug"></i> 业主管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Users/index');?>">业主信息</a>
              </li>
              <li><a href="<?php echo U('Admin/Users/add');?>">添加业主信息</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-bug"></i> 物业人员管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Mgrs/index');?>">物业人员信息</a>
              </li>
              <li><a href="<?php echo U('Admin/Mgrs/add');?>">添加物业人员信息</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-bug"></i> 超级管理员管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Admin/index');?>">超级管理员信息</a>
              </li>
              <li><a href="<?php echo U('Admin/Admin/add');?>">添加超级管理员信息</a>
              </li>
            </ul>
          </li>                          
          <li><a><i class="fa fa-windows"></i> 权限管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Access/index_list');?>">用户列表</a>
              </li>
              <li><a href="<?php echo U('Admin/Access/role_list');?>">角色列表</a>
              </li>
              <li><a href="<?php echo U('Admin/Access/node_list');?>">节点列表</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>

    </div>
    <!-- /sidebar menu -->

    <!-- /menu footer buttons -->
    <!-- <div class="sidebar-footer hidden-small"> -->
    <div class="sidebar-footer">
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
        <li id="user-profile" class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <img src="/smart_community/Public/admin/images/img.jpg" alt="">Admin
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

        <li id="presentation" role="presentation" class="dropdown">
          <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-envelope-o"></i>
            <span class="badge bg-green">6</span>
          </a>
          <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
            <li>
              <a>
                <span class="image">
                                  <img src="/smart_community/Public/admin/images/img.jpg" alt="Profile Image" />
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
                                  <img src="/smart_community/Public/admin/images/img.jpg" alt="Profile Image" />
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
        url: "/smart_community/index.php/Admin/Article/logout",
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
		<div class="col-lg-10 col-md-10 col-xs-12"
			style="background-color: #FFF;">
			<!-- begin tab -->
			<ul class="nav nav-tabs ">
				<li><a href="<?php echo U('Articlecate/index/');?>"><b>文章分类</b></a></li>
				<li><a href="<?php echo U('Articlecate/add/');?>"><b>分类增加</b></a></li>
				<li><a href="<?php echo U('Article/index/');?>"><b>文章管理</b></a></li>
				<li class="active"><a href="<?php echo U('Article/add/');?>"><b>文章增加</b></a></li>
			</ul>
			<p></p>
			<div class="row">
				<div class="col-lg-2 col-md-2 col-xs-2"></div>
				<div class="col-lg-6 col-md-6 col-xs-6">
					<span class="help-block"></span>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-4"></div>
			</div>
			<p></p>
			<form class="form-horizontal" role="form"
				enctype="multipart/form-data" action="<?php echo U('Article/addsave/');?>"
				method="post">
				<div class="form-group">
					<label for="inputEmail3" class="col-sm-2 control-label">文章标题</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="inputEmail3"
							name="atitle" value="">
					</div>
					<div class="col-sm-4">
						<span class="help-block"><i class="fa fa-exclamation"></i>请输入文章标题</span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail5" class="col-sm-2 control-label">文章分类</label>
					<div class="col-sm-3">
						<select class="form-control" name="acid">
							<?php if(is_array($clist)): $i = 0; $__LIST__ = $clist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo["acid"]); ?>"><?php echo ($vo["cname"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
					</div>
					<div class="col-sm-7">
						<span class="help-block"><i class="fa fa-exclamation"></i>请输入选择分类</span></span>
					</div>
				</div>
				<div class="form-group">
					<label for="inputEmail11" class="col-sm-2 control-label">内容</label>
					<div class="col-sm-8">
						<script id="conted" name="content" type="text/plain"></script>
						<script type="text/javascript">
									var editor = UE.getEditor('conted')
								</script>
					</div>
					<div class="col-sm-2">
						<span class="help-block"></span>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<button type="sumbit" class="btn btn-primary">保存</button>
				</div>
			</form>
		</div>
		<!-- end container -->
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

<script type="text/javascript" src="/smart_community/Public/admin/js/bootstrap.min.js"></script>
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

  <script src="/smart_community/Public/admin/js/custom.js"></script>

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
	<script src="/smart_community/Public/admin/js/bootstrap.min.js"></script>
<!-- <script src="/smart_community/Public/admin/js/nprogress.js"></script> -->
<!-- bootstrap progress js -->
<script src="/smart_community/Public/admin/js/progressbar/bootstrap-progressbar.min.js"></script>
<!-- icheck -->
<script src="/smart_community/Public/admin/js/icheck/icheck.min.js"></script>

<!-- <script src="/smart_community/Public/admin/js/custom.js"></script> -->

<!-- pace -->
<script src="/smart_community/Public/admin/js/pace/pace.min.js"></script>
<script>
/* 	function getCookie(cookie_name)
	{
	    var allcookies = document.cookie;
	    var cookie_pos = allcookies.indexOf(cookie_name);   //索引的长度
	 
	    // 如果找到了索引，就代表cookie存在，
	    // 反之，就说明不存在。
	    if (cookie_pos != -1)
	    {
	        // 把cookie_pos放在值的开始，只要给值加1即可。
	        cookie_pos += cookie_name.length + 1;      //这里容易出问题，所以请大家参考的时候自己好好研究一下
	        var cookie_end = allcookies.indexOf(";", cookie_pos);
	 
	        if (cookie_end == -1)
	        {
	            cookie_end = allcookies.length;
	        }
	 
	        var value = unescape(allcookies.substring(cookie_pos, cookie_end));         //这里就可以得到你想要的cookie的值了。。。
	    }
	    return value;
	} */

	function getCookie(name){
		var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
		if(arr=document.cookie.match(reg)){
			return unescape(arr[2]);		
		}else{
			return null;
		}
	}
	
	$('#user-profile').on('click',function(){
		$('#user-profile').addClass('open');
	})
	$('#presentation').on('click',function(){
		$('#presentation').addClass('open');
	})
</script>
	<script>
		$('#myModal').on('hidden.bs.modal', function(e) {
			location.reload()

		})
		$('#ajax').on('hidden.bs.modal', function(e) {
			location.reload()

		})

		function delcfm() {
			if (!confirm("确认要删除？")) {
				window.event.returnValue = false;
			}
		}
	</script>

	<!-- END CORE PLUGINS -->

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>