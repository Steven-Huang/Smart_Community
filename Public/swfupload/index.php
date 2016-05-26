<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head> 
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
        <title>演示：swfupload无刷新多图片上传</title>
        <meta name="keywords" content="swfupload多图片上传,php多文件上传" />
        <meta name="description" content="SWFUpload是一个客户端文件上传工具，最初由Vinterwebb.se开发，它通过整合flash与javascript技术为web开发者提供了一个具有丰富功能继而超越传统<input type='file' />标签的文件上传模式。" />
        <link rel="stylesheet" type="text/css" href="http://www.sucaihuo.com/jquery/css/common.css" />
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/swfupload.js"></script>
        <script type="text/javascript" src="js/handlers.js"></script>
        <link href="css/default.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript">
            var swfu;
            var file_queue_limit = 100;//队列1，每次只能上传1个,若是1个以上，上传后的样式是叠加图片
            window.onload = function() {
                swfu = new SWFUpload({
                    upload_url: "upload.php",
                    post_params: {"PHPSESSID": "<?php echo session_id(); ?>"},
                    file_size_limit: "2 MB", //最大2M
                    file_types: "*.jpg;*.png;*.gif;*.bmp", //设置选择文件的类型
                    file_types_description: "JPG Images", //描述文件类型
                    file_upload_limit: "0", //0代表不受上传个数的限制
                    file_queue_limit:file_queue_limit,
                    file_queue_error_handler: fileQueueError,
                    file_dialog_complete_handler: fileDialogComplete, //当关闭选择框后,做触发的事件
                    upload_progress_handler: uploadProgress, //处理上传进度
                    upload_error_handler: uploadError, //错误处理事件
                    upload_success_handler: uploadSuccess, //上传成功够,所处理的时间
                    upload_complete_handler: uploadComplete, //上传结束后,处理的事件
                    button_image_url: "images/upload.png",
                    button_placeholder_id: "spanButtonPlaceholder",
                    button_width: 113,
                    button_height: 33,
                    button_text: '',
                    button_text_style: '.spanButtonPlaceholder { font-family: Helvetica, Arial, sans-serif; font-size: 14pt;} ',
                    button_text_top_padding: 0,
                    button_text_left_padding: 0,
                    button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
                    button_cursor: SWFUpload.CURSOR.HAND,
                    flash_url: "js/swfupload.swf",
                    custom_settings: {
                        upload_target: "divFileProgressContainer"
                    },
                    debug: false //是否开启日志
                });
            };
        </script>
        <style type="text/css">
        </style>
    </head>
    <body>
<!--         <div class="head">
            <div class="head_inner clearfix">
                <ul id="nav">
                    <li><a href="http://www.sucaihuo.com">首 页</a></li>
                    <li><a href="http://www.sucaihuo.com/templates">网站模板</a></li>
                    <li><a href="http://www.sucaihuo.com/js">网页特效</a></li>
                    <li><a href="http://www.sucaihuo.com/php">PHP</a></li>
                    <li><a href="http://www.sucaihuo.com/site">精选网址</a></li>
                </ul>
                <a class="logo" href="http://www.sucaihuo.com"><img src="http://www.sucaihuo.com/Public/images/logo.jpg" alt="素材火logo" /></a>
            </div>
        </div> -->
        <div class="container">
            <div class="demo">
<!--                 <h2 class="title"><a href="http://www.sucaihuo.com/js/267.html">教程：swfupload无刷新多图片上传</a></h2> -->
                <div style="width: 610px; height: auto; border: 1px solid #e1e1e1; font-size: 12px; padding: 10px;">
                    <span id="spanButtonPlaceholder"></span>
                    <div id="divFileProgressContainer"></div>
                    <div id="thumbnails">
                        <ul id="pic_list" style="margin: 5px;"></ul>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="foot">
            Powered by sucaihuo.com  本站皆为作者原创，转载请注明原文链接：<a href="http://www.sucaihuo.com" target="_blank">www.sucaihuo.com</a>
        </div> -->
    </body>
</html>

<div style="width:728px;margin:0 auto">
    <script type="text/javascript">
        /*700*90 创建于 2015-06-27*/
        var cpro_id = "u2182156";
    </script>
    <script src="http://cpro.baidustatic.com/cpro/ui/c.js" type="text/javascript"></script>
</div>