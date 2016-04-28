<?php
namespace Home\Controller;
use Think\Controller;
class EmptyController extends Controller {
    public function index(){
    	$name = CONTROLLER_NAME;
    	$this->show("您访问的{$name}控制器不存在!",'utf-8');
    }
}