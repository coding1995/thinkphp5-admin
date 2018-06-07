<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/menu/menu-add.html";i:1528101172;s:83:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/meta.html";i:1527746715;s:85:"/home/wwwroot/works.songqiphp.xin/public/../application/admin/view/common/footer.html";i:1527234739;}*/ ?>
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
<title>栏目设置</title>
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
						上级菜单：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<span class="select-box">
						<select class="select" id="parent_id" name="parent_id" >
							<option value="0" <?php if((!empty($info) == true) and $info['parent_id'] == 0): ?>selected<?php endif; ?> >顶级菜单</option>
							<?php if(is_array($menuInfo) || $menuInfo instanceof \think\Collection || $menuInfo instanceof \think\Paginator): $i = 0; $__LIST__ = $menuInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
							<option value="<?php echo $vo['id']; ?>" <?php if((!empty($info) == true) and $info['parent_id'] == $vo['id']): ?>selected<?php endif; ?> ><?php echo $vo['name']; ?></option>
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
						菜单名称：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['name']; endif; ?>" placeholder="" id="name" name="name">
					</div>
					<div class="col-3">
					</div>
				</div>
				<?php if((!empty($info) == true) and (!empty($info['url']) == true)): ?>
				<div class="row cl"  id="url_is_show">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>url：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php echo $info['url']; ?>" placeholder="" id="url" name="url">
					</div>
					<div class="col-3">
					</div>
				</div>
				<?php else: ?>
				<div class="row cl" style="display: none" id="url_is_show">
					<label class="form-label col-xs-4 col-sm-3"><span class="c-red">*</span>url：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="" placeholder="" id="url" name="url">
					</div>
					<div class="col-3">
					</div>
				</div>
				<?php endif; ?>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">排序：</label>
					<div class="formControls col-xs-8 col-sm-9">
						<input type="text" class="input-text" value="<?php if(!empty($info) == true): ?><?php echo $info['sort']; endif; ?>" placeholder="" id="" name="sort">
					</div>
					<div class="col-3">
					</div>
				</div>
				<div class="row cl">
					<label class="form-label col-xs-4 col-sm-3">是否显示：</label>
					<div class="formControls col-xs-8 col-sm-9 skin-minimal">
						<div class="radio-box">
							<input name="is_show" <?php if((!empty($info) == true) and $info['status'] == 1): ?>checked<?php endif; ?> type="radio" value="1" id="sex-1" checked>
							<label for="sex-1">yes</label>
						</div>
						<div class="radio-box">
							<input type="radio" <?php if((!empty($info) == true) and $info['status'] == 2): ?>checked<?php endif; ?> id="sex-2" value="2" name="is_show">
							<label for="sex-2">no</label>
						</div>
					</div>
					<div class="col-3">
					</div>
				</div>
			</div>
		</div>
		<div class="row cl">
			<div class="col-9 col-offset-3">
				<input class="btn btn-primary radius" type="button" onclick="check();" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				<input type="hidden" id="tmp_url" value="<?php if(empty($info) == true): ?><?php echo url('admin/menu/addMenu'); else: ?><?php echo url('admin/menu/updateMenu',array('id'=>$info['id'])); endif; ?>">
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
			
		},
		onkeyup:false,
		focusCleanup:true,
		success:"valid",
		submitHandler:function(form){
			//$(form).ajaxSubmit();
			var index = parent.layer.getFrameIndex(window.name);
			//parent.$('.btn-refresh').click();
			parent.layer.close(index);
		}
	});
});

$('#parent_id').change(function () {
	var p1=$(this).children('option:selected').val();
	if (p1==0) {
		$('#url_is_show').hide();
	} else {
		$('#url_is_show').show();
	}
});


function check(){
    var name = $('#name').val();
    var parent_id = $('#parent_id').val();
    var url = $('#url').val();
    var sort = $('#sort').val();
    var tmp_url = $('#tmp_url').val();
    var is_show = $('input:radio[name="is_show"]:checked').val();
    if(name == ''){
        alert('菜单名称不可为空');return false;
    }
    if (parent_id!=0) {
    	if (url=='') { 
    		alert('url不可为空');return false;
    	}
    } 
    $.post(
    	tmp_url,
    	{name:name,parent_id:parent_id,url:url,sort:sort,is_show:is_show}, 
    	function (dat) {
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