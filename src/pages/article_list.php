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
           		 		<h4><a class="article_title" href="?<?php echo "article_uid=".$values["article_uid"];?>"><?php 
           		 				echo $values["article_name"];          		 
           		 				$_SESSION["article_uid"] = 	$values["article_uid"];// session操作
           		 		?></a></h4>
              			<p><?php 
              					echo substr($values["article_content"],0,140);
              					?></p>
              			<p style="font-size:50%"><?php echo  $values["article_moddate"];?></p>
              			<p><a class="btn"  onclick='getArticleDetail("<?php echo $values["article_uid"]; ?>")' >更多 &raquo;</a></p>
            		</div>
            	 </div>
   				<?php
   			}          
          ?>            
              <!--/span-->
            <!--/span-->            
            <div id="paginator"></div>
          </div><!--/row-->  
