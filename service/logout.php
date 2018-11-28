<?php
// 退出登录
session_start();
$_SESSION['user'] = null;
exit(json_encode(array('code'=>0,'msg'=>'退出成功')));