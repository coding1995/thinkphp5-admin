<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/menu/menu-index.html";i:1528101894;s:83:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/meta.html";i:1527746715;s:85:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/footer.html";i:1527234739;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="__STATIC__/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="__STATIC__/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>菜单设置</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页
	<span class="c-gray en">&gt;</span>
	菜单栏管理
	<span class="c-gray en">&gt;</span>
	菜单栏设置
	<a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a>
</nav>
<div class="page-container">
	<form action="<?php echo url('admin/menu/index'); ?>" method="post">
	<div class="text-c">
		<input type="text" name="keyword" id="" placeholder="菜单名称" style="width:250px" class="input-text" value="<?php if(!empty($keyword) == true): ?><?php echo $keyword; endif; ?>">
		<button name="" id="" class="btn btn-success" type="submit"><i class="Hui-iconfont">&#xe665;</i> 搜索</button>
	</div>
	</form>
	<div class="cl pd-5 bg-1 bk-gray mt-20">
		<span class="l">
		<a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a>
		<a class="btn btn-primary radius" onclick="system_category_add('添加菜单','<?php echo url('admin/menu/addMenu'); ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加菜单</a>
		</span>
		<span class="r">共有数据：<strong><?php echo $num; ?></strong> 条</span>
	</div>
	<div class="mt-20">
		<table class="table table-border table-bordered table-hover table-bg table-sort">
			<thead>
				<tr class="text-c">
					<th width="25"><input type="checkbox" name="" value=""></th>
					<th width="80">ID</th>
					<th width="80">排序</th>
					<th>菜单名称</th>
					<th>url</th>
					<th width="100">操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(is_array($menuInfo) || $menuInfo instanceof \think\Collection || $menuInfo instanceof \think\Paginator): $key = 0; $__LIST__ = $menuInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($key % 2 );++$key;?>
				<tr class="text-c">
					<td><input type="checkbox" name="" value=""></td>
					<td><?php echo $vo['id']; ?></td>
					<td><?php echo $vo['sort']; ?></td>
					<td><?php echo $vo['name']; ?></td>
					<td><?php echo $vo['url']; ?></td>
					<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('菜单编辑','<?php echo url('admin/menu/updateMenu',array('id'=>$vo['id'])); ?>','<?php echo $vo['id']; ?>','800','700')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除" href="javascript:;" onclick="system_category_del(this,'<?php echo $vo['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				 <?php if(!empty($vo['cmenu']) == true): if(is_array($vo['cmenu']) || $vo['cmenu'] instanceof \think\Collection || $vo['cmenu'] instanceof \think\Paginator): $k = 0; $__LIST__ = $vo['cmenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($k % 2 );++$k;?>
				<tr class="text-c">
					<td><input type="checkbox" name="" value=""></td>
					<td><?php echo $vv['id']; ?></td>
					<td><?php echo $vv['sort']; ?></td>
					<td>--&nbsp;--&nbsp;--&nbsp;<?php echo $vv['name']; ?></td>
					<td><?php echo $vv['url']; ?></td>
					<td class="f-14"><a title="编辑" href="javascript:;" onclick="system_category_edit('菜单编辑','<?php echo url('admin/menu/updateMenu',array('id'=>$vv['id'])); ?>','<?php echo $vv['id']; ?>','800','700')" style="text-decoration:none"><i class="Hui-iconfont">&#xe6df;</i></a>
						<a title="删除" href="javascript:;" onclick="system_category_del(this,'<?php echo $vv['id']; ?>')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
				</tr>
				<?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script> 

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="__STATIC__/lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="__STATIC__/lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">
// $('.table-sort').dataTable({
// 	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
// 	"bStateSave": true,//状态保存
// 	"aoColumnDefs": [
// 	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
// 	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
// 	]
// });
/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(index){
		$.post(
		'<?php echo url('admin/menu/delMenu'); ?>',
		{id:id},
		function(dat){
			var data = JSON.parse(dat);
			if(data.status == 1){
            	$(obj).parents("tr").remove();
				layer.msg('已删除!',{icon:1,time:1000});
            }else{
            	var msg = data.msg;
            	layer.msg(msg,{icon:2,time:2000});
            }
		});	
	});
}
</script>
</body>
</html>