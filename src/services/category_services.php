<?php
/**
 * CategoryService category处理类
 * @author xz
 * @date 2013��8��14��
 * @todo 
 */ 
class CategoryService
{
	/** 
    * 
    * 获取所有类别信息 
    *     
    * @return array 返回$all_category数组
    *                             
    */ 
	public function getAllCategory() {
		global $db,$charset;
		$basic_sql = "select * from category where 1=1  order by category_adddate";		
		$query = $basic_sql;						
		$all_category = $db->get_all($query);		
		//var_dump($all_category);		
		return $all_category;		
	}
	
	/** 
    * 
    * 从category表中，获取用户所有的类别列表 
    *     
    * @param string $uid 用户对应的唯一user_uid
    * @return array 返回指定用户的category数组
    *                             
    */ 
	public function getUserCategoryList($uid)
	{
		global $db,$charset;
		$basic_sql = "select * from category where 1=1 ";		
		$query = $basic_sql." and user_uid = '" . $uid . "'  order by category_adddate";						
		$user_category = $db->get_all($query);		
		//var_dump($user_category);		
		return $user_category;
	}	

	/** 
    * 
    * 从视图user_category中，获取用户所有的类别信息 
    *     
    * @param string $uid 用户对应的唯一user_uid
    * @return array 返回$user_category数组
    *                             
    */ 
	public function getUserCategoryFromViews($uid)
	{
		global $db,$charset;
		$basic_sql = "select * from user_category where 1=1 ";		
		$query = $basic_sql." and user_uid = '" . $uid . "'  order by category_adddate";						
		$user_category = $db->get_all($query);		
		return $user_category;
	}
	
	/** 
    * 
    * 获得用户category的明细，即：博客name与number及对应的id
    *     
    * @param string $uid 用户对应的唯一user_uid
    * @return array 返回$user_category_detail数组
    *                             
    */ 
	public function getUserCategoryDetail($uid='u1')
	{
		global $articles_service;
		$user_category = $this->getUserCategoryList($uid);					
		$user_category_detail = array(); //user_category明细							
		$article_number = 0;		
		foreach($user_category as $key=>$value)
		{
			$len = $articles_service->getArticlesByCategoryLength($value["category_uid"]);						
			$tmp = array();			
			$tmp["cat_uid"] = $value["category_uid"];
			$tmp["cat_name"] = $value["category_name"];
			$tmp["numbers"] = $len;
			
			$article_number+=$len;
			$user_category_detail[] = $tmp;
		}
		$all = array();
		$all["cat_uid"] = "all";
		$all["cat_name"] = "全部博客";	
		$all["numbers"] = $article_number;//$articles_service->getUserArticlesLength($uid);
		$user_category_detail[] = $all;
		//var_dump($category_detail);
		return $user_category_detail;
	}
	
	/** 
    * 
    * 从category表中，获取用户指定的类别信息 
    *     
    * @param string $uid 用户对应的唯一user_uid
    * @param string $cid 类别对应的唯一category_uid
    * @return array 返回指定用户的category数组
    *                             
    */ 
	public function getUserCategory($uid,$cid){
		global $db,$charset;
		$basic_sql = "select * from category where 1=1 ";		
		$query = $basic_sql." and user_uid = '" . $uid . "'"." and category_id = '".$cid."' order by category_adddate";						
		$user_category = $db->get_all($query);		
		//var_dump($user_category);		
		return $user_category;
		
	}
}
?>
