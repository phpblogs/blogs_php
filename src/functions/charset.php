<?php
/**
 * Charset 字符编码类
 * @author xz
 * @date 2013��8��14��
 * @todo 
 */ 
class Charset
{
	/** 
    	* 
    	* UTF8转成GBK 
    	* @param $str 给定的字符串
    	* @return string 成功进行转换后的$str
    	*                             
    	*/
	public function UTF82GBK($str)
	{
		$str = urlencode(iconv('UTF-8', 'GB2312', $str));
		return $str;
	}
}
?>
