<?php
namespace app\admin\controller;
use think\Db;
use think\Session;
use \think\Validate;
use think\Controller;
use app\admin\model\Roles;
class Base extends Controller {
    /**
     * 初始化操作
     */
    public function _initialize()
    {
        $admin = Session::get('admin_user');
        if(empty($admin)){
            $this->redirect('admin/login/index');
        }else{
            $admininfo = Db::name('admin_user')->where(array('names'=>$admin))->find();
        }
        //获取当前管理员是否有当前进去的方法的权限
        $url = getActionUrl();

        //获取当前用户拥有的权限
        $roles = new Roles();
        $auth = $roles->getAuthInfo($admininfo['role_id']);
        if ($auth==NULL) {
           echo '<script>alert("没有权限");请联系管理员</script>';exit;
        }

        $auth_array = array();
        foreach ($auth as $key => $value) {
            $auth_array[] = strtolower($value['url']);
        }
        // var_dump($url);
        // echo '<pre>';
        // var_dump($auth_array);die;
        //过滤首页，欢迎页
        if (!in_array($url ,array('admin/index/index','admin/index/welcome'))) {
            if (!in_array($url,$auth_array)) {
                echo "<script>alert('没有权限');</script>";exit;
            }
        }
        //获取当前用户可以访问的菜单
        $menuinfo = $roles->getMenuInfo($admininfo['role_id']);
        if ($menuinfo==NULL) {
           echo '<script>alert("没有权限");请联系管理员</script>';exit;
        }

        $this->assign('menuinfo',$menuinfo);
        
        
    }

      
}