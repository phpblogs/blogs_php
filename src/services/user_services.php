<?php
/**
 * UserService 用户处理类
 * @author xz
 * @date 2013��8��14��
 * @todo 
 */
class UserService
{
	/** 
    * 
    * 获得数据库中所有的user
    *     
    * @return array 返回$all_users数组
    *                             
    */
	public function getAllUsers()
	{
		global $db,$charset;		
		$basic_sql = "select * from users where 1=1";
		$query = $basic_sql;			
		$all_users = $db->get_all($query);
		return 	$all_users;	
	}	
	
}
?>
