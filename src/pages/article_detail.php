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
	<div class="row-fluid">
	   <div class="hero-unit">
           <h3><?php echo $article_detail[0]['article_name']?></h3>
           <p ><?php echo $article_detail[0]['article_moddate']."</br>";?>
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_detail[0]['article_content']?></p>
          </div><!--/row--> 
       </div>
</div>


