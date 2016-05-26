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
        <h2><?php echo ucfirst($_SESSION['nick_name']);?></h2>
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
          <li><a><i class="fa fa-bullhorn"></i> 通知管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Article/index','category_id=4');?>">小区通知</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/index','category_id=5');?>">政府公告</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/index','category_id=6');?>">办事指南</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/index','category_id=7');?>">便民服务</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/add','cid=1');?>"><i class="fa fa-edit red"></i> 发布文章</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/trash');?>"> <i class="fa fa-trash red"></i>回收站</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-wrench"></i> 维修管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Repair/toHandle');?>">待处理</a>
              </li>
              <li><a href="<?php echo U('Admin/Repair/handled');?>">已处理</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-envelope"></i> 反馈管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Feedback/toHandle');?>">待处理</a>
              </li>
              <li><a href="<?php echo U('Admin/Feedback/handled');?>">已处理</a>
              </li>
            </ul>
          </li>          
          <li><a href="<?php echo U('Admin/Category/index');?>"><i class="fa fa-list-ol"></i> 分类管理 <span class="fa fa-chevron-down"></span></a>
          </li>
        </ul>
      </div>
      <div class="menu_section">
        <h2>高级</h2>
        <ul class="nav side-menu">
          <li><a><i class="fa fa-users green"></i> 业主管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Users/index');?>">业主信息</a>
              </li>
              <li><a href="<?php echo U('Admin/Users/add');?>">添加业主信息</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-users blue"></i> 物业人员管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Mgrs/index');?>">物业人员信息</a>
              </li>
              <li><a href="<?php echo U('Admin/Mgrs/add');?>">添加物业人员信息</a>
              </li>
            </ul>
          </li>
          <li><a><i class="fa fa-user red"></i> 超级管理员管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Admin/index');?>">超级管理员信息</a>
              </li>
              <li><a href="<?php echo U('Admin/Admin/add');?>">添加超级管理员信息</a>
              </li>
            </ul>
          </li>                          
          <li><a><i class="fa fa-cog"></i> 权限管理 <span class="fa fa-chevron-down"></span></a>
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
            <img src="/smart_community/Public/admin/images/img.jpg" alt=""><?php echo ucfirst($_SESSION['nick_name']);?>
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
        url: "/smart_community/admin.php/Public/logout",
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
				<li class="active"><a href=""><b>待处理维修信息详情</b></a></li>
			</ul>
			<p></p>
			<form class="form-horizontal" role="form"
					enctype="multipart/form-data">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-xs-2"></div>
				<div class="col-lg-6 col-md-6 col-xs-6">
					<span class="help-block"></span>
				</div>
				<div class="col-lg-4 col-md-4 col-xs-4"></div>
			</div>
			<p></p>
				<input type="hidden" id="id"
					value="<?php echo $_GET['id']?>">
				<div class="form-group">
					<label for="title" class="col-sm-2 control-label">标题</label>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="title"
							name="title" value="<?php echo ($item['title']); ?>" maxlength="150"
							readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="type" class="col-sm-2 control-label">类别</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="type"
							name="type" value="<?php echo ($item['cid']); ?>" maxlength="20"
							readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="from_who" class="col-sm-2 control-label">来自</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="from_who"
							name="from_who" value="<?php echo ($item['from_who']); ?>" maxlength="20"
							readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="mobile" class="col-sm-2 control-label">手机</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="mobile"
							name="mobile" value="<?php echo ($item['mobile']); ?>" maxlength="20"
							readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="create_time" class="col-sm-2 control-label">创建时间</label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="create_time"
							name="create_time" value="<?php echo ($item['create_time']); ?>" readonly>
					</div>
				</div>
				<div class="form-group">
					<label for="content" class="col-sm-2 control-label">内容</label>
					<div class="col-sm-8">
						<script id="content" name="content"
							type="text/plain"><?php echo (htmlspecialchars_decode($item["content"])); ?></script>
						<script type="text/javascript">
							//设置只读
							var editor = new UE.ui.Editor({
								readonly : true,
							});
							editor.render('content');
						</script>
					</div>
				</div>
				<div class="form-group">
					<label for="materials" class="col-sm-2 control-label">图片</label>
					<div class="col-sm-3">
						<img alt="图片1" src="" width="100" height="50">
						<img alt="图片2" src="" width="100" height="50">
						<img alt="图片3" src="" width="100" height="50">
					</div>
				</div>
				<div class="ln_solid"></div>
			</form>		
			<form class="form-horizontal" role="form"
					enctype="multipart/form-data">
				<div class="form-group">
					<label for="results" class="col-sm-2 control-label">处理结果</label>
					<div class="col-sm-6">
						<textarea class="form-control" rows="3" id="results"
							placeholder="" maxlength="150"><?php echo ($item['des']); ?></textarea>
					</div>
				</div>
				<div class="form-group">
					<div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
						<a href="javascript:;" id="handle" class="btn btn-success"><li class="fa fa-check"></li> 保存处理结果</a>
					</div>
				</div>
			</form>
		</div>
		<!-- col end -->
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
  <!--[if lte IE 8]><script type="text/javascript" src="__ADMIN__/js/excanvas.min.js"></script><![endif]-->
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
	<!-- Tags -->
	<!-- 	<script src="/smart_community/Public/admin/js/tags/jquery.tagsinput.min.js"></script> -->
	<script>
		//input tags
		/* 		function onAddTag(tag) {
		 alert("Added a tag: " + tag);
		 }

		 function onRemoveTag(tag) {
		 alert("Removed a tag: " + tag);
		 }

		 function onChangeTag(input, tag) {
		 alert("Changed a tag: " + tag);
		 }

		 $(function() {
		 $('#article_keyword').tagsInput({
		 width : 'auto'
		 });
		 }); */
		 
		//保存处理结果
		$('body').on(
				'click',
				'#handle',
				function() {
					$.ajax({
						type : "post",
						url : "/smart_community/admin.php/Repair/handle",
						data : {
							'access_token' : getCookie('access_token'),
							'id' : $('#id').val(),
							'results' : $('#results').val()
						},
						dataType : "json",
						success : function(data) {
							if (data['code'] == '200' || data['code'] == '-200'
									|| data['code'] == '-205'
									|| data['code'] == '-206' || data['code'] == '-207' || data['code'] == '-208') {
								alert(data['info']);
								location.href = 'http://'
										+ data['data']['redirect_url'];
							}
							if(data['code'] == '-201'){
								alert(data['info']);
							}
						},
						error : function(xhr, type, errorThrown) {
							//异常处理
							console.log(type);
						}
					});
				})
	</script>

	<!-- END CORE PLUGINS -->

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>