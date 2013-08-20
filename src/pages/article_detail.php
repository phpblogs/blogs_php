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
	$more =$_GET["more"];
	
	
	if(empty($more))
	{
		$more = "show";
	}

?>

<?php
if($more === "show")
{
?>

	<div class="row-fluid" id="<?php echo $aid?>">
	   <div class="hero-unit">
           <h3 ><?php echo $article_detail[0]['article_name']?></h3>
           <p style="font-size:50%"><?php echo $article_detail[0]['article_moddate']."</br>";?>
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_detail[0]['article_content']?></p>
          <p><a class="btn"  onclick='getArticleDetail("<?php echo $aid; ?>","none")' >收回 &raquo;</a></p>
          </div><!--/row--> 
       </div>
<?php 
}
else if($more ==="none")
{
	

?>

<div class="row-fluid" id="<?php echo $aid?>">
	   <div class="hero-unit">
           <h4><?php echo $article_detail[0]['article_name']?></h4>
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo substr($article_detail[0]['article_content'], 0, 140)?></p>
		   <p style="font-size:50%"><?php echo  $values["article_moddate"];?></p>
          <p><a class="btn"  onclick='getArticleDetail("<?php echo $aid; ?>","show")' >展开 &raquo;</a></p>
          </div><!--/row--> 
       </div>
	   
       
 <?php 
}
 ?>

