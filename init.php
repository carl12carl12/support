<?php
/* Creator: Camelot Lin */
// 初始化資料庫
require 'loader.php';
function &_database() {
	global $_dbconfig;
	$config =& $_dbconfig['_system'];
	$db = DataBase::mysql($config);
	return $db;
}
$db =& _database();

//初始化用户组
$iarr = array();
$iarr['name'] = 'Everyone';
$iarr['nickname'] = 'Everyone';
$iarr['password'] = '';
$iarr['type'] = 0;
$iarr['state'] = 0;
$euid = $db->insert(MS . 'user', $iarr, true);
User::log(8, 0, array('group' => $euid, 'type' => 0), $euid);
//初始化用户组
$iarr = array();
$iarr['name'] = 'admin';
$iarr['nickname'] = 'admin';
$iarr['password'] = md5('123456');
$iarr['type'] = 1;
$iarr['state'] = 0;
$uid = $db->insert(MS . 'user', $iarr, true);
User::log(8, 0, false, $uid);
// 初始化系统配置
$config = array(
	'init' => false,
	'autoreferer' => 2500,
	'lang' => 'chs',
	'langs' => array(
		'chs' => '简体中文',
	),
	'prompt' => 'prompt.tpl.php',
	'autorefresh' => false,
	'timezone' => 'GMT',
);
$iarr = array();
$iarr['parent'] = 0;
$iarr['inherited'] = 0;
$iarr['permission'] = 1;
$iarr['config'] = serialize($config);
$iid = $db->insert(MS . 'item', $iarr, true);
User::log(512, $iid, array('parent' => 0, 'inherited' => 0, 'permission' => 1, 'config' => $config), $uid);
$iarr = array();
$iarr['iid'] = $iid;
$iarr['uid'] = $euid;
$iarr['all'] = 0;
$iarr['read'] = 1;
$iarr['add'] = 0;
$iarr['modify'] = 0;
$iarr['delete'] = 0;
$iarr['expansion'] = serialize(array());
$db->insert(MS . 'permission', $iarr);
$iarr = array();
$iarr['iid'] = $iid;
$iarr['uid'] = $uid;
$iarr['all'] = 0;
$iarr['read'] = 1;
$iarr['add'] = 0;
$iarr['modify'] = 1;
$iarr['delete'] = 0;
$iarr['expansion'] = serialize(array());
$db->insert(MS . 'permission', $iarr);
$iarr = array();
$iarr['name'] = '系统配置';
$iarr['key'] = 'system';
$iarr['iid'] = $iid;
$iarr['url'] = '';
$db->insert(MS . 'module', $iarr);

// 初始化用户配置
$config = array(
	'create' => true,
	'register' => true,
	'maxnamelenght' => 50,
	'changename' => true,
	'guestgroup' => array(1),
	'registergroup' => array(),
	'usergroup' => array(1),
	'sessiontimeout' => 1800,
	'sessionupdate' => 300,
	'loglevel' => 2047,
);
$iarr = array();
$iarr['parent'] = 0;
$iarr['inherited'] = 0;
$iarr['permission'] = 1;
$iarr['config'] = serialize($config);
$iid = $db->insert(MS . 'item', $iarr, true);
User::log(512, $iid, array('parent' => 0, 'inherited' => 0, 'permission' => 1, 'config' => $config), $uid);
$iarr = array();
$iarr['iid'] = $iid;
$iarr['uid'] = $euid;
$iarr['all'] = 0;
$iarr['read'] = 1;
$iarr['add'] = 0;
$iarr['modify'] = 0;
$iarr['delete'] = 0;
$iarr['expansion'] = serialize(array());
$db->insert(MS . 'permission', $iarr);
$iarr = array();
$iarr['iid'] = $iid;
$iarr['uid'] = $uid;
$iarr['all'] = 0;
$iarr['read'] = 1;
$iarr['add'] = 0;
$iarr['modify'] = 1;
$iarr['delete'] = 0;
$iarr['expansion'] = serialize(array());
$db->insert(MS . 'permission', $iarr);
$iarr = array();
$iarr['name'] = '用户配置';
$iarr['key'] = 'user';
$iarr['iid'] = $iid;
$iarr['url'] = '';
$db->insert(MS . 'module', $iarr);

echo 'Ok!' . date('Y-m-d H:i:s');