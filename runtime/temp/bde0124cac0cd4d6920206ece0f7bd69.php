<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:92:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/admin/admin-role-add.html";i:1528075199;s:83:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/meta.html";i:1527746715;s:85:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/footer.html";i:1527234739;}*/ ?>
﻿<!DOCTYPE HTML>
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
<title>新建网站角色 - 管理员管理 - H-ui.admin v3.1</title>
</head>
<body>
<article class="page-container">
	<form action="<?php if(empty($info) == true): ?><?php echo url('admin/admin/addRole'); else: ?><?php echo url('admin/admin/updateRole',array('id'=>$info['role_id'])); endif; ?>" method="post" class="form form-horizontal" id="form-admin-role-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>角色名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['role_name']; endif; ?>" placeholder="" id="roleName" name="roleName">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">备注：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['desc']; endif; ?>" placeholder="" id="desc" name="desc">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-3">网站角色：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<dl class="permission-list">
					<dt>
						<label>
							<input type="checkbox" value="<?php echo $vo['id']; ?>" <?php if((!empty($info) == true) and in_array($vo['id'],$info['menu'])): ?>checked<?php endif; ?> name="menuid[]" id="user-Character-0">
							<?php echo $vo['name']; ?></label>
					</dt>
					<dd>
						<?php if(!empty($vo['cmenu']) == true): if(is_array($vo['cmenu']) || $vo['cmenu'] instanceof \think\Collection || $vo['cmenu'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['cmenu'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vv): $mod = ($i % 2 );++$i;?>
						<dl class="cl permission-list2">
							<dt>
								<label class="">
									<input type="checkbox" value="<?php echo $vv['id']; ?>" name="menuid[]" id="user-Character-0-0" <?php if((!empty($info) == true) and in_array($vv['id'],$info['menu'])): ?>checked<?php endif; ?> >
									<?php echo $vv['name']; ?></label>
							</dt>
							<?php if(!empty($vv['per']) == true): ?>
							<dd>
								<?php if(is_array($vv['per']) || $vv['per'] instanceof \think\Collection || $vv['per'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vv['per'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vvo): $mod = ($i % 2 );++$i;?>
								<label class="">
									<input type="checkbox" value="<?php echo $vvo['id']; ?>" name="menuid[]" id="user-Character-0-0-0" <?php if((!empty($info) == true) and in_array($vvo['id'],$info['menu'])): ?>checked<?php endif; ?>>
									<?php echo $vvo['name']; ?></label>
								<?php endforeach; endif; else: echo "" ;endif; ?>
							</dd>
							<?php endif; ?>
						</dl>
						<?php endforeach; endif; else: echo "" ;endif; endif; ?>
					</dd>
				</dl>
				<?php endforeach; endif; else: echo "" ;endif; ?>
			</div>
		</div>
		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
				<button type="submit" class="btn btn-success radius" id="admin-role-save" name="admin-role-save"><i class="icon-ok"></i> 确定</button>
			</div>
		</div>
	</form>
</article>
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script> 

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/jquery.validate.js"></script>
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/validate-methods.js"></script>
<script type="text/javascript" src="__STATIC__/lib/jquery.validation/1.14.0/messages_zh.js"></script>
<script type="text/javascript">
$(function(){
	$(".permission-list dt input:checkbox").click(function(){
		$(this).closest("dl").find("dd input:checkbox").prop("checked",$(this).prop("checked"));
	});

	$(".permission-list2 dt input:checkbox").click(function(){
		$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		var l=$(this).parents(".permission-list").find(".permission-list2 dt").find("input:checked").length;

		if(l2==0){
			$(this).parent(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
		}
		if (l==0) {
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
		}
	});

	$(".permission-list2 dd input:checkbox").click(function(){
		var l =$(this).parent().parent().find("input:checked").length;
		var l2=$(this).parents(".permission-list").find(".permission-list2 dd").find("input:checked").length;
		if($(this).prop("checked")){
			$(this).closest("dl").find("dt input:checkbox").prop("checked",true);
			$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",true);
		}else{
			if(l==0){
				$(this).closest("dl").find("dt input:checkbox").prop("checked",false);
			}
			if(l2==0){
				$(this).parents(".permission-list").find("dt").first().find("input:checkbox").prop("checked",false);
			}
		}
		
	});
	
	$("#form-admin-role-add").validate({
		rules:{
			roleName:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		// submitHandler:function(form){
		// 	$(form).ajaxSubmit();
		// 	var index = parent.layer.getFrameIndex(window.name);
		// 	parent.layer.close(index);
		// }
		
	});

	$('#admin-role-save').click(function(){
		var tmp = $("input[type='checkbox']").is(':checked');
		var name = $.trim($('#roleName').val());
		var desc = $.trim($('#desc').val());
		var reg = /^[\u4E00-\u9FA5]{1,5}$/;
		if (name=='') {
			alert('角色名称不能为空');return false;
		}
		if(!reg.test(name)||!reg.test(desc)) {
	    	alert("名称和描述只支持中文字符");return false;
		} 
		if (tmp==false) {
			alert('请选择网站角色');
			return false;
		}
	});
});
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>