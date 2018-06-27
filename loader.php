<?php
/**
 * 公用文件，初始化基本的内容
 */
// 定义程序绝对目录
define('PATH_ROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
// 载入常量定义
require PATH_ROOT . 'define.cfg.php';
/**
 * 自动加载类函数
 * 
 * @param string $require require的路径
 */
function coreLoader(string $class) {
	$class = strtolower($class);
	if (file_exists(PATH_LIBRARY . $class . '.class.php')) {
		require PATH_LIBRARY . $class . '.class.php';
	} else {
		// 查找模块
		$module = strtok($class, '_');
		// 如果有_，查找模块下子类
		if ($module !== $class) {
			$class = strtok('');
		}
		if (file_exists(PATH_MODULE . $module . DIRECTORY_SEPARATOR . $class . '.class.php')) {
			require PATH_MODULE . $module . DIRECTORY_SEPARATOR . $class . '.class.php';
		}
	}
	// elseif (strpos($class, '_')) {
		// $module = strtok($class, '_');
		// $class = strtok('');
		// if (file_exists('module' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $class . '.class.php')) {
			// require 'module' . DIRECTORY_SEPARATOR . $module . DIRECTORY_SEPARATOR . $class . '.class.php';
		// }
	// }
}
// 注册自动加载类
spl_autoload_register('coreLoader');
/**
 * 自定义错误处理函数
 * 
 * @param integer $errno 错误代码
 * @param string $errstr 错误的具体信息
 * @param string $errfile 发生错误的文件
 * @param integer $errline 错误所在行
 * @param integer $errcontext 错误发生时的上下文信息
 */
function coreError(int $errno, string $errstr, string $errfile = '', int $errline = 0, array $errcontext = array()) {
	var_dump($errno, $errstr, $errfile, $errline, $errcontext);
	return TRUE;
}
// 注册自定义错误处理
set_error_handler('coreError');
/**
 * 自定义异常处理函数
 * 
 * @param Throwable $ex 异常
 * @param string $errstr 错误的具体信息
 * @param string $errfile 发生错误的文件
 * @param integer $errline 错误所在行
 * @param integer $errcontext 错误发生时的上下文信息
 */
function coreException(Throwable $ex) {
	var_dump($ex);
}
// 注册自定义异常处理
set_exception_handler('coreException');
// 载入基础配置文件
require PATH_CONFIG . 'global.cfg.php';

// 初始化些变量
$_now = time();
$_ip = Fun::remoteip();
// 载入整体配置
$_system = System::config();
// 获取用户状态
$session =& User::session();
// 初始化当前用户时区
date_default_timezone_set(Fun::timezone());

// 触发系统初始事件
$error = System::event('system', 'onLoad');
if ($error !== false) {
	$_page->promptinfo[] = $error;
}
if ($_system['init']) {
	require 'init.inc.php';
}