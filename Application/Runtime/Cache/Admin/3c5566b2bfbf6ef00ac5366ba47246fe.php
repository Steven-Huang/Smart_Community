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

  <link href="../../../Public/Admin/css/bootstrap.min.css" rel="stylesheet">

  <link href="../../../Public/Admin/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="../../../Public/Admin/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="../../../Public/Admin/css/custom.css" rel="stylesheet">
  <link href="../../../Public/Admin/css/icheck/flat/green.css" rel="stylesheet">


  <script src="../../../Public/Admin/js/jquery.min.js"></script>

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
          <form>
            <h1>后台登录</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" required="" />
            </div>
            <div>
              <a class="btn btn-default submit" href="index.html">登录</a>
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

                <p>©2015 All Rights Reserved.</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
    <div id="wrapper" style="min-width:500px">
      <div id="register" class="animate form">
        <section class="">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_content">

                  <form class="form-horizontal form-label-left" novalidate>
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
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input type="radio" id="user_gender" name="user_gender" value="1">&nbsp;男&nbsp;
                        <input type="radio" id="user_gender" name="user_gender" value="2">&nbsp;女
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
                      <label for="password" class="control-label col-md-3 col-sm-3 col-xs-12">密码</label>
                      <div class="col-md-6 col-sm-6 col-xs-9">
                        <input id="password" type="password" name="password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">再次输入密码</label>
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
					
					    <p>©2015 All Rights Reserved.</p>
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
  <script src="../../../Public/Admin/js/validator/validator.js"></script>
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

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);
  </script>
</body>

</html>