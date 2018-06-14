<?php
namespace app\admin\controller;
use app\admin\model\Admins;
use app\admin\model\Menus;
use app\admin\model\Roles;
use think\Db;
use think\Session;
use app\admin\controller\Base;
use think\cache\driver\Redis;

class Admin extends Base {

    /**
     * 管理员列表
     * @return [type] [description]
     */
    public function index(){
        
        $keyword = isset($_POST['keyword'])?$_POST['keyword']:'';
        $where = null;
        if(!empty($keyword)){
            $where['names'] = array("like","%$keyword%");
        } 
        $admin = new Admins();
        $data = $admin->getAdminUser($where);
        $num = count($data);
        $this->assign('data',$data);
        $this->assign('keyword',$keyword);
        $this->assign('num',$num);
    	return $this->fetch('admin-index');
    }


    /**
     * [addAdmin description]添加管理员
     */
    public function addAdmin(){
    	if (request()->post()) {
    		$insert_data= array();
            $insert_data['names'] = input('names');
            $insert_data['email'] = input('email');
            $insert_data['phone'] = input('phone');
            $insert_data['password'] = pswCrypt(input('password'));
            $insert_data['status'] = input('status');
            $insert_data['role_id'] = input('role_id');
            $insert_data['add_time'] = time();
            $info = Db::name('admin_user')->where(array('names'=>input('names')))->select();
            if (!empty($info)) {
                exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
            }
            $res = Db::name('admin_user')->insert($insert_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'添加成功')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'添加失败')));
            }
            
    	} else {
    		$admin = new Admins();
	        $data = $admin->getAdminRole();
	        $this->assign('data',$data);
	    	return $this->fetch('admin-add');
    	}
    }

    /**
     * [delAdmin description]删除管理员
     * @return [type] [description]
     */
    public function delAdmin(){
    	$id = input('id');
    	$admin = new Admins();
        $data = $admin->del_admin($id);
        exit(json_encode($data));
    }


    /**
     * [updateAdminStatus description]修改管理员状态
     * @return [type] [description]
     */
    public function updateAdminStatus(){
    	$id = input('id');
    	$status = input('status');
    	$admin = new Admins();
        $data = $admin->update_admin_status($id,$status);
        exit(json_encode($data));
    }

    /**
     * [updateAdmin description]编辑管理员
     * @return [type] [description]
     */
    public function updateAdmin(){
        $id = input('id');
        if (request()->post()) {
            $info = Db::name('admin_user')->where(array('id'=>$id))->find();
            
            $update_data= array();
            $update_data['names'] = input('names');
            $update_data['email'] = input('email');
            $update_data['phone'] = input('phone');
            if (input('password')==$info['password']) {
                $update_data['password'] = $info['password'];
            } else {
                $update_data['password'] = pswCrypt(input('password'));
            }
            $update_data['status'] = input('status');
            $update_data['role_id'] = input('role_id');
            $update_data['add_time'] = time();
            $info_tmp = Db::name('admin_user')->where(array('names'=>input('names')))->where('id','neq',$id)->select();
            if (!empty($info_tmp)) {
                exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
            }

            if ($info['names']=='admin'&&$update_data['status']==2) {
                exit(json_encode(array('status'=>0,'msg'=>'admin用户不可修改状态为禁用')));
            }

            $res = Db::name('admin_user')->where(array('id'=>$id))->update($update_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'编辑成功','url'=>'admin/admin/index')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'编辑失败')));
            }
        } else {
            $info = Db::name('admin_user')->where(array('id'=>$id))->find();
            if (empty($info)) {
                $this->error('信息有误');
            }
            $admin = new Admins();
            $data = $admin->getAdminRole();
            $this->assign('data',$data);
            $this->assign('info',$info);
            return $this->fetch('admin-add');
        }
    }

    /**
     * 获取角色列表
     * @return [type] [description]
     */
    public function role(){
        $admin = new Admins();
        $data = $admin->getAdminRole();
        $num = count($data);
        $this->assign('data',$data);
        $this->assign('num',$num);
        return $this->fetch('admin-role');
    }


    /**
     * [addRole description]添加角色
     */
    public function addRole(){
        if(request()->post()){
            $insert_data= array();
            $insert_data['role_name'] = $_POST['name'];
            $insert_data['desc'] = $_POST['desc'];
            $insert_data['menu_id'] = trim($_POST['menuid'],',');
            $info = Db::name('admin_role')->where(array('role_name'=>$_POST['name']))->select();
            if (!empty($info)) {
                exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
            }
            $res = Db::name('admin_role')->insert($insert_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'添加成功')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'添加失败')));
            }
        }
        $admin = new Admins();
        $data = $admin->getAllPermissionInfo();
        $this->assign('data',$data);
        return $this->fetch('admin-role-add');
    }


    /**
     * [updateRole description]编辑更新角色
     * @return [type] [description]
     */
    public function updateRole(){
        $role_id = input('id');
        if (request()->post()) {
            $update_data= array();
            $update_data['role_name'] = $_POST['name'];
            $update_data['desc'] = $_POST['desc'];
            $update_data['menu_id'] = trim($_POST['menuid'],',');
            $info = Db::name('admin_role')->where(array('role_name'=>$_POST['name']))->where('role_id','neq',$role_id)->select();
            if (!empty($info)) {
                exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
            }
            $res = Db::name('admin_role')->where(array('role_id'=>$role_id))->update($update_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'编辑成功')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'编辑失败')));
            }
        } else {
            $roles = new Roles();
            $info = $roles->getRoleInfo($role_id);
            if (empty($info)) {
                 exit(json_encode(array('status'=>0,'msg'=>'信息错误')));
            }
            $admin = new Admins();
            $data = $admin->getAllPermissionInfo();
            $this->assign('data',$data);
            $this->assign('info',$info);
            return $this->fetch('admin-role-add');
        }
    }

    /**
     * [delRole description]删除角色
     * @return [type] [description]
     */
    public function delRole(){
        $role_id = input('id');
        $roles = new Roles();
        $data = $roles->del_role($role_id);
        exit(json_encode($data));
        
    }


    /**
     * [permission description]获取权限子节点
     * @return [type] [description]
     */
    public function permission(){
        $keyword = isset($_POST['keyword'])?$_POST['keyword']:'';
        $where['type'] =  array('eq','per');
        if(!empty($keyword)){
            $where['name'] = array("like","%$keyword%");
        }
        $admin = new Admins();
        $data = $admin->getPermissionInfo($where);
        $num = count($data);
        $this->assign('data',$data);
        $this->assign('num',$num);
        $this->assign('keyword',$keyword);
        return $this->fetch('admin-permission');
    }

   	
   	/**
   	 * [addPermission description]添加权限子节点
   	 * @Author   songqiphp.xin
   	 * @DateTime 2018-06-03
   	 * @return   [type]
   	 * @param    [type]
   	 */
    public function addPermission(){
        if (request()->post()) {
            $insert_data = array();
            $insert_data['parent_id'] = input('post.parent_id');
            $insert_data['url'] = input('post.url');
            $insert_data['name'] = input('post.name');
            $insert_data['type'] = 'per';
            $info = Db::name('admin_menu')->where(array('name'=>input('post.name')))->select();
            if (!empty($info)) {
                exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
            }
            $res = Db::name('admin_menu')->insert($insert_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'添加成功','url'=>'admin/admin/permission')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'添加失败')));
            }
        }
        $admin = new Admins();
        $data = $admin->getCmenuInfo();
        $this->assign('data',$data);
        return $this->fetch('admin-permission-add');
    }


    /**
     * [updatePermission description]编辑修改子权限
     * @return [type] [description]
     */
    public function updatePermission(){
    	$id = input('id');
    	if (request()->post()) {
    		$update_data = array();
            $update_data['parent_id'] = input('post.parent_id');
            $update_data['url'] = input('post.url');
            $update_data['name'] = input('post.name');
            $update_data['type'] = 'per';
            $info = Db::name('admin_menu')->where(array('name'=>input('post.name')))->where('id','neq', $id)->select();
            if (!empty($info)) {
                exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
            }
            $res = Db::name('admin_menu')->where(array('id'=>$id))->update($update_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'编辑成功','url'=>'admin/admin/permission')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'编辑失败')));
            }
    	} else {
    		$info = Db::name('admin_menu')->where(array('id'=>$id))->find();
	    	if (empty($info)) {
	    		$this->error('信息有误');
	    	}
	    	$admin = new Admins();
	        $data = $admin->getCmenuInfo();
	        $this->assign('data',$data);
	        $this->assign('info',$info);
	        return $this->fetch('admin-permission-add');
    	}

    }

    /**
     * [delRole description]删除权限
     * @return [type] [description]
     */
    public function delPermission(){
        $id = input('id');
        $menu = new Menus();
        $data = $menu->del_permission($id);
        exit(json_encode($data));
        
    }

    public function test(){
        echo '<pre>';
        $redis = new Redis();
        $data = array('nums'=>1,'time'=>time());
        $redis->set('1',$data);
        $nums = $redis->get('test-nums');
        var_dump($nums);
    }
    
}