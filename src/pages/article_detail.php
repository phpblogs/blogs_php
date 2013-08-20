<?php
	global $article_detail;

?>


<div class="span9">  
	<div class="row-fluid">
	   <div class="hero-unit">
           <h3 ><?php echo $article_detail[0]['article_name']?></h3>
           <p style="font-size:50%"><?php echo $article_detail[0]['article_moddate']."</br>";?>
           <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $article_detail[0]['article_content']?></p>
          </div><!--/row--> 
       </div>
</div>


