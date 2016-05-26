<?php
namespace Wap\Controller;

class UploadController extends CommonController
{

    public function index()
    {
        $this->display();
    }

    /**
     * 上传文件
     *
     * @param string $ftype
     *            :image/file, default image
     * @param string $rootPath
     *            :default './Uploads/'
     * @param string $savePath
     *            :default ''
     *            
     * @author Steven.Huang <87144734@qq.com>
     */
    public function upload($ftype = 'image', $rootPath = './Uploads/', $savePath = '')
    {
        // 允许上传的文件类型
        if ($ftype == 'image') {
            $ftype = 'jpg,gif,png,jpeg,bmp';
        } elseif ($ftype == 'file') {
            $ftype = 'zip,rar,doc,xls,ppt';
        }
        
        $setting = array(
            'mimes' => '', // 允许上传的文件MiMe类型
            'maxSize' => 3 * 1024 * 1024, // 上传的文件大小限制 (0-不做限制)
            'exts' => $ftype, // 设置附件上传类型
            'autoSub' => true, // 自动子目录保存文件
            'subName' => array(
                'date',
                'Y-m-d'
            ), // 子目录创建方式，[0]-函数名，[1]-参数，多个参数使用数组
            'rootPath' => $rootPath, // 保存根目录路径
            'savePath' => $savePath
        ); // 保存子目录路径
 // 保存路径
        
        /* 调用文件上传组件上传文件 */
        // 实例化上传类，传入上面的配置数组
        $this->uploader = new \Think\Upload($setting, 'Local');
        $info = $this->uploader->upload($_FILES);
        // 这里判断是否上传成功
        if ($info) {
            // // 上传成功 获取上传文件信息
            foreach ($info as &$file) {
                // 拼接出上传目录
                $file['rootpath'] = __ROOT__ . ltrim($setting['rootPath'], ".");
                // 拼接出文件相对路径
                $file['filepath'] = $file['rootpath'] . $file['savepath'] . $file['savename'];
            }
            // 这里可以输出一下结果,相对路径的键名是$info['upload']['filepath']
            echo $file['filepath'];
            exit();
        } else {
            // 输出错误信息
            exit($this->uploader->getError());
        }
    }
    
    // Public function uppic()
    // {
    // $upload = new \Think\Upload();
    // $upload->maxSize = 3145728; // 设置附件上传大小
    // $upload->exts = array(
    // 'jpg',
    // 'gif',
    // 'png',
    // 'jpeg'
    // ); // 设置附件上传类型
    // $upload->rootPath = './Uploads/'; // 设置附件上传根目录
    // $upload->savePath = 'Repair/'; // 设置附件上传（子）目录
    // // 上传文件
    // $info = $upload->upload();
    // if (! $info) { // 上传错误提示错误信息
    // $this->error($upload->getError());
    // } else { // 上传成功 获取上传文件信息
    // foreach ($info as $file) {
    // echo $file['savepath'] . $file['savename'];
    // }
    // }
    // }
    public function aa()
    {
        $this->upload('image', './Uploads/', 'Repair/');
    }
}
