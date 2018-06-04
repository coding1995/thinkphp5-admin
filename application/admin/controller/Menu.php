<?php
namespace app\admin\controller;
use app\admin\model\Menus;
use app\admin\controller\Base;
use think\Db;
/**
 * 菜单栏控制器
 */
class Menu extends Base
{	
	/**
	 * 菜单首页
	 * @return [type] [description]
	 */
	public function index()
	{	
		$keyword = isset($_POST['keyword'])?$_POST['keyword']:'';
        if(!empty($keyword)){
            $where['name'] = array("like","%$keyword%");
            $where['type'] =  array('eq','menu');
            $menuInfo = Db::name('admin_menu')->where($where)->select();
        } else {
        	$menus = new Menus();
			$menuInfo = $menus->getMenu();
        }
        $num = count($menuInfo);
		$this->assign('menuInfo',$menuInfo);
		$this->assign('keyword',$keyword);
		$this->assign('num',$num);
		return $this->fetch('menu-index');
	}


	/**
	 * [addMenu description]添加菜单栏
	 */
	public function addMenu()
	{	
		if (request()->post()) {
			$insert_data = array();
			$insert_data['name'] = input('name');
			$insert_data['parent_id'] = input('parent_id');
			if ($insert_data['parent_id'] != 0) {
				$insert_data['url'] = input('url');
			}
			$insert_data['sort'] = input('sort');
			$insert_data['status'] = input('is_show');
			$info = Db::name('admin_menu')->where(array('name'=>input('name')))->find();
			if (!empty($info)) {
				exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
			}
			$res = Db::name('admin_menu')->insert($insert_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'添加成功')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'添加失败')));
            }
		} else {
			$menus = new Menus();
			$menuInfo = $menus->getMenu();
			$this->assign('menuInfo',$menuInfo); 
			return $this->fetch('menu-add');
		}
	}


	/**
	 * [updateMenu description]编辑菜单栏
	 * @return [type] [description]
	 */
	public function updateMenu(){
		$id = input('id');
		if (request()->post()) {
			$update_data = array();
			$update_data['name'] = input('name');
			$update_data['parent_id'] = input('parent_id');
			if ($update_data['parent_id'] != 0) {
				$update_data['url'] = input('url');
			}
			$update_data['sort'] = input('sort');
			$update_data['status'] = input('is_show');
			$info = Db::name('admin_menu')->where(array('name'=>input('name')))->where('id','neq',$id)->find();
			if (!empty($info)) {
				exit(json_encode(array('status'=>0,'msg'=>'当前名称已存在')));
			}
			$res = Db::name('admin_menu')->where(array('id'=>$id))->update($update_data);
            if ($res) {
                exit(json_encode(array('status'=>1,'msg'=>'编辑成功')));
            } else {
                exit(json_encode(array('status'=>0,'msg'=>'编辑失败')));
            }
			
		} else {
			$info = Db::name('admin_menu')->where(array('id'=>$id))->find();
	        if (empty($info)) {
	            $this->error('信息有误');
	        }
			$menus = new Menus();
			$menuInfo = $menus->getMenu();
			$this->assign('menuInfo',$menuInfo); 
			$this->assign('info',$info); 
			return $this->fetch('menu-add');
		}
	}

	/**
	 * [delMenu description]删除菜单
	 * @return [type] [description]
	 */
	public function delMenu(){
		$id = input('id');
		$menus = new Menus();
		$data = $menus->del_menu($id);
		exit(json_encode($data));
	}
}