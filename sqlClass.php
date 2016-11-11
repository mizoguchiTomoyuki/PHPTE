<?php

class MySQLClass {
private $link;
private $db_name;
private $connection = false;
private $notice;
	function __construct(){
		$this->connection = false;	
		$db_name = 'null';
		mysql_set_charset('sjis');
	}

	function connect($host,$username,$pass)	{
		if($this->connection){
			return;	
		}
		$this->link = mysql_connect($host,$username,$pass);
		if(!$this->link){
			die('接続失敗です。'.mysql_error());
			$this->connection = FALSE;
		}else{
			$this->connection = TRUE;	
		}
		$this->AddNotice('<p>接続に成功しました。</p>');

	}

	function disconnect(){
		if(!$this->connection){
		return;
	}
		$closeflag = mysql_close($this->link);
	
		if ($closeflag){
 	 		$this->AddNotice('<p>切断に成功しました。</p>');
			$this->connection = FALSE;
		}
	}
#databaseを指定する
	function selectDatabase($databasename){
		$db_selected = mysql_select_db($databasename,$this->link);
		if(!$db_selected){
		 die('データベース選択失敗です'.mysql_error());	
		}else{
			$this->db_name = $databasename;
		}
	
	}
#現在指定しているデータベースを返す
	function getDBname(){
		return $this->db_name;

	}
#現在指定しているデータベースを返す
	function getDB(){
		return $this->link;

	}
#queryで指定したクエリをlinkに送る
	function Query($query){
		$result = mysql_query($query);
		if(!$result){
			die('クエリ―が失敗しました。'.mysql_error());	
		}
		return $result;
	}
	function GetNotice(){
		return $this->notice;
	}
	
	function AddNotice($note){
		$this->notice.=$note;
	}

}

function quote_smart($value)
{
    // 数値以外をクオートする
    if (!is_numeric($value)) {
        $value = "'" . mysql_real_escape_string($value) . "'";
    }
    return $value;
}


?>