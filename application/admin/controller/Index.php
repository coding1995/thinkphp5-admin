<?php
namespace app\admin\controller;
use think\Db;
use app\admin\controller\Base;
class Index extends Base
{
    public function index()
    {
    	return $this->fetch();
    }


    public function welcome()
    {	
    	$sys_info['os']             = PHP_OS;
		$sys_info['zlib']           = function_exists('gzclose') ? 'YES' : 'NO';//zlib
		$sys_info['safe_mode']      = (boolean) ini_get('safe_mode') ? 'YES' : 'NO';//safe_mode = Off		
		$sys_info['timezone']       = function_exists("date_default_timezone_get") ? date_default_timezone_get() : "no_timezone";
		$sys_info['curl']			= function_exists('curl_init') ? 'YES' : 'NO';	
		$sys_info['web_server']     = $_SERVER['SERVER_SOFTWARE'];
		$sys_info['phpv']           = phpversion();
		// $sys_info['ip'] 			= GetHostByName($_SERVER['SERVER_NAME']);
		$sys_info['ip'] 			= '127.0.0.1';
		$sys_info['fileupload']     = @ini_get('file_uploads') ? ini_get('upload_max_filesize') :'unknown';
		$sys_info['max_ex_time'] 	= @ini_get("max_execution_time").'s'; //脚本最大执行时间
		$sys_info['set_time_limit'] = function_exists("set_time_limit") ? true : false;
		$sys_info['domain'] 		= $_SERVER['HTTP_HOST'];
		$sys_info['memory_limit']   = ini_get('memory_limit');
		$sys_info['timezone']       = date_default_timezone_get(); 	
		$sys_info['time']           = date('Y-m-d H:i:s',time());
		$sys_info['uptime']         = explode(",", exec('uptime'))[0];
		$sys_info['php_uname']         = php_uname();

		$mysqlinfo = Db::query("SELECT VERSION() as version");
		$sys_info['mysql_version']  = $mysqlinfo[0]['version'];
		if(function_exists("gd_info")){
			$gd = gd_info();
			$sys_info['gdinfo'] 	= $gd['GD Version'];
		}else {
			$sys_info['gdinfo'] 	= "未知";
		}
		// echo '<pre>';
		// var_dump(php_uname());die;
		$this->assign('sys_info',$sys_info);
    	return $this->fetch();
    }
}
