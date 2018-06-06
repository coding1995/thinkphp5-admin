<?php
namespace app\admin\controller;
use think\Controller;
use think\Cookie;
use think\Session;
use think\captcha;
use think\Db;
use think\cache\driver\Redis;
use app\admin\model\Admins;

class Login extends Controller
{   
    /**
     * [index description]登陆逻辑
     * @return [type] [description]
     */
    public function index()
    {
        if(Session::get('admin_user')){
            $this->redirect('admin/index/index');
        }else{
            if (request()->post()) {
                $name = input('post.name');
                $pwd = input('post.pwd');
                $is_rem = input('post.is_rem');
                if ($is_rem!=1) {
                    $pwd = pswCrypt($pwd);
                }

                $captcha = input('post.captcha');
                $rempsw = input('post.rempsw');
                if(empty($name)||empty($pwd)||empty($pwd)){
                    exit(json_encode(array('status'=>0,'msg'=>'用户名或密码,验证码不可为空')));
                }
                if(!captcha_check($captcha)){
                    exit(json_encode(array('status'=>0,'msg'=>'验证码错误')));
                }

                $userInfo = Db::name('admin_user')->where(array('names'=>$name))->find();
                if (empty($userInfo)) {
                    exit(json_encode(array('status'=>0,'msg'=>'当前用户不存在或者用户名错误')));
                }

                if($userInfo['status'] == 2){
                    exit(json_encode(array('status'=>0,'msg'=>'当前用户禁止登录')));
                }
                $redis = new Redis();
                //admin用户不能修改状态
                if($pwd != $userInfo['password']&&$userInfo['names']=='admin'){
                    exit(json_encode(array('status'=>0,'msg'=>'密码有误')));
                }
                if($pwd != $userInfo['password']&&$userInfo['names']!='admin'){
                    $admin = new Admins();
                    $data = $redis->get($userInfo['names'].'-nums');
                    if ($data) {
                        //判断过期时间
                        if (time()-$data['time']>=1800) {
                            $data = array('nums'=>1,'time'=>time());
                        } else {
                            $data = array('nums'=>$data['nums']+1,'time'=>$data['time']);
                        }
                    } else {
                        $data = array('nums'=>1,'time'=>time());
                    }
                    $redis->set($userInfo['names'].'-nums',$data);
                    $tmp = 5-$data['nums'];
                    if ($tmp==0) {
                        $admin->update_admin_status($userInfo['id'],2);
                        //删除记录
                        $redis->rm($userInfo['names'].'-nums');
                        exit(json_encode(array('status'=>0,'msg'=>'30分钟内,你已经连续输入密码错误5次，该账号已被禁用')));
                    } else {
                        exit(json_encode(array('status'=>0,'msg'=>'密码有误,你还有'.$tmp.'次机会')));
                    }
                    
                } 

                Session::set('admin_user',$name);
                //删除记录
                $redis->rm($userInfo['names'].'-nums');
                if($rempsw == 1){
                    //记住密码 存储于cookie
                    cookie('cu',trim($name),3600*24*30);
                    cookie('CSDFDSA',trim($pwd),3600*24*30);
                } else {
                    Cookie::delete('cu');
                    Cookie::delete('CSDFDSA');
                }
                //记录时间及ip
                Db::name('admin_user')->where(array('id'=>$userInfo['id']))->update(['last_login'=>date('Y-m-d H:i:s', time()), 'last_ip'=>request()->ip()]);
                //打印日志
                logs('login','ip：'.request()->ip().'——name：'.$name,__FILE__,__LINE__);
                exit(json_encode(array('status'=>1,'msg'=>'登录成功')));
                

            } else {
                $name = Cookie::get('cu');
                $pwd = Cookie::get('CSDFDSA');
                if($name && $pwd) {
                    $this->assign('name',$name);
                    $this->assign('pwd',$pwd);
                }
                return $this->fetch('login-index');
            }
        }
    }
    
    
    /**
     * Login::loginout()
     * 安全退出
     * @author Gary
     * @return void
     */
    public function loginout(){
        Session::delete('admin_user');
        $this->redirect('admin/login/index');
    }

    public function test(){

        // $a = Session::get('admin_user');
        // $name = Cookie::get('cu');
        // $pwd = Cookie::get('CSDFDSA');
        // var_dump($pwd);
        // $num = '123456';
        // $num = pswCrypt($num);
        // print_r($num);
    }
}
