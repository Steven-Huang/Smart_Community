<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
 <html>
 <head>
 <meta charset="utf-8">
 <title>图片上传</title>
 <script type="text/javascript" src="/smart_community/Public/wap/js/jquery.js"></script>
 <script type="text/javascript" src="/smart_community/Public/wap/js/ajaxupload.js"></script>
 <script type="text/javascript">
$(function(){
    var button = $('#upload_button'), interval;
    var confirmdiv = $('#uploadphotoconfirm');
    var fileType = "pic",fileNum = "one"; 
    new AjaxUpload(button,{
        action: "<?php echo U('Upload/uppic');?>",
        name: 'userfile',
        onSubmit : function(file, ext){
            if(fileType == "pic")
            {
                if (ext && /^(jpg|png|jpeg|gif|JPG)$/.test(ext)){
                    this.setData({
                        'info': '文件类型为图片'
                    });
                } else {
                     confirmdiv.text('文件格式错误，请上传格式为.png .jpg .jpeg 的图片');
                    return false;               
                }
            }
                        
            confirmdiv.text('文件上传中');
            
            if(fileNum == 'one')
                this.disable();
            
            interval = window.setInterval(function(){
                var text = confirmdiv.text();
                if (text.length < 14){
                    confirmdiv.text(text + '.');                    
                } else {
                    confirmdiv.text('文件上传中');             
                }
            }, 200);
        },
        onComplete: function(file, response){
            if(response != "success"){
                if(response =='2'){
                    confirmdiv.text("文件格式错误，请上传格式为.png .jpg .jpeg 的图片");
                }else{
                    if(response.length>20){
                        confirmdiv.text("文件上传失败请重新上传"+response);            
                    }else{
                        confirmdiv.text("上传完成");
                         $("#newbikephotoName").val("/upload/images/"+response);
                        $("#newbikephoto").attr("src","/upload/images/"+response);            
                    }
                }
                
            }
                                  
            window.clearInterval(interval);
                        
            this.enable();
            
            if(response == "success")
            alert('上传成功');              
        }
    });
 });
 </script>
 </head>
 <body>
    <label class="control-label" for="bike_type"> </label>
    <input type="file" style="display:none" name="userfile">
    <input type="" id="newbikephotoName" name="bike_photo" value="" />
    <input type="" id="newbikephoto" value="" />
    <div class="controls" style="text-align:left;">
        <span class="help-inline"></span>
        <br>
        <div id="uploadphotoconfirm"></div>
        <br>
        <input type="button" class="btn btn-primary" id="upload_button"  value="上传图片" /><br/>
        <span class="help-inline">*请上传格式为.png .jpg .jpeg 的图片</span>
    </div>
    
    
    <form action="<?php echo U('Upload/aa');?>" enctype="multipart/form-data" method="post" >
<input type="file" name="photo[]" />
<input type="file" name="photo[]" />
<input type="file" name="photo[]" />
<input type="submit" value="提交" >
</form>
 </body>
 </html>