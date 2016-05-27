<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-control" content="private, must-revalidate" />
<title>flash无刷新多图片上传</title>
<script type="text/javascript">
var path='__STYLE__';
var url='/smart_community/wap.php/UPLOAD';
</script>
<script type="text/javascript" src="/smart_community/Public/swfupload/js/jquery.js"></script>
<script type="text/javascript" src="/smart_community/Public/swfupload/js/swfupload.js"></script>
<script type="text/javascript" src="/smart_community/Public/swfupload/js/handlers.js"></script>
<link href="/smart_community/Public/swfupload/css/default.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
var swfu;
var file_queue_limit = 100;//队列1，每次只能上传1个,若是1个以上，上传后的样式是叠加图片
window.onload = function() {
    swfu = new SWFUpload({
        upload_url: "<?php echo U('Upload/aa');?>",
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
        upload_success_handler: uploadSuccess, //上传成功后,所处理的时间
        upload_complete_handler: uploadComplete, //上传结束后,处理的事件
        button_image_url: "/smart_community/Public/swfupload/images/upload.png",
        button_placeholder_id: "spanButtonPlaceholder",
        button_width: 113,
        button_height: 33,
        button_text: '',
        button_text_style: '.spanButtonPlaceholder { font-family: Helvetica, Arial, sans-serif; font-size: 14pt;} ',
        button_text_top_padding: 0,
        button_text_left_padding: 0,
        button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
        button_cursor: SWFUpload.CURSOR.HAND,
        flash_url: "/smart_community/Public/swfupload/js/swfupload.swf",
        custom_settings: {
            upload_target: "divFileProgressContainer"
        },
        debug: false //是否开启日志
    });
};
</script>
</head>
<body>
<form action="" method="">
<div style="width: 610px; height: auto; border: 1px solid #e1e1e1; font-size: 12px; padding: 10px;">
<span id="spanButtonPlaceholder"></span>
<div id="divFileProgressContainer"></div>
<div id="thumbnails">
<ul id="pic_list" style="margin: 5px;"></ul>
<div style="clear: both;"></div>
</div>
</div>
<input type="hidden" name="s" id="" value=""/>
<input type="submit" value="提交" />
</form>
</body>
</html>