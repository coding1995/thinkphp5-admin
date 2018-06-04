<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use app\admin\model\Menus;
class Roles extends Model 
{

	/**
	 * [getAuthInfo description]获取当前用户可以访问的权限，子节点
	 * @param  [type] $role_id [description]
	 * @return [type]          [description]
	 */
  	public function getAuthInfo($role_id){
  		if (empty($role_id)) {
  			return null;
  		}
  		$roleInfo = Db::name('admin_role')->where(array('role_id'=>$role_id))->find();
  		$menuid_array = explode(',',$roleInfo['menu_id']);
  		$menuInfo = Db::name('admin_menu')->where('id','in', $menuid_array)->field('url')->select();
  		if (!empty($menuInfo)) {
  			return $menuInfo;
  		} else {
  			return null;
  		}
  	}

  	/**
  	 * [getMenuInfo description]获取当前用户可以访问的菜单栏
  	 * @param  [type] $role_id [description]
  	 * @return [type]          [description]
  	 */
  	public function getMenuInfo($role_id){
  		if (empty($role_id)) {
  			return null;
  		}
  		$roleInfo = Db::name('admin_role')->where(array('role_id'=>$role_id))->find();
  		$menuid_array = explode(',',$roleInfo['menu_id']);
  		$menu = new Menus();
  		$info = $menu->getMenu($menuid_array);
  		if (!empty($info)) {
  			return $info;
  		} else {
  			return null;
  		}

  	}


    /**
     * [getRoleInfo description]获取角色信息
     * @param  [type] $role_id [description]
     * @return [type]          [description]
     */
    public function getRoleInfo($role_id){
        $info = Db::name('admin_role')->where(array('role_id'=>$role_id))->find();
        if (empty($info)) {
            return false;
        }
        $menuid_array = explode(',',$info['menu_id']);
        $info['menu'] = $menuid_array;
        if (empty($info)) {
            return false;
        } else {
            return $info; 
        }
        
    }


    /**
     * [del_role description]删除角色
     * @param  [type] $role_id [description]
     * @return [type]          [description]
     */
    public function del_role($role_id){
        $info = Db::name('admin_role')->where(array('role_id'=>$role_id))->find();
        if (empty($info)) {
            return array('status'=>0,'msg'=>'信息错误');
        }
        $data = Db::name('admin_user')->where(array('role_id'=>$role_id))->select();
        if (!empty($data)) {
            return array('status'=>0,'msg'=>'该角色有所属用户,不可删除');
        }

        $res = Db::name('admin_role')->where(array('role_id'=>$role_id))->delete();
        if (!$res) {
            return array('status'=>0,'msg'=>'删除失败');
        } else {
            return array('status'=>1,'msg'=>'删除成功');
        }

    }
   
}