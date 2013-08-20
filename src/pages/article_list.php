<?php
	session_start();
	require_once("../configure.php");
	require_once (DIR_WS_DB."mysql_db.php");
	require_once (DIR_WS_SERVICES."article_services.php");
?>
<?php
	$db = new MysqlDB();
	$articles_service = new ArticleService();
	
	$per_page = PAGESIZE;
	$page_num = $_GET["page"];
	
	if (!isset ($page_num)) {
		$page_num = 1;
	}
	$uid = $_GET["uid"];
	if (!isset ($uid)) {
		$uid = "u1";
	}
	
	$start_page = ($page_num -1) * $per_page;
	$end_page = $page_num * $per_page;

	//$user_articles_detail = $articles_service->getUserArticleDetail($uid, $start_page, $per_page);	
	if(empty($_SESSION["user_uid"])){	
		$user_articles_detail = $articles_service->getAllArticles($start_page,$per_page);	
	}
	else{
		if($_SESSION["category_uid"]==="all"){
			$user_articles_detail = $articles_service->getUserArticleDetail($_SESSION["user_uid"],$start_page,$per_page);
		}
		else{
			$user_articles_detail = $articles_service->getUserArticleCategoryDetail($_SESSION["user_uid"],$_SESSION["category_uid"],$start_page,$per_page);
		}
	}
	
	$page_num = $_GET["page"];
?>

<div class="span9">  
          <?php
				foreach ($user_articles_detail as $key => $values) {
			?>
   				 <div class="row-fluid">              
           		 	<div class="hero-unit">
						<!-- href="?<?php //echo "article_uid=".$values["article_uid"];?>" -->
           		 		<h4><a class="article_title" href='javascript:getArticleDetail("<?php echo $values["article_uid"]; ?>")'  ><?php 
           		 				echo $values["article_name"];          		 
           		 				$_SESSION["article_uid"] = 	$values["article_uid"];// session操作
           		 		?></a></h4>
              			<p><?php 
              					echo substr($values["article_content"],0,140);
              					?></p>
              			<p style="font-size:50%"><?php echo  $values["article_moddate"];?></p>
						
						<p><a class="btn" onclick='getArticleDetail("<?php echo $values["article_uid"]; ?>")' >更多 &raquo;</a></p>
						           		 		             			
            		</div>
            	 </div>
   				<?php	
					}
				?>            
              <!--/span-->
            <!--/span-->            
            <div id="paginator"></div>
          </div><!--/row--> 
