<?php
/**
 * LOG 日志处理类
 * @author xz
 * @date 2013��8��14��
 * @todo 
 */  
class LOG
{
	// For BI
    const LOG_LEVEL_BI = 0;
    // 程序出错，造成网站某些页面不能访问
    const LOG_LEVEL_ERR = 1;
    // 程序的一些异常分支，不影响网站页面的访问
    const LOG_LEVEL_WARNING = 2;
    // 程序的运行信息，不影响网站页面的访问
    const LOG_LEVEL_INFO = 3;
    // 一些关键代码加debug信息，主要用于测试开发及在线debug
    const LOG_LEVEL_DEBUG = 4;


    // Log切分的控制
    const LOG_NOT_SPLIT = 0;
    const LOG_SPLIT_BY_TIME = 1;
    const LOG_SPLIT_BY_LEVEL = 2;
    const LOG_SPLIT_BY_TIME_AND_LEVEL = 3;

    // 用于按日志级别切分日志
    public static $logLevleWord = array('0'=>'BI',
                                        '1'=>'ERROR',
                                        '2'=>'WARNING',
                                        '3'=>'INFO',
                                        '4'=>'DEBUG',
                                        );
    
    public static function log_bi()
    {
    	
    }       
    public static function log_error()
    {
    	
    }       
    public static function log_warning()
    {
    	
    }   
    public static function log_info()
    {
    	
    }   
    public static function log_debug()
    {
    	
    }   
                                     
}

?>
