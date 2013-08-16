<?php

/*
 * Created on 2013��8��14��
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */

	if(strpos('8002-b',$_SERVER['SERVER_NAME']) !== false){
        define('HTTP_SERVER', 'http://phpblog.com');
        define('HTTPS_SERVER', 'https://phpblog.com');
    }else{
        define('HTTP_SERVER', 'http://phpblog.com');
        define('HTTPS_SERVER', 'https://phpblog.com');
    }
	 define('HTTP_CATALOG_SERVER', 'http://phpblog.com');
	 define('HTTPS_CATALOG_SERVER', 'https://phpblog.com');

	// 工程目录配置文件
	define('DIR_FS_CATALOG', 'D:/project/blog/');	
	define('DIR_WS_SRC', DIR_FS_CATALOG.'src/');
	define('DIR_WS_DB', DIR_WS_SRC . 'db/');
	define('DIR_WS_TESTS', DIR_WS_SRC . 'test/');
	// functions pages配置文件
	define('DIR_WS_FUNCTIONS',DIR_WS_SRC.'functions/');
	define('DIR_WS_PAGES',DIR_WS_SRC.'pages/');
	define('DIR_WS_SERVICES',DIR_WS_SRC.'services/');
	// bootstrap配置文件
	define('DIR_WS_BOOTSTRAP', DIR_WS_SRC.'bootstrap/');
	define('DIR_WS_CSS', DIR_WS_BOOTSTRAP.'css/');
	define('DIR_WS_JS', DIR_WS_BOOTSTRAP.'js/');		
	
	// 数据库配置文件
	define('DB_TYPE', 'mysql');
	define('DB_SERVER', '192.168.65.47');
	define('DB_DATABASE', 'blog');
	define('DB_SERVER_USERNAME', 'root');
	define('DB_SERVER_PASSWORD', '123456');	
	define('USE_PCONNECT', 'true'); // use persistent connections?
	define('STORE_SESSIONS', 'db'); // use 'db' for best support, or '' for file-based storage
	define('DB_LOG',1);
	define('DB_LOG_PATH','./');	
	
	// 页面文件配置
	define("ROW_FLUID",3); //每行的rownumber
	define("PAGE_ROWS",3);//每页显示的数目
	define("PAGESIZE",8);
	
?>
