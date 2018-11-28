<?php
session_start();
$user = isset($_SESSION['user'])?$_SESSION['user']:false;
if (!$user) {
	exit('您还没有登录，请登录后再操作');
}
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/Db.php';
$db = new Db();
$cates = $db->table('cates')->lists();
?>

<!DOCTYPE html>
<html>
<head>
	<title>发表博客</title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/css/site.css">
	<script type="text/javascript" src="/static/plugins/bootstrap/dist/js/jquery.js"></script>
	<script type="text/javascript" src="/static/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/static/js/UI.js"></script>
	<script type="text/javascript" src="/static/plugins/wangEditor/release/wangEditor.min.js"></script>
	<style type="text/css">
	body{background: #fff;}
	.title{text-align: center;font-size: 18px;color: #666;}
	.form{margin: 5px 0px;}
	.form .input-group{margin:20px 0px;}
	</style>
</head>
<body>
    <div class="container form">
	    <div class="input-group input-group-sm" style="margin-top:5px;">
		    <span class="input-group-addon">博客标题</span>
		    <input type="text" class="form-control" name="title" id="title" placeholder="请输入博客标题">
        </div>
	    <div class="input-group input-group-sm" style="margin-bottom:0px">
		    <span class="input-group-addon">博客分类</span>
		    <select class="form-control" name="cid">
		    <?php foreach($cates as $cate){?>
		  	<option value="<?php echo $cate['id']?>"><?php echo $cate['name']?></option>
		  	<?php }?>
		    </select>
	    </div>

        <div class="row">
	        <div class="col-xs-6">
			    <div class="input-group input-group-sm">
				    <span class="input-group-addon">关键字</span>
				    <input type="text" class="form-control" name="keywords" placeholder="请输入博客关键字">
		        </div>
	        </div>
	        <div class="col-xs-6">
		        <div class="input-group input-group-sm">
				    <span class="input-group-addon">描述</span>
				    <input type="text" class="form-control" name="desc" placeholder="请输入博客描述">
		        </div>
		    </div>
        </div>
        <div class="input-group input-group-sm" style="margin-top:2px">
		    <span class="input-group-addon">博客内容</span>
		        <div id="editor">
                  
                </div>
		    
        </div>
    </div>
    <button type="button" class="btn btn-primary" style="float:right;" onclick="save()">发表博客</button>
</body>
</html>
<script type="text/javascript">
//初始化富文本编辑器
var editor;
function initEditor(){    
	var E = window.wangEditor;
    editor = new E('#editor');
    // 或者 var editor = new E( document.getElementById('editor') )
    editor.customConfig.uploadImgServer = '/upload.php';
    editor.customConfig.uploadFileName ="file_img";
    editor.customConfig.zIndex = 100
    editor.customConfig.customAlert = function (info) {
    // info 是需要提示的内容
    UI.alert({msg:info,icon:'error'});
    }    
    editor.create();
}
initEditor();
//保存
function save(){
	var data=new Object;
     data.title = $.trim($('input[name="title"]').val());
     // var title = $.trim($('#title').val());
     data.cid = $.trim($('select[name="cid"]').val());
     data.keywords = $.trim($('input[name="keywords"]').val());
     data.desc = $.trim($('input[name="desc"]').val());
     data.contents = editor.txt.html();
     // var data = $('form').serialize();//表单序列化获取表单内容
     // alert(contents);
     if(data.title==""){
     	UI.alert({msg:'请输入博客标题',icon:'error'});
     	return;
     }
     if(data.contents=="<p><br></p>"){
     	UI.alert({msg:'请输入博客内容',icon:'alert'});
     	return;
     }
     $.post('service/save_article.php',data,function(res){
     	    if(res.code>0){
                UI.alert({msg:res.msg,icon:'error'});
            }else{
                UI.alert({msg:res.msg,icon:'ok'});
                setTimeout(function(){parent.window.location.reload();},1000);
            }
     },'json');



     // 
}
</script>
