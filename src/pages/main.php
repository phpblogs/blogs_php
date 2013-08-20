<?php
	global $category_service,$articles_service,$user_service,$user_category_article_detail;	  	 
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
        padding-top: 100px;
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
          <a class="brand" href="http://phpblog.com/">PHP Blog</a>
          <div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              	登录： <a href="" class="navbar-link">PHP Team</a>
            </p>           
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container-fluid" >
      <div class="row-fluid" >
        <?php         
        	$all_users = $user_service->getAllUsers();        	
        	$uid_session_get = empty($_GET["user_uid"])?$_GET["user_uid"]:$_SESSION["user_uid"];
        	// 默认值
            if(empty($_GET)) 
            {
 
	        //$uid_session_get = "u1";
	 
	        //$cid_session_get = "all";       
	
	        
	
	        $_SESSION["user_uid"] = "";
	 
	        $_SESSION["category_uid"]= "all";  

         }
 
        else
 
        {
 
	        if(empty($_GET["user_uid"]))
	 
	        {
	 
	        	$uid_session_get = $_SESSION["user_uid"];
	 
	        }
	 
	        else //第一次进入user所对应的session设置
	 
	        {
	 
		        $_SESSION["user_uid"]=$_GET["user_uid"];
		 
		        $uid_session_get = $_GET["user_uid"];
	 
	        }
 
        } 
        

		if(empty($_GET["category_uid"]))
 
        {
 
        	$cid_session_get = $_SESSION["category_uid"];
 
        }
 
        else 
        {
 
	        $_SESSION["category_uid"]=$_GET["category_uid"];
	 
	        $cid_session_get = $_GET["category_uid"];
 
        } 
        
        	
        	$uid = $uid_session_get;
        	$user_category_detail = $category_service->getUserCategoryDetail($uid);
        	
			$user_articles_detail = $articles_service->getUserArticleDetail($uid);
			$user_category_article_detail = $articles_service->getUserArticleCategoryDetail($uid_session_get,$cid_session_get);
		
		
			
			if(empty($_SESSION["user_uid"])){
				
				$count = $articles_service->getAllArticlesLength();	
			}
			else{
				if($_SESSION["category_uid"]==="all"){
					$count = $articles_service->getUserArticlesLength($_SESSION["user_uid"]);
				}
				else{
					$count = $articles_service->getUserCategoryArticlesLength($_SESSION["user_uid"],$_SESSION["category_uid"]);
				
				}
			}
			
			// 获得分页相关信息
			$page_setting = $articles_service->getPageSetting($count);		
       	
        	// 默认首页为：用户导航+article_list
        	if(empty($_GET))
        	{
        		require_once("user_nav.php");
        	}
        	// 后面就是：cat导航+article_list
        	else
        	{        		
        		require("category_nav.php");
        	}	
        	
        	
        	?>
        	
        	<div class = "content">        	
  			
  			</div> <!--content--> 
  			<div id="paginator" ></div> 		
        </div><!--/span-->
         
      </div><!--/row-->    
       
      </br></br><hr>
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
 	var u = "<?php echo $uid; ?>";
 	$(document).ready(function(){               
	//var path = <?php echo DIR_WS_PAGES?>;
	//alert(path);
    $(".content").load("src/pages/article_list.php");
             
});

 function getArticleDetail(uid,more){	
		//var path = <?php echo DIR_WS_PAGES?>;
	    
		 $.post("src/pages/article_detail.php?article_uid="+uid+"&more="+more,{},function(result){
			     $("#"+uid).html(result);				
				 //$(".span9").html(result);			
				 });	
	 	}
        var options = {
            currentPage: 1,
            totalPages: <?php echo $page_setting["pages"]; ?>,            
            size:'normal',
            alignment:'center', //right
            onPageChanged: function(e,oldPage,newPage){
                $('#alert-content').text("Current page changed, old: "+oldPage+" new: "+newPage);              
                var para ="page="+newPage+"&uid="+u;             
                 $.post("src/pages/article_list.php?"+para,{page:newPage},function(result){              		
    				$(".content").html(result);
              		 });                
            }
        }
        $('#paginator').bootstrapPaginator(options);      
    </script>
</html>
