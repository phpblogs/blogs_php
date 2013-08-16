<?php
	global $user_category_detail;
/*	$uid = empty($_GET)?"u1":$_GET["user_uid"];
	$user_category_detail = $category_service->getUserCategoryDetail($uid);*/
	$last = end($user_category_detail);
?>

<div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">博客分类</li>
              <li class="active"><a href="
			  <?php               	
   				$cat_uid = $last["cat_uid"];
   				$number = $last["numbers"];
   				//$_SESSION["category_uid"] = $cat_uid;
              	echo "?category_uid=".$cat_uid ; //echo $cat_uid; 
              ?>
			  ">
              <?php 
   				$cat_name = $last["cat_name"];
   				$number = $last["numbers"];
              	echo $cat_name."(".$number.")";
              ?></a></li>
              <?php               	
   				foreach($user_category_detail as $key=>$values)
   				{
   					if($values["cat_name"] == "全部博客")
   						break;
   					else
   					{
   						$cat_uid = $values["cat_uid"];   					
   						$cat_name = $values["cat_name"];
   						$number = $values["numbers"];
   						//$_SESSION["category_uid"] = $cat_uid; //session操作
   					  	//echo "dd ".$cat_uid.$cat_name.$number;				
   					?>
	   					<li><a href="<?php 
	   							//echo "?".$_SERVER["QUERY_STRING"]."&category_uid=".$cat_uid;
	   							echo "?category_uid=".$cat_uid;
	   							?>">
	   						<?php echo $cat_name."(".$number.")";?>
	   					</a></li>
	   					<?php 
   					}   					
   				}
              ?>                           
            </ul>
          </div><!--/.well -->
        </div><!--/span-->