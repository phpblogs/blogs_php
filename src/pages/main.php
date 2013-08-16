<?php
	global $category_service,$articles_service,$user_service;	     
	$page_setting = $articles_service->getPageSetting();	
	
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="content-type" content="html/text; charset=utf-8" />
    <title>PHP Blog</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles
    <link rel="shortcut icon" href="./favicon.ico" type="image/vnd.microsoft.icon">
	<link rel="icon" href="./favicon2.ico" type="image/vnd.microsoft.icon"> 
	-->
	
	<!-- 设置网页图标-->
	<link rel="shortcut icon" href="bootstrap/img/the-letter-m.png" > 
	<!-- 设置地址栏图标-->
	<link rel="icon" type="image/gif" href="bootstrap/img/the-letter-m.png" >
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
        	$all_users = $user_service->getAllUsers();        	
        	$uid_session_get = empty($_GET["user_uid"])?$_GET["user_uid"]:$_SESSION["user_uid"];
        	// 默认值
        	if(empty($_GET))
        	{
        		$uid_session_get = "u1";        		
        	}
        	else
        	{
        		if(empty($_GET["user_uid"]))
        		{
        			$uid_session_get = $_SESSION["user_uid"];
        		}
        		else
        		{
        			$_SESSION["user_uid"]=$_GET["user_uid"];
        			$uid_session_get = $_GET["user_uid"];
        		}
        	}       	
        	if(empty($_GET))
        	{
        		$cid_session_get = "all";        		
        	}
        	else
        	{
        		if(empty($_GET["category_uid"]))
        		{
        			$cid_session_get = $_SESSION["category_uid"];
        		}
        		else
        		{
        			$_SESSION["category_uid"]=$_GET["category_uid"];
        			$cid_session_get = $_GET["category_uid"];
        		}        			
        	} 
        	
        	$uid = $uid_session_get;
        	$user_category_detail = $category_service->getUserCategoryDetail($uid);
			$user_articles_detail = $articles_service->getUserArticleDetail($uid);
			$aid = empty($_GET)?"a1":$_GET["article_uid"];
			$article_detail = $articles_service->getArticleDetail($aid);
       	
        	// 默认首页为：用户导航+article_list
        	if(empty($_GET))
        	{
        		require_once("user_nav.php");
        	}
        	// 后面就是：cat导航+article_list
        	else
        	{
        		//echo "load category_nav";
        		require("category_nav.php");
        	}	
        	
        	// 加载article_list.php
        	if($_GET["category_uid"]||$_GET["user_uid"]||empty($_GET)) 
  			{
  				echo '$_GET["user_uid"]的值为:'.$uid_session_get.', $_GET["category_uid"]的值为:'.$cid_session_get."</br>";
				require_once(DIR_WS_PAGES."article_list.php"); 		
  			}    	
			if($_GET["article_uid"])
			{
				require_once(DIR_WS_PAGES."article_detail.php");
			}	
         ?>          
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
