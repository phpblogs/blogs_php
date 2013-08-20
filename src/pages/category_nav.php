<?php
	global $user_category_detail;
/*	$uid = empty($_GET)?"u1":$_GET["user_uid"];
	$user_category_detail = $category_service->getUserCategoryDetail($uid);*/
	$last = end($user_category_detail);
?>

<div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list" id="cat_list">
              <li class="nav-header">博客分类</li>
              <li class="active" id='<?php echo $last["cat_name"]?>'><a href="
			  <?php               	
   				$cat_uid = $last["cat_uid"];
   				$number = $last["numbers"];
   				//$_SESSION["category_uid"] = $cat_uid;
              	echo "?category_uid=".$cat_uid ; //echo $cat_uid; 
              ?>
			  " onclick = "javascript:changeCategoryActive('全部博客')">
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
	   					<li id='<?php echo $values["cat_name"]?>'><a href="<?php 
	   							//echo "?".$_SERVER["QUERY_STRING"]."&category_uid=".$cat_uid;
	   							echo "?category_uid=".$cat_uid;
	   							?>" onclick = "javascript:changeCategoryActive('<?php echo $values["cat_name"]?>')">
	   						<?php echo $cat_name."(".$number.")";?>
	   					</a></li>
	   					<?php 
   					}   					
   				}
              ?>                           
            </ul>
          </div><!--/.well -->
        </div><!--/span-->