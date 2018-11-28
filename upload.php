<?php
//上传图片
if ($_FILES['file_img']['error']>0) {
	exit(json_encode(array('errno'=>1,'data'=>[])));
}
// echo "<pre>";
// print_r($_FILES);
//限制文件类型和大小

$fi = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $fi->file($_FILES['file_img']['tmp_name']);

$allows = array('image/jpeg','image/png','image/gif');
if(!in_array($mime_type,$allows))
{
	exit(json_encode(array('errno'=>1,'data'=>[])));
}
move_uploaded_file($_FILES['file_img']['tmp_name'], $_SERVER['DOCUMENT_ROOT'].'/images/'.$_FILES['file_img']['name']);
exit(json_encode(array('errno'=>0,'data'=>['/images/'.$_FILES['file_img']['name']])));
?>