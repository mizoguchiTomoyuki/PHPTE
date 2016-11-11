<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無題ドキュメント</title>
</head>
<?php
session_start();
if(!isset($_SESSION['join'])){
	header('Location: ../top.html');
	exit();
}
?>
<p>ユーザー登録が完了しました</p>
<p><a href= "login.php">ログインする</a></p>
<body>
</body>
</html>