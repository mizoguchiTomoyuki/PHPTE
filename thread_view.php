<?php
require_once 'sqlClass.php';

function threadview($threadid){
$mysql = new MySQLClass();
$mysql->connect('***','***','***');
$mysql->selectDatabase('service');
mysql_set_charset('utf8');
$query = sprintf('SELECT * FROM thread where threadID = %s',
				quote_smart($threadid));
$qresult = $mysql->Query($query);
while ($row = mysql_fetch_assoc($qresult)) {
    print('<p>'.$row['id'].': '.$row['usrname'].' Date :'.$row['submitDate'].'</p>');
    print('<p>本文</p>');
    print($row['text']);
    print('</p>');
}
$mysql->disconnect();

}
?>