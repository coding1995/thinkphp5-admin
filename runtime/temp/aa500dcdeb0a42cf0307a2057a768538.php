<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:98:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/admin/admin-permission-add.html";i:1528094428;s:83:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/meta.html";i:1527746715;s:85:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/footer.html";i:1527234739;}*/ ?>
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
<title>添加权限节点</title>
</head>
<body>
<div class="page-container">
	<form action="" method="post" class="form form-horizontal" id="form-category-add">
		<div id="tab-category" class="HuiTab">
			<div class="tabBar cl">
				<span>基本设置</span>
			</div>
			<div class="tabCon">
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						父级菜单：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="parent_id" name="parent_id">
							<?php if(is_array($data) || $data instanceof \think\Collection || $data instanceof \think\Paginator): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $vo['id']; ?>"<?php if((!empty($info) == true) and $vo['id'] == $info['id']): ?>checked<?php endif; ?>><?php echo $vo['name']; ?></option>
							<?php endforeach; endif; else: echo "" ;endif; ?>
						</select>
						</span>
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						url：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['url']; endif; ?>" placeholder="admin/admin/delUser" id="url" name="url">
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">
						<span class="c-red">*</span>
						名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['name']; endif; ?>" placeholder="" id="name" name="name">
					</div>
					<div class="col-3">
					</div>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;" onclick="check()">
				<input type="hidden" id="tmp_url" value="<?php if(empty($info) == true): ?><?php echo url('admin/admin/addPermission'); else: ?><?php echo url('admin/admin/updatePermission',array('id'=>$info['id'])); endif; ?>">
			</div>
		</div>
	</form>
</div>
<script type="text/javascript" src="__STATIC__/lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="__STATIC__/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="__STATIC__/h-ui.admin/js/H-ui.admin.js"></script> 
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="__STATIC__/lib/My97DatePicker/4.8/WdatePicker.js"></script>
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
	
	$("#tab-category").Huitab({
		index:0
	});
	$("#form-category-add").validate({
		rules:{
			url:{
				required:true,
			},
			name:{
				required:true,
			},
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			//$(form).ajaxSubmit();
			// var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			// parent.layer.close(index);
		}
	});

});


function check(){
	var url = $.trim($('#url').val());
	var parent_id = $('#parent_id').val();
	var name = $.trim($('#name').val());
	var reg = /^[\u4E00-\u9FA5]{1,5}$/;
	if (name==''||url=='') {
		alert('请填写信息');return false;
	}
	if(reg.test(name)) {
	    alert("名称只支持中文字符");
	    return false;
	} 

	var tmp_url = $('#tmp_url').val();
	if (tmp_url=='') {
		alert('未知错误');return false;
	}
	$.post(
		tmp_url,
		{parent_id:parent_id,url:url,name:name},
		function (dat) {
			var data = JSON.parse(dat);
	        if(data.status == 1){
	            alert(data.msg);
	   //          var index = parent.layer.getFrameIndex(window.name);
				// parent.$('.btn-refresh').click();
				// window.parent.location.reload();
				// parent.layer.close(index);

				// layer.msg('添加成功!',{icon:1,time:1000});
				var index = parent.layer.getFrameIndex(window.name);
				parent.$('.btn-refresh').click();
				window.parent.location.reload();
				parent.layer.close(index);
	        }else{
	            alert(data.msg);return false;
	        }
	});
		
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>