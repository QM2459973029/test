<?php
//访问Mysql数据库
$dsn = 'mysql:host=127.0.0.1;dbname=myblog';
$username='root';
$pwd='root';
$pdo = new PDO($dsn,$username,$pwd);

// $sql='select * from cates where id=:id';
// $sql='update cates set name ="PHP中文网面试" where id=:id';
$sql='insert into cates(name)values(:name)';
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':name','淘宝开发');
$stmt->execute();
$id = $pdo->lastInsertId();
// $row =$stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($id);
echo "<pre>";
// print_r($row);