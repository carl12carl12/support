<?php
/**
 * 系统常量定义配置
 * 
 * @author Camelot Lin
 * @version 1.0
 */
// library库目录
define('PATH_LIBRARY', PATH_ROOT . 'library' . DIRECTORY_SEPARATOR);

// config文件目录
define('PATH_CONFIG', PATH_ROOT . 'config' . DIRECTORY_SEPARATOR);

// event事件目录
define('PATH_EVENT', PATH_ROOT . 'event' . DIRECTORY_SEPARATOR);

// module模块目录
define('PATH_MODULE', PATH_ROOT . 'module' . DIRECTORY_SEPARATOR);

// cache缓存目录
define('PATH_CACHE', PATH_ROOT . 'cache' . DIRECTORY_SEPARATOR);

// template模板及语言包所在住目录，模版在此目录的template目录下，语言包在此目录的language目录下
define('PATH_TEMPLATE', PATH_ROOT . 'theme' . DIRECTORY_SEPARATOR . 'default' . DIRECTORY_SEPARATOR);

// 程序相对路径，在某些情况下，如虚拟目录等，程序无法自动获得针对于域名的相对路径，需要自定义相对路径，必须已/结尾
define('VIRTUALDIR', '');
