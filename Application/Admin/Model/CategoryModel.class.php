<?php
namespace Admin\Model;
use Think\Model;

class CategoryModel extends Model {
    
	// 自动验证设置
	protected $_validate = array(
        array('aname','require','分类名称不可以为空!'),
	    array('afid','require','分类不可以为空!'),
	    array('sort','require','排序不可以为空!'),
//     	array('dir','require','分类目录名不可以为空'),
//     	array('dir','','分类目录名已经存在！',0,'unique',1), 
//     	array('aname','','分类名称已经存在！',0,'unique',1), 
//         array('dir','english','分类目录名为英文字符'),　　　　　
    );
	
	/**
	 * 判断同级分类是否存在
	 * @param $name 分类名
	 * @param $fid 父级分类ID
	 */
	function is_exist_cat($name,$fid){
	    $res = $this->where(array('aname' => $name,'afid' => $fid))->select();
	    if ($res){
	        return true;
	    }else {
	        return false;
	    }
	   
	}
// 	//判定已否已存在模块
// 	function ismdir($name){
// 	   if ($name=='index'||$name=='prouduct'||$name=='shop'||$name=='message'||$name=='contact'||$name=='cart'||$name=='user'||$name=='order'){
// 	       return false;
// 	   }else {
// 	       return true;
// 	   }
//     }
	
// 	function isdir($name){
//         $con['dir']=$name;
//         $res=$this->where($con)->select();
//         if ($name=='index'||$name=='prouduct'||$name=='shop'||$name=='message'||$name=='contact'||$name=='cart'||$name=='user'){
//             return false;
//         }else {
//             if ($res) {
//                 return false;
//             }else {
//                 return true;
//             }
//         }
//     }
}
?>