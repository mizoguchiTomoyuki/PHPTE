<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>確認</title>
</head>
<?php
session_start();
if(!isset($_SESSION['join'])){
	header('Location: ../top.html');
	exit();
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
require_once "../sqlClass.php";
$mysql = new MySQLClass();
$mysql->connect('***','***','***');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');

$sql = sprintf('INSERT INTO loginpage VALUES( %s,%s,%s)',
quote_smart( $_SESSION['join']['name']),
quote_smart( $_SESSION['join']['mail']),
quote_smart( sha1($_SESSION['join']['pass'])));
echo $sql;
$res = $mysql->Query($sql);
unset($_SESSION['join']);

$mysql->disconnect();
if($res){
	header('Location: complete.php');
	exit();
}else{
	echo 'データベースエラー。書き直してください。'	;
}
}

?>

<form action="" method="post" >
<dt>ユーザー名</dt>
<dd>
<?php print("<p>".$_SESSION['join']['name'])."</p>" ?>
</dd>
<dt>メールアドレス</dt>
<dd>
<?php print("<p>".$_SESSION['join']['mail'])."</p>" ?>
</dd>
<div><a href="signup.php?action=rewrite">&laquo;&nbsp;書き直す</a>
<input type="submit" value="登録する"></div>
</form>
<body>
</body>
</html>