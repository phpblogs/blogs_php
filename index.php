<?php
/*
 * Created on 2013��8��14��
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */  
	 /**
	 * 加载主配置文件
	 */
	if (!file_exists('configure.php')) {
	  /**
	   * load the main configure file.
	   */
	  require_once('src/configure.php');
	}
	$baseDir = dirname(__FILE__); // 获取当前dir路径	

	session_start(); //session start位置
?>

<?php	
	require_once(DIR_WS_DB."mysql_db.php");	
	require_once(DIR_WS_FUNCTIONS."charset.php");		
	require_once(DIR_WS_SERVICES."article_services.php");
	require_once(DIR_WS_SERVICES."category_services.php");
	require_once(DIR_WS_SERVICES."user_services.php");			
	//require_once(DIR_WS_BOOTSTRAP."category.html");	
	//require_once(DIR_WS_BOOTSTRAP."article.html");	
?>

<?php
	ob_start();	
	$db = new MysqlDB();
	$charset = new Charset();
	$articles_service = new ArticleService();
	$category_service = new CategoryService();
	$user_service = new UserService();
	//$articles_service->db_connect();	
	//$articles_service->getAllArticles();	
	//$articles_service->getArticlesByCategory(0);
	//$category_service = new CategoryService();
	//$category_service->getAllCategory();
?>

<?php
	require_once(DIR_WS_PAGES."main.php");
?>

<?php

?>