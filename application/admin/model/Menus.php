<?php
namespace app\admin\model;
use think\Db;
use think\Model;
class Menus extends Model 
{

    /**
     * 获取所有菜单栏
     * @return [type] [description]
     */
	public function getMenu($menuid_array=null)
	{
        if (!empty($menuid_array)) {
           $menu = Db::name('admin_menu')->where(array('parent_id'=>0,'type'=>'menu'))->where('id','in',$menuid_array)->order('sort asc')->select();
        } else {
            $menu = Db::name('admin_menu')->where(array('parent_id'=>0,'type'=>'menu'))->order('sort asc')->select();
        }
        $nmenu = array();
        if(!empty($menu)){
            foreach ($menu as $k=>$v) {
                $pid = $v['id'];
                $nmenu[$k] = $v;
                if (!empty($menuid_array)) {
                    $cmenu = Db::name('admin_menu')->where(array('parent_id'=>$pid,'type'=>'menu'))->where('id','in',$menuid_array)->order('sort asc')->select();
                } else {
                    $cmenu = Db::name('admin_menu')->where(array('parent_id'=>$pid,'type'=>'menu'))->order('sort asc')->select();
                }
                if(!empty($cmenu)){
                    $nmenu[$k]['cmenu'] = $cmenu;
                }else{
                    $nmenu[$k]['cmenu'] = array();
                }
            }
        }
        return $nmenu;
	}


    /**
     * [del_permission description]子权限删除
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function del_permission($id){
        $info = Db::name('admin_menu')->where(array('id'=>$id))->find();
        if (empty($info)) {
            return array('status'=>0,'msg'=>'信息错误');
        }

        $res = Db::name('admin_menu')->where(array('id'=>$id))->delete();
        if (!$res) {
            return array('status'=>0,'msg'=>'删除失败');
        } else {
            return array('status'=>1,'msg'=>'删除成功');
        }
    }


    /**
     * [del_menu description]删除菜单
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function del_menu($id){
        $info = Db::name('admin_menu')->where(array('id'=>$id))->find();
        if (empty($info)) {
             return array('status'=>0,'msg'=>'信息错误');
        }

        $cmenu_info = Db::name('admin_menu')->where(array('parent_id'=>$id))->find();
        if (!empty($info)) {
             return array('status'=>0,'msg'=>'当前菜单栏有子菜单,不可删除');
        } else {
            $res = Db::name('admin_menu')->where(array('id'=>$id))->delete();
            if (!$res) {
                return array('status'=>0,'msg'=>'删除失败');
            } else {
                return array('status'=>1,'msg'=>'删除成功');
            }
        }
    }
   
}