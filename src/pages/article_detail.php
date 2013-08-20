<?php
	require_once("../configure.php");
	require_once (DIR_WS_DB."mysql_db.php");
	require_once (DIR_WS_SERVICES."article_services.php");
?>
<?php
	$db = new MysqlDB();
	$articles_service = new ArticleService();
	$per_page = PAGESIZE;
	
	$aid = empty($_GET)?"a1":$_GET["article_uid"];
	$article_detail = $articles_service->getArticleDetail($aid);
?>

<div class="span9">  
           <h1><?php echo $article_detail[0]['article_name']?></h1>
           <p><?php echo $article_detail[0]['article_content']?></p>
          </div><!--/row--> 


