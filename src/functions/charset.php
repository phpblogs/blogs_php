<?php
/**
 * Charset 字符编码类
 * @author xz
 * @date 2013��8��14��
 * @todo 
 */ 
class Charset
{
	public function UTF82GBK($str)
	{
		$str = urlencode(iconv('UTF-8', 'GB2312', $str));
		return $str;
	}	
	
	public function unicode2utf8($str)
	{

	}
	
}
?>
