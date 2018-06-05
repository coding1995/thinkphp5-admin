<?php
namespace app\admin\model;
use think\Db;
use think\Model;
use app\admin\model\Menus;
class Admins extends Model 
{	
	/**
	 * [getAdminUser description]获取管理员信息
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	public function getAdminUser($where=null){
		if ($where==null) {
			$res = Db::name('admin_user')->alias('u')->join('admin_role r','u.role_id=r.role_id','left')->select();
		} else {
			$res = Db::name('admin_user')->alias('u')->join('admin_role r','u.role_id=r.role_id','left')->where($where)->select();
		}
		return $res;
	}

	/**
	 * [del_admin description]删除管理员
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	public function del_admin($id){
		$info = Db::name('admin_user')->where(array('id'=>$id))->find();
		if (empty($info)) {
			return array('status'=>0,'msg'=>'信息有误');
		}
		if ($info['names']=='admin') {
			return array('status'=>0,'msg'=>'admin用户不可删除');
		}
		$res = Db::name('admin_user')->where(array('id'=>$id))->delete();
        if (!$res) {
            return array('status'=>0,'msg'=>'删除失败');
        } else {
            return array('status'=>1,'msg'=>'删除成功');
        }
	}


	/**
	 * [update_admin_status description]修改管理员状态
	 * @param  [type] $id     [description]
	 * @param  [type] $status [description]
	 * @return [type]         [description]
	 */
	public function update_admin_status($id,$status){
		$info = Db::name('admin_user')->where(array('id'=>$id))->find();
		if (empty($info)) {
			return array('status'=>0,'msg'=>'信息有误');
		}
		if ($info['names']=='admin') {
			return array('status'=>0,'msg'=>'admin用户不可修改状态为禁用');
		}
		$res = Db::name('admin_user')->where(array('id'=>$id))->update(array('status'=>$status));
        if ($res) {
            return array('status'=>1,'msg'=>'修改成功');
        } else {
            return array('status'=>0,'msg'=>'修改失败');
        }
	}

	/**
	 * [getAdminRole description]获取角色
	 * @return [type] [description]
	 */
	public function getAdminRole(){
		$res = Db::name('admin_role')->select();
		foreach ($res as $key => $value) {
			$admin_user = Db::name('admin_user')->field('names')->where(array('role_id'=>$value['role_id']))->select();
			$tmp = array();
			if (!empty($admin_user)) {
				foreach ($admin_user as $k => $v) {
					$tmp[] = $v['names'];
				}
				$res[$key]['admin_user'] = implode(',',$tmp);
			} else {
				$res[$key]['admin_user'] = '无';
			}
		}
		return $res;
	}


	/**
	 * [getPermissionInfo description]获取子节点
	 * @param  [type] $where [description]
	 * @return [type]        [description]
	 */
	public function getPermissionInfo($where){
		$res = DB::name('admin_menu')->where($where)->select();
		foreach ($res as $key => $value) {
			$res[$key]['parent'] = DB::name('admin_menu')->where(array('id'=>$value['parent_id']))->field('name')->find();
		}
		return $res;
	}


	/**
	 * [getAllPermissionInfo description]获取所有菜单栏以及子节点
	 * @return [type] [description]
	 */
	public function getAllPermissionInfo(){
		$menus = new Menus();
		$data = $menus->getMenu();
		$tmp = array();
		foreach ($data as $key => $value) {
			if (!empty($value['cmenu'])) {
				foreach ($value['cmenu'] as $k => $v) {
					$tmp = DB::name('admin_menu')->where(array('type'=>'per','parent_id'=>$v['id']))->select();
					if (!empty($tmp)) {
						$data[$key]['cmenu'][$k]['per'] = $tmp;
					} else {
						$data[$key]['cmenu'][$k]['per'] = array();
					}
				}
			}
		}

		return $data;
	}

	/**
     * [getCmenuInfo description]获取二级菜单
     * @return [type] [description]
     */
    public function getCmenuInfo(){
        $where['parent_id'] =  array('neq','0');
        $where['type'] =  array('eq','menu');
        $menu = Db::name('admin_menu')->where($where)->order('sort asc')->select();
        return $menu;
    }
}