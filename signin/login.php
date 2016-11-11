<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html// xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ログイン</title>

</head>
<?php

require '../sqlClass.php';
session_start();

if(isset($_SESSION['username'])){
	header('Location: ../index.php');
	exit;	
}
#このページからのサブミットに対応
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	
	if($_POST['mail'] != '' && $_POST['pass'] != ''){
		$mysql = new MySQLClass();
		$mysql->connect('***','***','***');
		$mysql->selectDatabase('service');
		mysql_set_charset('utf8');
		$query = sprintf('SELECT * FROM loginpage WHERE mail = %s AND pass = %s',
						quote_smart($_POST['mail']),
						quote_smart(sha1($_POST['pass'])));
		$qresult = $mysql->Query($query);
		$table = mysql_fetch_assoc($qresult);
		if(!empty($table)){
			//ログイン成功
			session_regenerate_id(true);
			$_POST = array();
			$_SESSION['username'] = $table['name'];
			header('Location: ../index.php');
			exit();
		}else{
			$error['login'] = 'failed';	
		}
		$mysql->disconnect();
	}else{
		$error['login'] = 'blank';
	}


	
	
	
	
}	
?>
<p>メールアドレスとパスワードを入力してください。</p>
<form method="POST" action="login.php">

<p>MailAddress:<input type="text" name="mail" size="60" maxlength="255" value="<?php if(!empty($_POST['mail']))echo htmlspecialchars($_POST['mail'], ENT_QUOTES,'UTF-8'); ?>"></p>

<p>Password:<input type="text" name="pass" size="60" maxlength="255" value=""></p>

<?php
if(!empty($error['login']) && $error['login'] == 'blank')
print('<p><font color = "red">※いずれかの項目が入力されていません。</font></p>');
if(!empty($error['login']) && $error['login'] == 'failed')
print('<p><font color = "red">※ログインに失敗しました。アドレスとパスワードを確認してください。</font></p>');

?>
<input type="submit" value="ログイン">
</form>

<hr>

</body>
</html>
