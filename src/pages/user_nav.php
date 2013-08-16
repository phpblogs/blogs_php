<?php
	global $all_users;
?>

<div class="span3">
          <div class="well sidebar-nav">
            <ul class="nav nav-list">
              <li class="nav-header">所有用户</li>              
              <?php 
                $show_user = 0;              	
   				foreach($all_users as $key=>$values)
   				{
   					if($show_user>10)
   					{
   						echo "....";
   						break;
   					}
   					$show_user+=1;
   					$user_uid = $values["user_uid"];   					
   					$user_name = $values["user_name"];		   					
   					?>
	   				<li><a href="<?php echo "?user_uid=".$user_uid;?>">
	   					<?php echo $user_name;?>
	   				</a></li>
	   				<?php  					
   				}
              ?>                           
            </ul>
          </div><!--/.well -->
        </div><!--/span-->