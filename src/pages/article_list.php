<?php
	global $user_articles_detail;
/*	$uid = empty($_GET)?"u1":$_GET["user_uid"];
	$user_articles_detail = $articles_service->getUserArticleDetail($uid);*/
?>

<div class="span9">  
          <?php
          	foreach($user_articles_detail as $key=>$values)
   			{   	
   				?>
   				 <div class="row-fluid">              
           		 	<div class="hero-unit">
           		 		<h3><?php 
           		 				echo $values["article_name"];          		 
           		 				$_SESSION["article_uid"] = 	$values["article_uid"];// session操作
           		 		?></h3>
              			<p><?php 
              					echo substr($values["article_content"],0,120);
              					?></p>
              			<p><a class="btn" href="?<?php echo "article_uid=".$values["article_uid"];?>">更多 &raquo;</a></p>
            		</div>
            	 </div>
   				<?php
   			}          
          ?>            
              <!--/span-->
            <!--/span-->            
            <div id="paginator"></div>
          </div><!--/row-->  
