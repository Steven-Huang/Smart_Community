<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>登录JoyRill智慧社区后台 </title>

  <!-- Bootstrap core CSS -->

  <link href="/smart_community/Public/admin/css/bootstrap.min.css" rel="stylesheet">

  <link href="/smart_community/Public/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="/smart_community/Public/admin/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="/smart_community/Public/admin/css/custom.css" rel="stylesheet">
  <link href="/smart_community/Public/admin/css/icheck/flat/green.css" rel="stylesheet">


  <script src="/smart_community/Public/admin/js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form id="login_form" novalidate>
            <h1>后台登录</h1>
            <div class="form-group">
	            <select class="form-control" id="role">
	              <option value='-1'>请选择角色</option>
	              <option value= "users">业主</option>
	              <option value= "mgrs">物业</option>
	              <option value= "admin">管理员</option>
	            </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="username" placeholder="用户名/邮箱/手机号" required="" />
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="password" placeholder="密码" required="" />
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="code" placeholder="请输入下面的验证码" required="" />
            </div>
            <div class="form-group">
                <img id="code_img" src="/smart_community/index.php/Admin/Public/verify" alt="CAPTCHA" style="cursor: pointer;" title="看不清？点击更换另一个验证码。" onclick="this.src='/smart_community/index.php/Admin/Public/verify/'+Math.random()" />
            </div>                  
            <div>
               <!-- <input type="submit" class="btn btn-success" value="登录" /> -->
	           <a href="javascript:;" class="btn btn-default submit loginsubmit" >登录</a>
	           <input type="checkbox" id="remember" class="flat" value="on" />记住我一个星期
               <a class="reset_pass" href="#">忘记密码?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">新用户?
                <a href="#toregister" class="to_register"> 注册新账号 </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="fa fa-paw" style="font-size: 26px;"></i> JoyRill Smart Community</h1>

                <p>©2016 All Rights Reserved.</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
    <div id="wrapper" style="min-width:700px">
      <div id="register" class="animate form">
        <section class="login_content">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">

                  <form class="form-horizontal form-label-left" id="register_form" novalidate>
                    <h1>新用户注册申请</h1>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_nick_name">用户名 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input id="user_nick_name" name="user_nick_name" class="form-control col-md-7 col-xs-12" maxlength="10" placeholder="" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_true_name">真实姓名 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input id="user_true_name" name="user_true_name" class="form-control col-md-7 col-xs-12" maxlength="10" placeholder="" required="required" type="text">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_gender">性别 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9" style="text-align:left">
                        <div id="gender" class="btn-group" data-toggle="buttons">
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="gender" value="1"> &nbsp; 男 &nbsp;
                          </label>
                          <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                            <input type="radio" name="gender" value="2"> &nbsp; 女 &nbsp;
                          </label>
                        </div>
                      </div>
                    </div>                    
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_id_card_num">身份证号 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input id="user_id_card_num" name="user_id_card_num" class="form-control col-md-7 col-xs-12" maxlength="18" placeholder="" required="required" type="text">
                      </div>
                    </div>   
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="user_pocn">房产证号 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input id="user_pocn" name="user_pocn" class="form-control col-md-7 col-xs-12" maxlength="18" placeholder="" required="required" type="text">
                      </div>
                    </div>                                                                        
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">邮箱地址 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">确认邮箱地址 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input type="email" id="email2" name="confirm_email" data-validate-linked="email" required="required" class="form-control col-md-7 col-xs-12">
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
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">手机号 <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input type="tel" id="telephone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button type="reset" class="btn btn-primary">清除</button>
                        <button id="send" type="submit" class="btn btn-success">提交</button>
                      </div>
                    </div>
                    <div class="clearfix"></div>
					<div class="separator">
					  <p class="change_link">已经拥有账号 ?
					    <a href="#login" class="to_register"> 去登录 </a>
					  </p>
					  <div class="clearfix"></div>
					  <br />
					  <div>
					    <h1><i class="fa fa-paw" style="font-size: 26px;"></i> JoyRill Smart Community</h1>
					
					    <p>©2016 All Rights Reserved.</p>
					  </div>
					</div>
                  </form>
                </div>
              </div>
       		</div>
       	</div>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>
	
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

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });
    //验证码
/*     window.onload = function(){
        $.ajax({
            type: "post",
            url: "/smart_community/index.php/Admin/Public/verify",
            data: {
              },
            dataType: "json",
            success: function(data) {
			
            },
            error: function(xhr, type, errorThrown) {
              //异常处理
              console.log(type);
            }
          });    	
    } */
    //触发登录事件
/*     function checklogin(){
      $.ajax({
        type: "post",
        url: "/smart_community/index.php/Admin/Public/checkLogin",
        data: {
          username : $('#username').val(),
          password : $('#password').val(),
          role : $('#role').val(),
          code : $('#code').val()
          },
        dataType: "json",
        success: function(data) {
        	if(data['code'] == '-201'){
        		alert(data['info']);
        	}
        	if(data['code'] == '-202'){
        		alert(data['info']);
         		var verify=document.getElementById('code_img');
        		verify.setAttribute('src','/smart_community/index.php/Admin/Public/verify/'+Math.random());
        	}
        	if(data['code'] == '-203' || data['code'] == '-204'){
        		alert(data['info']);
        		location.href = 'http://' + data['data']['redirect_url'];
        	}        	
        },
        error: function(xhr, type, errorThrown) {
          //异常处理
          console.log(type);
        }
      });
    } */
    $('body').on('click','.loginsubmit',function(){
    	$.ajax({
            type: "post",
            url: "/smart_community/index.php/Admin/Public/checkLogin",
            data: {
              username : $('#username').val(),
              password : $('#password').val(),
              role : $('#role').val(),
              code : $('#code').val(),
              remember : $('#remember:checked').val()
            },
            dataType: "json",
            success: function(data) {
            	if(data['code'] == '-201'){
            		alert(data['info']);
            	}
            	if(data['code'] == '-202'){
            		alert(data['info']);
              		var verify=document.getElementById('code_img');
            		verify.setAttribute('src','/smart_community/index.php/Admin/Public/verify/'+Math.random()); 
            	}
            	if(data['code'] == '200' || data['code'] == '-200' || data['code'] == '-203' || data['code'] == '-204'){
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