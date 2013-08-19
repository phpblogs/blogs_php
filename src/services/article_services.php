<?php

/**
 * ArticleService article处理类
 * @author xz 
 * @date 2013��8��14��
 * @todo 
 */ 
 class ArticleService {	
	/** 
    * 
    * 数据库连接测试 
    *     
    * @return array 连接成功
    *                             
    */
	public function db_connect() //连接数据库 
	{
		@ $links = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
		if (!$links) {
			throw new Exception('连接数据库失败!请重试!');
			die();
		}
		echo 'Connected successfully';
		@ mysql_select_db('blog');
		return $links;
	}
	
	/** 
    * 
    * 获得$aid对应的article
    *     
    * @param string $aid article的ID
    * @return array 返回$one_articles数组
    *                             
    */
	public function getArticleById($aid) {
		global $db,$charset;		
		$basic_sql = "select * from article where 1=1 and article_uid= '".$aid."'";
		$query = $basic_sql;			
		$one_articles = $db->get_all($query);
		return 	$one_articles;	
	}

	/** 
    * 
    * 获得数据库中所有的article
    *     
    * @return array 返回$all_articles数组
    *                             
    */
	public function getAllArticles() {
		global $db,$charset;		
		$basic_sql = "select * from article where 1=1";
		$query = $basic_sql;			
		$all_articles = $db->get_all($query);
		/*$i = 0;
		$result = array();
		while($row = &mysql_fetch_array($query,MYSQL_ASSOC)) {
			$result[$i]=$row;
			$i++;
		}
		$DB->write_log("获取全部记录 ".$query);	*/			
		//var_dump($all_articles);
		//echo json_encode($result); //json格式字符处理
		return 	$all_articles;	
	}

	/** 
    * 
    * 获得指定category对应的articles
    *     
    * @param string $cid 
    * @return array 返回$category_articles数组
    *                             
    */
	public function getArticlesByCategory($cid) {
		global $db,$charset;
		$basic_sql = "select * from article where 1=1";
		$query = $basic_sql." and category_uid = '".$cid."'";				
		$category_articles = $db->get_all($query); //使用get_one()，获取array长度时候有问题。因为组成的array格式有问题
		//var_dump($category_articles);		
		return $category_articles;
	}
	
	/** 
    * 
    * 从category_article视图中，获得指定category对应的articles
    *     
    * @param string $cid 
    * @return array 返回$category_articles数组
    *                             
    */
	public function getArticlesByCategoryFromViews($cid){
		global $db,$charset;
		$basic_sql = "select * from category_article where 1=1";
		$query = $basic_sql." and category_uid = '".$cid."'";				
		$category_articles = $db->get_all($query); //使用get_one()，获取array长度时候有问题。因为组成的array格式有问题
		//var_dump($category_articles);		
		return $category_articles;
	}
	
	/** 
    * 
    * 获得所有articles的数目
    *     
    * @return int 返回所有articles的长度
    *                             
    */
	public function getAllArticlesLength() {
		$all_articles = $this->getAllArticles();
		$len = 0;
		foreach($all_articles as $key)
		{
			$len+=1;
		}		
		return $len;
	}
	
	/** 
    * 
    * 获得指定类别下文章的数目
    *     
    * @param string $cid category分类
    * @return int 返回指定类别下articles的长度
    *                             
    */
	public function getArticlesByCategoryLength($cid) {
		$cat_articles = $this->getArticlesByCategory($cid);			
		$len = 0;
		foreach($cat_articles as $key)
		{			
			$len+=1;
		}		
		return $len;
	}
	
	/** 
    * 
    * 获得用户所有的articles数目
    *     
    * @param string $uid 用户id
    * @return int 返回用户articles的长度
    *                             
    */
	public function getUserArticlesLength($uid)
	{
		global $category_service;
		$user_category = $category_service->getUserCategory($uid);								
		$user_article_number = 0;		
		foreach($user_category as $key=>$value)
		{
			$len = $this->getArticlesByCategoryLength($value["category_uid"]);					
			$user_article_number+=$len;
		}
		return $user_article_number;
	}
	
	/** 
    * 
    * 获得$uid用户所对应的articles明细
    * select * from article a where a.category_uid in (select category_uid from category where user_uid = "u1")
    *     
    * @param string $uid 用户id
    * @return array 返回用户$user_articles_detail的长度
    *                             
    */
	public function getUserArticleDetail($uid='u1')
	{
		global $category_service;		
		global $db,$charset;
		$basic_sql = "select * from article where 1=1";
		$query = $basic_sql." and category_uid in ("."select category_uid from category where user_uid = '".$uid."')";				
		$user_articles = $db->get_all($query); //使用get_one()，获取array长度时候有问题。因为组成的array格式有问题	
										
		$user_articles_detail = array(); //user_article明细	
		foreach($user_articles as $key=>$value)
		{
			$user_articles_detail[] = $value;
		} 		
		return $user_articles_detail;
	}
	
	/** 
    * 
    * 获得$uid用户，指定category目录下的articles明细
    * select * from article a where a.category_uid in (select category_uid from category where user_uid = "u1")
    *     
    * @param string $uid 用户id
    * @param string $cid cetegory分类id
    * @return array 返回用户$user_category_articles_detail的长度
    *                             
    */
	public function getUserArticleCategoryDetail($uid='u1',$cid)
	{
		global $category_service;		
		global $db,$charset;
		$basic_sql = "select * from article where 1=1";
		$query = $basic_sql." and category_uid in ("."select category_uid from category where user_uid = '".$uid."' and category_uid ='".$cid."')";				
		$user_articles = $db->get_all($query); //使用get_one()，获取array长度时候有问题。因为组成的array格式有问题	
										
		$user_category_articles_detail = array(); //user_article明细	
		foreach($user_articles as $key=>$value)
		{
			$user_category_articles_detail[] = $value;
		} 		
		return $user_category_articles_detail;
	}
	
	/** 
    * 
    * 获得$aid文章所对应的article明细
    *     
    * @param string $aid 文章id
    * @return array 返回指定article数组
    *                             
    */
	public function getArticleDetail($aid)
	{
		return $this->getArticleById($aid);
	}
	
	/** 
    * 
    * 页面设置pageSetting
    *     
    * @return array 返回页面配置文件
    *                             
    */
	public function getPageSetting($count)
	{
		$article_number = $this->getAllArticlesLength();//$this->getUserArticlesLength($uid);
		$page_setting["numbers"] = $article_number;
		
		$page_setting["pages"] = ceil($count/PAGESIZE);
		$page_setting["pagesize"] = PAGESIZE;
		return $page_setting;
	}
}
?>
