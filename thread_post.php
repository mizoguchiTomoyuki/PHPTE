<?php
require_once 'sqlClass.php';
require_once 'date_encode.php';
function threadpost($usrname,$text,$threadid){
	$mysql = new MySQLClass();
	$mysql->connect('***','***','***');
	$mysql->selectDatabase('service');
	mysql_set_charset('utf8');
	$qresult = $mysql->Query('select count(*) from thread');
	$record =  mysql_fetch_assoc($qresult);
	$date = nowTimeInMySql();
	$count = $record['count(*)']+1;
	$query = sprintf('INSERT INTO thread VALUES(%s,%s,%s,null,%s,%s)',
				quote_smart($count),
				quote_smart($usrname),
				quote_smart($text),
				quote_smart($threadid),
				quote_smart($date));
	$qresult = $mysql->Query($query);

	$mysql->disconnect();

}
?>