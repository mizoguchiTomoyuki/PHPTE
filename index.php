<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
?>
<html// xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無題ドキュメント</title>

</head>
<a href = "/signin/logout.php">ログアウトする</a>
<form method="post" action="index.php">
<input type="text" name="toukou" size="255">
<input type="submit" value="送信">
</form>
<hr>

<?php
if(!isset($_SESSION['username'])){
	header('Location: ../top.html');
	exit;	
}
?>
<?php
require_once 'thread_post.php';
#投稿ボタンを押されたら.
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$DATA['name'] = '';
	if(isset($_SESSION['username'])){
		$DATA['name'] = $_SESSION['username'];	
	}
	$DATA['text'] = $_POST['toukou'];
	$DATA['threadID'] = '1';
	
	threadpost($DATA['name'],$DATA['text'],$DATA['threadID']);
}
?>
<?php
require_once 'date_encode.php';
nowTimeInMySql();
require_once 'thread_view.php';
threadView('1');
?>


</body>
</html>
