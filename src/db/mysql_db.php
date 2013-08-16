<?php
/**
 * MysqlDB 数据库操作类
 * @author xz
 * @date 2013��8��14��
 * @todo 
 */ 
Class MysqlDB {

	private $link_id;
	private $handle;
	private $is_log;
	private $time;

	//构造函数
	public function __construct() {
		$this->time = $this->microtime_float();
		$this->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT);
		$this->is_log = DB_LOG;
		if($this->is_log){
			$handle = fopen(DB_LOG_PATH."dblog.txt", "a+");
			$this->handle=$handle;
		}
	}
	
	//数据库连接
	public function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0,$charset='utf8') {
		if( $pconnect==0 ) {
			$this->link_id = @mysql_connect($dbhost, $dbuser, $dbpw, true);
			if(!$this->link_id){
				$this->halt("数据库连接失败");
			}
		} else {
			$this->link_id = @mysql_pconnect($dbhost, $dbuser, $dbpw);
			if(!$this->link_id){
				$this->halt("数据库持久连接失败");
			}
		}
		if(!@mysql_select_db($dbname,$this->link_id)) {
			$this->halt('数据库选择失败');
		}
		@mysql_query("set names ".$charset); // 解决mysql中文 乱码问题
		/*@mysql_query("set names "."utf8");
		@mysql_query("set character_set_client=utf8");  
    	@mysql_query("set character_set_results=utf8"); */
	}
	
	//查询 
	public function query($sql) {
		$this->write_log("查询 ".$sql);
		@mysql_query("set names "."utf8"); // 解决mysql中文 乱码问题
		$query = mysql_query($sql,$this->link_id);
		if(!$query) 
			$this->halt('Query Error: ' . $sql);
		return $query;
	}
	
	//插入
	public function insert($table,$dataArray) {
		$field = "";
		$value = "";
		if( !is_array($dataArray) || count($dataArray)<=0) {
			$this->halt('没有要插入的数据');
			return false;
		}
		while(list($key,$val)=each($dataArray)) {
			$field .="$key,";
			$value .="'$val',";
		}
		$field = substr( $field,0,-1);
		$value = substr( $value,0,-1);
		$sql = "insert into $table($field) values($value)";
		$this->write_log("插入 ".$sql);
		if(!$this->query($sql)) return false;
		return true;
	}
	
	public function insert_a($table, $inserts) {
		$values = array_map('mysql_real_escape_string', array_values($inserts)); // 回调函数
		$keys = array_keys($inserts);
		return mysql_query('INSERT INTO `' . $table . '` (`' . implode('`,`', $keys) . '`) VALUES (\'' . implode('\',\'', $values) . '\')');
	}

	//更新
	public function update( $table,$dataArray,$condition="") {
		if( !is_array($dataArray) || count($dataArray)<=0) {
			$this->halt('没有要更新的数据');
			return false;
		}
		$value = "";
		while( list($key,$val) = each($dataArray))
		$value .= "$key = '$val',";
		$value .= substr( $value,0,-1);
		$sql = "update $table set $value where 1=1 and $condition";
		$this->write_log("更新 ".$sql);
		if(!$this->query($sql)) return false;
		return true;
	}

	//删除
	public function delete( $table,$condition="") {
		if( empty($condition) ) {
			$this->halt('没有设置删除的条件');
			return false;
		}
		$sql = "delete from $table where 1=1 and $condition";
		$this->write_log("删除 ".$sql);
		if(!$this->query($sql)) return false;
		return true;
	}

	//返回结果集
	public function fetch_array($query, $result_type = MYSQL_ASSOC){
		$this->write_log("返回结果集");
		return mysql_fetch_array($query, $result_type);
	}
	
	
	//获取一条记录（MYSQL_ASSOC，MYSQL_NUM，MYSQL_BOTH）:在处理array数据时候有点问题			
	public function get_one($sql,$result_type = MYSQL_ASSOC,$charset='utf8') {
		$query = $this->query($sql);
		$rt =& mysql_fetch_array($query,$result_type);
		$this->write_log("获取一条记录 ".$sql);
		return $rt;
	}

	//获取全部记录
	public function get_all($sql,$result_type = MYSQL_ASSOC,$charset='utf8') {
		$query = $this->query($sql);
		$i = 0;
		$rt = array();
		while($row =& mysql_fetch_array($query,$result_type)) {
			$rt[$i]=$row;
			$i++;			
			/*			
			测试用的数据：
			$this->toString($row);		
			echo json_encode($row);	*/			
			
		}
		$this->write_log("获取全部记录 ".$sql);
		return $rt;
	}
	

	//获取记录条数
	public function num_rows($results) {
		if(!is_bool($results)) {
			$num = mysql_num_rows($results);
			$this->write_log("获取的记录条数为".$num);
			return $num;
		} else {
			return 0;
		}
	}

	//释放结果集
	public function free_result() {
		$void = func_get_args();
		foreach($void as $query) {
			if(is_resource($query) && get_resource_type($query) === 'mysql result') {
				return mysql_free_result($query);
			}
		}
		$this->write_log("释放结果集");
	}

	//获取最后插入的id
	public function insert_id() {
		$id = mysql_insert_id($this->link_id);
		$this->write_log("最后插入的id为".$id);
		return $id;
	}
	
	public function toString($row)
	{
		$ret = "ID: " . $row["category_id"] . " , Name: " . $row["category_name"];
		echo $ret."<br/>";
	}

	//关闭数据库连接
	protected function close() {
		$this->write_log("已关闭数据库连接");
		return @mysql_close($this->link_id);
	}

	//错误提示
	private function halt($msg='') {
		$msg .= "\r\n".mysql_error();
		$this->write_log($msg);
		die($msg);
	}
	
	//获取fields list
	protected function fields_list($table)
	{
		@ $links = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD);
		$fields = mysql_list_fields(DB_DATABASE, $table, $links); // SHOW COLUMNS FROM table [LIKE 'name']
		$columns = mysql_num_fields($fields);
		for ($i = 0; $i < $columns; $i++) {
		    echo mysql_field_name($fields, $i) . "<br/>";
		} 
	}

	//析构函数
	public function __destruct() {
		$this->free_result();
		$use_time = ($this-> microtime_float())-($this->time);
		$this->write_log("完成整个查询任务,所用时间为".$use_time);
		if($this->is_log){
			fclose($this->handle);
		}
	}
	
	//写入日志文件
	public function write_log($msg=''){
		if($this->is_log){
			$text = date("Y-m-d H:i:s")." ".$msg."\r\n";
			fwrite($this->handle,$text);
		}
	}
	
	//获取毫秒数
	public function microtime_float() {
		list($usec, $sec) = explode(" ", microtime());
		return ((float)$usec + (float)$sec);
	}
}

?>