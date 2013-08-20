blogs_php
=========
A blog system developed by php which uses the bootstrap to show blogs

 by （php team）
 
 
 一个利用php和bootstrap搭建的blog系统。
 这里面主要用到的技术思想：
 1、类MVC思想：将model view和具体的control进行分离；（具体可参考zen-cart和YII的mvc思想）
 2、页面的模块化：将页面进行分块，方便页面的管理和操作；同时也方便页面的widget和模块化；
 3、利用memcache对常见的数据进行缓存，减少服务器端的压力；
 4、加入log日志处理功能，方便对数据库操作的查看；
 5、实现blog的配置化管理，一些常见的数据信息都配置在configure.php中；
 6、变量保存及session跨页面传值；
 7、PHP编码问题（UTF-8）；
 8、ajax无刷新翻页；
 9、......



扩展：
  1、增加blog的其它基本功能；
  2、增加blog的定制化功能
  3、......
