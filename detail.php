<?php
session_start();
$user = isset($_SESSION['user'])?$_SESSION['user']:false;
if (!$user) {
	exit('您还没有登录，请登录后再操作');
}
//文章详情
$aid = (int)$_GET['aid'];
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/Db.php';
$db = new Db();

$article=$db->table('blog')->where(array('id'=>$aid))->item();
$pv=$db->table('blog')->field('pv')->where(array('id'=>$aid))->item();
$pv=$pv['pv'] +1;
$data=['pv'=>$pv];
$db->table('blog')->where(array('id'=>$aid))->update($data);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title><?php echo $article['title']?></title>
	<link rel="stylesheet" type="text/css" href="/static/plugins/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/static/css/site.css">
	<script type="text/javascript" src="/static/plugins/bootstrap/dist/js/jquery.js"></script>
	<script type="text/javascript" src="/static/plugins/bootstrap/dist/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/static/js/UI.js"></script>
	<style type="text/css">
         .container-list .title{text-align: center;font-size: 18px;margin-top: 20px;color:#666;}
         .container-list .time{float: right;font-size: 12px;color: grey;margin-top: -10px;}
	</style>
</head>
<body>
    <div class="header">
       <div class="container">
          <span class="title">小小恶龙的博客</span>
          <div class="search">
             <div class="input-grounp">
               <input type="text" class="form-control" placeholder="输入标题搜索">
                <span class="input-grounp-btn">
                  <button class="btn btn-default" id="go" type="button">搜索</button>
                </span>
             </div>
          </div>
          <div class="login-reg">
        <?php if($user){?>
        <span style="color:#FFFF00;font-size:25px;font-weight: bold;"><?php echo $user['username']?></span>&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="logout()" style="margin-left:130px;position:absolute;margin-top:10px;" class="btn btn-danger">退出登录</a>
        <?php }else{?>
             <button type="button" class="btn btn-primary">点击注册</button>
             <button type="button" class="btn btn-success" onclick="login()">点击登录</button>
             <?php }?>
             <button type="button" class="btn btn-warning"  onclick="add_article()">发表博客</button>
          </div>
       </div>  
    </div>

    <div class="main container">
       <div class="col-lg-3 left-container">
          <p class="cates">博客分类</p>
          <div class="cates-list">
            <div class="cates-item"><a href="/index.php?cid=1">编程语言</a></div>
            <div class="cates-item"><a href="/index.php?cid=2">软件设计</a></div>
            <div class="cates-item"><a href="/index.php?cid=3">安卓开发</a></div>
            <div class="cates-item"><a href="/index.php?cid=4">web前端</a></div>
            <div class="cates-item"><a href="/index.php?cid=5">PHP后端</a></div>
            <div class="cates-item"><a href="/index.php?cid=6">IOS开发</a></div>
            <div class="cates-item"><a href="/index.php?cid=7">接口开发</a></div>
            <div class="cates-item"><a href="/index.php?cid=8">微信小程序开发</a></div>
            <div class="cates-item"><a href="/index.php?cid=9">模块开发</a></div>
          </div>
       </div>
       <div class="col-lg-9">
          <div class="nav">
             <a href="">热门</a>
             <a href="" class="active">最新</a>
          </div>
          <div class="container-list">        
             <p class="title"><?php echo $article['title'];?></p>
             <p><span class="time">发布时间：<?php echo date('Y-m-d H:i:s',$article['add_time']);?></span></p><hr>
             <div class="contents">
                 <?php echo htmlspecialchars_decode((string)$article['contents']);?>
             </div>

         </div>
      </div>
   </div>
</body>
</html>

<script type="text/javascript">
//登录
function login(){
     //UI.alert({title:'系统消息',msg:'提示成功',icon:'ok'})
     UI.open({title:'登录',url:'/login.php',width:450,height:300});
 }

  // 退出登录
  function logout(){
    if(!confirm('确定要退出吗？')){
      return;
    }
    $.get('/service/logout.php',{},function(res){
      if(res.code>0){
        UI.alert({msg:res.msg,icon:'error'});
      }else{
        UI.alert({msg:res.msg,icon:'ok'});
        setTimeout(function(){parent.window.location.reload();},1000);
      }
    },'json');
  }
    // 发表博客
  function add_article(){
    UI.open({title:'发表博客',url:'/add_article.php',width:750,height:590});
  }
</script>