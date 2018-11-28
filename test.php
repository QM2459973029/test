<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/practice/blog/lib/Db.php';

$db = new Db();

$page= $_GET['page'];
$pagesize=2;
$res =$db->table('cates')->field('id,name')->pages($page,$pagesize,'test.php');
// echo json_encode($res);

// echo "<pre>";
// print_r($res);
// echo "共有数据".$res['total'].'<br>';
// foreach ($res['data'] as $key => $value) {
// 	# code...
// 	echo $value['name'].'<br>';
// }



// $data= array('id'=>16,'name'=>'MYSQL分布式架构');
// $id=$db->table('cates')->insert($data);
// if ($id>="1") {
// 	# code...
// 	echo "插入成功";
// }

// $res=$db->table('cates')->where('id=12')->delete();
 // $data=['name'=>'数据库连接','id'=>10];
// $res=$db->table('cates')->where('id=14')->update($data);
// var_dump($res);
// print_r($res);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<title>分页</title>
    <link rel="stylesheet" type="text/css" href="static/plugins/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<div class="container" style="margin-top:50px;">
	    <p>共有数据<?php echo $res['total']?>条</p>
		<table class="table table-bordered">
		  <thead>
		     <tr>
		         <th>ID</th>
		         <th>标题</th>
		     </tr>
		  </thead>
		  <tbody>
		     <?php foreach ($res['data'] as $cates) {?>
		     	<tr>
		     	   <td><?php echo $cates['id'] ?></td>
		     	   <td><?php echo $cates['name'] ?></td>
		     	</tr>
		     <?php } ?>
		  </tbody>
		</table>

       <div>
       <?php echo $res['pages'];  ?>
       </div>

	</div>
</body>
</html>