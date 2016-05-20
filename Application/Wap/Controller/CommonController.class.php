<?php
namespace Wap\Controller;

use Think\Controller;
include './Application/Common/Common/Mobile_Detect.php';

class CommonController extends Controller
{

    public function _initialize()
    {
        $detect = new \Mobile_Detect();
        $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
        
        if ($deviceType == 'computer') {
            // 判断电脑用户是否登陆
            if (! session('?user_id')) {
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('您没有登录或登录已过期，请重新登录！'),
                    'code' => - 206
                );
                exit(urldecode(json_encode($output)));
            }
        } elseif ($deviceType == 'tablet' || $deviceType == 'phone') {
            // 判断APP客户端用户
            // 针对APP 客户端，超过3天需重新登录
            if (! isset($_SESSION['time']) || (time() - $_SESSION['time']) > 259200) {
                // 设置access_token为空
                session('access_token', NULL);
                $output = array(
                    'data' => array(
                        'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                        'sec' => 3
                    ),
                    'info' => urlencode('ACCESS_TOKEN超时，请重新登录！'),
                    'code' => - 208
                );
                exit(urldecode(json_encode($output)));
            }
        }
        
        // 判断是否有权限
        $access = \Org\Util\Rbac::AccessDecision();
        if (! $access) {
            $output = array(
                'data' => array(
                    'redirect_url' => urlencode($_SERVER['HTTP_HOST'] . __APP__ . '/Public/login'),
                    'sec' => 3
                ),
                'info' => urlencode('您没有权限访问！！'),
                'code' => - 207
            );
            exit(urldecode(json_encode($output)));
        }
        
        // $access = \Org\Util\Rbac::AccessDecision();
        // if(!$access){
        // $this->error('你没有权限');
        // }
        // // 用户权限检查
        // if (C ( 'USER_AUTH_ON' ) && ! in_array ( MODULE_NAME, explode ( ',', C ( 'NOT_AUTH_MODULE' ) ) )) {
        // //1.如果需要验证
        // if (! \Org\Util\Rbac::AccessDecision ()) {
        // // 2.没有登陆
        // if (! $_SESSION [C ( 'USER_AUTH_KEY' )]) {
        // // 3.游客可访问
        // if(C('GUEST_AUTH_ON')) {
        // // 4.游客授权
        // if(!isset($_SESSION['_ACCESS_LIST']))
        // // 保存游客权限
        // \Org\Util\Rbac::saveAccessList(C('GUEST_AUTH_ID'));
        // }else{
        // // 5.无登陆，禁止游客访问，无权限页面
        // $this->error ( L ( '_VALID_ACCESS_' ) );
        // }
        // }
        // // 6.登陆，没有权限， 如果有错误页面则定向
        // if (C ( 'RBAC_ERROR_PAGE' )) {
        // // 定义权限错误页面
        // redirect ( C ( 'RBAC_ERROR_PAGE' ) );
        // }
        // //7.没有定义错误页面定向，跳到登陆页面
        // else{
        // redirect(PHP_FILE.C('USER_AUTH_GATEWAY'));
        // }
        // }
        // }
    }
}