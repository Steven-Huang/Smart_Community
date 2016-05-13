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
          <li><a><i class="fa fa-edit"></i> 通知管理 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="<?php echo U('Admin/Article/index','category_id=1');?>">小区通知</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/index','category_id=2');?>">政府公告</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/index','category_id=3');?>">办事指南</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/add');?>">发布通知</a>
              </li>
              </li>
              <li><a href="<?php echo U('Admin/Articlecate/index');?>">分类管理</a>
              </li>
              <li><a href="<?php echo U('Admin/Article/trash');?>">回收站</a>
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
        url: "/smart_community/index.php/Admin/Mgrs/logout",
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
		<div class="col-md-12 col-sm-12 col-xs-12">
        	<div class="x_panel">
                <ul id="myTab" class="nav nav-tabs " role="tablist">
                  <li role="presentation" class="active"><a href="#tab_content1" role="tab" id="approved-tab" data-toggle="tab" aria-expanded="true">物业人员（已审批）</a>
                  </li>
                  <li role="presentation" class=""><a href="#tab_content2" role="tab" id="pending-tab" data-toggle="tab" aria-expanded="false">物业人员（待审批）</a>
                  </li>
                </ul>
                <div id="myTabContent" class="tab-content">
                	<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
					    <div class="container-fluid">
					        <table class="table table-hover">
					            <thead>
					                <tr>
					                    <th>ID</th>
					                    <th>头像</th>
					                    <th>用户名</th>
					                    <th>真实姓名</th>
					                    <th>性别</th>
					                    <th>手机号</th>
					                    <th>邮箱</th>
					                    <th>身份证号</th>
					                    <th>创建时间</th>
					                    <th>上次登录IP</th>
					                    <th>上次登录时间</th>
					                    <th>操作</th>
					                </tr>
					            </thead>
					            <tbody id="tab1">
			                					                
					            </tbody>
					        </table>
					        <div id="pages1"></div>
					    </div>
                	</div>
                    <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
					    <div class="container-fluid">
					        <table class="table table-hover">
					            <thead>
					                <tr>
					                    <th>ID</th>
					                    <th>头像</th>
					                    <th>用户名</th>
					                    <th>真实姓名</th>
					                    <th>性别</th>
					                    <th>手机号</th>
					                    <th>邮箱</th>
					                    <th>身份证号</th>
					                    <th>创建时间</th>
					                    <th>操作</th>
					                </tr>
					            </thead>
					            <tbody id="tab2">
			                					                
					            </tbody>
					        </table>
					        <div id="pages2"></div>
					    </div>
                    </div>
                </div>
	  		</div>
	  	</div>
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
	<script type="text/javascript">
		window.onload = function(){
	    	$.ajax({
	            type: "post",
	            url: "/smart_community/index.php/Admin/Mgrs/approved_mgrs",
	            data: {
	            	access_token : getCookie('access_token'),
	              	num : '5',
	            },
	            dataType: "json",
	            success: function(data) {
	            	if(data['code'] == 200){
	            		if(data['data']['count'] == 0){
	            			$("#tab1").append("<font color='red'><h5>无用户信息！</h5></font>");
	            		}	            		
			            var len = data['data']['data'].length;
		            	for(var i=0; i < len; i++){
		            	 	var array = "/role/mgrs/user_id/"+data['data']['data'][i]['id'];
		            		$("#tab1").append("<tr><td>M"+data['data']['data'][i]['id']+"</td><td>"+data['data']['data'][i]['icon_url']+"</td><td>"+data['data']['data'][i]['nick_name']+"</td><td>"+data['data']['data'][i]['true_name']+"</td><td>"+data['data']['data'][i]['gender']+"</td><td>"+data['data']['data'][i]['mobile']+"</td><td>"+data['data']['data'][i]['email']+"</td><td>"+data['data']['data'][i]['id_card_num']+"</td><td>"+data['data']['data'][i]['create_time']+"</td><td>"+data['data']['data'][i]['last_log_ip']+"</td><td>"+data['data']['data'][i]['last_log_time']+"</td><td><a class=\"btn btn-info btn-xs\" href=\""+"<?php echo U('Admin/Mgrs/edit"+array+"');?>\"><i class=\"fa fa-pencil\"></i>更新</a>"+"<a class=\"btn btn-danger btn-xs\" href=\""+"<?php echo U('Admin/Admin/del_mgrs"+array+"');?>\"><i class=\"fa fa-trash\"></i>删除</a></td>"+"</tr>");
		            	 }
		            	$('#pages1').append(data['data']['page']);
	            	}
	            	if(data['code'] == '-205' || data['code'] == '-208'){
	            		alert(data['info']);
            			location.href = 'http://' + data['data']['redirect_url'];	            		
	            	}
	            },
	            error: function(xhr, type, errorThrown) {
	              //异常处理
	              console.log(type);
	            }
	          }); 			
		}
	    $('#pending-tab').one('click',function(){
	    	$.ajax({
	            type: "post",
	            url: "/smart_community/index.php/Admin/Mgrs/pending_mgrs",
	            data: {
			     	access_token : getCookie('access_token'),
			        num : '5',
	            },
	            dataType: "json",
	            success: function(data) {
	            	if(data['code'] == 200){
	            		if(data['data']['count'] == 0){
	            			$("#tab2").append("<font color='red'><h5>无用户信息！</h5></font>");
	            		}	            		
			            var len = data['data']['data'].length;
		            	for(var i=0; i < len; i++){
		            	 	var array = "/role/users/user_id/"+data['data']['data'][i]['id']+"/username/"+data['data']['data'][i]['nick_name']+"/role_id/"+data['data']['data'][i]['role_id'];
		            		$("#tab2").append("<tr><td>M"+data['data']['data'][i]['id']+"</td><td>"+data['data']['data'][i]['icon_url']+"</td><td>"+data['data']['data'][i]['nick_name']+"</td><td>"+data['data']['data'][i]['true_name']+"</td><td>"+data['data']['data'][i]['gender']+"</td><td>"+data['data']['data'][i]['mobile']+"</td><td>"+data['data']['data'][i]['email']+"</td><td>"+data['data']['data'][i]['id_card_num']+"</td><td>"+data['data']['data'][i]['create_time']+"</td><td><a class=\"btn btn-success btn-xs\" href=\""+"<?php echo U('Admin/Users/edit"+array+"');?>\"><i class=\"fa fa-check\"></i>审批通过</a>"+"<a class=\"btn btn-danger btn-xs\" href=\""+"<?php echo U('Admin/Users/edit"+array+"');?>\"><i class=\"fa fa-close\"></i>拒绝</a></td>"+"</tr>");
		            	 }
		            	$('#pages2').append(data['data']['page']);
	            	}
		            if(data['code'] == '-205' || data['code'] == '-208'){
	            		alert(data['info']);
            			location.href = 'http://' + data['data']['redirect_url'];	            		
	            	}
	            },
	            error: function(xhr, type, errorThrown) {
	              //异常处理
	              console.log(type);
	            }
	          }); 
	    })
	</script>
    
</body>
</html>