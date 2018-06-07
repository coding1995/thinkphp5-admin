<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:87:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/admin/admin-add.html";i:1528097854;s:83:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/meta.html";i:1527746715;s:85:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/footer.html";i:1527234739;}*/ ?>
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
<title>添加管理员 - 管理员管理</title>
</head>
<body>
<article class="page-container">
	<form class="form form-horizontal" id="form-admin-add">
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>管理员：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['names']; endif; ?>" placeholder="" id="adminName" name="adminName">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>初始密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off" value="<?php if(!empty($info) == true): ?><?php echo $info['password']; endif; ?>" placeholder="密码" id="password"  name="password">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>确认密码：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="password" class="input-text" autocomplete="off"  placeholder="确认新密码" value="<?php if(!empty($info) == true): ?><?php echo $info['password']; endif; ?>" id="password2" name="password2">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>是否启用：</label>
		<div class="formControls col-xs-8 col-sm-9 skin-minimal">
			<div class="radio-box">
				<input name="status" type="radio" <?php if((!empty($info) == true) and $info['status'] == 1): ?>checked<?php endif; ?> value="1" id="sex-1" >
				<label for="sex-1">是</label>
			</div>
			<div class="radio-box">
				<input type="radio" id="sex-2" name="status" <?php if((!empty($info) == true) and $info['status'] == 2): ?>checked<?php endif; ?> value="2">
				<label for="sex-2">否</label>
			</div>
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>手机：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['phone']; endif; ?>" placeholder="" id="phone" name="phone">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>邮箱：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<input type="text" value="<?php if(!empty($info) == true): ?><?php echo $info['email']; endif; ?>" class="input-text" placeholder="@" name="email" id="email">
		</div>
	</div>
	<div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">角色：</label>
		<div class="formControls col-xs-8 col-sm-9"> <span class="select-box" style="width:150px;">
			<select class="select" name="adminRole" size="1" id="adminRole">
				<?php if(!empty($data) == true): if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
				<option value="<?php echo $vo['role_id']; ?>" <?php if((!empty($info) == true) and $vo['role_id'] == $info['role_id']): ?>selected<?php endif; ?> ><?php echo $vo['role_name']; ?></option>
				<?php endforeach; endif; else: echo "" ;endif; endif; ?>
			</select>
			</span> </div>
	</div>
	<!-- <div class="row cl">
		<label class="form-label col-xs-4 col-sm-3">备注：</label>
		<div class="formControls col-xs-8 col-sm-9">
			<textarea name="" cols="" rows="" class="textarea"  placeholder="说点什么...100个字符以内" dragonfly="true" onKeyUp="$.Huitextarealength(this,100)"></textarea>
			<p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
		</div>
	</div> -->
	<div class="row cl">
		<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-3">
			<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="check()">
			<input type="hidden" id="tmp_url" value="<?php if(empty($info) == true): ?><?php echo url('admin/admin/addAdmin'); else: ?><?php echo url('admin/admin/updateAdmin',array('id'=>$info['id'])); endif; ?>">
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
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});
	
	$("#form-admin-add").validate({
		rules:{
			adminName:{
				required:true,
				minlength:4,
				maxlength:16
			},
			password:{
				required:true,
			},
			password2:{
				required:true,
				equalTo: "#password"
			},
			status:{
				required:true,
			},
			phone:{
				required:true,
				isPhone:true,
			},
			email:{
				required:true,
				email:true,
			},
			adminRole:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			// $(form).ajaxSubmit({
			// 	type: 'post',
			// 	url: "xxxxxxx" ,
			// 	success: function(data){
			// 		layer.msg('添加成功!',{icon:1,time:1000});
			// 	},
   //              error: function(XmlHttpRequest, textStatus, errorThrown){
			// 		layer.msg('error!',{icon:1,time:1000});
			// 	}
			// });
			// var index = parent.layer.getFrameIndex(window.name);
			// parent.$('.btn-refresh').click();
			// parent.layer.close(index);
		}
	});
});


function check(){
	var names = $.trim($('#adminName').val());
	var email = $.trim($('#email').val());
	var phone = $.trim($('#phone').val());
	var password = $.trim($('#password').val());
	var status = $('input[name=status]:checked').val();
	var role_id = $('#adminRole').val();
	if (names==''||email==''||phone==''||password=='') {
		alert('请填写完整信息');return false;
	}
	var reg = /^[\u4E00-\u9FA5]{1,5}$/;
	// if(!reg.test(names)) {
	//     alert("名称只支持中文字符");
	//     return false;
	// }
	var tmp_url = $('#tmp_url').val();
	if (tmp_url=='') {
		alert('未知错误');return false;
	}
	$.post(
		tmp_url,
		{names:names,email:email,phone:phone,password:password,status:status,role_id:role_id},
		function (dat){
			var data = JSON.parse(dat);
	        if(data.status == 1){
	        	alert(data.msg);
	            // layer.msg('添加成功!',{icon:1,time:3000});
				var index = parent.layer.getFrameIndex(window.name);
				parent.$('.btn-refresh').click();
				window.parent.location.reload();
				parent.layer.close(index);
	        }else{
	        	var msgs = data.msg;
	            layer.msg(msgs,{icon:2,time:2000});
	        }
		}); 
	
}
</script> 
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>