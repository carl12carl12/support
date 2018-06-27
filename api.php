<?php
/**
 * 默认入口
 * 
 * @author Camelot Lin
 * @version 1.0
 */
require 'loader.php';
$module = preg_replace('/[^a-z0-9_]/i', '', Request::get('m'));
$controller = preg_replace('/[^a-z0-9_]/i', '', Request::get('c'));
$action = strtolower(preg_replace('/[^a-z0-9_]/i', '', Request::get('a')));
$class = $module . '_' . $controller;
if (!$action) {
	$action = 'do';
}

$return = array(
	'error' => array(
		'code' => 0,
		'message' => ''
	),
	'data' => array()
);

try {
	$class::$action($return);
} catch (Error $e) {
    var_dump($e);
	$return['error']['code'] = 999;
	$return['error']['message'] = 'Unknow error!';
}

echo json_encode($return, JSON_FORCE_OBJECT);