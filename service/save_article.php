<?php
session_start();
$user = isset($_SESSION['user'])?$_SESSION['user']:false;
if(!$user){
	exit(json_encode(array('code'=>1,'msg'=>'您还未登录，请先登录后再发表博客')));
}
//保存博客
$data=array();
$data['uid']=$user['uid'];
$data['title']= trim($_POST['title']);
$data['cid'] = trim($_POST['cid']);
$data['keywords']= trim($_POST['keywords']);
$data['desc'] = trim($_POST['desc']);
$data['contents'] = htmlspecialchars(trim($_POST['contents']),true);
$data['add_time']=time();
if(!$data['title']){
	exit(json_encode(array('code'=>1,'msg'=>'标题不能为空')));
}
//保存数据
require_once $_SERVER['DOCUMENT_ROOT'].'/lib/Db.php';
$db = new Db();

$id=$db->table('blog')->insert($data);
if(!$id){
	exit(json_encode(array('code'=>1,'msg'=>'发表失败！')));
}
exit(json_encode(array('code'=>0,'msg'=>'博客发表成功')));

?>