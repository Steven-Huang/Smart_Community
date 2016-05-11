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
          <li><a><i class="fa fa-edit"></i> 通知发布 <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu" style="display: none">
              <li><a href="#">小区通知</a>
              </li>
              <li><a href="#">政府公告</a>
              </li>
              <li><a href="#">办事指南</a>
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
	<div id="wrapper" style="min-width:900px">
<!-- 		<div id="register" class="animate form"> -->
			   <section class="login_content">
			      <div class="row">
			        <div class="col-md-12 col-sm-12 col-xs-12">
			          <div class="x_panel">
			            <div class="x_content">
			              <form class="form-horizontal form-label-left" id="register_form">
			                <h1>添加物业人员信息</h1>
			                <div class="item form-group">
			                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mgrs_nick_name">用户名 <span class="required">*</span>
			                  </label>
			                  <div class="col-md-6 col-sm-6 col-xs-9">
			                    <input id="mgrs_nick_name" name="mgrs_nick_name" class="form-control col-md-7 col-xs-12" maxlength="10" placeholder="" required="required" type="text">
			                  </div>
			                </div>
			                <div class="item form-group">
			                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mgrs_true_name">真实姓名 <span class="required">*</span>
			                  </label>
			                  <div class="col-md-6 col-sm-6 col-xs-9">
			                    <input id="mgrs_true_name" name="mgrs_true_name" class="form-control col-md-7 col-xs-12" maxlength="10" placeholder="" required="required" type="text">
			                  </div>
			                </div>
			                <div class="item form-group">
			                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mgrs_gender">性别 <span class="required">*</span>
			                  </label>
			                  <div class="col-md-6 col-sm-6 col-xs-9" style="text-align:left">
			                <div class="btn-group" data-toggle="buttons">
			                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
			                    <input type="radio" id="mgrs_gender" name="mgrs_gender" value="1"> &nbsp; 男 &nbsp;
			                  </label>
			                  <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
			                    <input type="radio" id="mgrs_gender" name="mgrs_gender" value="2"> &nbsp; 女 &nbsp;
			                  </label>
			                </div>
			              </div>
			            </div>                    
			            <div class="item form-group">
			              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mgrs_id_card_num">身份证号 <span class="required">*</span>
			              </label>
			              <div class="col-md-6 col-sm-6 col-xs-9">
			                <input id="mgrs_id_card_num" name="mgrs_id_card_num" class="form-control col-md-7 col-xs-12" maxlength="18" placeholder="" required="required" type="text">
			              </div>
			            </div>                                                                        
			            <div class="item form-group">
			              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mgrs_email">邮箱地址 <span class="required">*</span>
			              </label>
			              <div class="col-md-6 col-sm-6 col-xs-9">
			                <input type="email" id="mgrs_email" name="mgrs_email" required="required" class="form-control col-md-7 col-xs-12">
			              </div>
			            </div>
			            <div class="item form-group">
			              <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">密码 <span class="required">*</span>
			              </label>
			              <div class="col-md-6 col-sm-6 col-xs-9">
			                <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
			              </div>
			            </div>
			            <div class="item form-group">
			              <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">再次输入密码 <span class="required">*</span>
			              </label>
			              <div class="col-md-6 col-sm-6 col-xs-9">
			                <input id="password2" type="password" name="password2" data-validate-linked="password" class="form-control col-md-7 col-xs-12" required="required">
			              </div>
			            </div>
			            <div class="item form-group">
			              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="mgrs_mobile">手机号 <span class="required">*</span>
			              </label>
			              <div class="col-md-6 col-sm-6 col-xs-9">
			                <input type="text" id="mgrs_mobile" name="mgrs_mobile" required="required" class="form-control col-md-7 col-xs-12">
			              </div>
			            </div>
			            <div class="ln_solid"></div>
			            <div class="form-group">
			              <div class="col-md-6 col-md-offset-3">
 			                <button type="reset" class="btn btn-primary">清除</button>
			                <!-- <a href="javascript:;" class="btn btn-default submit savedata" >保存</a> -->
			                <button id="send" type="submit" class="btn btn-success">提交</button>
			              </div>
			            </div>
			            <div class="clearfix"></div>
			          </form>
			        </div>
			      </div>
				</div>
			</div>
			  <!-- form -->
			</section>
			<!-- content -->
<!-- 	      </div> -->
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
  <!-- form validation -->
  <script src="/smart_community/Public/admin/js/validator/validator.js"></script>
  <script>
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });
    
     $('form').submit(function(e) {
        e.preventDefault();
        var submit = true;
        // evaluate the form using generic validaing
        if (!validator.checkAll($(this))) {
          	submit = false;
        }
        if (submit){
	    	$.ajax({
	            type: "post",
	            url: "/smart_community/index.php/Admin/Mgrs/do_add",
	            data: {
	            	'access_token' : getCookie('access_token'),
	            	'mgrs_nick_name' : $('#mgrs_nick_name').val(),
	            	'mgrs_true_name' : $('#mgrs_true_name').val(),
	            	'mgrs_gender' : $("input[name='mgrs_gender']:checked").val(),
	            	'mgrs_id_card_num' : $('#mgrs_id_card_num').val(),
	            	'mgrs_email' : $('#mgrs_email').val(),
	            	'mgrs_password' : $('#password').val(),
	            	'mgrs_password_confirmed' : $('#password2').val(),
	            	'mgrs_mobile' : $('#mgrs_mobile').val()
	            },
	            dataType: "json",
	            success: function(data) {
	            	if(data['code'] == '200' || data['code'] == '-200' || data['code'] == '-205' || data['code'] == '-208'){
	            		alert(data['info']);
	            		location.href = 'http://' + data['data']['redirect_url'];
	            	}else if(data['code'] == '-201A' || data['code'] == '-201B' || data['code'] == '-201C' || data['code'] == '-201D' || data['code'] == '-202A' || data['code'] == '-202B' || data['code'] == '-202C' || data['code'] == '-202D' || data['code'] == '-203'){
	            		console.log(data);
	            		alert(data['info']);
	            	}
	            },
	            error: function(xhr, type, errorThrown) {
	              //异常处理
	              console.log(type);
	            }
	          }); 
        }       
        return false;
      }); 
	</script>
</body>
</html>