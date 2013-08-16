<?php
	global $user_category_detail,$user_articles_detail;
	global $page_setting;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="html/text; charset=utf-8" />
    <title>PHP Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }

      @media (max-width: 980px) {
        /* Enable use of floated navbar text */
        .navbar-text.pull-right {
          float: none;
          padding-left: 5px;
          padding-right: 5px;
        }
      }
    </style>
    <link href="bootstrap/bootstrap-responsive.css" rel="stylesheet">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
    <![endif]-->
    <!-- Fav and touch icons -->
  </head>

  <body>
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid"> <!-- ;text-align ='center' -->
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="">PHP Blog</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              	登录： <a href="" class="navbar-link">PHP Team</a>
            </p>           
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row-fluid">
        <?php 
        	// 默认首页为：用户导航+article_list
        	if(empty($_GET))
        	{
        		require_once("user_nav.php");
        	}
        	// 后面就是：cat导航+article_list
        	else
        		require_once("category_nav.php");
         ?>



        <div class="span9">  
          <?php
          	foreach($user_articles_detail as $key=>$values)
   			{   	
   				?>
   				 <div class="row-fluid">              
           		 	<div class="hero-unit">
           		 		<h3><?php echo $values["article_name"]?></h3>
              			<p><?php echo substr($values["article_content"],0,120)?></p>
              			<p><a class="btn" href="?<?php echo "article_uid=".$values["article_uid"]?>">更多 &raquo;</a></p>
            		</div>
            	 </div>
   				<?php
   			}          
          ?>            
              <!--/span-->
            <!--/span-->            
            <div id="paginator"></div>
          </div><!--/row-->  




            
        </div><!--/span-->
      </div><!--/row-->      
      <hr>
      <footer>
        <p class="text-align:center;">&copy; Company 2013  &nbsp;&nbsp;&nbsp; PHP TEAM</p>
      </footer>
    </div><!--/.fluid-container-->
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <link href="bootstrap/css/bootstrap-combined.min.css" rel="stylesheet">
    <script src="bootstrap/js/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap-paginator.js"></script>
  </body>

  <!-- detail information : http://bootstrappaginator.org/-->
  <script type='text/javascript'>
        var options = {
            currentPage: 1,
            totalPages: <?php echo $page_setting["pages"]; ?>,
            size:'normal',
            alignment:'right',
            onPageChanged: function(e,oldPage,newPage){
                $('#alert-content').text("Current page changed, old: "+oldPage+" new: "+newPage);
            }
        }
        $('#paginator').bootstrapPaginator(options);
    </script>
</html>