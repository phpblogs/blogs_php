<?php
/*
 * Created on 2013��8��14��
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
 	$baseDir = dirname(__FILE__);
 	echo $baseDir;
 	echo __DIR__; 	
 	echo __FILE__;
 	echo DIR_FS_CATALOG;
 	echo "<br/>";
 	echo $_SERVER['DOCUMENT_ROOT']; 	
	require_once(DIR_WS_DB.'queryFactory.php');

	echo DIR_WS_DB;
	function db_connect()//连接数据库 
	{ 
		@$links =mysql_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD); 
		if(!$links) 
		throw new Exception('连接数据库失败!请重试!'); 
		mysql_select_db('blog'); 
		return $links; 
	} 

?>


